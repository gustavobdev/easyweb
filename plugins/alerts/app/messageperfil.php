
    <?php
    function messagePerfil()
    {
        if (!(isset($_SESSION))) // if the session is no  set then start to
        {
            session_start();
        }
        /**decline_perfil */
        if (isset($_SESSION["appreg_decline"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#appregdecline").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="appregdecline" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-danger">
                            <ion-icon name="close-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">OOPS!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["appreg_decline"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
           unset($_SESSION["appreg_decline"]);
        endif;
        /** FIM appreg_decline */

        /**completaperfil */
        if (isset($_SESSION["completa_perfil"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#completaperfil").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="completaperfil" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon">
                            <ion-icon name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Bem-Vindo novamente</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["completa_perfil"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["completa_perfil"]);
        endif;
        /** FIM completaperfil */

        /**boas_vindas */
        if (isset($_SESSION["boas_vindas"])) :
        ?>
            <script>
                $(document).ready(function() {
                    $("#boasvindas").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="boasvindas" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-success">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Registrado com sucesso!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["boas_vindas"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["boas_vindas"]);
        endif;
        /** FIM boas_vindas */

        /**save_perfil */
        if (isset($_SESSION["save_perfil"])) :
        ?>
            <script>
                $(document).ready(function() {
                    $("#saveperfil").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="saveperfil" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-success">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Feito!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["save_perfil"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["save_perfil"]);
        endif;
        /** FIM save_perfil */

        /**decline_perfil */
        if (isset($_SESSION["decline_perfil"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#declineperfil").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="declineperfil" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-danger">
                            <ion-icon name="close-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">OOPS!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["decline_perfil"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["decline_perfil"]);
        endif;
        /** FIM decline_perfil */

        /**save_bank */
        if (isset($_SESSION["save_bank"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#savebank").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="savebank" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-success">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Feito!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["save_bank"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["save_bank"]);
        endif;
        /** FIM save_bank */

        if (isset($_SESSION["decline_bank"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#declinebank").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="declinebank" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-danger">
                            <ion-icon name="close-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">OOPS!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["decline_bank"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["decline_bank"]);
        endif;

        if (isset($_SESSION["save_car"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#savecar").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="savecar" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-success">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Feito!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["save_car"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["save_car"]);
        endif;

        if (isset($_SESSION["decline_car"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#declinecar").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="declinecar" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-danger">
                            <ion-icon name="close-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">OOPS!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["decline_car"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["decline_car"]);
        endif;

        if (isset($_SESSION["save_reboque"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#savereboque").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="savereboque" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-success">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Feito!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["save_reboque"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["save_reboque"]);
        endif;

        if (isset($_SESSION["decline_reboque"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#declinereboque").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="declinereboque" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon text-danger">
                            <ion-icon name="close-circle"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">OOPS!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["decline_reboque"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["decline_reboque"]);
        endif;
        if (isset($_SESSION["imgprofile"])) : ?>
            <script>
                $(document).ready(function() {
                    $("#declinereboque").modal();
                });
            </script>
            <div class="modal fade dialogbox" id="declinereboque" data-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-icon <?= $_SESSION["img_true"] ? $_SESSION["img_true"] : '' ?>">
                            <ion-icon name="<?= $_SESSION["img_icon"] ?>"></ion-icon>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title"><?= $_SESSION["img_title"] ?>!</h5>
                        </div>
                        <div class="modal-body">
                            <?= $_SESSION["imgprofile"] ?>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <a href="#" class="btn" data-dismiss="modal">FECHAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
            unset($_SESSION["imgprofile"]);
            unset($_SESSION["img_true"]);
            unset($_SESSION["img_title"]);
            unset($_SESSION["img_icon"]);
        endif;
    }

    ?>