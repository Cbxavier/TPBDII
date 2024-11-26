<?php

class ClienteController extends Controller
{
    public function index()
    {
        $this->loadView('cadastrar_cliente');
    }
    
}
