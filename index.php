<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set("error_log", "php—error.log");
error_log('==================================================');
error_log("Inicio de aplicacion");

require_once 'libs/database.php';

require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/app.php';

require_once 'classes/session.php';
require_once 'classes/sessionController.php';
require_once 'classes/successMessages.php';
require_once 'classes/errorMessages.php';

include_once 'Model/User.php';
require_once 'Config/config.php';
$app = new App();
