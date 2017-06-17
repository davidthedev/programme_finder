<?php

namespace App\Controllers;

use App\Services\Protector;
use App\Models\Search;

abstract class BaseController {
    /**
     * Route parameters
     *
     * @var array
     */
    protected $routeParams = [];

    protected $protector;

    protected $search;

    public function __construct($routeParams = [])
    {
        $this->routeParams = $routeParams;
        $this->protector = new Protector;
        $this->search = new Search($this->protector);
    }
}
