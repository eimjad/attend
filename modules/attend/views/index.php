<?php
// this view renders the attendance page. $module_path available from controller
?>


<div class="attend-wrapper">
<h2>Attendance</h2>


<div id="first-time-form" class="card">
<p>First time on this device? Enter your details:</p>
<label>Full name<br>
<input type="text" id="attend-fullname" placeholder="Full name">
</label><br>
<label>Device name<br>
<input type="text" id="attend-device" placeholder="Device name (e.g. My Phone)">
</label><br>
<button id="attend-save-device">Save</button>
</div>


<div id="attend-controls" style="display:none;">
<p id="attend-status">Checking location...</p>
<button id="btn-in">Clock In</button>
<button id="btn-out">Clock Out</button>
<div id="attend-message"></div>
</div>


<hr>
<h3>Monthly Report</h3>
<label>Year: <input type="number" id="report-year" value="<?=date('Y')?>"></label>
<label>Month: <input type="number" id="report-month" value="<?=date('m')?>" min="1" max="12"></label>
<button id="load-report">Load Report</button>
<div id="report-area"></div>
</div>


<link rel="stylesheet" href="<?=BASE_URL?>public/modules/attend/css/attend.css">
<script>
var ATTEND_MODULE_PATH = '<?=BASE_URL?>modules/attend';
</script>
<script src="<?=BASE_URL?>public/modules/attend/assets/attend.js"></script>