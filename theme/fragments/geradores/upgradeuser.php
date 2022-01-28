<?php

use CoffeeCode\Router\Router;
use Source\Models\User;

if (!isset($_SESSION)) {
  session_start();
}
$router = new Router(URL_BASE);
$user = (new User())->findById("{$data["user_id"]}");

foreach ($data as $key => $value) {
  if (empty($value) xor is_null($value)) {
    echo "campo $key";
    $_SESSION["decline_newuser"] = "Preencha todos os Campos para atualizar o perfil do(a) {$user->nome}!";
    $router->redirect("console/members");
    exit();
  }
}

if (isset($user)) {
  $nome = SanitizeSpecialChars($data["user_nome"]);
  $sobrenome = SanitizeSpecialChars($data["user_sobrenome"]);
  $email = SanitizeEmail($data["user_email"], "console/members");
  $phone = phoneValidate($data["user_contato"], "console/members");

  $user->nome = $nome;
  $user->sobrenome = $sobrenome;
  $user->email = $email;
  if (isset($data["user_tipo"])) {
    $user->nivel_acesso = $data["user_tipo"];
  }
  $user->contato = $phone;
  $user->save();
}
if ($user->save() != false) {

  $_SESSION["success_newuser"] = "Usuário {$user->nome} atualizado com sucesso!";
  $router->redirect("console/members");
  //echo "<pre>", var_dump($data), "</pre> <hr> <pre>", var_dump($user), "</pre>";
} else {
  $_SESSION["decline_newuser"] = "Ocorreu um erro durante a atualização do perfil";
  $router->redirect("console/members");

}
