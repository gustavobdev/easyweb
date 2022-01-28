        
        <?php

        use CoffeeCode\Router\Router;
        use Source\Models\Frete;
        use Source\Models\Cidades;
        use Dompdf\Dompdf;
        use Dompdf\Options;
        use Source\Models\Pdf_Frete;
        use Source\Models\Estados;
        use Source\Models\Log_Fretes;
        use Source\Models\Motorista;
        use Source\Models\Nl_Acesso;
        use Source\Models\User;

        $router = new Router(URL_BASE);

        if (!isset($_SESSION)) {
          session_start();
        }

        if (!isset($data["imo"]) or empty($data["imo"]) ) {
          $_SESSION["decline_frete"] = "IMO obrigatório!";
          $router->redirect("console/fretes/{$data["id_principal"]}");
          die();
        }
        if (empty($data["origem_cidade"]) or !isset($data["origem_cidade"])) {
          $_SESSION["decline_frete"] = "Origem da cidade obrigatório!";
          $router->redirect("console/fretes/{$data["id_principal"]}");
          die();
        }
        if (empty($data["destino_cidade"]) or !isset($data["destino_cidade"])) {
          $_SESSION["decline_frete"] = "Destino obrigatório!";
          $router->redirect("console/fretes/{$data["id_principal"]}");
          die();
        }
        $relacao1 = (new Cidades())->find("nome = :mot", "mot={$data['origem_cidade']}")->fetch(true);
        $relacao2 = (new Cidades())->find("nome = :mot", "mot={$data['retirada_cheio_vazio_cidade']}")->fetch(true);
        $relacao3 = (new Cidades())->find("nome = :mot", "mot={$data['destino_cidade']}")->fetch(true);
        $relacao4 = (new Cidades())->find("nome = :mot", "mot={$data['dep_ch_vz_cidade']}")->fetch(true);

        $frete = (new Frete())->findById("{$data["id_principal"]}");
        //$motorista = (new Motorista())->findById($frete->motorista); //CRIAR FUNC PARA VERIFICAR SE EXISTE MOTORISTA PRA PODER DAR ECHO NA VARIAVEL

        /**CONVERSAO DATA VENDA */
        if (!empty($data['data_venda']) && !is_null($data['data_venda'])) {
          $data_venda = $data['data_venda'];
          $data_venda = explode(" ", $data_venda);
          list($date, $hora) = $data_venda;
          $data_sem_barra = array_reverse(explode("/", $date));
          $data_sem_barra = implode("-", $data_sem_barra);
          $data_venda = $data_sem_barra . " " . $hora;
        } else {
          $data_venda = null;
        }
       /**CONVERSAO DATA AGENDAMENTO */
       if (!empty($data['data_agendamento']) && !is_null($data['data_agendamento'])) {
        $data_agendamento = $data['data_agendamento'];
        $data_agendamento = explode(" ", $data_agendamento);
        list($date, $hora) = $data_agendamento;
        $data_sem_barra = array_reverse(explode("/", $date));
        $data_sem_barra = implode("-", $data_sem_barra);
        $data_agendamento = $data_sem_barra . " " . $hora;
      } else {
        $data_agendamento = null;
      }
      /**CONVERSAO DATA SALDO */
        if (!empty($data['data_saldo']) && !is_null($data['data_saldo'])) {
          $data_saldo = $data['data_saldo'];
          $data_saldo = explode(" ", $data_saldo);
          list($date, $hora) = $data_saldo;
          $data_sem_barra = array_reverse(explode("/", $date));
          $data_sem_barra = implode("-", $data_sem_barra);
          $data_saldo = $data_sem_barra . " " . $hora;
        } else {
          $data_saldo = null;
        }
        /**CONVERSAO DATA ADIANTAMENTO */
        if (!empty($data['data_adiantamento']) && !is_null($data['data_adiantamento'])) {
          $data_adiantamento = $data['data_adiantamento'];
          $data_adiantamento = explode(" ", $data_adiantamento);
          list($date, $hora) = $data_adiantamento;
          $data_sem_barra = array_reverse(explode("/", $date));
          $data_sem_barra = implode("-", $data_sem_barra);
          $data_adiantamento = $data_sem_barra . " " . $hora;
        } else {
          $data_adiantamento = null;
        }
        /**CONVERSAO DATA BOLETO */
        if (!empty($data['data_boleto']) && !is_null($data['data_boleto'])) {
          $data_boleto = $data['data_boleto'];
          $data_boleto = explode(" ", $data_boleto);
          list($date, $hora) = $data_boleto;
          $data_sem_barra = array_reverse(explode("/", $date));
          $data_sem_barra = implode("-", $data_sem_barra);
          $data_boleto = $data_sem_barra . " " . $hora;
        } else {
          $data_boleto = null;
        }

        /**Relação cidades e estados*/

        /**DADOS TABELA */
        $origem_cidade = (new Cidades())->find("id = :cid", "cid={$frete->origem_cidade}")->fetch(true);
        $origem_uf = (new Estados())->find("id = :eid", "eid={$frete->origem_uf}")->fetch(true);
        $retirada_ch_vz_cidade = (new Cidades())->find("id = :cid", "cid={$frete->retirada_cheio_vazio_cidade}")->fetch(true);
        $retirada_cheio_vazio_uf = (new Estados())->find("id = :cid", "cid={$frete->retirada_cheio_vazio_uf}")->fetch(true);
        $destino_cidade = (new Cidades())->find("id = :cid", "cid={$frete->destino_cidade}")->fetch(true);
        $deposito_cheio_vazio_cidade = (new Cidades())->find("id = :cid", "cid={$frete->deposito_cheio_vazio_cidade}")->fetch(true);
        $deposito_cheio_vazio_uf = (new Estados())->find("id = :cid", "cid={$frete->deposito_cheio_vazio_uf}")->fetch(true);
        $destino_uf = (new Estados())->find("id = :cid", "cid={$frete->destino_uf}")->fetch(true);

        /**DADOS POST */
        $origem_uf_post = (new Estados())->find("id = :cid", "cid={$data['origem_uf']}")->fetch(true);
        $retirada_cheio_vazio_uf_post = (new Estados())->find("id = :cid", "cid={$data['retirada_cheio_vazio_uf']}")->fetch(true);
        $destino_uf_post = (new Estados())->find("id = :cid", "cid={$data['destino_uf']}")->fetch(true);
        $deposito_cheio_vazio_uf_post = (new Estados())->find("id = :cid", "cid={$data['dep_ch_vz_uf']}")->fetch(true);

        $dados_post = array(
          "Quantidade Vigente" => $data['qde_vg'],
          "Data Venda" =>  $data_venda,
          "Data Agendamento" =>  $data_agendamento,
          "Controle Interno" => $data['controle_interno'],
          "Tipo Categoria" => $data['tipo_categoria'],
          "Importador" => $data['importador'],
          "Exp-di-dta" => $data['exp_di_dta'],
          "Dimensao" => $data['dimensao'],
          "Size" => $data['dimensao'],
          "Tipo" => $data['tipo'],
          "IMO" => $data['imo'],
          "Rastreado" => $data['rastreado'],
          "Ref Cliente" => $data['ref_cliente'],
          "ndi-dta-reserva-nf" => $data['ndi_dta_reserva_nf'],
          "Container qnt carga solta" => $data['container_qnt_carga_solta'],
          "mercadoria produto" => $data['mercadoria_produto'],
          "Peso Total" => $data['peso_total'],
          "Valor cif" => $data['valor_cif'],
          "Origem Cidade"  => $relacao1[0]->nome,
          "Origem UF"  => $origem_uf_post[0]->uf,
          "Obs Origem"  => $data["obs_origem_cidade"],
          "Retirada CH-VZ-Cidade"  => $relacao2[0]->nome,
          "Retirada CH-VZ-UF"  => $retirada_cheio_vazio_uf_post[0]->uf,
          "Obs Retirada CH-VZ"  => $data["obs_retirada_chvz_cidade"],
          "Destino Cidade" => $relacao3[0]->nome,
          "Destino UF" => $destino_uf_post[0]->uf,
          "Obs Destino" => $data["obs_destino_cidade"],
          "Depósito CH-VZ Cidade" => $relacao4[0]->nome,
          "Depósito CH-VZ UF" => $deposito_cheio_vazio_uf_post[0]->uf,
          "Obs Depósito CH-VZ" => $data["obs_deposito_chvz_cidade"],
          "Doc Viagem CTE" => $data['doc_viagem_cte'],
          "Frete Motorista" => $data['frete_motorista'],
          "Custo Extra" => $data['custo_extra'],
          "Adiantamento" => $data['adiantamento'],
          "Tipo Transação" =>  $data['tipo_transacao'],
          "Data Adiantamento"  => $data_adiantamento,
          "Frete Saldo" => $data['frete_saldo'],
          "Tipo transação Saldo" => $data['tipo_transacao_saldo'],
          "Data Saldo" =>  $data_saldo,
          "Obs frete Motorista" => $data['obs_frete_motorista'],
          "Nº Fatura cliente" => $data['n_fatura_cliente'],
          "Valor Cliente" => $data['valor_cliente'],
          "Data Boleto" => $data_boleto,
          "Obs Cliente" => $data['obs_cliente'],
          "Obs Frete" => $data['obs_frete']
        );

        $dados_tabela = array(
          "Quantidade Vigente" => $frete->qde_vg,
          "Data Venda" => $frete->data_venda,
          "Data Agendamento" => $frete->data_agendamento,
          "Controle Interno" => $frete->controle_interno,
          "Tipo Categoria" => $frete->agenciamento_ou_cliente,
          "Importador" => $frete->importador,
          "Exp-di-dta" => $frete->exp_di_dta,
          "Dimensao" => $frete->dimensao,
          "Size" => $frete->size,
          "Tipo" => $frete->tipo,
          "IMO" => $frete->imo,
          "Rastreado" => $frete->rastreado,
          "Ref Cliente" => $frete->ref_cliente,
          "ndi-dta-reserva-nf" => $frete->ndi_dta_reserva_nf,
          "Container qnt carga solta" => $frete->container_qnt_carga_solta,
          "mercadoria produto" => $frete->mercadoria_produto,
          "Peso Total" => $frete->peso_total,
          "Valor cif" => $frete->valor_cif,
          "Origem Cidade"  =>  $origem_cidade[0]->nome,
          "Origem UF"  => $origem_uf[0]->uf,
          "Obs Origem"  => $frete->obs_origem_cidade,
          "Retirada CH-VZ-Cidade"  => $retirada_ch_vz_cidade[0]->nome,
          "Retirada CH-VZ-UF"  => $retirada_cheio_vazio_uf[0]->uf,
          "Obs Retirada CH-VZ"  => $frete->obs_retirada_chvz_cidade,
          "Destino Cidade" => $destino_cidade[0]->nome,
          "Destino UF" => $destino_uf[0]->uf,
          "Obs Destino" => $frete->obs_destino_cidade,
          "Depósito CH-VZ Cidade" => $deposito_cheio_vazio_cidade[0]->nome,
          "Depósito CH-VZ UF" => $deposito_cheio_vazio_uf[0]->uf,
          "Obs Depósito CH-VZ" => $frete->obs_deposito_chvz_cidade,
          "Doc Viagem CTE" => $frete->doc_viagem_cte,
          "Frete Motorista" => $frete->frete_motorista,
          "Custo Extra" => $frete->custo_extra,
          "Adiantamento" => $frete->adiantamento,
          "Tipo Transação" => $frete->tipo_transacao,
          "Data Adiantamento" => $frete->data_adiantamento,
          "Frete Saldo" => $frete->frete_saldo,
          "Tipo transação Saldo" => $frete->tipo_transacao_saldo,
          "Data Saldo" => $frete->data_saldo,
          "Obs frete Motorista" => $frete->obs_frete_motorista,
          "Nº Fatura cliente" => $frete->n_fatura_cliente,
          "Valor Cliente" => $frete->valor_cliente,
          "Data Boleto" => $frete->data_boleto,
          "Obs Cliente" => $frete->obs_cliente,
          "Obs Frete" => $frete->obs_frete
        );



        $frete->qde_vg = $data['qde_vg'];
        $frete->data_venda =  $data_venda;
        $frete->data_agendamento =  $data_agendamento;
        $frete->controle_interno = $data['controle_interno'];
        $frete->agenciamento_ou_cliente = $data['tipo_categoria'];
        $frete->importador = $data['importador'];
        $frete->exp_di_dta = $data['exp_di_dta'];
        $frete->dimensao = $data['dimensao'];
        $frete->size = $data['dimensao'];
        $frete->tipo = $data['tipo'];
        $frete->imo = $data['imo'];
        $frete->rastreado = $data['rastreado'];
        $frete->ref_cliente = $data['ref_cliente'];
        $frete->ndi_dta_reserva_nf = $data['ndi_dta_reserva_nf'];
        $frete->container_qnt_carga_solta = $data['container_qnt_carga_solta'];
        $frete->mercadoria_produto = $data['mercadoria_produto'];
        $frete->peso_total = $data['peso_total'];
        $frete->valor_cif = $data['valor_cif'];

        $frete->origem_cidade = $relacao1[0]->id;
        $frete->origem_uf = $data['origem_uf'] ? $data['origem_uf'] : null;
        $frete->obs_origem_cidade = $data["obs_origem_cidade"];
        $frete->retirada_cheio_vazio_cidade = $relacao2[0]->id;
        $frete->retirada_cheio_vazio_uf = $data['retirada_cheio_vazio_uf'] ? $data['retirada_cheio_vazio_uf'] : null;
        $frete->obs_retirada_chvz_cidade = $data["obs_retirada_chvz_cidade"];
        $frete->destino_cidade = $relacao3[0]->id;
        $frete->destino_uf = $data['destino_uf'] ? $data['destino_uf'] : null;
        $frete->obs_destino_cidade = $data["obs_destino_cidade"];
        $frete->deposito_cheio_vazio_cidade = $relacao4[0]->id;
        $frete->deposito_cheio_vazio_uf = $data['dep_ch_vz_uf'] ? $data['dep_ch_vz_uf'] : null;
        $frete->obs_deposito_chvz_cidade = $data["obs_deposito_chvz_cidade"];

        $frete->doc_viagem_cte = $data['doc_viagem_cte'];
        $frete->frete_motorista = $data['frete_motorista'];
        $frete->custo_extra = $data['custo_extra'];
        $frete->adiantamento = $data['adiantamento'];
        $frete->tipo_transacao = $data['tipo_transacao'];
        $frete->data_adiantamento = $data_adiantamento;
        $frete->frete_saldo = $data['frete_saldo'];
        $frete->tipo_transacao_saldo = $data['tipo_transacao_saldo'];
        $frete->data_saldo =  $data_saldo;
        $frete->obs_frete_motorista = $data['obs_frete_motorista'];
        $frete->n_fatura_cliente = $data['n_fatura_cliente'];
        $frete->valor_cliente = $data['valor_cliente'];
        $frete->data_boleto = $data_boleto;
        $frete->obs_cliente = $data['obs_cliente'];
        $frete->obs_frete = $data['obs_frete'];
        $frete->save();


        if ($frete->save() != false) {

          $nl_acesso = (new Nl_Acesso())->find("id = :mid", "mid={$_SESSION["nl_acesso"]}")->fetch(true);

          $arr_dif = array_diff_assoc($dados_post, $dados_tabela);
          foreach ($arr_dif as $key => $value) {
            if (is_null($dados_post["$key"]) or empty($dados_post["$key"])) {
              $dados_post["$key"] = "Vazio";
            }
            $logfrete = new Log_Fretes();
            $logfrete->frete_id = $frete->id;
            $logfrete->user_id = $_SESSION["user_id"];
            $logfrete->campo = $key;
            $logfrete->val_antigo = $dados_tabela["$key"];
            $logfrete->val_novo = $dados_post["$key"];
            $logfrete->save();
          }

          if (isset($data['scales'])) {
            
            foreach ($data as $key => $value) {
              
              if (empty($value) xor is_null($value)) {
                
                 echo "Campo:" . $key ." <br>";
                $_SESSION["decline_frete"] = "Campos:  $key <br>";
                $router->redirect("console/fretes/{$data["id_principal"]}");
           
              }
             
            }

            define("IDFRETE", "{$data["id_principal"]}");
            ob_start();
            require __DIR__ . "/invoice.php";
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml(ob_get_clean());
            $dompdf->setPaper("A4", "landscape");
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents('documents/' . $frete->id . '.pdf', $output);
            /**Salva caminho no banco de dados e */


            if ($frete->pdf()) {
              $buscadoc = (new Pdf_Frete())->find("id_frete = :fid", "fid={$data["id_principal"]}")->fetch(true);
              $salvadoc = (new Pdf_Frete())->findById($buscadoc[0]->id);
              $salvadoc->id_frete = $data["id_principal"];
              $salvadoc->caminho = 'documents/' . $frete->id . '.pdf';
              $salvadoc->save();
            } else {
              $newdoc = new Pdf_Frete();
              $newdoc->id_frete = $data["id_principal"];
              $newdoc->caminho = 'documents/' . $frete->id . '.pdf';
              $newdoc->save();
            }
          }
          $_SESSION["success_frete"] = "Alterações gerais feitas com sucesso!";
        } else {
          $_SESSION["decline_frete"] = "Erro na solicitação!";
        }

        $router->redirect("console/fretes/{$data["id_principal"]}");
        die();
         
       
                    
              