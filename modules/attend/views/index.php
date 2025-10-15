<?php
// this view renders the attendance page. $module_path available from controller
?>

<div class="attend-wrapper">
<h2>Attendance</h2>


<div id="first-time-form" class="card" style="padding:1em">
<p>First time on this device? Enter your details:</p>
<label>Full name<br>
<input type="text" id="attend-fullname" placeholder="Full name">
</label><br>
<label>Device name<br>
<input type="text" id="attend-device" placeholder="Device name (e.g. My Phone)">
</label><br>
<button id="attend-save-device">Save</button>
</div>


<div id="attend-controls" style="display:auto;">
<p id="attend-status">Checking location...</p>
<button id="btn-in">Clock In</button>
<button id="btn-out">Clock Out</button>
<div id="attend-message"></div>
</div>


<!-- <hr>
<h3>Monthly Report</h3>
<label>Year: <input type="number" id="report-year" value="<?=date('Y')?>"></label>
<label>Month: <input type="number" id="report-month" value="<?=date('m')?>" min="1" max="12"></label>
<button id="load-report">Load Report</button>
<div id="report-area"></div>
</div> -->


<script>

  // Attendance module frontend logic

var ATTEND_MODULE_PATH = '<?=BASE_URL?>attend';


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
    const form = qs('#first-time-form');
    const controls = qs('#attend-controls');
    if (!form || !controls) return;
    form.style.display = show ? 'block' : 'none';
    controls.style.display = show ? 'none' : 'block';
  }

  function setStatus(txt) {
    const el = qs('#attend-status');
    if (el) el.innerText = txt;
  }

  function haversineDistance(lat1, lon1, lat2, lon2) {
    function toRad(x) { return x * Math.PI / 180; }
    var R = 6371;
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
        const msg = qs('#attend-message');
        if (msg) {
          msg.innerText = json.message +
            (json.in_radius ? ' (in radius)' : ' (out of radius)');
        }
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
    if (!area) return;
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
    if (typeof ATTEND_MODULE_PATH === 'undefined') {
      console.error('ATTEND_MODULE_PATH not defined. Check your view file.');
      return;
    }

    const stored = loadStored();
    showFirstTimeForm(!stored || !stored.name || !stored.device);

    const saveBtn = qs('#attend-save-device');
    if (saveBtn) {
      saveBtn.addEventListener('click', function () {
        const name = qs('#attend-fullname').value.trim();
        const device = qs('#attend-device').value.trim();
        if (!name || !device) {
          alert('Name and device required');
          return;
        }
        saveStored({ name, device });
        showFirstTimeForm(false);
      });
    }

    const btnIn = qs('#btn-in');
    const btnOut = qs('#btn-out');
    if (btnIn) btnIn.addEventListener('click', () => submitAttendance('in'));
    if (btnOut) btnOut.addEventListener('click', () => submitAttendance('out'));

    const reportBtn = qs('#load-report');
    if (reportBtn) {
      reportBtn.addEventListener('click', function () {
        const y = qs('#report-year').value;
        const m = qs('#report-month').value;
        loadReport(y, m);
      });
    }

    // Initial geolocation check
    const officeLat = 6.229751;
    const officeLng = 100.420016;
    // const officeLat = 6.204195;
    // const officeLng = 100.417649;
    const allowed = 100; // meters

    checkLocation(allowed, officeLat, officeLng, function (ok) {
      const msg = ok
        ? 'You are within allowed radius'
        : 'You are outside allowed radius; clock buttons disabled';
      setStatus(msg);
      if (btnIn) btnIn.disabled = !ok;
      if (btnOut) btnOut.disabled = !ok;
    });
  });
})();

</script>
