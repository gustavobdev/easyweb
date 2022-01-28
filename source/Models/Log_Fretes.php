<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Log_Fretes extends DataLayer
{
    public function __construct()
    {
        parent::__construct("log_fretes",[]);
    }

    public function user()
    {
       return (new User())->findById("{$this->user_id}");
    }
    public function nl_acesso()
    {
       $user = (new User())->findById("{$this->user_id}");

       return (new Nl_Acesso())->find("id = :uid","uid={$user->nivel_acesso}")->fetch(true);
    }
    public function frete(){
        return (new Frete())->findById("{$this->frete_id}");
    }
}