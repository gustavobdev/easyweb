<?php

$this->layout("/dashboard/_theme");

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);


if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['nome'])) {

    $router->redirect("/login");
}

messageDash();
?>


<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Dashboard</strong> Principal </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <input class="form-control " type="text" id="cte" name="cte" placeholder="Insira aqui o numero do CTE" autocomplete="off" />
                        </div>
                        <div class="col-3">
                            <button type="button" data-action="<?= url("console/cria/frete") ?>" data-cte="" class="btn btn-primary ">Criar Novo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <input id="searchinput" type="text" class="form-control" placeholder="Busque pelo numero do CTE" autocomplete="off" />
                        </div>
                        <div class="col-3">
                            <button type="button" data-actione="<?= url("console/searchcte") ?>" data-cte="" class="btn btn-success ">Buscar Frete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-xxl-6 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Total de CT-E</h5>
                                <h3 class="mt-1 mb-3"><?= $frete ?> </h3>
                                <div class="mb-1">
                                    <span class="text-success"><a href="<?= url("/console/fretes") ?>">Consultar</a> </span>
                                    <span class="text-muted">todos os CT-Es</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Pendentes de CT-e</h5>
                                <h3 class="mt-1 mb-3"><?= $secte ?></h3>
                                <div class="mb-1">
                                    <a href="<?= url("/console/fretes") ?>"><i class="mdi mdi-arrow-bottom-right"></i> Consultar</a>
                                    <span class="text-muted">todos os pendentes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Em Processo <small><b>(Editando)</b></small></h5>
                                <h3 class="mt-1 mb-3"><?= $emop ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Em modo de edição</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Saldo Pendente</h5>
                                <h3 class="mt-1 mb-3">R$ 8.654,21</h3>
                                <div class="mb-1">
                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-6 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Em Operação <small><b>(Em transporte)</b></small></h5>
                                <h3 class="mt-1 mb-3"><?= $emtransp ?> </h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Transporte de carga iniciado </span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Finalizados do dia</h5>
                                <h3 class="mt-1 mb-3"><?= $finalizados ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Fretes finalizados hoje</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Sem Caminhoneiro</h5>
                                <h3 class="mt-1 mb-3"><?= $semmot ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted"> Fretes sem motorista</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Faturados</h5>
                                <h3 class="mt-1 mb-3"><?= $faturados ?></h3>
                                <div class="mb-1">
                                    <span class="text-muted">Fretes faturados</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Últimos adicionados <small><b>(Ultimos 5 adicionados)</b></small></h4>
            </div>
            <div class="card-body">
                <table id="hometable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id / CTE</th>
                            <th>Criação</th>
                            <th>Origem / Destino</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Motorista</th>
                            <th>Faturamento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($fretes) :
                            /*@var Clients*/
                            foreach ($fretes as $frete) :
                                $created_at = new DateTime($frete->created_at);

                        ?>
                                <tr>
                                    <td><?= $frete->id . "/"; ?> <?= $frete->doc_viagem_cte ? $frete->doc_viagem_cte : "Vazio" ?></td>
                                    <td><?= $created_at->format("d/m/Y H:i:s") ?></td>
                                    <td>
                                        <?= $frete->origem_city() ?  $frete->origem_city()[0]->nome . " / " : "Vazio / "; ?>
                                        <?= $frete->uf_origem() ? $frete->uf_origem()[0]->uf . " => " :  "Vazio => "; ?>
                                        <?= $frete->destino_city() ? $frete->destino_city()[0]->nome . " / " : "Vazio / "; ?>
                                        <?= $frete->destin_uf() ? $frete->destin_uf()[0]->uf : "Vazio"; ?></td>
                                    <td>
                                        <?= $frete->clientes() ? $frete->clientes()[0]->razao_social : "Sem cliente" ?> <a href="<?= url("console/clientes/") ?>">
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <?= $frete->status_fretes()[0]->status_desc ?>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <?= $frete->motoristas() ? $frete->motoristas()[0]->nome . " " . $frete->motoristas()[0]->sobrenome : "Sem motorista"; ?>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a><?= $frete->n_fatura_cliente ? 'Faturado' : 'Não faturado' ?></a>
                                    </td>

                                    <td class="table-action">
                                        <a href="<?= url("console/fretes/{$frete->id}") ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                        <?php
                                        if ($frete->pdf()) : ?>
                                            <a href="<?= URL_BASE . $frete->pdf()[0]->caminho ?>" download="<?= $frete->doc_viagem_cte ?>"><i class="align-middle" data-feather="download"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;

                        else :
                            ?>
                            <h4>Não existem fretes cadastrados</h4>
                        <?php
                        endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar CTE </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div style="border-width: 3px;  border-style:double; border-color: #f2f2f2;">
                    <table class="table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id / CTE</th>
                                <th>Data de criação</th>
                                <th>Origem / Destino </th>
                                <th>Cliente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="idcte"></td>
                                <td id="criacao"></td>
                                <td id="origemdestino"></td>
                                <td id="cliente"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table-striped" style="background-color: #f2f2f2; width:100%">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Motorista</th>
                                <th>Faturamento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="status_fre"></td>
                                <td id="motorista"></td>
                                <td id="faturado"></td>
                                <td id="editfr"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <a href="<?= url("console")?>"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></a>
            </div>
        </div>
    </div>
</div>

<?php $this->push("scripts") ?>
<script>
    $(document).ready(function() {
        $('#hometabsle').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todos"]
            ]
        });
        $('body').on("click", "[data-action]", function(e) {
            e.preventDefault();
            var data = $(this).data();
            var cte = $('#cte').val();
            data.cte += (cte);

            if   (cte == '') {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você quer criar um CTE sem numero?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, criar CTE!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(data.action, data, function(data) {
                            console.log(data);

                            Swal.fire({
                                icon: data.icon,
                                title: data.title,
                                text: data.msg,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    location.href = data.frete;
                                } else {
                                    location.href = data.frete;
                                }
                            });

                        }, "json").fail(function(data) {
                            console.log(data);

                            alert("Erro ao processar requisição");
                        });
                    }
                });
            } else {
                $.post(data.action, data, function(data) {
                    console.log(data);

                    Swal.fire({
                        icon: data.icon,
                        title: data.title,
                        text: data.msg,
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.href = data.frete;
                        } else {
                            location.href = data.frete;
                        }
                    });

                }, "json").fail(function(data) {
                    console.log(data);

                    alert("Erro ao processar requisição");
                });
            }
        });
        $('body').on("click", "[data-actione]", function() {
            var data = $(this).data();
            var cte = $('#searchinput').val();
            var url = '<?= URL_BASE ?>';
            data.cte += (cte);

            if (cte == '') {
                Swal.fire({
                    title: 'OOPS!',
                    text: "Digite um número de CTE válido",
                    icon: 'error',

                });
            } else {
                $.post(data.actione, data, function(data) {

                    if (data.temcte) {
                        $("#exampleModal").modal('show');
                        $("#idcte").html(data.idcte);
                        $("#criacao").html(data.criacao);
                        $("#origemdestino").html(data.origemdestino);
                        $("#cliente").html(data.cliente);
                        $("#status_fre").html(data.statusfr);
                        $("#motorista").html(data.motorista);
                        $("#faturado").html(data.faturado);
                        $("#editfr").html(`<a class="btn btn-primary" href="${url}console/fretes/${data.editfr}">Editar</a>`);
                    } else {
                        Swal.fire({
                            title: data.title,
                            text: data.msg,
                            icon: data.icon,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        });
                    }


                }, "json").fail(function(data) {
                    console.log(data);

                    alert("Erro ao processar requisição");
                });
            }
        });
    });
</script>

<!--
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: [
                        2115,
                        1562,
                        1584,
                        1892,
                        1587,
                        1923,
                        2566,
                        2448,
                        2805,
                        3438,
                        2917,
                        3327
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Paga", "Pendente", "Em Atraso"],
                datasets: [{
                    data: [<?= $pagas ?>, <?= $emAtraso ?>, <?= $pendente ?>],
                    backgroundColor: [
                        window.theme.success,
                        window.theme.danger,
                        window.theme.warning
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "This year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    });
</script>
-->
<?= $this->end(); ?>