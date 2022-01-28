<?php $this->layout("/dashboard/_theme");?>
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Fatura</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-sm-3 m-md-5">
                    <div class="mb-4">
                        Olá <strong>Transdoni</strong>,
                        <br /> Aqui esta a fatura completa no valor de <strong>5.215,00</strong> (BRL) referente aos serviços prestados este mês.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-muted">Nosso Número</div>
                            <strong>741037024</strong>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <div class="text-muted">Data de vencimento</div>
                            <strong>16 de Julho de 2021</strong>
                        </div>
                    </div>

                    <hr class="my-4" />

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="text-muted">Cliente</div>
                            <strong>
                                TRANSDONI TRANSPORTES ERELI
                            </strong>
                            <p>
                                Rua Riachuelo <br> 45 cj 173B <br> Centro/Santos <br> BRA <br>
                                <a href="#">
                                    financeiro@transdoni.com.br
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <div class="text-muted">Prestador</div>
                            <strong>
                                GBS SOLUÇÕES EM TI LTDA
                            </strong>
                            <p>
                                Av. Conselheiro Nébias <br> 754 - Cj2408 B <br> Boqueirão <br> BRA <br>
                                <a href="#">
                                    financeiro@softgbs.com
                                </a>
                            </p>
                        </div>
                    </div>

                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Qnt</th>
                            <th class="text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Pacote Web Full</td>
                            <td>1</td>
                            <td class="text-right">R$ 3100.00</td>
                        </tr>
                        <tr>
                            <td>Pacote de Horas</td>
                            <td>75</td>
                            <td class="text-right">R$ 1225.00</td>
                        </tr>
                        <tr>
                            <td>Horas adicionais</td>
                            <td>10</td>
                            <td class="text-right">R$ 100.00</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Desconto</th>
                            <th class="text-right">R$ 422.16</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Imposto</th>
                            <th class="text-right">R$ 8.00</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th> </th>
                            <th class="text-right">5%</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Total </th>
                            <th class="text-right">R$ 268.85</th>
                        </tr>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <p class="text-sm">
                            <strong>Extra note:</strong> As informações acima são de caráter informativo.
                        </p>

                        <a href="#" class="btn btn-primary">
                            Imprimir esse recibo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>