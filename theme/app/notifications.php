<?php $this->layout("/app/_theme");
if (!isset($_SESSION)) {
    session_start();
}
?>

<div class="section full">

    <ul class="listview image-listview flush">
       
        <?php
        if (isset($_SESSION["em_servico"])) :
            foreach ($messages as $me) : ?>
                <li <?= $me->lida_off === "1" ? 'class="active"' : '' ?>>
                    <a href="<?= $me->msgAjax()->link ?>" class="item">
                        <div class="icon-box bg-danger">
                            <ion-icon name="key-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div>
                                <div class="mb-05"><strong><?= $me->msgAjax()->title ?></strong></div>
                                <div class="text-small mb-05"><?= $me->msgAjax()->text ?></div>
                                <?php $data = new DateTime($me->created_at) ?>
                                <div class="text-xsmall"><?php echo $data->format("d/m/Y H:i") ?></div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach;
        else : ?>
            <li>
                <a class="item">

                    <div class="in">
                        <div>
                            <div class="mb-05"><strong>Fique ativo para visualizar mensagens</strong></div>
                        </div>
                    </div>
                </a>
            </li>
        <?php endif ?>
    </ul>

</div>