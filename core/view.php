<?php

class View {

    public function render($content_view, $name, $data = null)
    {
        require 'views/' . $name;
    }
}