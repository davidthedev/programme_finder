<?php

namespace App\Controllers;

use App\Views\BaseView as BaseView;
use App\Controllers\BaseController as BaseController;

class ErrorController extends BaseController
{
    public function index()
    {
        die('There has been an error, most like due to the fact that the route is not supported yet.');
    }
}
