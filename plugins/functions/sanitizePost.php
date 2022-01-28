<?php

use CoffeeCode\Router\Router;


if (!isset($_SESSION)) {
    session_start();
}
/** variable $data */
function SanitizeSpecialChars($variable)
{
    // $var = htmlspecialchars($variable);
    $var = str_replace(array("#", "'", ";", "<", ">", "{", "}", '"', "[", "]"), '', $variable);

    $var = tirarAcento($var);

    return $var;
}

function tirarAcento($texto)
{
    // array com letras acentuadas
    $com_acento = array(
        'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', 'Ÿ',
    );
    // array com letras correspondentes ao array anterior, porém sem acento
    $sem_acento = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i',
        'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A',
        'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U',
        'U', 'Y',
    );
    // procuramos no nosso texto qualquer caractere do primeiro array esubstituímos pelo seu correspondente presente no 2º array
    $final = str_replace($com_acento, $sem_acento, $texto);
    // array com pontuação e acentos
    $com_pontuacao = array('´', '`', '¨', '^', '~', ' ', '-');
    // array com substitutos para o array anterior
    $sem_pontuacao = array('', '', '', '', '', ' ', ' ');
    // procuramos no nosso texto qualquer caractere do primeiro array e substituímos pelo seu correspondente presente no 2º array
    $final = str_replace($com_pontuacao, $sem_pontuacao, $final);
    // retornamos a variável com nosso texto sem pontuações, acentos e letras acentuadas
    return $final;
} // -> fim function tirarAcento()


function SanitizeEmail($email, $caminho)
{
    $router = new Router(URL_BASE);
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false || $emailB != $email) {
        $_SESSION["email_validate"] = "Formato de email Inválido";
        $router->redirect("{$caminho}");
        die();
    } else {
        return $emailB;
    }
}

function validaCPF($cpf = null, $caminho)
{
    $router = new Router(URL_BASE);
    // Verifica se um número foi informado
    if (empty($cpf)) {
        $_SESSION["cpf_validate"] = "CPF vazio";
        $router->redirect("{$caminho}");
        return false;
    }

    // Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999'
    ) {
        return false;
        $_SESSION["cpf_validate"] = "formato de CPF inválido!";
        $router->redirect("{$caminho}");
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{
                    $c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{
                $c} != $d) {
                return false;
                $_SESSION["cpf_validate"] = "CPF invalido";
                $router->redirect("{$caminho}");
        
            }
        }

        return $cpf;
    }
}

function phoneValidate($phone,  $caminho)
{
    $router = new Router(URL_BASE);
    $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
    $matches = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
    if ($matches) {
        return '('.$matches[1].') '.$matches[2].'-'.$matches[3];
    }else{
        $_SESSION["phone_validate"] = "Formato de telefone Inválido";
        $router->redirect("{$caminho}");
      
    }

    //return $phone; // return number without format
}
