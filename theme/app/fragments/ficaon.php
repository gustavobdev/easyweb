<?php

use Source\Models\Driver_Notifications;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($data['checked_box'])) :

    $_SESSION["em_servico"] = true;
    $online = '<div class="modal fade dialogbox" id="ficaon" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon text-success">
                <ion-icon name="checkmark-circle"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Feito!</h5>
            </div>
            <div class="modal-body">
                Você ficou ativo e já pode receber fretes
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="" class="btn" data-dismiss="modal">FECHAR</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
$("#ficaon").modal(\'show\');
});
</script>
';
    $destinatario = (new Driver_Notifications())->find("id_driver = :idd and lida_off = 0", "idd={$_SESSION["driver_id"]}")->count();



    if ($destinatario > 0) {

        $notifi = '<a href="#" class="headerButton" data-toggle="modal" data-target="#MessagesModal">
                        <ion-icon class="icon" name="notifications-outline"></ion-icon>
                        <span class="badge badge-danger">' . $destinatario . '</span>
                    </a>';
        $newmessages = ' <a href"#" data-toggle="modal" data-target="#MessagesModal">
                            <div id="toast-12" class="toast-box toast-center">
                                <div class="in">
                                <a><b>Você tem novas mensagens!</b></a>
                                    <div class="text">
                                        Acesse sua caixa de mensagens.                              
                                    </div>
                                </div>
                            </div>
                        </a>
                            <script>
                                $(document).ready(function () {
                                    setTimeout(function() {

                                       
                                        toastbox(\'toast-12\', 5000);

                                    }, 1500);
                                });
                            </script>';

        $messages = (new Driver_Notifications())->find("id_driver = :idd", "idd={$_SESSION["driver_id"]}")->order("created_at DESC")->fetch(true);

        if ($messages) :
            foreach ($messages as $me) :

                if($me->lida_off ===  "1"):
                    $active = "active";
                else:
                    $active = "a";
                endif;
                
                $data = new DateTime($me->created_at);
                $atualizamsg[] = '<ul class="listview image-listview flush">
                                    <li class="'.$active.'">
                                    <a href="#" class="item" data-val="'.$me->msgAjax()->link.'"  data-ids="'.$me->id.'"  data-lidaoffs="'.url("app/lidaoff").'">
                                            <div class="icon-box bg-danger">
                                                <ion-icon name="key-outline"></ion-icon>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="mb-05"><strong>'.$me->msgAjax()->title.'</strong></div>
                                                    <div class="text-small mb-05">'.$me->msgAjax()->text.'</div>
                                                    <div class="text-xsmall">'.$data->format("d/m/Y H:i").'</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>';
                            endforeach;
                            $script = '<script>
                            $(document).ready(function () {
                                $(\'body\').on("click", "[data-lidaoffs]", function(e) {
                                    e.preventDefault();
                    
                                    var data = $(this).data();
                    
                                    $.post(data.lidaoffs, data, function(data) {
                                        console.log(data);
                                        window.location.href= data.val;
                    
                                    }, "json").fail(function(data) {
                                        console.log(data);
                    
                                        alert("Erro ao processar requisição");
                                    });
                                });
                            });</script>';
        else :
            $atualizamsg = "Sem mensagens na sua caixa";
        endif;

    } else {
        $messages = (new Driver_Notifications())->find("id_driver = :idd", "idd={$_SESSION["driver_id"]}")->order("created_at DESC")->fetch(true);

        if ($messages) :
            foreach ($messages as $me) :
                

                if($me->lida_off ===  "1"):
                    $active = "active";
                else:
                    $active = "a";
                endif;

                $data = new DateTime($me->created_at);
                $atualizamsg[] = '<ul class="listview image-listview flush">
                                    <li class="'.$active.'">
                                    <a href="#" class="item" data-val="'.$me->msgAjax()->link.'"  data-ids="'.$me->id.'"  data-lidaoffs="'.url("app/lidaoff").'">
                                    <div class="icon-box bg-danger">
                                                <ion-icon name="key-outline"></ion-icon>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="mb-05"><strong>'.$me->msgAjax()->title.'</strong></div>
                                                    <div class="text-small mb-05">'.$me->msgAjax()->text.'</div>
                                                    <div class="text-xsmall">'.$data->format("d/m/Y H:i").'</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>';
            endforeach;
            $script = '
            $(document).ready(function () {
                $(\'body\').on("click", "[data-lidaoffs]", function(e) {
                    e.preventDefault();
    
                    var data = $(this).data();
    
                    $.post(data.lidaoffs, data, function(data) {
                        console.log(data);
                        window.location.href= data.val;
    
                    }, "json").fail(function(data) {
                        console.log(data);
    
                        alert("Erro ao processar requisição");
                    });
                });
            });';
        else :
            $atualizamsg = "Sem mensagens na sua caixa";

        endif;

        $newmessages = null;
        $notifi = '<a class="headerButton"  data-toggle="modal" data-target="#MessagesModal"><ion-icon class="icon" name="notifications-outline"></ion-icon></a>';
    }

    echo json_encode(array(
        "modal" => $online,
        "notifi" => $notifi,
        "newmessage" => $newmessages,
        "msg" => $atualizamsg,
        "script" => $script
    ));


else:

    unset($_SESSION["em_servico"]);

    $offline = ' 
    <div class="modal fade dialogbox" id="ficaoff" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-danger">
                    <ion-icon name="close-circle"></ion-icon>
                </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Feito!</h5>
                    </div>
                <div class="modal-body">
                    Você ficou inativo!
                </div>
            <div class="modal-footer">
            <div class="btn-inline">
                <a href="" class="btn" data-dismiss="modal">FECHAR</a>
            </div>
        </div>
    </div>
</div>
</div>
    <script>
$(document).ready(function () {
$("#ficaoff").modal(\'show\');
});
</script>
    ';

    $notifi = '<a class="headerButton"><ion-icon class="icon" name="notifications-outline"></ion-icon></a>';

    echo json_encode(array(
        "notifi" => $notifi,
        "modal" => $offline
    ));
endif;
