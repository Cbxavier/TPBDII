<?php
require_once '../config/config.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard/index';
$urlParts = explode('/', trim($url, '/'));

// Remova qualquer extensão .php do nome do controlador
$controllerBaseName = pathinfo($urlParts[0], PATHINFO_FILENAME);
$controllerName = ucfirst($controllerBaseName) . 'Controller';

// Determine o nome do método
$methodName = $urlParts[1] ?? 'index';

// Construa o caminho correto do arquivo do controlador
$controllerPath = "../app/controllers/{$controllerName}.php";

try {
    // Verifique se o controlador existe
    if (!file_exists($controllerPath)) {
        throw new Exception("Arquivo do controlador '{$controllerName}' não encontrado em '{$controllerPath}'");
    }

    require_once $controllerPath;

    // Verifique se a classe do controlador existe
    if (!class_exists($controllerName)) {
        throw new Exception("Classe '{$controllerName}' não encontrada no arquivo '{$controllerPath}'");
    }

    $controller = new $controllerName();

    // Verifique se o método existe no controlador
    if (!method_exists($controller, $methodName)) {
        throw new Exception("Método '{$methodName}' não encontrado no controlador '{$controllerName}'");
    }

    // Chame o método do controlador
    $controller->{$methodName}();
} catch (Exception $e) {
    // Tratamento de erros
    die("Erro: " . $e->getMessage());
}
