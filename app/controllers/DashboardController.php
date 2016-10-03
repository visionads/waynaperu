<?php

class DashboardController extends BaseController
{
    /**
    * Index loggued page
    */
    public function index()
    {
        return View::make('admin.dashboard');
    }
}
