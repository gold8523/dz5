<?php
require_once dirname(__DIR__).'/vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

class View {

    private $twig;

    function __construct()
    {
        $loader = new Twig_Loader_Filesystem(dirname(__DIR__).'/views/twig');
        $twig = new Twig_Environment($loader, array(
            'cache' => false
        ));
        $this->twig = $twig;

    }

//    public function render($content_view, $name, $data = null)
//    {
//        require 'views/' . $name;
//    }

    function generate($content_view, $data = []) {

        echo $this->twig->render($content_view, $data);

    }

}