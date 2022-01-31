<?php
use CoffeeCode\Router\Router;
use Source\Models\User;

$router = new Router(URL_BASE);
if(!isset($_SESSION)){
    session_start();
}
$usermail = (new User())->find("email = :iem","iem={$data["email"]}")->fetch(true);
$lembrete = (isset($data['lembrete'])) ? $data['lembrete'] : '';

if(isset($usermail)){

    if (password_verify($data["senha"], $usermail[0]->password)) {
        
        $_SESSION["imgprofile"] = $usermail["0"]->profile_photo;
        $_SESSION["nome"] = $usermail["0"]->nome;
        $_SESSION["sobrenome"] = $usermail["0"]->sobrenome;
        $_SESSION["email"] = $usermail["0"]->email;
        $_SESSION["contato"] = $usermail["0"]->contato;
        $_SESSION["nl_acesso"] = $usermail["0"]->nivel_acesso;
        $_SESSION["user_id"] = $usermail["0"]->id;
        $date = new DateTime();
        $usermail["0"]->last_login = $date->format( "Y-m-d H:i:s" ) . ' ';
        $usermail["0"]->save();

        if($lembrete == 'SIM'){
            $expira = time() + 60*60*24*30; 
            setCookie('CookieLembrete', base64_encode('SIM'), $expira);
            setCookie('CookieEmail', base64_encode($usermail["0"]->email), $expira);
            setCookie('CookieSenha', base64_encode($data["senha"]), $expira);
        }else{
            setCookie('CookieLembrete');
            setCookie('CookieEmail');
            setCookie('CookieSenha');
  
        }
        $router->redirect("/console");
}else{
    $_SESSION["decline_loga"] = "Senha inválida!";
    //echo "Senha inválida!";
    $router->redirect("/login");
}
}else{
    $_SESSION["decline_loga"] = "Email não encontrado!";
    //echo "Email não encontrado!";
    $router->redirect("/login");
}

