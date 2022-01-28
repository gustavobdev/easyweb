<?php

function messageLoga()
{
    if(!isset($_SESSION)) // if the session is no  set then start to
    {
     session_start();
    }
    if (isset($_SESSION["decline_loga"])) {
        error("error", "OOPS!", "{$_SESSION["decline_loga"]}");
        unset($_SESSION["decline_loga"]);
    }
}