<?php

class Route
{

    public function start()
    {

        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);


        $action = 'action';
//        print_r($url[0]);
//        print_r($url[1]);



        if (empty($url[0]) || $url[0] == 'index.php' || $url[0] == 'index.html') {
            $controller_dir = 'controllers/main.php';
            include $controller_dir;
            $cont = new main();
            $cont->$action();
        }
        else {
            $controller_dir = 'controllers/' . $url[0] . '.php';
            if (file_exists($controller_dir)) {
                include $controller_dir;

                if(!empty($url[1])) {
                    $action = $url[1];
                }

                $cont = new $url[0];

                if(method_exists($url[0], $action)) {
                    $cont->$action();
                } else {
                    $controller_dir = 'controllers/controller_404.php';
                    include $controller_dir;
                    $cont = new controller_404();
                    $cont->action();
                }

            } else {
                $controller_dir = 'controllers/controller_404.php';
                include $controller_dir;
                $cont = new controller_404();
                $cont->action();
            }
        }
    }
}
