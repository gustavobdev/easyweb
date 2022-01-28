<?php

function messageTracking()
{
    if(!isset($_SESSION)){
        session_start();
        }
        if (isset($_SESSION["statusfail"])) {
            error("error", "OOPS!", "{$_SESSION["statusfail"]}");
            unset($_SESSION["statusfail"]);
        }
}