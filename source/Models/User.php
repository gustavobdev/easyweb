<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct()
    {
//        string $entity, array $required, string $primary = 'id', bool $timestamps = true
        parent::__construct("users", ["nome","sobrenome","email","nivel_acesso"]);
    }
//
//    public function addressess(){
//        return (new Address())->find("user_id = :uid", "uid={$this->id}")->fetch(true);
//    }
public function nl_acesso(){
    
    return (new Nl_Acesso())->find("id = :mid","mid={$this->nivel_acesso}")->fetch(true);
}
}