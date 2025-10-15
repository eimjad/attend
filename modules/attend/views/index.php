<?php
// this view renders the attendance page. $module_path available from controller
?>

<div class="attend-wrapper">
<h2>Staff Attendance</h2>

<div id="user-info" style="margin-bottom:1em; display:none;">
  <p><strong>Current User:</strong> <span id="user-name"></span><br>
  <strong>Device:</strong> <span id="user-device"></span></p>
</div>

<div id="first-time-form" class="card" style="padding:1em">
  <p>First time on this device? Please enter your details:</p>
  <label>Full name<br>
  <input type="text" id="attend-fullname" placeholder="Full name">
  </label><br>
  <label>Device name<br>
  <input type="text" id="attend-device" placeholder="Device name (e.g. My Phone)">
  </label><br>
  <button id="attend-save-device">Save</button>
</div>

<div id="attend-controls" style="display:auto;">
  
  <textarea id="attend-note" rows="2" placeholder="Add a note if you're outside radius (optional)"></textarea><br>
  
  <button id="btn-in">Clock In</button>
  <button id="btn-out">Clock Out</button>
  <p id="attend-status" style="font-weight:bold;">Checking location...</p>
  <div id="attend-message" style="margin-top:10px;"></div>
</div>

<script>
var ATTEND_MODULE_PATH = '<?=BASE_URL?>attend';

(function () {
  function qs(sel) { return document.querySelector(sel); }

  const storageKey = 'attend_device_info_v1';

  function loadStored() {
    try { return JSON.parse(localStorage.getItem(storageKey)) || null; }
    catch { return null; }
  }

  function saveStored(obj) {
    localStorage.setItem(storageKey, JSON.stringify(obj));
  }

  function showFirstTimeForm(show) {
    const form = qs('#first-time-form');
    const controls = qs('#attend-controls');
    const info = qs('#user-info');
    if (!form || !controls) return;
    form.style.display = show ? 'block' : 'none';
    controls.style.display = show ? 'none' : 'block';
    info.style.display = show ? 'none' : 'block';
  }

  function showUserInfo(info) {
    const elName = qs('#user-name');
    const elDevice = qs('#user-device');
    if (elName && elDevice && info) {
      elName.innerText = info.name || '-';
      elDevice.innerText = info.device || '-';
      qs('#user-info').style.display = 'block';
    }
  }

  function setStatus(txt, color) {
    const el = qs('#attend-status');
    if (el) {
      el.innerText = txt;
      el.style.color = color || 'inherit';
    }
  }

  function haversineDistance(lat1, lon1, lat2, lon2) {
    function toRad(x) { return x * Math.PI / 180; }
    var R = 6371;
    var dLat = toRad(lat2 - lat1);
    var dLon = toRad(lon2 - lon1);
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
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
    }, function () { cb(false, null); }, { enableHighAccuracy:true, timeout:10000 });
  }

  function submitAttendance(action) {
    const info = loadStored();
    if (!info || !info.name || !info.device) {
      alert('Please save your name and device first.');
      return;
    }

    const message = qs('#attend-note').value.trim();

    // setStatus('Getting location...');
    navigator.geolocation.getCurrentPosition(function (pos) {
      postPayload({
        action, 
        name: info.name,
        device: info.device,
        lat: pos.coords.latitude,
        lng: pos.coords.longitude,
        message
      });
    }, function () {
      postPayload({
        action,
        name: info.name,
        device: info.device,
        message
      });
    }, { enableHighAccuracy:true, timeout:8000 });
  }

  function postPayload(payload) {
    // setStatus('Submitting...');
    fetch(ATTEND_MODULE_PATH + '/submit', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(json => {
      if (json.status === 'success') {
        const msg = qs('#attend-message');
        // setStatus('Attendance recorded', json.in_radius ? 'green' : 'red');
        if (msg) {
          msg.innerText = json.message +
            (json.in_radius ? ' (in radius)' : ' (out of radius)');
        }
      } else {
        setStatus('Error: ' + (json.message || 'Unknown'), 'red');
      }
    })
    .catch(() => setStatus('Network error', 'red'));
  }

  document.addEventListener('DOMContentLoaded', function () {
    const stored = loadStored();
    showFirstTimeForm(!stored || !stored.name || !stored.device);
    if (stored && stored.name && stored.device) showUserInfo(stored);

    qs('#attend-save-device').addEventListener('click', function () {
      const name = qs('#attend-fullname').value.trim();
      const device = qs('#attend-device').value.trim();
      if (!name || !device) return alert('Name and device required');
      saveStored({ name, device });
      showUserInfo({ name, device });
      showFirstTimeForm(false);
    });

    const btnIn = qs('#btn-in');
    const btnOut = qs('#btn-out');
    const note = qs('#attend-note');

    if (btnIn) btnIn.addEventListener('click', () => submitAttendance('in'));
    if (btnOut) btnOut.addEventListener('click', () => submitAttendance('out'));

    // Enable buttons when note has text
    if (note) {
      note.addEventListener('input', function () {
        const hasText = note.value.trim().length > 0;
        if (hasText) {
          btnIn.disabled = false;
          btnOut.disabled = false;
        }
      });
    }

    // Office UIN
    // const officeLat = 6.229751;
    // const officeLng = 100.420016;
    // Office Tok Mat
    const officeLat = 6.204174;
    const officeLng = 100.417664;
    // Office Alor Setar
    // const officeLat = 6.103393;
    // const officeLng = 100.352048;
    const allowed = 100;

    checkLocation(allowed, officeLat, officeLng, function (ok) {
      const msg = ok
        ? 'You are within allowed radius'
        : 'You are outside allowed radius';
      setStatus(msg, ok ? 'green' : 'red');
      if (btnIn) btnIn.disabled = !ok;
      if (btnOut) btnOut.disabled = !ok;
    });
  });
})();
</script>
