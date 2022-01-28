<?php

use Source\Models\User;

$this->layout("/dashboard/_theme");

messageEditFrete();
/** @var TYPE_NAME $client */

$url = URL_BASE;
?>

<div class="container-fluid p-0">

        <div class="row">
                <div class="col-sm-3">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title mb-4">Nº Referência CTE</h5>
                                        <h3 class="mt-1 mb-3"><?= $frete[0]->id . "/" . $frete[0]->doc_viagem_cte ?> </h3>
                                        <div class="mb-1">
                                                <span class="text-success"><a href="<?= $url ?>console/fretes">Consultar</a> </span>
                                                <span class="text-muted">todos os CT-Es</span>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="col-sm-3">
                        <button style="display: none" id="fetchstatus" data-act="<?= url("console/fetchStatus") ?>" data-freteid="<?= $frete[0]->id ?>">aq</button>

                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title mb-4">Status</h5>

                                        <form id="statusform" action="console/editStatus">
                                                <input type="text" style="display: none;" name="id_status" id="id_status" value="<?= $frete[0]->id ?>" />
                                                <input type="text" style="display: none" name="tem_motorista" id="tem_motorista" value="<?= $frete[0]->motoristas() ? true : false ?>" />
                                                <input type="text" style="display: none" name="tem_cliente" id="tem_cliente" value="<?= $frete[0]->clientes() ? true : false ?>" />
                                                <div class="text-center m-3 ">
                                                        <select class="form-control" name="status" id="status" onchange="$('#statusform').submit()">
                                                                <option id="options" selected disabled> Selecione</option>
                                                                <?php
                                                                foreach ($status as $statu) :
                                                                ?>

                                                                        <option value="<?= $statu->id ?>"><?= $statu->status_desc ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                        </select>
                                                        <div class="m-3">
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                        </div>
                </div>
                <div class="col-sm-3">
                        <div class="card">
                                <div class="card-body text-center">
                                        <h5 class="card-title mb-4">Candidaturas</h5>
                                        <h3 id="qntmotorista" class="mt-1"><?= $n_candidatos ?> <?= $n_candidatos > 1 ? "Motoristas" : "Motorista"  ?> </h3>
                                        <div class="mb-3">
                                                <span class="text-muted mb-3">candidato(s) para este frete</span>
                                        </div>
                                        <button class="badge btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#candidatos" aria-controls="candidatos">Ver </button>

                                </div>
                        </div>
                </div>
                <div class="col-sm-3">
                        <div class="card">
                                <div class="card-body">
                                        <h5 class="card-title mb-4">Histórico de Edição</h5>
                                        <h3 class="mt-1 mb-3"> </h3>
                                        <div class="mb-1 text-center">
                                                <span class="text-muted">Veja o que foi alterado nesta documentação<br><br></span>
                                                <button class="badge btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Exibir </button>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <form method="post" action="<?= $url ?>console/editGeral">
                <div class="row">
                        <div class="col-12 col-lg-12">
                                <div class="accordion" id="accordionExample">
                                        <!-- Geral -->
                                        <div class="col-lg-12 ">
                                                <div class="row mb-3">
                                                        <div class="col-lg-10"></div>
                                                        <div class="col-lg-2">
                                                                <a class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#docfrete" aria-controls="docfrete">Editar documentação</a>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="card">
                                                <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="headingOne">
                                                        <h5 class="card-title my-2">
                                                                Comercial / Informações / Viagens / Solicitações
                                                        </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">

                                                                <input type="text" style="display: none" name="id_principal" value="<?= $frete[0]->id ?>">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="data_venda">Data Venda</label>
                                                                                        <input type="text" name="data_venda" class="form-control" value="" id="data-venda" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="data_agendamento">Data Agendamento <small><b>(Se houver)</b></small></label>
                                                                                        <input type="text" name="data_agendamento" class="form-control" value="" id="data_agendamento" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-8">
                                                                                        <label class="form-label" for="inputUsername">Cliente / Transportador</label>
                                                                                        <?= $frete[0]->clientes() ? "<input type='text' name='razao' class='form-control' id='inputUsername'  value='{$frete[0]->clientes()[0]->razao_social}'>" : "<button type='button' class='form-control btn btn-info' data-toggle='modal' data-target='#modalCliente' >Buscar Cliente</button>" ?>

                                                                                </div>

                                                                        </div>

                                                                        <div class="row mb-3">
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">QDE. VG</label>
                                                                                        <input type="text" name="qde_vg" value="<?= $frete[0]->qde_vg ? $frete[0]->qde_vg : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">Controle Interno</label>
                                                                                        <input type="text" name="controle_interno" value="<?= $frete[0]->controle_interno ?  $frete[0]->controle_interno : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">Agenciamento / Cliente direto </label>

                                                                                        <select class="form-control" value="<?= $frete[0]->agenciamento_ou_cliente ? $frete[0]->agenciamento_ou_cliente : null ?>" name="tipo_categoria" id="">
                                                                                                <option selected disabled>Selecione</option>
                                                                                                <option value="Agenciamento">Agenciamento</option>
                                                                                                <option value="Cliente Direto">Cliente Direto</option>
                                                                                                <option value="Sobcontratação">Sobcontratação</option>
                                                                                                <option value="Documental">Documental</option>
                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">EXP / DI / DTA</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->exp_di_dta ? $frete[0]->exp_di_dta : null ?>" name="exp_di_dta" id="exp_di_dta">
                                                                                                <option selected disabled>Selecione</option>
                                                                                                <option value="EXP">EXP</option>
                                                                                                <option value="DI">DI</option>
                                                                                                <option value="DTA">DTA</option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">DIMENSÃO</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->dimensao ? $frete[0]->dimensao : null ?>" name="dimensao" id="addas">
                                                                                                <?php

                                                                                                if ($frete[0]->dimensao == "20") :
                                                                                                ?>
                                                                                                        <option value="<?= $frete[0]->dimensao ?>"><?= $frete[0]->dimensao ?></option>
                                                                                                        <option value='40'>40</option>
                                                                                                <?php
                                                                                                elseif ($frete[0]->dimensao == "40") :
                                                                                                ?>
                                                                                                        <option value="<?= $frete[0]->dimensao ?>"><?= $frete[0]->dimensao ?></option>
                                                                                                        <option value='20'>20</option>
                                                                                                <?php
                                                                                                else :
                                                                                                        echo "<option selected disabled>Selecione</option>
                                                                                                        <option value='20'>20</option>
                                                                                                        <option value='40'>40</option>";
                                                                                                endif;
                                                                                                ?>

                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">TIPO (SIZE)</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->tipo ? $frete[0]->tipo : null ?>" name="tipo" id="tipo">
                                                                                                <?php
                                                                                                if ($frete[0]->tipo) :
                                                                                                ?>
                                                                                                        <option value="<?= $frete[0]->tipo ?>"><?= $frete[0]->tipo ?></option>
                                                                                                        <option value="DR">DR</option>
                                                                                                        <option value="HC">HC</option>
                                                                                                        <option value="FR">FR</option>
                                                                                                        <option value="TQ">TQ</option>
                                                                                                        <option value="VT">VT</option>
                                                                                                        <option value="OP">OP</option>
                                                                                                        <option value="PT">PT</option>
                                                                                                        <option value="RF">RF</option>
                                                                                                <?php
                                                                                                else :
                                                                                                ?>
                                                                                                        <option selected disabled>Selecionar</option>
                                                                                                        <option value="DR">DR</option>
                                                                                                        <option value="HC">HC</option>
                                                                                                        <option value="FR">FR</option>
                                                                                                        <option value="TQ">TQ</option>
                                                                                                        <option value="VT">VT</option>
                                                                                                        <option value="OP">OP</option>
                                                                                                        <option value="PT">PT</option>
                                                                                                        <option value="RF">RF</option>
                                                                                                <?php
                                                                                                endif;
                                                                                                ?>
                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">container / QTE. LCL</label>
                                                                                        <input type="text" name="container_qnt_carga_solta" value="<?= $frete[0]->container_qnt_carga_solta ? $frete[0]->container_qnt_carga_solta : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">IMO <b>(OBRIGATÓRIO)</b></label>
                                                                                        <select class="form-control" name="imo" id="imo" value="<?= $frete[0]->imo ? $frete[0]->imo : null ?>">
                                                                                                <?php
                                                                                                if ($frete[0]->imo) :
                                                                                                ?>
                                                                                                        <option value="<?= $frete[0]->imo ?>"><?= $frete[0]->imo == "1" ? "SIM" : "NÃO"; ?></option>
                                                                                                        <?= $frete[0]->imo == "1" ? "" : "<option value='1'>SIM</option>"; ?>
                                                                                                        <?= $frete[0]->imo == "2" ? "" : "<option value='2'>NÃO</option>"; ?>
                                                                                                <?php
                                                                                                else :
                                                                                                ?>
                                                                                                        <option selected disabled>Selecione</option>
                                                                                                        <option value="1">SIM</option>
                                                                                                        <option value="2">NÃO</option>
                                                                                                <?php
                                                                                                endif;
                                                                                                ?>

                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">RASTREADO</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->rastreado ? $frete[0]->rastreado : null ?>" name="rastreado" id="rastreado">
                                                                                                <?php
                                                                                                if ($frete[0]->rastreado) :
                                                                                                ?>
                                                                                                        <option value="<?= $frete[0]->rastreado ?>"><?= $frete[0]->rastreado == "1" ? "SIM" : "NÃO"; ?></option>
                                                                                                        <?= $frete[0]->rastreado == "1" ? "" : "<option value='1'>SIM</option>"; ?>
                                                                                                        <?= $frete[0]->rastreado == "2" ? "" : "<option value='2'>NÃO</option>"; ?>
                                                                                                <?php
                                                                                                else :
                                                                                                ?>
                                                                                                        <option selected disabled>Selecione</option>
                                                                                                        <option value="1">SIM</option>
                                                                                                        <option value="2">NÃO</option>
                                                                                                <?php
                                                                                                endif;
                                                                                                ?>
                                                                                        </select>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">REF. Cliente</label>
                                                                                        <input type="text" name="ref_cliente" value="<?= $frete[0]->ref_cliente ? $frete[0]->ref_cliente : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">N° DI / DTA RESERVA / NF</label>
                                                                                        <input type="text" name="ndi_dta_reserva_nf" value="<?= $frete[0]->ndi_dta_reserva_nf ? $frete[0]->ndi_dta_reserva_nf : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-6">
                                                                                        <label class="form-label" for="inputUsername">MERCADORIA/ PRODUTO</label>
                                                                                        <input type="text" name="mercadoria_produto" value="<?= $frete[0]->mercadoria_produto ? $frete[0]->mercadoria_produto : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">PESO TOTAL (CARGA + CC)</label>
                                                                                        <input type="text" name="peso_total" value="<?= $frete[0]->peso_total ? $frete[0]->peso_total : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">VALOR CIF R$</label>
                                                                                        <input type="text" name="valor_cif" value="<?= $frete[0]->valor_cif ? $frete[0]->valor_cif : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">Docto Viagem (CT-e / OC)</label>
                                                                                        <input type="text" name="doc_viagem_cte" class="form-control" value="<?= $frete[0]->doc_viagem_cte ?>" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">Importador</label>
                                                                                        <input type="text" name="importador" class="form-control" value="<?= $frete[0]->importador ? $frete[0]->importador : null ?>" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="origem_cidade">ORIGEM </label>
                                                                                        <input type="search" name="origem_cidade" id="origem_cidade" class="form-control" value="<?= $frete[0]->origem_city() ? $frete[0]->origem_city()[0]->nome : null ?>" list="cidades1" onchange="FetchEstado1(this.value)" autocomplete="off">
                                                                                        <datalist name="cidades1" id="cidades1">
                                                                                                <?php
                                                                                                foreach ($cidades as $cidade) :
                                                                                                ?>
                                                                                                        <option value="<?= $cidade->nome ?>"></option>
                                                                                                <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                        </datalist>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                        <label class="form-label" for="origem_uf">UF</label>
                                                                                        <select type="text" name="origem_uf" id="origem_uf" class="form-control">
                                                                                                <option value="<?= $frete[0]->origem_uf ? $frete[0]->origem_uf : null ?>"><?= $frete[0]->uf_origem() ? $frete[0]->uf_origem()[0]->uf : null ?></option>

                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-9">
                                                                                        <label class="form-label" for="obs_origem_cidade">Endereço detalhado</label>
                                                                                        <textarea class="form-control" id="obs_origem_cidade" name="obs_origem_cidade" rows="1"><?= $frete[0]->obs_origem_cidade ? $frete[0]->obs_origem_cidade : '' ?></textarea>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="retirada_cheio_vazio_cidade">RETIRADA CH/VAZIO</label>
                                                                                        <input type="search" name="retirada_cheio_vazio_cidade" id="retirada_cheio_vazio_cidade" class="form-control" value="<?= $frete[0]->retirada_ch_vz() ? $frete[0]->retirada_ch_vz()[0]->nome : null ?>" list="cidades2" onchange="FetchEstado2(this.value)" autocomplete="off">
                                                                                        <datalist name="cidades2" id="cidades2">
                                                                                                <?php
                                                                                                foreach ($cidades as $cidade) :
                                                                                                ?>
                                                                                                        <option value="<?= $cidade->nome ?>"></option>
                                                                                                <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                        </datalist>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                        <label class="form-label" for="retirada_cheio_vazio_uf">UF</label>
                                                                                        <select type="text" name="retirada_cheio_vazio_uf" id="retirada_cheio_vazio_uf" class="form-control">
                                                                                                <option value="<?= $frete[0]->retirada_cheio_vazio_uf ? $frete[0]->retirada_cheio_vazio_uf : null ?>"><?= $frete[0]->retirada_ch_vz_uf() ?  $frete[0]->retirada_ch_vz_uf()[0]->uf : null ?></option>

                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-9">
                                                                                        <label class="form-label" for="obs_retirada_chvz_cidade">Endereço detalhado</label>
                                                                                        <textarea class="form-control" id="obs_retirada_chvz_cidade" name="obs_retirada_chvz_cidade" rows="1"><?= $frete[0]->obs_retirada_chvz_cidade ? $frete[0]->obs_retirada_chvz_cidade : '' ?></textarea>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="destino_cidade">DESTINO</label>
                                                                                        <input type="search" name="destino_cidade" id="destino_cidade" class="form-control" value="<?= $frete[0]->destino_city() ? $frete[0]->destino_city()[0]->nome : null ?>" list="cidades2" onchange="FetchEstado3(this.value)" autocomplete="off">
                                                                                        <datalist name="cidades3" id="cidades3">
                                                                                                <?php
                                                                                                foreach ($cidades as $cidade) :
                                                                                                ?>
                                                                                                        <option value="<?= $cidade->nome ?>"></option>
                                                                                                <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                        </datalist>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                        <label class="form-label" for="destino_uf">UF</label>
                                                                                        <select type="text" name="destino_uf" id="destino_uf" class="form-control">
                                                                                                <option value="<?= $frete[0]->destino_uf ? $frete[0]->destino_uf : null ?>"><?= $frete[0]->destin_uf() ? $frete[0]->destin_uf()[0]->uf : null ?></option>

                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-9">
                                                                                        <label class="form-label" for="obs_destino_cidade">Endereço detalhado</label>
                                                                                        <textarea class="form-control" id="obs_destino_cidade" name="obs_destino_cidade" rows="1"><?= $frete[0]->obs_destino_cidade ? $frete[0]->obs_destino_cidade : '' ?></textarea>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">DP DO CHEIO/ VAZIO</label>
                                                                                        <input type="search" name="dep_ch_vz_cidade" id="dep_ch_vz_cidade" class="form-control" value="<?= $frete[0]->deposito_ch_vz() ? $frete[0]->deposito_ch_vz()[0]->nome : null ?>" list="cidades4" onchange="FetchEstado4(this.value)" autocomplete="off">
                                                                                        <datalist name="cidades4" id="cidades4">
                                                                                                <?php
                                                                                                foreach ($cidades as $cidade) :
                                                                                                ?>
                                                                                                        <option value="<?= $cidade->nome ?>"></option>
                                                                                                <?php
                                                                                                endforeach;
                                                                                                ?>
                                                                                        </datalist>
                                                                                </div>
                                                                                <div class="col-1">
                                                                                        <label class="form-label" for="inputUsername">UF</label>
                                                                                        <select type="text" name="dep_ch_vz_uf" id="dep_ch_vz_uf" class="form-control">
                                                                                                <option value="<?= $frete[0]->deposito_cheio_vazio_uf ? $frete[0]->deposito_cheio_vazio_uf : null ?>"><?= $frete[0]->deposito_ch_vz_uf() ? $frete[0]->deposito_ch_vz_uf()[0]->uf : null ?></option>

                                                                                        </select>

                                                                                </div>
                                                                                <div class="col-9">
                                                                                        <label class="form-label" for="obs_deposito_chvz_cidade">Endereço detalhado</label>
                                                                                        <textarea class="form-control" id="obs_deposito_chvz_cidade" name="obs_deposito_chvz_cidade" rows="1"><?= $frete[0]->obs_deposito_chvz_cidade ? $frete[0]->obs_deposito_chvz_cidade : '' ?></textarea>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- Motorista -->
                                        <div class="card">
                                                <div id="select-motorista">
                                                        <div class="card-header" data-toggle="collapse" <?= $frete[0]->motoristas() ? "data-target='#collapseTwo'" : "( indisponível )" ?> aria-expanded="true" aria-controls="collapseOne" id="headingTwo">
                                                                <h5 class="card-title my-2 align-content-between">
                                                                        Informações do motorista
                                                                        <span id="infodriver">
                                                                                <?= $frete[0]->motoristas() ? "<a type='button' class='text-primary' data-toggle='modal' data-target='#modalMotorista'> Alterar motorista<a/>" : "<a type='button' class='text-info' data-toggle='modal' data-target='#modalMotorista'> Selecione um motorista<a/>" ?>
                                                                        </span>
                                                                </h5>
                                                        </div>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3">
                                                                                <div class="col-4">
                                                                                        <label class="form-label" for="drivername">Nome</label>
                                                                                        <input type="text" id="drivername" name="nome" value="<?= $frete[0]->motoristas()[0]->nome ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                        <label class="form-label" for="driversobrenome">Sobrenome</label>
                                                                                        <input type="text" id="driversobrenome" name="sobrenome" value="<?= $frete[0]->motoristas()[0]->sobrenome ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                        <label class="form-label" for="drivercpf">CPF</label>
                                                                                        <input type="text" id="drivercpf" name="cpf" value="<?= $frete[0]->motoristas()[0]->cpf ?>" class="form-control" disabled>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="dplacacar">Placa Caminhão</label>
                                                                                        <input type="text" id="dplacacar" name="placa_caminhao" value="<?= $frete[0]->caminhao()[0]->placa_caminhao ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="drenavamcar">Renavam Caminhão</label>
                                                                                        <input type="text" id="drenavamcar" name="renavam_caminhao" value="<?= $frete[0]->caminhao()[0]->renavam_caminhao ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                        <label class="form-label" for="dmodelocar">Modelo</label>
                                                                                        <input type="text" id="dmodelocar" name="modelo" value="<?= $frete[0]->caminhao()[0]->modelo ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="dcorcar">Cor</label>
                                                                                        <input type="text" id="dcorcar" name="cor" value="<?= $frete[0]->caminhao()[0]->cor ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="dtipocar">Tipo Caminhão</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->caminhao()[0]->tipo_caminhao ?>" name="tipo_caminhao" id="dtipocar" disabled>
                                                                                                <option value="<?= $frete[0]->caminhao()[0]->tipo_caminhao ?>">
                                                                                                        <?= $frete[0]->caminhao()[0]->tipo_caminhao ?>
                                                                                                </option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">Placa Reboque</label>
                                                                                        <input type="text" id="placa_reboque" name="placa_reboque" value="<?= $frete[0]->reboque() ? $frete[0]->reboque()[0]->placa_reboque : 'Sem Reboque' ?>" class="form-control" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">Renavam Reboque</label>
                                                                                        <input type="text" id="renavam_reboque" name="renavam_reboque" value="<?= $frete[0]->reboque() ? $frete[0]->reboque()[0]->renavam_reboque : 'Sem Reboque' ?>" class="form-control" id="inputUsername" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="tipo_reboque">Tipo Reboque</label>
                                                                                        <select class="form-control" value="<?= $frete[0]->reboque() ? $frete[0]->reboque()[0]->tipo_reboque : 'Sem Reboque' ?>" name="tipo_reboque" id="tipo_reboque" disabled>
                                                                                                <option value="<?= $frete[0]->reboque() ? $frete[0]->reboque()[0]->tipo_reboque : 'Sem Reboque' ?>">
                                                                                                        <?= $frete[0]->reboque() ? $frete[0]->reboque()[0]->tipo_reboque : 'Sem Reboque' ?>
                                                                                                </option>
                                                                                        </select>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- Operacional -->
                                        <div class="card">
                                                <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree">
                                                        <h5 class="card-title my-2">
                                                                <a href="#" aria-expanded="true" aria-controls="collapseOne">
                                                                        Informações Operacionais
                                                                </a>
                                                        </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3 ">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="cda_terminal">CDA TERMINAL COLETA</label>
                                                                                        <?php $frete[0]->cda_terminal_coleta ? $cda_terminal_coleta = new DateTime($frete[0]->cda_terminal_coleta) : $cda_terminal_coleta = '' ?>
                                                                                        <input type="text" id="cda_terminal" class="form-control text-center" value="<?= $cda_terminal_coleta ? $cda_terminal_coleta->format("d/m/Y - H:i") : "Sem data" ?>" disabled>
                                                                                </div>
                                                                                <div class=" col-2">
                                                                                        <label class="form-label" for="sda_terminal">SDA TERMINAL COLETA</label>
                                                                                        <?php $frete[0]->sda_terminal_coleta ? $sda_terminal_coleta = new DateTime($frete[0]->sda_terminal_coleta) :  $sda_terminal_coleta = '' ?>
                                                                                        <input type="text" id="sda_terminal" value="<?= $sda_terminal_coleta ? $sda_terminal_coleta->format("d/m/Y - H:i") : "Sem data" ?>" class="form-control text-center" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">CDA CLIENTE</label>
                                                                                        <?php $frete[0]->cda_cliente ? $cda_cliente = new DateTime($frete[0]->cda_cliente) : $cda_cliente = '' ?>
                                                                                        <input type="text" id="cda_cliente" class="form-control text-center" value="<?= $cda_cliente ? $cda_cliente->format("d/m/Y - H:i") : 'Sem Data' ?>" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">SDA DO CLIENTE</label>
                                                                                        <?php $frete[0]->sda_cliente ? $sda_cliente = new DateTime($frete[0]->sda_cliente) : $sda_cliente = '' ?>
                                                                                        <input type="text" id="sda_cliente" class="form-control text-center" value="<?= $sda_cliente ? $sda_cliente->format("d/m/Y - H:i") : "Sem data" ?>" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">DEV VZ/ BEM. CHEIO</label>
                                                                                        <?php $frete[0]->devolucao_vazio ? $devolucao_vazio = new DateTime($frete[0]->devolucao_vazio) : $devolucao_vazio = '' ?>
                                                                                        <input type="text" id="dev_ch" class="form-control text-center" value="<?= $devolucao_vazio ? $devolucao_vazio->format("d/m/Y - H:i") : "Sem data" ?>" disabled>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername" style="color: transparent">atualizar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;operação </label>
                                                                                        <button type="button" data-toggle='modal' id="inputUsername" data-target='#modalOperacao' class="btn btn-success">Atualizar Operação</button>
                                                                                </div>
                                                                        </div>


                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- Frete motorista -->
                                        <div class="card">
                                                <div class="card-header" id="headingFor" data-toggle="collapse" data-target="#collapseFor">
                                                        <h5 class="card-title my-2">
                                                                <a href="#" aria-expanded="true" aria-controls="collapseOne">
                                                                        Frete Valor Motorista
                                                                </a>
                                                        </h5>
                                                </div>
                                                <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername"> FRETE MOTORISTA</label>
                                                                                        <input type="text" name="frete_motorista" value="<?= $frete[0]->frete_motorista ?  $frete[0]->frete_motorista : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">CUSTO EXTRA</label>
                                                                                        <input type="text" name="custo_extra" value="<?= $frete[0]->custo_extra ? $frete[0]->custo_extra : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">ADIANTAMENTO</label>
                                                                                        <select name="tipo_transacao_saldo" value="<?= $frete[0]->adiantamento ? $frete[0]->adiantamento : null ?>" class="form-control" id="inputUsername">
                                                                                                <option selected disabled>Selecione</option>
                                                                                                <option value="Dinheiro">Dinheiro</option>
                                                                                                <option value="Pix">Pix</option>
                                                                                                <option value="TED">TED</option>
                                                                                                <option value="DOC">DOC</option>
                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">TIPO DE TRANSAÇÃO</label>
                                                                                        <input type="text" name="tipo_transacao" value="<?= $frete[0]->tipo_transacao ? $frete[0]->tipo_transacao : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="data-adiantamento">DATA ADIANTAMENTO</label>
                                                                                        <input type="text" name="data_adiantamento" value="<?= $frete[0]->data_adiantamento ? $frete[0]->data_adiantamento : null ?>" class="form-control" id="data-adiantamento" autocomplete="off">
                                                                                </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername"> FRETE SALDO</label>
                                                                                        <input type="text" name="frete_saldo" value="<?= $frete[0]->frete_saldo ? $frete[0]->frete_saldo : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                        <label class="form-label" for="inputUsername">TIPO DE TRANSAÇÃO</label>
                                                                                        <select name="tipo_transacao_saldo" value="<?= $frete[0]->tipo_transacao_saldo ? $frete[0]->tipo_transacao_saldo : null ?>" class="form-control" id="inputUsername">
                                                                                                <option selected disabled>Selecione</option>
                                                                                                <option value="Dinheiro">Dinheiro</option>
                                                                                                <option value="Pix">Pix</option>
                                                                                                <option value="TED">TED</option>
                                                                                                <option value="DOC">DOC</option>
                                                                                        </select>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="data-saldo">DATA SALDO</label>
                                                                                        <input type="text" name="data_saldo" value="<?= $frete[0]->data_saldo ? $frete[0]->data_saldo : null ?>" class="form-control" id="data-saldo" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-5">
                                                                                        <label class="form-label" for="inputUsername">Obs</label>
                                                                                        <input type="text" name="obs_frete_motorista" value="<?= $frete[0]->obs_frete_motorista ? $frete[0]->obs_frete_motorista : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- Faturamento CLiente -->
                                        <div class="card">
                                                <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive">
                                                        <h5 class="card-title my-2">
                                                                <a href="#" aria-expanded="true" aria-controls="collapseOne">
                                                                        Faturamento Cliente
                                                                </a>
                                                        </h5>
                                                </div>
                                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3">
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">Nº FATURA CLIENTE</label>
                                                                                        <input type="text" name="n_fatura_cliente" value="<?= $frete[0]->n_fatura_cliente ? $frete[0]->n_fatura_cliente : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="inputUsername">VALOR CLIENTE</label>
                                                                                        <input type="text" name="valor_cliente" value="<?= $frete[0]->valor_cliente ? $frete[0]->valor_cliente : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-2">
                                                                                        <label class="form-label" for="data-boleto">DATA BOLETO</label>
                                                                                        <input type="text" name="data_boleto" value="<?= $frete[0]->data_boleto ? $frete[0]->data_boleto : null ?>" class="form-control" id="data-boleto" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-6">
                                                                                        <label class="form-label" for="inputUsername">OBSERVAÇÃO CLIENTE</label>
                                                                                        <input type="text" name="obs_cliente" value="<?= $frete[0]->obs_cliente ? $frete[0]->obs_cliente : null ?>" class="form-control" id="inputUsername" autocomplete="off">
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <!-- Observações frete -->
                                        <div class="card">
                                                <div class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix">
                                                        <h5 class="card-title my-2">
                                                                <a href="#" aria-expanded="true" aria-controls="collapseOne">
                                                                        Observações do Frete
                                                                </a>
                                                        </h5>
                                                </div>
                                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="col-md-12 ">
                                                                        <div class="row mb-3">
                                                                                <div class="col-6">
                                                                                        <label for="obs_frete" class="form-label">Descreva as observações</label>
                                                                                        <textarea name="obs_frete" id="obs_frete" class="form-control" rows="4"><?= $frete[0]->obs_frete ?></textarea>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <div id="buttonsform" class="row">

                        <div class="col-2">
                                <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="form-control btn btn-danger">Cancelar Edição</a>
                        </div>
                        <div class="col-3">

                                <button type="submit" class="form-control btn-primary">Salvar Alterações</button>
                        </div>
                        <?php if ($frete[0]->status_frete === "1" || $frete[0]->status_frete === "6") : ?>
                                <div class="col-2">
                                        <input type="checkbox" id="scales" name="scales">
                                        <label for="scales"><b>Gerar PDF do frete</b></label>
                                </div>
                        <?php endif; ?>
                </div>
        </form>
</div>

<!-- Modal Motorista -->
<div class="modal fade" id="modalMotorista" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Escolha um motorista</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?= $url ?>console/editMotorista">
                                <input type="text" style="display: none" name="id_frete_motorista" value="<?= $frete[0]->id ?>">
                                <div class="modal-body m-3">
                                        <label>Escolha um motorista</label>
                                        <input type="search" class="form-control" name="motorista" id="motorista" list="motorista1" onchange="FetchCaminhao(this.value)">
                                        <datalist name="motorista1" id="motorista1" required>
                                                <option>Selecione um Motorista</option>
                                                <?php
                                                foreach ($motoristas as $motorista) :
                                                ?>
                                                        <option value="<?= $motorista->id ?>"><?= $motorista->nome . " " . $motorista->sobrenome ?> </option>
                                                <?php
                                                endforeach;
                                                ?>
                                        </datalist>


                                        <br>
                                        <label>Escolha um Caminhao</label>
                                        <select class="form-control" name="caminhao" id="caminhao" onchange="FetchReboque(this.value)" required>
                                                <option>Selecione um Caminhão</option>
                                        </select>
                                        <br>

                                        <label>Escolha um Reboque</label>
                                        <select class="form-control" name="reboque" id="reboque" required>
                                                <option>Selecione o cavalo</option>

                                        </select>


                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Mudar Motorista</button>
                                </div>
                        </form>
                </div>
        </div>
</div>
<!-- Modal Motorista -->

<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Alteração de Cliente</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?= $url ?>console/editFreteCliente">
                                <input type="text" style="display: none" name="id_frete_cliente" value="<?= $frete[0]->id ?>">
                                <div class="modal-body m-3">
                                        <input type="search" class="form-control" name="cliente" list="cliente1">
                                        <datalist id="cliente1">
                                                <?php
                                                foreach ($clientes as $cliente) :
                                                ?>
                                                        <option value="<?= $cliente->id ?>"><?= $cliente->razao_social ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                        </datalist>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Mudar Cliente</button>
                                </div>
                        </form>
                </div>
        </div>
</div>
<!-- Modal Cliente -->

<!-- Modal Operação -->
<div class="modal fade" id="modalOperacao" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Atualizar operação</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body center">
                                <form action="<?= url("console/editOperacao") ?>" method="post">
                                        <div class="row mb-3">
                                                <input type="text" style="display: none" name="id_frete_operacao" value="<?= $frete[0]->id ?>" autocomplete="off">
                                                <div class="row mb-4">

                                                        <div class="col-4">
                                                                <label class="form-label" for="cda_terminal_coleta">CDA TERMINAL COLETA</label>
                                                                <input type="text" name="cda_terminal_coleta" class="cdaterminalcoleta" id="cda_terminal_coleta" autocomplete="off">

                                                        </div>
                                                        <div class="col-4">
                                                                <label class="form-label" for="sda_terminal_coleta">SAÍDA TERMINAL COLETA</label>
                                                                <input type="text" name="sda_terminal_coleta" class="sda_terminal_coleta" id="sda_terminal_coleta" autocomplete="off">
                                                        </div>
                                                        <div class="col-4">
                                                                <label class="form-label" for="prev_cda_cliente">PREV CHEGADA CLIENTE</label>
                                                                <input type="text" name="prev_cda_cliente" class="prev_cda_cliente" id="prev_cda_cliente" autocomplete="off">
                                                        </div>
                                                </div>
                                                <div class="row mb-4">
                                                        <div class="col-4">
                                                                <label class="form-label" for="inputUsername">CHEGADA CLIENTE</label>
                                                                <input type="text" name="cda_cliente" class="cda_cliente" id="cda_cliente" autocomplete="off">
                                                        </div>
                                                        <div class="col-4">
                                                                <label class="form-label" for="inputUsername">SAÍDA DO CLIENTE</label>
                                                                <input type="text" name="sda_cliente" class="sda_cliente" id="sda_cliente" autocomplete="off">

                                                        </div>
                                                        <div class="col-4">
                                                                <label class="form-label" for="prev_cda_devolucao">PREV CHEGADA DEVOLUCAO</label>
                                                                <input type="text" name="prev_cda_devolucao" class="prev_cda_devolucao" id="prev_cda_devolucao" autocomplete="off">
                                                        </div>
                                                </div>
                                                <div class="row">

                                                        <div class="col-4">
                                                                <label class="form-label" for="devolucao_vazio">DEVOLUÇÃO VAZIO/ BEM. CHEIO</label>
                                                                <input type="text" name="devolucao_vazio" class="devolucao_vazio" id="devolucao_vazio" autocomplete="off">
                                                        </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer text-center">
                                                <div class="row mb-3">
                                                        <div class="col-12">

                                                                <button type="submit" class="btn btn-success">Atualizar Operação</button>
                                                        </div>
                                                </div>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>

<!--off canvas docfrete -->
<div class="offcanvas offcanvas-top" id="docfrete" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
                <h3 id="off-center">Documentação referente ao do frete <?= $frete[0]->id . "/" . $frete[0]->doc_viagem_cte ?> </h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>
        <div class="offcanvas-body">
                <div class="row mb-3" style="background-color: #f2f2f2;">
                        <div class="col-lg-12 mb-3">
                                <div class="row mb-3"></div>
                                <form method="POST" enctype="multipart/form-data" action="<?= url("console/docfrete/upload") ?>">

                                        <div class="row mb-3 text-center">
                                                <h4>Cadastrar novo documento para este frete</h4>
                                                <div class="col-2"></div>
                                                <div class="col-3">
                                                        <label class="form-label" for="titulo_doc">Título</label>
                                                        <input type="hidden" name="idfrete_doc" value="<?= $frete[0]->id ?>">
                                                        <input type="text" class="form-control" name="titulo_doc" id="titulo_doc">
                                                </div>
                                                <div class="col-2">
                                                        <label class="form-label" for="categoria_doc">Categoria</label>
                                                        <select class="form-control" name="categoria_doc" id="categoria_doc">
                                                                <option selected disabled>Selecione</option>
                                                                <option value="Comprovantes">Comprovantes</option>
                                                                <option value="Documentos">Documentos</option>
                                                                <option value="Despesas">Despesas</option>
                                                        </select>
                                                </div>
                                                <div class="col-2 mb-3">
                                                        <label for="caminho_doc" class="form-label">Upload de arquivos</label>
                                                        <input class="form-control" type="file" name="caminho_doc" id="caminho_doc">
                                                </div>
                                                <div class="col-1">
                                                        <label for="caminho_doc" class="form-label" style="color: transparent;">Enviar Doc </label>
                                                        <button type="submit" class="btn btn-primary mb-3" id="upload">Upload</button>
                                                </div>
                                                <div class="col-2"></div>
                                        </div>
                                </form>
                        </div>
                </div>
                <?php if ($docfrete) : ?>
                        <h5 id="offcanvasTopLabel text-center">Filtrar por: Nome do operador, data e hora de alteração, nível de acesso e campos alterados</h5>
                        <table id="tabledocfrete" class="table table-striped text-center" style="width:100%">
                                <thead>
                                        <tr>
                                                <th>Id frete</th>
                                                <th>Título</th>
                                                <th>Categoria</th>
                                                <th>Ações</th>

                                        </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($docfrete as $doc) : ?>
                                                <tr>
                                                        <td><?= $doc->id_frete ?></td>
                                                        <td><?= $doc->titulo ?></td>
                                                        <td><?= $doc->categoria ?></td>
                                                        <td> 
                                                        <a href="<?= url("{$doc->docfrete}") ?>" download="<?= $doc->docfrete ?>"><i class="align-middle" data-feather="download"></i></a>        
                                                        <a target="_blank" href="<?= url("{$doc->docfrete}") ?>"><i class="align-middle" data-feather="eye"></i></a>
                                                        </td>
                                                </tr>

                                        <?php endforeach; ?>
                                </tbody>
                        </table>
                <?php else : ?>
                        <div class="row mb-3 text-center">
                                <h4>Não existe documentação para este frete</h4>
                        </div>
                <?php endif; ?>

        </div>
</div>
<!-- fim offcanvas docfrete-->

<!-- offcanvas historico-->
<div class="offcanvas offcanvas-top" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
                <h3 id="off-center">Histórico de edições do frete <?= $frete[0]->id . "/" . $frete[0]->doc_viagem_cte ?> </h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
                <?php if ($history) : ?>
                        <h5 id="offcanvasTopLabel text-center">Filtrar por: Nome do operador, data e hora de alteração, nível de acesso e campos alterados</h5>

                        <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                        <tr>
                                                <th>Data</th>
                                                <th>Hora</th>
                                                <th>Nome do operador</th>
                                                <th>Nivel hierarquico</th>
                                                <th>Nome do campo alterado</th>
                                                <th>Valor antigo</th>
                                                <th>Valor novo</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($history as $log) : ?>
                                                <?php $created_at = new DateTime($log->created_at); ?>
                                                <tr>
                                                        <td><?php echo $created_at->format("d/m/Y"); ?></td>
                                                        <td><?php echo  $created_at->format("H:i:s"); ?> </td>
                                                        <td><?= $log->user()->nome . " " . $log->user()->sobrenome ?></td>
                                                        <td><?= $log->nl_acesso()[0]->desc_acesso ?></td>
                                                        <td><?= $log->campo ?></td>
                                                        <td><?= $log->val_antigo ?></td>
                                                        <td><?= $log->val_novo ?></td>
                                                </tr>
                                        <?php endforeach; ?>

                                </tbody>

                        </table>
                <?php else : ?>
                        <h2>Não existe histórico disponível.</h2>
                <?php endif; ?>
        </div>
</div>
<!--fim offcanvas histórico-->

<!-- offcanvas candidato-->
<div class="offcanvas offcanvas-top" id="candidatos" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
                <h3 id="off-center">Candidaturas do frete <?= $frete[0]->id . "/" . $frete[0]->doc_viagem_cte ?> </h3>
                <button id="clbutton" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
                <?php if ($candidaturas) : ?>
                        <h5 id="offcanvasTopLabel text-center">Filtrar por: Nome do candidato, data e hora de incrição.</h5>

                        <table id="examples" class="table table-striped" style="width:100%">
                                <thead>
                                        <tr>
                                                <th>Data</th>
                                                <th>Motorista</th>
                                                <th>Status</th>
                                                <th>Informações cadastrais</th>
                                                <th>Ação</th>

                                        </tr>
                                </thead>
                                <tbody>
                                        <?php foreach ($candidaturas as $candidatura) : ?>
                                                <?php $created_at = new DateTime($candidatura->created_at); ?>
                                                <tr>
                                                        <td><?php echo $created_at->format("d/m/Y H:i:s"); ?></td>
                                                        <td> <?= $candidatura->motoristas()[0]->nome . " " . $candidatura->motoristas()[0]->sobrenome ?></td>
                                                        <td> <?= $candidatura->statu()[0]->status_desc ?></td>
                                                        <td><button class="badge btn-primary" data-actione="<?= url("console/fetch/candidato") ?>" data-id="<?= $candidatura->motoristas()[0]->id ?>">Ver perfil completo</button></td>
                                                        <td id="aproved">
                                                                <?php if ($candidatura->statu()[0]->id != "2") : ?>
                                                                        <button type="button" style="border: none;" onmouseover="this.setAttribute('style', 'background-color: green; border: none;')" onmouseout="this.setAttribute('style', 'text-decoration: none; border: none;')" class=" badge btn-secondary" data-id="<?= $candidatura->id ?>" data-status="2" data-action="<?= url("console/alteraCandidatura") ?>">Aprovar</button>
                                                                <?php else : ?>
                                                                        <span class="badge btn-success">Aprovado</span>
                                                                <?php endif; ?>
                                                        </td>



                                                </tr>
                                        <?php endforeach; ?>

                                </tbody>

                        </table>
                <?php else : ?>
                        <h2>Não existe candidatos para o frete.</h2>
                <?php endif; ?>
        </div>
</div>

<!-- Modal edit motorista -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="background-color:#f0f0f0;">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ver Perfil de <span id="driver_nome1"></span></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body" style="align-items: center;">
                                <div class="row mb-3">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                        <a class="nav-link active" id="ab1-tab" data-toggle="tab" href="#ab1" role="tab" aria-controls="ab1" aria-selected="true">Informações Pessoais</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="ab2-tab" data-toggle="tab" href="#ab2" role="tab" aria-controls="ab2" aria-selected="false">Informações Bancárias</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="ab3-tab" data-toggle="tab" href="#ab3" role="tab" aria-controls="ab3" aria-selected="false">Registro de caminhões</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="ab4-tab" data-toggle="tab" href="#ab4" role="tab" aria-controls="ab4" aria-selected="false">Registro de reboques</a>
                                                </li>
                                        </ul>
                                </div>
                                <div class="tab-content">
                                        <div class="tab-pane fade show active" id="ab1" role="tabpanel" aria-labelledby="ab1-tab">
                                                <table class="table table-sm text-center">
                                                        <tbody>
                                                                <tr class="table-secondary">
                                                                        <th>Status da Conta</th>
                                                                        <th>Nome</th>
                                                                        <th>Sobrenome</th>
                                                                        <th>Email</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_status"></td>
                                                                        <td id="driver_nome"></td>
                                                                        <td id="driver_sobrenome"></td>
                                                                        <td id="driver_email"></td>
                                                                </tr>
                                                                <tr class="table-secondary">
                                                                        <th>CPF</th>
                                                                        <th>RG</th>
                                                                        <th>CNH</th>
                                                                        <th>Validade CNH</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_cpf"></td>
                                                                        <td id="driver_rg"></td>
                                                                        <td id="driver_cnh"></td>
                                                                        <td id="driver_validadecnh"></td>
                                                                </tr>
                                                                <tr class="table-secondary">
                                                                        <th>Telefone Principal</th>
                                                                        <th>CEP</th>
                                                                        <th>Rua</th>
                                                                        <th>Nº</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_phone"></td>
                                                                        <td id="driver_cep"></td>
                                                                        <td id="driver_rua"></td>
                                                                        <td id="driver_numero"></td>
                                                                </tr>
                                                                <tr class="table-secondary">
                                                                        <th>Bairro</th>
                                                                        <th>Cidade</th>
                                                                        <th>Estado</th>
                                                                        <th>Possui Indivisível</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_bairro"></td>
                                                                        <td id="driver_cidade"></td>
                                                                        <td id="driver_estado"></td>
                                                                        <td id="driver_indivisivel"></td>
                                                                </tr>
                                                                <tr class="table-secondary">
                                                                        <th>Possui Mopp</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_mopp"></td>
                                                                </tr>
                                                        </tbody>
                                                </table>
                                        </div>

                                        <div class="tab-pane fade" id="ab2" role="tabpanel" aria-labelledby="ab2-tab">
                                                <table class="table table-sm text-center">
                                                        <tbody>
                                                                <tr class="table-secondary">
                                                                        <th>Agência</th>
                                                                        <th>Conta</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_agencia"></td>
                                                                        <td id="driver_conta"></td>
                                                                </tr>
                                                                <tr class="table-secondary">
                                                                        <th>Nome do Titular</th>
                                                                        <th>CPF do Titular</th>
                                                                </tr>
                                                                <tr>
                                                                        <td id="driver_titular"></td>
                                                                        <td id="driver_cpftitular"></td>
                                                                </tr>
                                                        </tbody>
                                                </table>
                                        </div>
                                        <div class="tab-pane fade" id="ab3" role="tabpanel" aria-labelledby="ab3-tab">

                                                <table id='camtable' class='table table-sm text-center'>
                                                        <thead>
                                                                <tr class='table-secondary'>
                                                                        <th>Renavam</th>
                                                                        <th>Venc. doc</th>
                                                                        <th>Placa</th>
                                                                        <th>Modelo</th>
                                                                        <th>Tipo</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody id="tab99">

                                                        </tbody>
                                                </table>


                                        </div>
                                        <div class="tab-pane fade" id="ab4" role="tabpanel" aria-labelledby="ab4-tab">
                                                <table id="rebtable" class='table table-sm text-center'>
                                                        <thead>
                                                                <tr class='table-secondary'>
                                                                        <th>Renavam</th>
                                                                        <th>Venc. doc</th>
                                                                        <th>Placa</th>
                                                                        <th>Tipo</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody id="tab100">

                                                        </tbody>
                                                </table>

                                        </div>
                                </div>
                        </div>
                </div>

        </div>
</div>

<div class="modal fade" id="loading" role="dialog" style=" background-color: rgba(0, 0, 0, .0001) !important;" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="background-color: transparent;" role="document">
                <div class="modal-content" style="background-color: transparent;">
                        <div class="modal-body text-center" style="background-color: transparent;">
                                <img src="<?= url("assets/img/carregando.gif") ?>" width="100px" />
                        </div>

                </div>
        </div>
</div>

<?= $this->push("scripts") ?>
<script type="text/javascript">
        $(document).ready(function() {
                $('body').on("click", "[data-action]", function(e) {
                        e.preventDefault();
                        var data = $(this).data();

                        Swal.fire({
                                title: 'Tem certeza?',
                                text: "Você não poderá reverter isso!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sim, Aprovar motorista!',
                                cancelButtonText: 'Cancelar'
                        }).then((result) => {
                                if (result.isConfirmed) {
                                        $.post(data.action, data, function(data) {
                                                console.log(data);
                                                if (data.statuscandidatura === "2") {
                                                        $("#aproved").html("<span class='badge btn-success'>Aprovado</span>")
                                                        $("#select-motorista").html(data.motorista);
                                                        $("#drivername").val(data.nome);
                                                        $("#driversobrenome").val(data.sobrenome);
                                                        $("#drivercpf").val(data.cpf);
                                                        $("#dplacacar").html(data.placacaminhao);
                                                        $("#drenavamcar").html(data.renavam);
                                                        $("#dmodelocar").html(data.modelo);
                                                        $("#dcorcar").html(data.cor);
                                                        $("#dtipocar").html(data.tipocaminhao);
                                                        $("#placa_reboque").html(data.placareboque);
                                                        $("#renavam_reboque").html(data.renavam_reboque);
                                                        $("#tipo_reboque").html(data.tiporeboque);
                                                        $('select[name="status"]').html(data.status);
                                                        $("#qntmotorista").html(data.qntmotorista);
                                                        $("#clbutton").click();
                                                }
                                                Swal.fire({
                                                        icon: data.icon,
                                                        title: data.title,
                                                        text: data.msg
                                                });

                                        }, "json").fail(function(data) {
                                                console.log(data);

                                                alert("Erro ao processar requisição");
                                        });
                                }
                        });
                });

                $('body').on("click", "[data-actione]", function(e) {
                        e.preventDefault();
                        var data = $(this).data();

                        $.post(data.actione, data, function(data) {

                                $("#exampleModal").modal('show');
                                $("#driver_id").val(data.id);
                                $("#driver_nome1").html(data.nomesobrenome);
                                $("#driver_status").html(data.statusconta);
                                $("#driver_nome").html(data.nome);
                                $("#driver_sobrenome").html(data.sobrenome);
                                $("#driver_email").html(data.email);
                                $("#driver_cpf").html(data.cpf);
                                $("#driver_rg").html(data.rg);
                                $("#driver_cnh").html(data.cnh);
                                $("#driver_validadecnh").html(data.validadecnh);
                                $("#driver_phone").html(data.phone);
                                $("#driver_cep").html(data.cep);
                                $("#driver_rua").html(data.rua);
                                $("#driver_numero").html(data.numero);
                                $("#driver_bairro").html(data.bairro);
                                $("#driver_cidade").html(data.cidade);
                                $("#driver_estado").html(data.estado);
                                $("#driver_agencia").html(data.banco);
                                $("#driver_conta").html(data.conta);
                                $("#driver_titular").html(data.titular);
                                $("#driver_cpftitular").html(data.cpfconta);
                                $("#tab99").html(data.output);
                                $("#tab100").html(data.outputreb);
                                $("#driver_indivisivel").each(function() {
                                        if (data.indivisivel === '1') {
                                                $(this).html('Sim');
                                        } else
                                        if (data.indivisivel === null) {
                                                $(this).html('Não');
                                        } else
                                        if (data.indivisivel === '') {
                                                $(this).html('Não');
                                        } else
                                        if (data.indivisivel === '0') {
                                                $(this).html('Não');
                                        }
                                });
                                $("#driver_mopp").each(function() {
                                        if (data.mopp === '1') {
                                                $(this).html('Sim');
                                        } else
                                        if (data.mopp === null) {
                                                $(this).html('Não');
                                        } else
                                        if (data.mopp === '') {
                                                $(this).html('Não');
                                        } else
                                        if (data.mopp === '0') {
                                                $(this).html('Não');
                                        }
                                });
                        }, "json").fail(function(data) {
                                console.log(data);
                                alert("Erro ao processar requisição");
                        });
                });

                $('#example').DataTable({
                        "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                        },
                        "order": [
                                [0, "desc"]
                        ],
                        "lengthMenu": [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Todos"]
                        ]
                });
                $('#tabledocfrete').DataTable({
                        "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                        },
                        "order": [
                                [0, "desc"]
                        ],
                        "lengthMenu": [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Todos"]
                        ]
                });
                $('#examples').DataTable({
                        "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                        },
                        "lengthMenu": [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Todos"]
                        ]
                });


        });

        function FetchCaminhao(id) {
                $('#caminhao').html('');
                $('#reboque').html('<option value="">Selecione o reboque</option>');
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_carro.php') ?>',
                        data: {
                                motorista_id: id
                        },
                        success: function(data) {
                                $('#caminhao').html(data);
                        }

                })
        }

        function FetchReboque(id) {
                $('#reboque').html('');
                var idss = $("#motorista").val();
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_carro.php') ?>',
                        data: {
                                caminhao_id: idss
                        },
                        success: function(data) {
                                $('#reboque').html(data);
                        }

                })
        }

        function FetchEstado1(id) {
                $('#origem_uf').html('');
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_estado.php') ?>',
                        data: {
                                estado_id: id
                        },
                        success: function(data) {
                                $('#origem_uf').html(data);
                        }

                })
        }

        function FetchEstado2(id) {
                $('#retirada_cheio_vazio_uf').html('');
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_estado.php') ?>',
                        data: {
                                estado_id: id
                        },
                        success: function(data) {
                                $('#retirada_cheio_vazio_uf').html(data);
                        }

                })
        }

        function FetchEstado3(id) {
                $('#destino_uf').html('');
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_estado.php') ?>',
                        data: {
                                estado_id: id
                        },
                        success: function(data) {
                                $('#destino_uf').html(data);
                        }

                })
        }

        function FetchEstado4(id) {
                $('#dep_ch_vz_uf').html('');
                $.ajax({
                        type: 'post',
                        url: '<?= url('theme/fragments/geradores/buscar_estado.php') ?>',
                        data: {
                                estado_id: id
                        },
                        success: function(data) {
                                $('#dep_ch_vz_uf').html(data);
                        }

                })
        }

        $(document).ready(function() {
                <?php $data_venda = new DateTime($frete[0]->data_venda) ?>
                $('#data-venda').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->data_venda ? $data_venda->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $data_agendamento = new DateTime($frete[0]->data_agendamento) ?>
                $('#data_agendamento').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->data_agendamento ? $data_agendamento->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $data_saldo = new DateTime($frete[0]->data_saldo) ?>
                $('#data-saldo').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->data_saldo ? $data_saldo->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $data_adiantamento = new DateTime($frete[0]->data_adiantamento) ?>
                $('#data-adiantamento').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->data_adiantamento ? $data_adiantamento->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $data_boleto = new DateTime($frete[0]->data_boleto) ?>
                $('#data-boleto').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->data_boleto ? $data_boleto->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $cda_terminal_coleta = new DateTime($frete[0]->cda_terminal_coleta) ?>
                $('#cda_terminal_coleta').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->cda_terminal_coleta ? $cda_terminal_coleta->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $sda_terminal_coleta = new DateTime($frete[0]->sda_terminal_coleta) ?>
                $('#sda_terminal_coleta').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->sda_terminal_coleta ? $sda_terminal_coleta->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $prev_chegada_cliente = new DateTime($frete[0]->prev_chegada_cliente) ?>
                $('#prev_cda_cliente').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->prev_chegada_cliente ? $prev_chegada_cliente->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $cda_cliente = new DateTime($frete[0]->cda_cliente) ?>
                $('#cda_cliente').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->cda_cliente ? $cda_cliente->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $sda_cliente = new DateTime($frete[0]->sda_cliente) ?>
                $('#sda_cliente').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->sda_cliente ? $sda_cliente->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $prev_chegada_devolucao = new DateTime($frete[0]->prev_chegada_devolucao) ?>
                $('#prev_cda_devolucao').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->prev_chegada_devolucao ? $prev_chegada_devolucao->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })
                <?php $devolucao_vazio = new DateTime($frete[0]->devolucao_vazio) ?>
                $('#devolucao_vazio').datetimepicker({
                        timepicker: true,
                        datepicker: true,
                        format: 'd/m/Y H:i:s',
                        value: '<?= $frete[0]->devolucao_vazio ? $devolucao_vazio->format("d/m/Y H:i:s") : '' ?>',
                        hours12: false,
                        step: 15,
                        yearStart: 2018,
                        yearEnd: 2024
                })

        });

        function tog(v) {
                return v ? "addClass" : "removeClass";
        }
        $(document).on("change", ".cdaterminalcoleta", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".cdaterminalcoleta", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".cdaterminalcoleta", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".sda_terminal_coleta", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".sda_terminal_coleta", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".sda_terminal_coleta", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".prev_cda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".prev_cda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".prev_cda_cliente", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".cda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".cda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".cda_cliente", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".sda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".sda_cliente", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".sda_cliente", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".prev_cda_devolucao", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".prev_cda_devolucao", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".prev_cda_devolucao", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });



        $(document).on("change", ".devolucao_vazio", function() {
                $(this)[tog(this.value)]("x");
        }).on("input", ".devolucao_vazio", function() {
                $(this)[tog(this.value)]("x");
        }).on("mouseover", ".devolucao_vazio", function() {
                $(this)[tog(this.value)]("x");

        }).on("mousemove", ".x", function(e) {
                $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]("onX");
        }).on("touchstart click", ".onX", function(ev) {
                ev.preventDefault();
                $(this).removeClass("x onX").val("").change();
        });

        $(document).ready(function($) {

                $('body').on("click", "[data-act]", function(e) {
                        e.preventDefault();
                        var data = $(this).data();

                        $.post(data.act, data, function(data) {
                                if (data.idstatus === "2") {
                                        $("input").prop('disabled', true);
                                        $("select").prop('disabled', true);
                                        $("textarea").prop('disabled', true);
                                        $("#buttonsform").hide();
                                        $("#infodriver").hide();
                                        $("#id_status").prop('disabled', false);
                                        $("#tem_motorista").prop('disabled', false);
                                        $("#tem_cliente").prop('disabled', false);

                                        if (data.nlacesso === "1") {
                                                console.log(data.nlacesso);
                                                $('select[name="status"]').prop('disabled', false);
                                        } else {
                                                $('select[name="status"]').prop('disabled', true);
                                                $('select[name="status"]').html('<option>Canceldo</option>');
                                        }
                                } else if (data.idstatus === "8") {
                                        $("input").prop('disabled', true);
                                        $("select").prop('disabled', true);
                                        $("textarea").prop('disabled', true);
                                        $("#buttonsform").hide();
                                        $("#infodriver").hide();
                                        $("#id_status").prop('disabled', false);
                                        $("#tem_motorista").prop('disabled', false);
                                        $("#tem_cliente").prop('disabled', false);

                                        if (data.nlacesso === "1") {
                                                $('select[name="status"]').prop('disabled', false);
                                        } else {
                                                $('select[name="status"]').prop('disabled', true);
                                                $('select[name="status"]').html('<option>Finalizado</option>');
                                        }
                                } else {
                                        $("#infodriver").show();
                                        $("#buttonsform").show();
                                        $("input").prop('disabled', false);
                                        $("select").prop('disabled', false);
                                        $("textarea").prop('disabled', false);
                                        $("#cda_terminal").prop('disabled', true);
                                        $("#sda_terminal").prop('disabled', true);
                                        $("#cda_cliente").prop('disabled', true);
                                        $("#sda_cliente").prop('disabled', true);
                                        $("#dev_ch").prop('disabled', true);
                                        $("#drivername").prop('disabled', true);
                                        $("#driversobrenome").prop('disabled', true);
                                        $("#drivercpf").prop('disabled', true);
                                        $("#dplacacar").prop('disabled', true);
                                        $("#drenavamcar").prop('disabled', true);
                                        $("#dmodelocar").prop('disabled', true);
                                        $("#dcorcar").prop('disabled', true);
                                        $("#dtipocar").prop('disabled', true);
                                        $("#placa_reboque").prop('disabled', true);
                                        $("#renavam_reboque").prop('disabled', true);
                                        $("#tipo_reboque").prop('disabled', true);
                                }
                                console.log(data);


                        }, "json").fail(function(data) {
                                console.log(data);
                                alert("Erro ao processar requisição");
                        });

                });
                $("#fetchstatus").click();

                // on submit...
                $('#statusform').submit(function(e) {
                        e.preventDefault();
                        $("#options").html('');

                        $.ajax({
                                type: "POST",
                                url: '<?= url("console/editStatus") ?>',
                                data: $(this).serialize(), // get all form field value in serialize form
                                dataType: "json",
                                async: true,
                                beforeSend: function() {

                                        $("#loading").modal({
                                                backdrop: 'static',
                                                keyboard: false
                                        });
                                        $("#loading").modal("show");

                                },
                                success: function(data) {
                                        $("#options").html(data.option);
                                        if (data.idstatus === "2") {
                                                $("input").prop('disabled', true);
                                                $("select").prop('disabled', true);
                                                $("textarea").prop('disabled', true);
                                                $('select[name="status"]').prop('disabled', false);
                                                $("#id_status").prop('disabled', false);
                                                $("#tem_motorista").prop('disabled', false);
                                                $("#tem_cliente").prop('disabled', false);
                                                $("#buttonsform").hide();

                                                if (data.nlacesso === "1") {
                                                        $('select[name="status"]').prop('disabled', false);
                                                } else {
                                                        $('select[name="status"]').prop('disabled', true);
                                                        $('select[name="status"]').html('<option>Cancelado</option>');
                                                }
                                        } else if (data.idstatus === "8") {
                                                $("input").prop('disabled', true);
                                                $("select").prop('disabled', true);
                                                $("textarea").prop('disabled', true);
                                                $('select[name="status"]').prop('disabled', false);
                                                $("#id_status").prop('disabled', false);
                                                $("#tem_motorista").prop('disabled', false);
                                                $("#tem_cliente").prop('disabled', false);
                                                $("#buttonsform").hide();
                                                $("#infodriver").hide();

                                                if (data.nlacesso === "1") {
                                                        $('select[name="status"]').prop('disabled', false);
                                                } else {
                                                        $('select[name="status"]').prop('disabled', true);
                                                        $('select[name="status"]').html('<option>Finalizado</option>');
                                                }
                                        } else {
                                                $("input").prop('disabled', false);
                                                $("select").prop('disabled', false);
                                                $("textarea").prop('disabled', false);
                                                $("#cda_terminal").prop('disabled', true);
                                                $("#sda_terminal").prop('disabled', true);
                                                $("#cda_cliente").prop('disabled', true);
                                                $("#sda_cliente").prop('disabled', true);
                                                $("#dev_ch").prop('disabled', true);
                                                $("#drivername").prop('disabled', true);
                                                $("#driversobrenome").prop('disabled', true);
                                                $("#drivercpf").prop('disabled', true);
                                                $("#dplacacar").prop('disabled', true);
                                                $("#drenavamcar").prop('disabled', true);
                                                $("#dmodelocar").prop('disabled', true);
                                                $("#dcorcar").prop('disabled', true);
                                                $("#dtipocar").prop('disabled', true);
                                                $("#placa_reboque").prop('disabled', true);
                                                $("#ranavam_reboque").prop('disabled', true);
                                                $("#tipo_reboque").prop('disabled', true);
                                                $("#buttonsform").show();
                                                $("#infodriver").show();

                                        }
                                        Swal.fire({
                                                icon: data.icon,
                                                title: data.title,
                                                text: data.msg,
                                                confirmButtonText: 'Ok'
                                        }).then((result) => {
                                                /* Read more about isConfirmed, isDenied below */
                                                if (result.isConfirmed) {
                                                        $("#loading").modal("hide");
                                                } else {
                                                        $("#loading").modal("hide");
                                                }
                                        });
                                        console.log(data);


                                },
                                complete: function() {
                                        $("#loading").modal("hide");
                                },
                                error: function(e) {
                                        console.log(e);
                                }
                        });
                });

        });
</script>
<?php $this->end() ?>