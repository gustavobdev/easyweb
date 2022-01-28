<?php //var_dump($frete[0]->motorista()->id);
function messageExcluiPdf()
{
    if( !( isset($_SESSION) ) ) // if the session is no  set then start to
    {
            session_start();
    }
    if (isset($_SESSION["success_pdf"])) {
        error("success", "Feito!", "{$_SESSION["success_pdf"]}");
        $_SESSION["success_pdf"] = null;
    }
    if (isset($_SESSION["decline_pdf"])) {
        error("error", "OOPS!", "{$_SESSION["decline_pdf"]}");
        $_SESSION["success_pdf"] = null;
    }
}
