<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Driver_Notifications extends DataLayer
{
    public function __construct()
    {
        parent::__construct("driver_notifications",[]);
    }
   
public function msgAjax(){

    return (new Messages_Ajax())->findById("{$this->id_message}");
}


}