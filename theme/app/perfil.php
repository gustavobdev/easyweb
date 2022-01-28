<?php $this->layout("/app/_theme");


messagePerfil();

use CoffeeCode\Router\Router;
use Source\Models\Motorista;

$router = new Router(URL_BASE);
if (!isset($_SESSION)) {
    session_start();
}
//echo "<pre>", var_dump($_SESSION), "</pre>";
if (isset($_SESSION['driver_first_name']) == false) {
    $router->redirect("/app/login");
}
$motorista = (new Motorista())->findById("{$_SESSION["driver_id"]}");
?>

<form method="POST" id="form" action="<?= url("app/perfil/saveimgprofile") ?>" enctype="multipart/form-data">
    <div class="section mt-3 text-center">
        <div class="avatar-section">
            <?php if (isset($motorista->profile_photo)) : ?>
                <img src="<?= url("{$motorista->profile_photo}") ?>" alt="avatar" class="imaged w100 " style="width: 200px; height: 100px; border-radius: 200px; overflow: hidden;">
            <?php else : ?>
                <img src="<?= url("assets/app/assets/img/sample/avatar/avatar1.jpg") ?>" alt="avatar" class="imaged w100 rounded">

            <?php endif; ?>
            <div class="image-upload button">
                <label for="file-input" class="text-center">
                    <ion-icon class="camera-outline" name="camera-outline" style="margin-top: 15px;"></ion-icon>
                </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
                <input type="file" id="file-input" name="image" required />
            </div>
        </div>
    </div>

</form>


<div class="listview-title mt-1">Stauts de serviço</div>
<ul class="listview image-listview text inset">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    <div id="title">
                        Habilitar
                    </div>
                    <div class="text-muted">
                        Clique para ficar disponível e receber fretes
                    </div>
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="ficaonline" id="ficaonline" onclick="processForm()" <?php if (isset($_SESSION["em_servico"])) : echo 'checked';
                                                                                                                                    endif; ?> />
                    <label class="custom-control-label" for="ficaonline"></label>
                </div>
            </div>
        </div>
    </li>
</ul>
<div id="messageon"></div>


<div class="section mt-2 mb-2">
    <div class="listview-title mt-1">Informações Pessoais</div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?= url("app/perfil/save") ?>">
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Nome</label>
                        <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                        <input type="text" value="<?= $_SESSION["driver_first_name"] ?>" class="form-control" name="nome" id="text4b" placeholder="Digite seu nome">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">Sobrenome</label>
                        <input type="text" value="<?= $_SESSION["driver_last_name"] ?>" class="form-control" name="sobrenome" id="text4b" placeholder="Digite seu Sobrenome">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="text4b">CPF</label>
                        <input type="text" value="<?= $_SESSION["driver_cpf"] ?>" class="form-control" name="cpf" id="text4b" placeholder="Digite seu CPF">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="email4b">E-mail</label>
                        <input type="email" value="<?= $_SESSION["driver_email"] ?>" class="form-control" name="email" id="email4b" placeholder="E-mail Input">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="phone4b">Telefone1</label>
                        <input type="tel" class="form-control" name="phone1" <?= $_SESSION["driver_fone1"] ? "value='{$_SESSION['driver_fone1']}'" : 'placeholder="Digite o número do telefone"'; ?>>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="phone4b">Telefone2</label>
                        <input type="tel" class="form-control" name="phone2" <?= $_SESSION["driver_fone2"] ? "value='{$_SESSION['driver_fone2']}'" : 'placeholder="Digite o número do telefone"'; ?>>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
                <div class="form-group basic">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="listview-title mt-1">Preferências de conta</div>
<ul class="listview image-listview text inset">
    <li>
        <a href="#" data-toggle="modal" data-target=" #banks" class="item">
            <div class="in">
                <div>Informações bancárias</div>
                <span class="text-primary">Editar</span>
            </div>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="modal" data-target=" #address" class="item">
            <div class="in">
                <div>Endereço</div>
                <span class="text-primary">Editar</span>
            </div>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="modal" data-target=" #certificados" class="item">
            <div class="in">
                <div>Certificados/Licenças</div>
                <span class="text-primary">Inserir</span>
            </div>
        </a>
    </li>
</ul>

<div class="listview-title mt-1">Informações do Veículo</div>
<ul class="listview image-listview text inset">
    <li>
        <a href="<?= url("app/editcar") ?>" class="item">
            <div class="in">
                <div><span class="badge badge-primary"><?= $caminhoes ?></span> <?= $caminhoes > 1 ? "Caminhões" : "Caminhão" ?> </div>
                <span class="text-primary">Adicionar</span>
            </div>
        </a>
    </li>
    <li>
        <a href="<?= url("app/editreboque") ?>" class="item">
            <div class="in">
                <div><span class="badge badge-primary"><?= $reboques ?></span> <?= $reboques > 1 ? "Reboques" : "Reboque" ?></div>
            </div>
            <span class="text-primary">Adicionar</span>
            </div>
        </a>
    </li>
</ul>


<div class="listview-title mt-1">Segurança</div>
<ul class="listview image-listview text mb-2 inset">
    <li>
        <a href="#" class="item">
            <div class="in">
                <div>Atualizar senha</div>
            </div>
        </a>
    </li>
    <li>
        <a href="<?= url("app/logout") ?>" class="item">
            <div class="in">
                <div>Sair da conta</div>
            </div>
        </a>
    </li>
</ul>

<!--INFORMAÇÕES BANCARIAS -->
<div class="modal fade action-sheet" id="banks" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Informações Bancárias</h5>
            </div>

            <form method="POST" action="<?= url("app/editbank/save") ?>">
                <div class="modal-body text-left mb-5">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Agência</label>
                                <input type="search" class="form-control" id="banco" name="banco" <?= $_SESSION["driver_banco"] ? "value='{$_SESSION['driver_banco']}'" : 'placeholder="Digite o código da agencia"'; ?> list="bancos">
                                <datalist id="bancos">
                                    <?php
                                    foreach ($banks as $bank) :
                                    ?>
                                        <option value="<?= $bank->banco ?>"></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Conta</label>
                                <input type="text" name="conta" id="conta" <?= $_SESSION["driver_conta"] ? "value='{$_SESSION['driver_conta']}'" : 'placeholder="Digite o número da conta"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Titular da conta</label>
                                <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                                <input type="text" name="titular" id="titular" <?= $_SESSION["driver_titular"] ? "value='{$_SESSION['driver_titular']}'" : 'placeholder="Digite o nome do titular da conta"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">CPF do titular da conta</label>
                                <input type="text" name="cpf_conta" id="cpf_conta" <?= $_SESSION["driver_cpf_conta"] ? "value='{$_SESSION['driver_cpf_conta']}'" : 'placeholder="CPF do titular da conta"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a class="btn btn-text-secondary" data-dismiss="modal">FECHAR</a>
                        <button type="submit" class="btn btn-text-primary">ATUALIZAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM INFORMAÇÕES BANCARIAS-->

<!--INFORMAÇÕES ENDEREÇO -->
<div class="modal fade action-sheet" id="address" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Informações de Logradouro</h5>
            </div>

            <form method="POST" action="<?= url("app/editaddress/save") ?>">
                <div class="modal-body ">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">CEP:</label>
                                <input type="text" class="form-control" id="cep" name="cep" onblur="pesquisacep(this.value)" <?= $_SESSION["driver_cep"] ? "value='{$_SESSION['driver_cep']}'" : 'placeholder="Digite o CEP" value=""'; ?>>
                            </div>
                        </div>
                        <div class=" form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Rua</label>
                                <input type="text" class="form-control" id="rua" name="rua" <?= $_SESSION["driver_rua"] ? "value='{$_SESSION['driver_rua']}'" : 'placeholder="Digite o nome da rua"'; ?>>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Número</label>
                                <input type="text" name="numero" id="numero" <?= $_SESSION["driver_numero"] ? "value='{$_SESSION['driver_numero']}'" : 'placeholder="Digite o número da casa/apto"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Bairro</label>
                                <input type="text" name="bairro" id="bairro" <?= $_SESSION["driver_bairro"] ? "value='{$_SESSION['driver_bairro']}'" : 'placeholder="Digite seu Bairro"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Cidade</label>
                                <input type="text" name="driver_id" id="driver_id" style="display: none;" value="<?= $_SESSION["driver_id"] ?>">
                                <input type="text" name="cidade" id="cidade" <?= $_SESSION["driver_cidade"] ? "value='{$_SESSION['driver_cidade']}'" : 'placeholder="Cidde Atual"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="text4b">Estado</label>
                                <input type="text" name="estado" id="estado" <?= $_SESSION["driver_estado"] ? "value='{$_SESSION['driver_estado']}'" : 'placeholder="Digite o Estado"'; ?> class="form-control">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a class="btn btn-text-secondary" data-dismiss="modal">FECHAR</a>
                                <button type="submit" class="btn btn-text-primary">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM INFORMAÇÕES ENDEREÇO-->


<!--CERTIFICADOS -->
<div class="modal fade action-sheet" id="certificados" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Certificados</h5>
            </div>
            <div class="input-info text-center">Selecione os certificados que você possui</div>

            <form method="POST" action="<?= url("app/editcerts/save") ?>">
                <div class="modal-body mb-2">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="custom-control custom-radio d-inline">
                                <input type="checkbox" id="indivisivel" name="indivisivel" class="custom-control-input" <?php if (isset($_SESSION["driver_indivisivel"])) : echo 'checked';
                                                                                                                        endif; ?>>
                                <label class="custom-control-label p-0" for="indivisivel">&nbsp;Carga Indivisível
                                    <?php
                                    if (isset($_SESSION["driver_indivisivel"])) :
                                        echo '<ion-icon style="color: green;" name="checkmark-circle"></ion-icon>';
                                    endif;
                                    ?>
                                </label>
                            </div>
                        </div>


                        <div class="form-group basic">
                            <div class="custom-control custom-radio d-inline">
                                <input type="checkbox" id="mopp" name="mopp" class="custom-control-input" <?php if (isset($_SESSION["driver_mopp"])) : echo 'checked';
                                                                                                            endif; ?>>
                                <label class="custom-control-label p-0" for="mopp">&nbsp;MOPP <?php if (isset($_SESSION["driver_mopp"])) : echo '  <ion-icon style="color: green;" name="checkmark-circle"></ion-icon>';
                                                                                                endif; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a class="btn btn-text-secondary" data-dismiss="modal">FECHAR</a>
                        <button type="submit" class="btn btn-text-primary">ATUALIZAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM CERTIFICADOS-->

<!---- CEP ---->
<div class="modal fade action-sheet" id="declinecep" data-backdrop="static" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.8); ">
            <div class="modal-icon text-danger">
                <ion-icon name="close-circle"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" style="color: white">OOPS!</h5>
                <div id="modalbody" style="color: white" class="text-center">

                </div>
            </div>

            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn" style="color: white" data-dismiss="modal">FECHAR</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!---- FIM CEP ---->

<div id="ficaonn">
</div>
<div id="newmessages">
</div>
<div id="script">

</div>
<script>
    $(document).ready(function() {
        document.getElementById("file-input").onchange = function() {
            document.getElementById("form").submit();
        };
    });

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('estado').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('estado').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            $(document).ready(function() {
                $("#modalbody").html('Cep Não Encontrado');
                $("#declinecep").modal();
            });

        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.

                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('estado').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $(document).ready(function() {
                    $("#modalbody").html('Formato de CEP inválido');
                    $("#declinecep").modal();
                });

            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }

    function processForm() {


        var checkbox = $("input:checkbox[name=ficaonline]:checked").val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?= url("app/perfil/ficaonline") ?>',
            data: {
                checked_box: checkbox
            },
            success: function(data) {

                console.log(data.modal);
                $("#ficaonn").html(data.modal);
                $("#notmessage").html(data.notifi);
                if (data.newmessage) {
                    $("#newmessages").html(data.newmessage);

                }
                if (data.msg) {
                    $('#msgviewer1').html(" ");
                    $('#msgviewer').html(data.msg);
                    console.log(data.msg);
                }
                if (data.script) {

                    $('#script').html(data.script);
                    console.log(data.script);

                }

            }
        });
    }
</script>