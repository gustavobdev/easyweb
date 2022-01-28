<?php


namespace Source\App\Aplicativo;

use CoffeeCode\Router\Router;
use DateTime;
use League\Plates\Engine;
use Source\Models\Banco;
use Source\Models\Caminhao;
use Source\Models\Candidaturas;
use Source\Models\Cliente;
use Source\Models\Frete;
use Source\Models\Messages_Ajax;
use Source\Models\Motorista;
use Source\Models\Reboque;
use Source\Models\Relacao_Caminhao;
use Source\Models\Relacao_Reboque;
use Source\Models\Driver_Notifications;
use Source\Models\Uf;
use Source\Models\User;

if (!isset($_SESSION)) {
    session_start();
}
class App
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . '/../../../theme');
    }

    public function searchmessages()
    {
        if (isset($_SESSION["em_servico"])) {
            $destinatario = (new Driver_Notifications())->find("id_driver = :idd and lida_on = 0", "idd={$_SESSION["driver_id"]}")->fetch(true);

            if ($destinatario) {
                foreach ($destinatario as $d) {
                    $publicfrete = (new Messages_Ajax())->find("id = :idd and status != :lid", "idd={$d->id_message}&lid=1")->fetch(true);
                }

                if ($publicfrete) {
                    foreach ($publicfrete as $pufrete) :


                        $destinatario = (new Driver_Notifications())->find("id_driver = :idd and id_message = :ime", "idd={$_SESSION["driver_id"]}&ime={$pufrete->id}")->fetch(true);

                        $output[] = '<div id="notification-12" class="notification-box">
                        <a href="#" data-val="'.$pufrete->link.'"  data-ids="'.$destinatario["0"]->id.'"  data-lidaoffs="'.url("app/lidaoff").'">

                                        <div class="notification-dialog ios-style">
                                                <div class="notification-header">
                                                    <div class="in">
                                                        <strong>' . $pufrete->title . '</strong>
                                                    </div>
                                                    <div class="right">
                                                        <span>agora</span>
                                                        <a href="#" data-dimiss="notification-12" class="close-button">
                                                            <ion-icon name="close-circle"></ion-icon>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="notification-content">
                                                    <div class="in">
                                                        <h3 class="subtitle">' . $pufrete->text . '</h3>
                                                        <div class="text">
                                                            Fechamento automático.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <script>
                                    $(document).ready(function () {
                                        notification(\'notification-12\', 5000);   
                                    });
                                </script>';
                    
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
                                console.log(data.ids);
            
                                alert("Erro ao processar requisição");
                            });
                        });
                    });</script>';

                    $messages = (new Driver_Notifications())->find("id_driver = :idd", "idd={$_SESSION["driver_id"]}")->order("created_at DESC")->fetch(true);

                    if ($messages) :
                        foreach ($messages as $me) :


                            if ($me->lida_off ===  "1") :
                                $active = "active";
                            else :
                                $active = "a";
                            endif;

                            $data = new DateTime($me->created_at);
                            $atualizamsg[] = '<ul class="listview image-listview flush">
                                                <li class="' . $active . '">
                                                    <a href="#" class="item" data-val="'.$me->msgAjax()->link.'"  data-ids="'.$me->id.'"  data-lidaoffs="'.url("app/lidaoff").'">
                                                        <div class="icon-box bg-danger">
                                                            <ion-icon name="key-outline"></ion-icon>
                                                        </div>
                                                        <div class="in">
                                                            <div>
                                                                <div class="mb-05"><strong>' . $me->msgAjax()->title . '</strong></div>
                                                                <div class="text-small mb-05">' . $me->msgAjax()->text . '</div>
                                                                <div class="text-xsmall">' . $data->format("d/m/Y H:i") . '</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                    
                                            ';
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
                    $destinatario = (new Driver_Notifications())->find("id_driver = :idd and lida_off = 0", "idd={$_SESSION["driver_id"]}")->count();

                    echo json_encode(array(
                        "output" => $output,
                        "msg" => $atualizamsg,
                        "destinatario" => $destinatario,
                        "script" => $script
                    ));
                }
            } else {
                die();
            }
        }

        $driver = (new Motorista())->findById("{$_SESSION["driver_id"]}");
        if ($driver) {
            $lida = (new Driver_Notifications())->find("id_driver = :idd and lida_on = 0", "idd={$driver->id}")->fetch(true);
            if ($lida) {

                foreach ($lida as $li) {
                    $li->lida_on = "1";
                    $li->lida_off = "0";
                    $li->save();
                }
            }
        }
    }

    public function lidaoff($data)
    {


        if (isset($data["ids"])) {

            $lidaoff = (new Driver_Notifications())->findById("{$data["ids"]}");

            if ($lidaoff) {


                $lidaoff->lida_off = "1";
                $lidaoff->save();

                if ($lidaoff->save() != false) {
                    echo json_encode($data);
                }
            }
        }
    }
    public function login()
    {
        echo $this->view->render("/app/login");
    }

    public function loga($data)
    {
        echo $this->view->render("app/fragments/loga", [
            "data" => $data
        ]);
    }

    public function register()
    {
        echo $this->view->render("/app/register");
    }

    public function registra($data)
    {
        echo $this->view->render("app/fragments/registra", [
            "data" => $data
        ]);
    }
    public function home()
    {
        $this->view->addData(['page' => 'home'], ['app/fragments/footer']);
        $aprovados = (new Candidaturas())->find("status = 2")->fetch(true);
        $candidaturas = (new Candidaturas())->find("status = 1")->fetch(true);
        $fretes = (new Frete())->find()->fetch(true);
        echo $this->view->render("/app/home", [
            "fretes" => $fretes,
            "candidaturas" => $candidaturas,
            "aprovados" => $aprovados
        ]);
    }

    public function logout()
    {
        echo $this->view->render("app/fragments/logout", [
            "title" => "Home |Gbs"
        ]);
    }
    public function perfil()
    {
        $reboques = (new Relacao_Reboque())->find("id_motorista = :imo", "imo={$_SESSION["driver_id"]}")->count();
        $caminhoes = (new Relacao_Caminhao())->find("id_motorista = :imo", "imo={$_SESSION["driver_id"]}")->count();
        $banks = (new Banco())->find()->fetch(true);
        $this->view->addData(['page' => 'perfil'], ['app/fragments/footer']);
        echo $this->view->render("/app/perfil", [
            "banks" => $banks,
            "caminhoes" => $caminhoes,
            "reboques" => $reboques
        ]);
    }
    public function notifications()
    {
        $destinatario = (new Driver_Notifications())->find("id_driver = :idd", "idd={$_SESSION["driver_id"]}")->fetch(true);
        echo $this->view->render("/app/notifications", [
            "messages" => $destinatario
        ]);
    }
    public function editcerts($data)
    {

        echo $this->view->render("/app/fragments/editcerts", [
            "data" => $data
        ]);
    }
    public function selectcar($data)
    {

        echo $this->view->render("/app/fragments/selectcar", [
            "data" => $data
        ]);
    }

    public function selectreboque($data)
    {

        echo $this->view->render("/app/fragments/selectreboque", [
            "data" => $data
        ]);
    }

    public function saveperfil($data)
    {
        echo $this->view->render("app/fragments/saveperfil", [
            "data" => $data
        ]);
    }
    public function saveimgprofile($data)
    {
        echo $this->view->render("app/fragments/imgprofile", [
            "data" => $data
        ]);
    }
    public function ficaonline($data)
    {
        echo $this->view->render("app/fragments/ficaon", [
            "data" => $data
        ]);
    }
    public function verificaon($data)
    {
        if (isset($_SESSION["em_servico"])) {

            echo json_encode(array("active" => true));
            die();
        }
        if (!isset($_SESSION["em_servico"])) {
            echo json_encode(array("active" => false));
            die();
        }
    }
    public function editcar()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
        $caminhoes = (new Relacao_Caminhao())->find("id_motorista =:imo", "imo={$_SESSION["driver_id"]}")->fetch(true);
        if ($motorista) {
            $caremsuso = (new Caminhao())->find("id = :mid", "mid={$motorista->id_caminhao}")->fetch(true);
        }
        if (isset($caremsuso)) {
            echo $this->view->render("/app/caminhao", [
                "caminhoes" => $caminhoes,
                "car_emuso" => $caremsuso[0]->id
            ]);
        } else {
            $caremsuso = null;
            echo $this->view->render("/app/caminhao", [
                "caminhoes" => $caminhoes,
                "car_emuso" => $caremsuso
            ]);
        }
    }

    public function savecar($data)
    {
        echo $this->view->render("app/fragments/savecaminhao", [
            "data" => $data
        ]);
    }

    public function editreboque()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $reboque = (new Relacao_Reboque())->find("id_motorista = :imo", "imo={$_SESSION["driver_id"]}")->fetch(true);
        $motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
        if ($motorista) {
            $rebemsuso = (new Relacao_Reboque())->find("id_reboque = :mid", "mid={$motorista->id_reboque}")->fetch(true);
        }
        if (isset($rebemsuso)) {

            echo $this->view->render("/app/reboque", [
                "reboques" => $reboque,
                "reb_emuso" => $rebemsuso[0]->reboque()[0]->id
            ]);
        } else {
            $rebemsuso = null;
            echo $this->view->render("/app/reboque", [
                "reboques" => $reboque,
                "reb_emuso" => $rebemsuso
            ]);
        }
    }

    public function savereboque($data)
    {
        echo $this->view->render("app/fragments/savereboque", [
            "data" => $data
        ]);
    }

    public function editbank()
    {
        $banks = (new Banco())->find()->fetch(true);
        echo $this->view->render("/app/bank", [
            "banks" => $banks
        ]);
    }
    public function savebank($data)
    {

        echo $this->view->render("app/fragments/savebank", [
            "data" => $data
        ]);
    }
    public function editaddress()
    {
        $address = (new Motorista())->find()->fetch(true);
        echo $this->view->render("/app/address", [
            "address" => $address
        ]);
    }
    public function saveaddress($data)
    {
        echo $this->view->render("app/fragments/savaddress", [
            "data" => $data
        ]);
    }
    public function fretes()
    {
        $this->view->addData(['page' => 'publicados'], ['app/fragments/footer']);
        $aprovados = (new Candidaturas())->find("status = 2")->fetch(true);
        $fretes = (new Frete())->find("status_frete = 3")->fetch(true);
        echo $this->view->render("/app/fretes", [
            "fretes" => $fretes,
            "aprovados" => $aprovados
        ]);
    }
    public function fretes_aprovados()
    {
        $this->view->addData(['page' => 'meusfretes'], ['app/fragments/footer']);
        $aprovados = (new Candidaturas())->find("status = 2")->fetch(true);

        echo $this->view->render("/app/fretes_aprovados", [
            "aprovados" => $aprovados
        ]);
    }

    public function fretes_candidaturas()
    {
        $candidaturas = (new Candidaturas())->find("status = 1")->fetch(true);

        echo $this->view->render("/app/fretes_candidaturas", [
            "candidaturas" => $candidaturas
        ]);
    }


    public function infofrete($data)
    {
        $frete = (new Frete())->find("id = :fid", "fid={$data['id']}")->fetch(true);
        echo $this->view->render("app/detalhe", [
            "frete" => $frete
        ]);
    }

    public function geraCandidatura($data)
    {
        echo $this->view->render("fragments/app/gera_candidatura", [
            "data" => $data
        ]);
    }
}
