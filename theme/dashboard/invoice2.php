<?php $this->layout("dashboard/_invoice");
$url = URL_BASE; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
 <link type="text/css" rel="stylesheet" href="http://localhost/transdoni/assets/css/app.css"/>
    <link type="text/css" rel="stylesheet" href="http://localhost/transdoni/assets/landing/css/bootstrap.min.css"/>
</head>


<main class="content">
            <div class="container-fluid p-0">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body m-sm-3 m-md-5">

                                <div class="row">
                                    <div class="col-md-6">
                                       <img src="<?= url("assets/img/invoice.png")?>" width="100px" alt="image"/>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3 ">
                                        <table class="table small text-center" style="border:thin solid gray;">
                                            <tr>
                                                <td>Ref / CTE</td>
                                                <td> </td>
                                                <td>Data</td>
                                            </tr>
                                            <tr>
                                                <th>125 / GFD890S</th>
                                                <th> </th>
                                                <th>12/10/2021</th>
                                            </tr>

                                        </table>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <table class="table-responsive-lg col-sm-12 text-center"
                                           style="border:thin solid gray;">
                                        <tbody>
                                        <tr>
                                            <td>QTD. VG</td>
                                            <td>CONTROLE INTERNO</td>
                                            <td>MODALIDE</td>
                                            <td>CLIENTE / TRANSPORTADORA</td>
                                        </tr>
                                        <tr>
                                            <th>1254</th>
                                            <th>1254</th>
                                            <th class="">AGENCIAMENTO</th>
                                            <th class="">GBS SOLUÇÕES EM TI</th>
                                        </tr>
                                        <tr>
                                            <td>TIPO</td>
                                            <td>SIZE</td>
                                            <td>TIPO</td>
                                            <td>IMO</td>
                                            <td>CONTAINER / QTE.LCL</td>
                                            <td>RASTREADO</td>
                                            <td>REF.CLIENTE</td>
                                        </tr>
                                        <tr>
                                            <th>DTA</th>
                                            <th>40</th>
                                            <th>HC</th>
                                            <th class="">ASSDFASDG-4</th>
                                            <th class="">NÃO</th>
                                            <th class="">SIM</th>
                                            <th>ASFD12SD3</th>
                                        </tr>
                                        <tr>
                                            <td>DI / DTA / NF</td>
                                            <td>MARCADORIA / PRODUTO</td>
                                            <td>PESO TOTAL</td>
                                            <td>VALOR CIF R$</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">ASFD12SD3</th>
                                            <th>COPOS DE PLÁSTICO DE 350ML</th>
                                            <th>4582</th>
                                            <th>54,864</th>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <table CLASS="text-center">
                                    <tbody>
                                    <tr >
                                        <td style="width: 70%">
                                        <a><br>INFORMAÇÕES DO MOTORISTA</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="col-lg-12">
                                    <table class=" table-responsive-sm col-sm-12"
                                           style="border: thin solid gray;">
                                        <tbody>
                                        <tr>
                                            <td>NOME</td>
                                            <td>CPF</td>
                                        </tr>
                                        <tr>
                                            <th>GUSTAVO BOMFIM ENGEL</th>
                                            <th>52*.***.**8-20</th>
                                        </tr>
                                        <tr>
                                            <td>PLACA DO CAMINHÃO</td>
                                            <td>RENAVAM</td>
                                            <td>MODELO</td>
                                            <td>COR</td>
                                            <td>TIPO</td>
                                        </tr>
                                        <tr>
                                            <th>125A58D</th>
                                            <th>654567546545664</th>
                                            <th>SCANIA F0879</th>
                                            <th class="">PRETO</th>
                                            <th class="">TRUCK</th>
                                        </tr>
                                        <tr>
                                            <td>PLACA DO REBOQUE</td>
                                            <td>RENAVAM</td>
                                            <td>TIPO REBOQUE</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">125A58D</th>
                                            <th>654567546545664</th>
                                            <th>2X 40</th>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <table CLASS="text-center">
                                    <tbody>
                                    <tr >
                                        <td style="width: 70%">
                                            <a><br>INFORMAÇÕES OPERACIONAIS</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="col-lg-12">
                                    <table class=" table-responsive-sm col-sm-12"
                                           style="border:thin solid gray;">
                                        <tbody>
                                        <tr>
                                            <td>CDA TERMINAL COLETA</td>
                                            <td>SDA TERMINAL COLETA</td>
                                            <td>CDA CLIENTE</td>
                                            <td>SDA CLIENTE</td>
                                            <td>DEVOLUÇÃO VAZIO/BEM. CHEIO</td>
                                        </tr>
                                        <tr>
                                            <th>12/12/2021 12:32</th>
                                            <th>12/12/2021 12:32</th>
                                            <th>12/12/2021 12:32</th>
                                            <th>12/12/2021 12:32</th>
                                            <th>12/12/2021 12:32</th>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
