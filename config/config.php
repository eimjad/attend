<?php
//The main config file
// define('BASE_URL', 'http://kkpk.webmalaya.pro/');
define('BASE_URL', 'http://localhost/attend/');
// define('ENV', 'live');
define('ENV', 'dev');
define('DEFAULT_MODULE', 'welcome');
define('DEFAULT_CONTROLLER', 'Welcome');
define('DEFAULT_METHOD', 'index');
define('MODULE_ASSETS_TRIGGER', '_module');
define('INTERCEPT_404', 'trongate_pages/attempt_display');

date_default_timezone_set('Asia/Kuala_Lumpur');
