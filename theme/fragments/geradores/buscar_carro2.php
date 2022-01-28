<?php

include __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Reboque;

if (isset($_POST['motorista_id'])) {
    $relacaos = (new Caminhao())->find("id_motorista = :ica", "ica={$_POST['motorista_id']}")->fetch(true);

    if ($relacaos) {
        echo '<option>Selecione o Caminhão</option>';
        foreach ($relacaos as $re) {?>
		<option value=" <?=$re->id?>"> <?=$re->modelo?> - Placa -  <?=$re->placa_caminhao?></option>
	<?php
}
    } else {
        echo '<option>Nenhum Cadastrado!</option>';
    }
} elseif (isset($_POST['caminhao_id'])) {

    $pegaidcaminhao = (new Caminhao())->find("id = :cid", "cid={$_POST['caminhao_id']}")->fetch(true);
    $motorista = (new Motorista())->find("id = :sid", "sid={$pegaidcaminhao[0]->id_motorista}")->fetch(true);
    $relacao = (new Reboque())->find("id_motorista = :mid", "mid={$motorista[0]->id}")->fetch(true);

    if ($relacao) {

        echo '<option value="">Selecione o Reboque</option>';
        foreach ($relacao as $re) {
            ?>
		<option value=" <?=$re->id?>"> <?=$re->tipo_reboque?> - Placa -  <?=$re->placa_reboque?></option>
	<?php
}
    } else {
        echo '<option>Nenhum Cadastrado!</option>';
    }

}
?>