<?php

include __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Cidades;
use Source\Models\Estados;


if (isset($_POST['estado_id'])) {

    $relacao = (new Cidades())->find("nome = :mot","mot={$_POST['estado_id']}")->fetch(true);
    $relacaos = (new Estados())->find("id = :mot","mot={$relacao[0]->id_estado}")->fetch(true);

    if ($relacaos) { ?>
		<option value=" <?=$relacaos[0]->id?>"> <?=$relacaos[0]->uf?></option>
	<?php

    } else {
        echo '<option>Nenhum Cadastrado!</option>';
    }
} 
?>