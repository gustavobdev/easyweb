<?php $this->layout("/dashboard/_theme");
messageExcluiPdf(); ?>


<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Documentos PDF dos fretes</h5>
                <h5><small><b>Filtrar por: ID frete, Nº de CTE ou cliente.</b></small></h5>

            </div>
            <div class="card-body">
                <table class="table" id="fretestable">
                    <thead>
                        <tr class="text-center">
                            <th>Id / CTE</th>
                            <th>Cliente</th>
                            <th>Ver PDF</th>
                            <th>Download</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($docfretes) :
                            /*@var Clients*/
                            foreach ($docfretes as $docfrete) :
                        ?>
                                <tr class="text-center">
                                    <td><?= $docfrete->pdf()[0]->id . "/"; ?> <?= $docfrete->pdf()[0]->doc_viagem_cte ? $docfrete->pdf()[0]->doc_viagem_cte : "Vazio" ?></td>
                                    <td>
                                        <?php
                                        if ($docfrete->clientes()) :
                                            echo $docfrete->clientes()[0]->razao_social;
                                        else :
                                            echo "Sem cliente";
                                        endif;
                                        ?>
                                    </td>
                                    <td class="table-action">
                                        <a target="_blank" href="<?= URL_BASE . $docfrete->caminho ?>"><i class="align-middle" data-feather="eye"></i></a>
                                    </td>

                                    <td class="d-none d-md-table-cell">

                                        <a href="<?= URL_BASE . $docfrete->caminho ?>" download="<?= $docfrete->pdf()[0]->doc_viagem_cte ?>"><i class="align-middle" data-feather="download"></i></a>

                                    </td>
                                    <td class="table-action">
                                        <a href='' data-action="<?= url("console/excluirpdf") ?>" class=" btn btn-outline-danger fa fa-trash" data-pdf="<?= $docfrete->id ?>" aria-hidden="true"></a>
                                    </td>
                                </tr>

                            <?php endforeach;

                        else :
                            ?>
                            <h4 class="text-center">Não existem Documentos gerados</h4>
                        <?php
                        endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>

        <?php $this->push("scripts") ?>
        <script>
            $(document).ready(function() {

                $('body').on("click", "[data-action]", function(e) {
                    e.preventDefault();
                    var data = $(this).data();
                    var $tr = $(this).closest("tr");

                    Swal.fire({
                        title: 'Tem certeza?',
                        text: "Você não poderá reverter isso!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim, Excluir pdf!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post(data.action, data, function(data) {
                                console.log(data);
                                Swal.fire({
                                    icon: data.icon,
                                    title: data.title,
                                    text: data.msg
                                });
                                $tr.fadeOut();
                            }, "json").fail(function() {
                                alert("Erro ao processar requisição");
                            });
                        }
                    });
                });


                $('#fretestable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                    },
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Todos"]
                    ]
                });
            });
        </script>
        <?php $this->end() ?>