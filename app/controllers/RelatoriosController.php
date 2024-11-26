<?php

class RelatoriosController extends Controller
{
    // Método para exibir a página de dashboard
    public function index()
    {
        $this->loadView('relatorios');
    }
}
