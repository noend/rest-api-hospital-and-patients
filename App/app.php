<?php
const ROOT_PATH = __DIR__ . "/../";

// Composer autoload
include __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->safeLoad();

// include helper file
require_once ROOT_PATH . "/App/Helpers/router.php";

//// include lib file
require_once ROOT_PATH . "/Lib/Config.php";


//
//// include the routes
require_once ROOT_PATH . "/Lib/routes.php";
//
//// include the base controller file
require_once ROOT_PATH . "/App/Controllers/BaseController.php";
require_once ROOT_PATH . "/App/Controllers/UsersController.php";
require_once ROOT_PATH . "/App/Controllers/HospitalsController.php";

// include the use model file
require_once ROOT_PATH . "/App/Models/BaseModel.php";
require_once ROOT_PATH . "/App/Models/User.php";
require_once ROOT_PATH . "/App/Models/Hospital.php";
