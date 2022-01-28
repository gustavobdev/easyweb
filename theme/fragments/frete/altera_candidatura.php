      <?php

      use Source\Models\Caminhao;
      use Source\Models\Candidaturas;
      use Source\Models\Frete;
      use Source\Models\Log_Fretes;
      use Source\Models\Motorista;
      use Source\Models\Nl_Acesso;
      use Source\Models\Reboque;
      use Source\Models\Status_frete;

      if (!isset($_SESSION)) {
        session_start();
      }

      $candidatura = (new Candidaturas())->findById($data["id"]);
      $frete = (new Frete())->findById("{$candidatura->frete_id}");

      /**SALVA LOG DE FRETE */
      $motorista_post = (new Motorista())->findById("{$candidatura->motorista}");
      $motorista_banco = (new Motorista())->find("id = :mid", "mid={$frete->motorista}")->fetch(true);
      $caminhao = (new Caminhao())->findById("{$motorista_post->id_caminhao}");
      $reboque = (new Reboque())->find("id = :rid", "rid={$motorista_post->id_reboque}")->fetch(true);

      $status_post = (new Status_frete())->findById("4");
      $status_banco = (new Status_frete())->find("id = :sid", "sid={$frete->status_frete}")->fetch(true);

      $dados_post = array(
        "Aprovação Motorista" => $motorista_post->nome . " " . $motorista_post->sobrenome,
        "Status Frete" => $status_post->status_desc
      );

      $dados_tabela = array(
        "Aprovação Motorista" => $motorista_banco ? $motorista_banco[0]->nome . " " . $motorista_banco[0]->sobrenome : "Vazio",
        "Status Frete" => $status_banco ? $status_banco[0]->status_desc : "Vazio"
      );

      if (isset($data["status"])) {
        if (isset($frete->motorista)) {
          $msg = "Já existe motorista para este frete!";
          echo json_encode(array(
            "title" => "OOPS!",
            "icon" => "error",
            "msg" => $msg
          ));
          die();
        }

        $frete->motorista = $candidatura->motorista;
        $frete->status_frete = "4";
        $frete->save();
        $candidatura->status = "2";
        $candidatura->save();

        $excandidatura = (new Candidaturas())->find("frete_id = :fid and motorista != :cid", "fid={$candidatura->frete_id}&cid={$candidatura->motorista}")->fetch(true);
        if (isset($excandidatura)) {
          foreach ($excandidatura as $exc) {
            $exc->destroy();
          }
        }

        if ($frete->save() != false  && $candidatura->save() != false) {

          $arr_dif = array_diff_assoc($dados_post, $dados_tabela);
          foreach ($arr_dif as $key => $value) {
            if (is_null($dados_post["$key"]) xor empty($dados_post["$key"])) {
              $dados_post["$key"] = "Vazio";
            }
            $logfrete = new Log_Fretes();
            $logfrete->frete_id = $candidatura->frete_id;
            $logfrete->user_id = $_SESSION["user_id"];
            $logfrete->campo = $key;
            $logfrete->val_antigo = $dados_tabela["$key"];
            $logfrete->val_novo = $dados_post["$key"];
            $logfrete->save();
          }

          $datamotorista = '<div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" id="headingTwo">
          <h5 class="card-title my-2 align-content-between">
          Informações do motorista
          <a type="button" class="text-primary" data-toggle="modal" data-target="#modalMotorista"> Alterar motorista<a/></h5>
          </div>';
          $msg = "Você aprovou {$motorista_post->nome} para este frete!";

          echo json_encode(array(
            "qntmotorista" => "1 Motorista",
            "status" => "<option value='4'>Aguardando Faturar</option>",
            "statuscandidatura" => "2",
            "msg" => $msg,
            "icon" => "success",
            "title" => "Feito!",
            "statuscandidatura" => "2",
            "option" => "<option value='3'>Aprovado</option>",
            "motorista" => $datamotorista,
            "nome" => $motorista_post->nome,
            "sobrenome" => $motorista_post->sobrenome,
            "cpf" => $motorista_post->cpf,
            "placacaminhao" => $caminhao->placa_caminhao,
            "renavam" => $caminhao->renavam_caminhao,
            "modelo" => $caminhao->modelo,
            "cor" => $caminhao->cor,
            "tipocaminhao" => $caminhao->tipo_caminhao,
            "placareboque" => $reboque ? $reboque[0]->placa_reboque : 'Sem Reboque',
            "renavamreboque" => $reboque ? $reboque[0]->renavam_reboque : 'Sem Reboque',
            "tiporeboque" => $reboque ? $reboque[0]->tipo_reboque : 'Sem Reboque'
          ));
          die();
        }
      }
      if ($data["status"] === "3") {

        $candidatura->destroy();

        if ($candidatura->destroy() != false) {

          if ($motorista_post->id === $frete->motorista) {
            $frete->motorista = null;
            $frete->status_frete = "3";
            $frete->save();
          }


          $msg = "Você cancelou a aprovação de {$motorista_post->nome} para este frete!";
          echo json_encode(array(
            "msg" => $msg,
            "icon" => "success",
            "title" => "CANCELADO!"
          ));
        } else {
          $msg = "Erro ao processar requisição";
          echo json_encode(array("msg" => $msg, "icon" => "error", "title" => "OOPS!"));
        }

        die();
      }




      //$router->redirect("console/aprovacoes");
