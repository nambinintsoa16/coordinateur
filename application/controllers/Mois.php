<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mois extends My_Controller
{

    public function index()
    {
    }
    public function mois()
    {
        $this->render_view('performance/mois');
    }
}
