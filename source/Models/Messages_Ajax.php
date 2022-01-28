<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Messages_Ajax extends DataLayer
{
    public function __construct()
    {
        parent::__construct("messages_ajax",[], "id", false);
    }
}
