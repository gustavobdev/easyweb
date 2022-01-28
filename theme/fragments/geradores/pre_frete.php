<?php $this->layout("/dashboard/_theme");?>
<?php $url = URL_BASE ?>
<div class="row">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
                <h1 class="h2">Novo Frete</h1>
                <p class="lead">
                    Informe o numero do CTE ou clique em para gerar uma ID automático.
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="m-sm-3">
                        <form action="<?=$url?>console/cria/frete" method="post" >
                            <div class="mb-3">
                                <label class="form-label">CTE</label>
                                <input class="form-control form-control-lg" type="text" name="cte" placeholder="Insira aqui o numero do CTE" />
                            </div>
                            <div class="text-center mt-3">
                                 <button type="submit" class="btn btn-lg btn-primary">CRIAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>