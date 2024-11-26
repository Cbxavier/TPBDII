<?php

class View {
    public function render($view, $data = []) {
        // Extrai os dados para a variável de array
        extract($data);
        
        // Inclui a view
        require_once ROOT . '/app/views/' . $view . '.php';
    }
}
