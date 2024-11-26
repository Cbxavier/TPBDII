<?php

class DashboardController extends Controller
{
    // Método para exibir a página de dashboard
    public function index()
    {
        $this->loadView('dashboard');
    }
}
