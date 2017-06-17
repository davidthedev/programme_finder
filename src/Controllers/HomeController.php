<?php

namespace App\Controllers;

use App\Views\BaseView as BaseView;
use App\Controllers\BaseController as BaseController;

class HomeController extends BaseController
{
    /**
     * Home
     *
     * @return void
     */
    public function index()
    {
        $results = '';

        if (isset($_GET['search'])) {
            $this->search->setDataSource('https://rmp.files.bbci.co.uk/technical-test/source-data.json');
            $this->search->setImgUrl('https://ichef.bbci.co.uk/images/ic/480x270/');
            $this->search->setSearchTerm($_GET['search']);
            $results = $this->search->getResults();
        }

        // check for AJAX calls
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            BaseView::render('home/partials/results', array('results' => $results));
        } else {
            BaseView::render('home/index', array('results' => $results));
        }
    }
}
