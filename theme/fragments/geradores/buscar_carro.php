<?php

include __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Relacao_Caminhao;
use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Relacao_Reboque;


if (isset($_POST['motorista_id'])) {

    $relacaos = (new Relacao_Caminhao())->find("id_motorista = :mot","mot={$_POST['motorista_id']}")->fetch(true);

    if ($relacaos) {
        echo '<option>Selecione o Caminhão</option>';
        foreach ($relacaos as $key => $re) {?>
		<option value=" <?=$re->id?>"> <?=$re->caminhao()[0]->modelo?> - Placa -  <?=$re->caminhao()[0]->placa_caminhao?></option>
	<?php
}
    } else {
        echo '<option>Nenhum Cadastrado!</option>';
    }
} elseif (isset($_POST['caminhao_id'])) {
   
    $relacao = (new Relacao_Reboque())->find("id_motorista = :mid", "mid={$_POST['caminhao_id']}")->fetch(true);

    if ($relacao) {

        echo '<option>Selecione o Reboque</option>';
        foreach ($relacao as $re) {
            ?>
		<option value=" <?=$re->id?>"> <?=$re->reboque()[0]->tipo_reboque?> - Placa -  <?=$re->reboque()[0]->placa_reboque?></option>
	<?php
}
    } else {
        echo '<option>Nenhum Cadastrado!</option>';
    }

}
?>