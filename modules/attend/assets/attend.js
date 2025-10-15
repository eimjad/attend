// public/modules/attend/js/attend.js
// Attendance module frontend logic
// 2-space indentation

(function () {
  function qs(sel) { return document.querySelector(sel); }
  function qsa(sel) { return document.querySelectorAll(sel); }

  const storageKey = 'attend_device_info_v1';

  function loadStored() {
    try {
      const raw = localStorage.getItem(storageKey);
      return raw ? JSON.parse(raw) : null;
    } catch (err) { return null; }
  }

  function saveStored(obj) {
    localStorage.setItem(storageKey, JSON.stringify(obj));
  }

  function showFirstTimeForm(show) {
    qs('#first-time-form').style.display = show ? 'block' : 'none';
    qs('#attend-controls').style.display = show ? 'none' : 'block';
  }

  function setStatus(txt) {
    qs('#attend-status').innerText = txt;
  }

  function haversineDistance(lat1, lon1, lat2, lon2) {
    function toRad(x) { return x * Math.PI / 180; }
    var R = 6371; // km
    var dLat = toRad(lat2 - lat1);
    var dLon = toRad(lon2 - lon1);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  function checkLocation(allowedRadiusM, officeLat, officeLng, cb) {
    if (!navigator.geolocation) {
      cb(false, null);
      return;
    }

    navigator.geolocation.getCurrentPosition(function (pos) {
      const lat = pos.coords.latitude;
      const lng = pos.coords.longitude;
      const distance = haversineDistance(lat, lng, officeLat, officeLng) * 1000;
      cb(distance <= allowedRadiusM, { lat, lng, distance });
    }, function () {
      cb(false, null);
    }, { enableHighAccuracy: true, timeout: 10000 });
  }

  function submitAttendance(action) {
    const info = loadStored();
    if (!info || !info.name || !info.device) {
      alert('Please save your name and device first.');
      return;
    }

    setStatus('Getting location...');
    navigator.geolocation.getCurrentPosition(function (pos) {
      const lat = pos.coords.latitude;
      const lng = pos.coords.longitude;
      postPayload({ action, name: info.name, device: info.device, lat, lng });
    }, function () {
      // still allow without location
      postPayload({ action, name: info.name, device: info.device });
    }, { enableHighAccuracy: true, timeout: 8000 });
  }

  function postPayload(payload) {
    setStatus('Submitting...');
    fetch(ATTEND_MODULE_PATH + '/submit', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(json => {
      if (json.status === 'success') {
        setStatus('Saved.');
        qs('#attend-message').innerText = json.message +
          (json.in_radius ? ' (in radius)' : ' (out of radius)');
      } else {
        setStatus('Error: ' + (json.message || 'Unknown'));
      }
    })
    .catch(() => {
      setStatus('Network error');
    });
  }

  function loadReport(year, month) {
    setStatus('Loading report...');
    fetch(ATTEND_MODULE_PATH + '/monthly_report/' + year + '/' + ('0' + month).slice(-2), {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(json => {
      if (json.status === 'success') {
        renderReport(json.report);
        setStatus('Report loaded');
      } else {
        setStatus('Failed to load report');
      }
    })
    .catch(() => setStatus('Network error'));
  }

  function renderReport(report) {
    const area = qs('#report-area');
    if (!report || report.length === 0) {
      area.innerHTML = '<p>No data</p>';
      return;
    }

    let html = '<table class="attend-report-table"><thead><tr>' +
               '<th>User</th><th>Device</th><th>Date</th><th>In</th><th>Out</th><th>Hours</th>' +
               '</tr></thead><tbody>';
    report.forEach(r => {
      html += '<tr>' +
        '<td>' + escapeHtml(r.user_name) + '</td>' +
        '<td>' + escapeHtml(r.device_name) + '</td>' +
        '<td>' + r.day + '</td>' +
        '<td>' + (r.first_in || '-') + '</td>' +
        '<td>' + (r.last_out || '-') + '</td>' +
        '<td>' + (r.worked_hours || '0') + '</td>' +
      '</tr>';
    });
    html += '</tbody></table>';
    area.innerHTML = html;
  }

  function escapeHtml(s) {
    return String(s).replace(/[&<>\"']/g, c => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '\"': '&quot;', '\'': '&#39;'
    }[c]));
  }

  document.addEventListener('DOMContentLoaded', function () {
    const stored = loadStored();
    if (!stored || !stored.name || !stored.device) {
      showFirstTimeForm(true);
    } else {
      showFirstTimeForm(false);
    }

    qs('#attend-save-device').addEventListener('click', function () {
      const name = qs('#attend-fullname').value.trim();
      const device = qs('#attend-device').value.trim();
      if (!name || !device) {
        alert('Name and device required');
        return;
      }
      saveStored({ name, device });
      showFirstTimeForm(false);
    });

    qs('#btn-in').addEventListener('click', function () { submitAttendance('in'); });
    qs('#btn-out').addEventListener('click', function () { submitAttendance('out'); });

    qs('#load-report').addEventListener('click', function () {
      const y = qs('#report-year').value;
      const m = qs('#report-month').value;
      loadReport(y, m);
    });

    // initial geolocation check (must match server-side coords)
    const officeLat = 6.476;  // update to your office location
    const officeLng = 100.366;
    const allowed = 100;      // meters

    checkLocation(allowed, officeLat, officeLng, function (ok) {
      if (ok) {
        setStatus('You are within allowed radius');
        qs('#btn-in').disabled = false;
        qs('#btn-out').disabled = false;
      } else {
        setStatus('You are outside allowed radius; clock buttons disabled');
        qs('#btn-in').disabled = true;
        qs('#btn-out').disabled = true;
      }
    });
  });
})();
