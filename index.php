<?php

$site_path = dirname(__FILE__);

//Định nghĩa các hằng số ở phần site dùng cho ứng dụng ngoài frontend

define('APP_PATH', $site_path.'/app');
define('CONTROLLER_PATH',$site_path.'/app/controllers');
define('MODEL_PATH',$site_path.'/app/models');
define('VIEW_PATH',$site_path.'/app/views');
define('CORE_PATH',$site_path.'core');
define('DB_PATH',$site_path.'/core/database');
define('HELPER_PATH',$site_path.'/core/helper');
define('URL','http://localhost/phpmvc/');
define('URL_ASSETS','http://localhost/phpmvc/assets/');


spl_autoload_register(function ($class_name) {
    /**
     * Tôi là aql autoload đây
     * Tôi sẽ được chạy ngay khi bạn khởi tạo
     * Một class hoặc bạn sử dụng hàm class_exist()
     */
    $class_file = $class_name . '.php';

    $paths = array(CONTROLLER_PATH,MODEL_PATH,VIEW_PATH,CORE_PATH,DB_PATH,HELPER_PATH);
    if (is_array($paths) && count($paths)) {
        foreach ($paths as $path) {
            $class_file_path = $path .'/'.$class_file;
            if (file_exists($class_file_path)) {
                require $class_file_path;
            }
        }
    }

});

$controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'index';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

$controller = strtolower($controller);
$action = strtolower($action);

$controllerClass = $controller.'Controller';
$actionName = $action.'Action';

echo '<br> tên class controller : ' . $controllerClass;
echo '<br> tên action : ' . $actionName;

if (class_exists($controllerClass)) {
    // class controller có tồn tại
    // new indexController()
    // new articleController()
    // new productController()
    $instanceController = new $controllerClass();

    if (method_exists($instanceController, $actionName)) {
        $instanceController->$actionName();
    } else {
        $instanceController->indexAction();
    }

} else {
    $controllerClass = 'errorController';
    $instanceController = new $controllerClass();
    $instanceController->indexAction();
}
