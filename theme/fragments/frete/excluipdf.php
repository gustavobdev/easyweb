<?php
use CoffeeCode\Router\Router;
use Source\Models\Documento_Frete;

$router = new Router(URL_BASE);
$docfrete = (new Documento_Frete())->findById("{$data['pdf']}");
 
//echo "<pre>",var_dump($docfrete), "</pre>";

$docfrete->destroy();

 $arquivo = $docfrete->caminho;

if (file_exists($arquivo)) {
    unlink(dirname(__FILE__) . "/../../../" . $arquivo);
    $msg = "Documento excluído com sucesso";
    echo json_encode(array("msg" => $msg, "icon" => "success", "title" => "Feito!", "pdf" => $data["pdf"]));
}else{
    $msg = "Algo de errado aconteceu e seu PDF não foi encontrado!";
    echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!"));
}
//$router->redirect("console/fretespdf");
