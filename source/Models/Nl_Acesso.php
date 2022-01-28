<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Nl_Acesso extends DataLayer
{
    public function __construct()
    {
//        string $entity, array $required, string $primary = 'id', bool $timestamps = true
        parent::__construct("nl_acesso",[],false);
    }
//
//    public function addressess(){
//        return (new Address())->find("user_id = :uid", "uid={$this->id}")->fetch(true);
//    }

}