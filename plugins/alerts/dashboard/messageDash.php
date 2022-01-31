
<?php //var_dump($frete[0]->motorista()->id);
function messageDash()
{
    if(!isset($_SESSION)) // if the session is no  set then start to
    {
            session_start();
    }
    if (isset($_SESSION["img_profile"])) {
        error("{$_SESSION["img_icon"]}", "{$_SESSION["img_title"]}", "{$_SESSION["img_profile"]}");
        unset($_SESSION["img_icon"]);
        unset($_SESSION["img_title"]);
        unset($_SESSION["img_profile"]);
    }
    if (isset($_SESSION["success_msg"])) {
        error("success", "Feito!", "{$_SESSION["success_msg"]}");
        unset($_SESSION["success_msg"]);
    }
    if (isset($_SESSION["decline_msg"])) {
        error("error", "OOPS!", "{$_SESSION["decline_msg"]}");
        unset($_SESSION["decline_msg"]);
    } 
    if (isset($_SESSION["success_cte"])) {
        error("success", "Feito!", "{$_SESSION["success_cte"]}");
        unset($_SESSION["success_cte"]);
    }
    if (isset($_SESSION["decline_cte"])) {
        error("error", "OOPS!", "{$_SESSION["decline_cte"]}");
        unset($_SESSION["decline_cte"]);
    }
    if (isset($_SESSION["success_newuser"])) {
        error("success", "Feito!", "{$_SESSION["success_newuser"]}");
        unset($_SESSION["success_newuser"]);
    }
    if (isset($_SESSION["decline_newuser"])) {
        error("error", "OOPS!", "{$_SESSION["decline_newuser"]}");
        unset($_SESSION["decline_newuser"]);
    }
    if (isset($_SESSION["success_newdriver"])) {
        error("success", "Feito!", "{$_SESSION["success_newdriver"]}");
        unset($_SESSION["success_newdriver"]);
    }
    if (isset($_SESSION["decline_newdriver"])) {
        error("error", "OOPS!", "{$_SESSION["decline_newdriver"]}");
        unset($_SESSION["decline_newdriver"]);
    }
    if (isset($_SESSION["email_validate"])) {
        error("error", "OOPS!", "{$_SESSION["email_validate"]}");
        unset($_SESSION["email_validate"]);
    }
    if (isset($_SESSION["phone_validate"])) {
        error("error", "OOPS!", "{$_SESSION["phone_validate"]}");
        unset($_SESSION["phone_validate"]);
    }
}
?>