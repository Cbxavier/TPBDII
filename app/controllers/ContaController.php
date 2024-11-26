<?php

class ContaController extends Controller
{
    public function index()
    {
        $this->loadView('cadastrar_conta');
    }
}
