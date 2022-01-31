<?php

use Source\Models\Caminhao;
use Source\Models\Motorista;
use Source\Models\Relacao_Caminhao;

$relacao = (new Caminhao())->find("tipo_caminhao = :tip", "tip={$data["input"]}")->fetch(true);

if ($relacao) {

    foreach ($relacao as $re) {

        $recam = (new Relacao_Caminhao())->find("id_caminhao = :mid", "mid={$re->id}")->fetch(true);

        if ($recam) {

            foreach ($recam as $rec) {

                $motorista = (new Motorista())->find("id = :mid", "mid={$rec->id_motorista}")->fetch(true);

                if ($motorista) {

                    foreach ($motorista as $mot){
                   

                      $resultado[] =  '<tr>
                                                <td>'. $mot->nome.' '.$mot->sobrenome.'</td>
                                                <td>'. $mot->email .'</td>
                                                <td>'. $mot->cpf .'</td>
                                                <td>'. $re->tipo_caminhao .'</td>
                                              </tr>';
                        
                       
                    }
                }
            }
        }
    }
    echo json_encode($resultado);

}else{
    echo json_encode("<h2>Não encontrado</h2>");

}
