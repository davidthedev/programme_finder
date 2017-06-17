<?php

namespace App\Views;

abstract class BaseView {
    public static function render($view, $args = [])
    {
        $viewLocation = __DIR__ . '/';
        $viewPath = explode('/', $view);
        // e.g. index.php
        $viewFile = strtolower(end($viewPath)) . '.php';

        array_pop($viewPath);

        $file = implode('/', array_map('ucfirst', $viewPath)) . '/' . $viewFile;

        extract($args);

        require $file;
    }
}
