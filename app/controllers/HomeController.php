<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->loadView('home', [
            'title' => 'Bem-vindo ao Módulo Financeiro'
        ]);
    }
}
