<?php

use CoffeeCode\Router\Router;
use Source\Models\Cliente;
use Source\Models\Driver_Notifications;
use Source\Models\Frete;
use Source\Models\Log_Fretes;
use Source\Models\Messages_Ajax;
use Source\Models\Motorista;
use Source\Models\Status_frete;
use Source\Models\User;

if (!isset($_SESSION)) {
    session_start();
}
$router = new Router(URL_BASE);

if (!isset($data["status"]) or !empty($data["status"]) xor !is_null(!$data["status"])) {
    $msg = "Selecione um item!";
    echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!"));
    exit();
} else {
    $frete = (new Frete())->findById($data["id_status"]);
    $status_frete = (new Status_frete)->find("id = :mde", "mde={$data['status']}")->fetch(true);
    $status_frete_banco = (new Status_frete())->find("id = :sid", "sid={$frete->status_frete}")->fetch(true);

    $dados_post = array(
        "Status do Frete" => $status_frete[0]->status_desc
    );
    $dados_tabela = array(
        "Status do Frete" => $status_frete_banco ? $status_frete_banco[0]->status_desc : "Vazio"
    );

    if ($status_frete[0]->id === "2" and $_SESSION["nl_acesso"] != "1") {

        $msg = "Voce precisa ter nivel master para cancelar esse frete";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }


    if ($status_frete[0]->id === "3" and $data["tem_motorista"]) {

        $msg = "Já existe um motorista para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif ($status_frete[0]->id === "3" and !$data["tem_cliente"]) {
        $msg = "Não existe um cliente para este frete, adicione um!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif ($status_frete[0]->id === "3" and !$frete->ndi_dta_reserva_nf) {
        $msg = "Não existe um ndi_dta_reserva_nf para este frete, adicione!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } 

    if (!$data["tem_motorista"] and $status_frete[0]->id === "4") {

        $msg = "Você precisa adicionar ou aprovar motorista para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif ($status_frete[0]->id === "4" and !$data["tem_cliente"]) {
        $msg = "Não existe um cliente para este frete, adicione um!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }

    if (!$data["tem_motorista"]  and $status_frete[0]->id === "5") {

        $msg = "Você precisa adicionar ou aprovar motorista para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif ($status_frete[0]->id === "5" and !$data["tem_cliente"]) {

        $msg = "Você precisa adicionar um cliente para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }

    if (!$data["tem_motorista"]  and $status_frete[0]->id === "6") {

        $msg = "Você precisa adicionar ou aprovar motorista para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif (!$status_frete[0]->id === "6" and $data["tem_cliente"]) {
        $msg = "Você precisa adicionar um cliente para este frete!";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }elseif ($status_frete[0]->id === "6" and !$frete->prev_chegada_cliente) {
        $msg = "Não existe um previsão de chegada para o cliente nas datas operacionais, adicione!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }

    if (!$data["tem_motorista"]  and $status_frete[0]->id === "7") {

        $msg = "Você precisa adicionar ou aprovar motorista para este frete!";
        $option = "";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    } elseif (!$status_frete[0]->id === "7" and $data["tem_cliente"]) {
        $msg = "Você precisa adicionar um cliente para este frete!";
        echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!", "option" => $option, "idstatus" => $status_frete[0]->id));
        die();
    }

    if ($status_frete[0]->id === "6") {

        $cliente = (new Cliente())->findById("{$frete->cliente_transportadora}");

        $mail = getSend();
        $titlemail = utf8_decode("Atualização de tracking | {$cliente->razao_social}");
        $mail->AddAddress("{$cliente->email}", "{$titlemail}");
        $mail->SetFrom("atendimento@softgbs.com", "Transdoni Fretes");
        $mail->Subject = $titlemail;
        $content = str_replace(array('%cliente%', '%link%', '%docviagemcte%'), array($cliente->razao_social, url("rastrear/{$frete->doc_viagem_cte}"), $frete->doc_viagem_cte), file_get_contents('theme/dashboard/mailer/clientetransport.html'));
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/logotd_Lzg.png", "my-logo");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/track_BAj.png", "img-track");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/vector_Pm3.png", "img-nuvem");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group2.png", "png-one");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group1.png", "png-two");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group_fHk.png", "png-three");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/facebook-circle-colored.png", "facebook");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/instagram-circle-colored.png", "instagram");
        $mail->msgHTML(utf8_decode($content), __DIR__);
        $mail->send();


    }

    if ($status_frete[0]->id === "9") {

        $cliente = (new Cliente())->findById("{$frete->cliente_transportadora}");
        $agendamento = new DateTime($frete->data_agendamento);
        $mail = getSend();
        $titlemail = utf8_decode("Agendamento de frete | {$cliente->razao_social}");
        $mail->AddAddress("mdmion@gmail.com", "{$titlemail}");
        $mail->SetFrom("atendimento@softgbs.com", "Transdoni Fretes");
        $mail->Subject = $titlemail;
        $content = str_replace(array('%cliente%', '%datafrete%'), array($cliente->razao_social, $agendamento->format("d/m/Y")), file_get_contents('theme/dashboard/mailer/clienteagendado.html'));
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/logotd_Lzg.png", "my-logo");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/agendtrack.png", "img-track");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/vector_Pm3.png", "img-nuvem");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group2.png", "png-one");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group1.png", "png-two");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/group_fHk.png", "png-three");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/facebook-circle-colored.png", "facebook");
        $mail->AddEmbeddedImage("theme/dashboard/mailer/images/instagram-circle-colored.png", "instagram");
        $mail->msgHTML(utf8_decode($content), __DIR__);
        $mail->send();


    }

    $frete->status_frete = $data['status'];
    $frete->save();
}

if ($frete->save() != false) {

    $enviou = 0;
    if ($status_frete[0]->id === "3") {
        $verificapost = (new Messages_Ajax())->find("id_frete = :idf", "idf={$frete->id}")->fetch(true);
        if (!isset($verificapost)) {
            $msgajax = new Messages_Ajax();
            $msgajax->id_frete = $frete->id;
            $msgajax->title = "Novo Frete publicado!";
            $msgajax->text = "CTE   Nº" . $frete->id . " / " . $frete->doc_viagem_cte . " Veja mais informações!";
            $msgajax->link = URL_BASE . "app/infofrete/" . $frete->id;
            $msgajax->status = "0";
            $msgajax->save();

            if ($msgajax->save() != false) {

                $driver = (new Motorista())->find()->fetch(true);
                $verificamessage = (new Driver_Notifications())->find("id_message = :idm", "idm={$msgajax->id}}")->fetch(true);

                if (!$verificamessage) {
                    foreach ($driver as $d) {
                        $notification = new Driver_Notifications();
                        $notification->id_message = $msgajax->id;
                        $notification->id_driver = $d->id;
                        $notification->lida_on = "0";
                        $notification->lida_off = "0";
                        $notification->save();
                    }
                }
            }
        }
    }

    $arr_dif = array_diff_assoc($dados_post, $dados_tabela);
    foreach ($arr_dif as $key => $value) {
        if (is_null($dados_post["$key"]) xor empty($dados_post["$key"])) {
            $dados_post["$key"] = "VAZIO";
        }
        $logfrete = new Log_Fretes();
        $logfrete->frete_id = $frete->id;
        $logfrete->user_id = $_SESSION["user_id"];
        $logfrete->campo = $key;
        $logfrete->val_antigo = $dados_tabela["$key"];
        $logfrete->val_novo = $dados_post["$key"];
        $logfrete->save();
    }


    $msg =  "Status alterado para {$status_frete[0]->status_desc}";
    $option = "<option>{$status_frete[0]->status_desc}</option>";
    echo json_encode(array(
        "msg" => $msg, 
        "icon" => "success",
         "title" => "Feito!",
          "option" => $option, 
          "idstatus" => $status_frete[0]->id, 
          "enviou" => $enviou,
          "nlacesso" => $_SESSION["nl_acesso"]
        ));

    
} else {
    $msg =  "Erro na solicitação!";
    $option = "<option>Selecione</option>";
    echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOOPS!", "option" => $option, "idstatus" => $status_frete[0]->id, "enviou" => $enviou));
}
