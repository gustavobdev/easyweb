
<?php //var_dump($frete[0]->motorista()->id);
function messageEditFrete()
{
    if( !( isset($_SESSION) ) ) // if the session is no  set then start to
    {
            session_start();
    }
    if (isset($_SESSION["success_frete"])) {
        error("success", "Feito!", "{$_SESSION["success_frete"]}");
        $_SESSION["success_frete"] = null;
    }
    if (isset($_SESSION["decline_frete"])) {
        error("error", "OOPS!", "{$_SESSION["decline_frete"]}");
        $_SESSION["decline_frete"] = null;
    }
}
                                    ?>