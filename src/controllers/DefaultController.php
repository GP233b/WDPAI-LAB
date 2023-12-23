<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }

    public function home()
    {
        $this->render('home');
    }

    public function licytacje()
    {
        $this->render('licytacje');
    }
    public function licytacje_archiwalne()
    {
        $this->render('licytacje_archiwalne');
    }
    public function moje_licytacje()
    {
        $this->render('moje_licytacje');
    }
}