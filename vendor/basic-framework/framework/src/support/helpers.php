<?php

// dump and die
function dd($data = '') {
    if (!empty($data) || $data == 0) {
        echo '<pre>', var_dump($data), '<pre>';
    }

    die;
}

// dump don't die
function ddd($data) {
    echo '<pre>', print_r($data, true), '</pre>';
}

function makePascalCaseWithSpace($string) {
    return ucwords(str_replace('_', ' ', $string));
}

function makePascalCase($string) {
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
}

function makeStudlyCase($string) {
    return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
}

function redirect($location) {
    return header('Location: ' . $location);
}
