function FetchCaminhao(id) {
    $('#caminhao').html('');
    $('#reboque').html('<option>Selecione o reboque</option>');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_carro.php ') ?>',
        data: {
            motorista_id: id
        },
        success: function(data) {
            $('#caminhao').html(data);
        }

    })
}

function FetchReboque(id) {
    $('#reboque').html('');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_carro.php ') ?>',
        data: {
            caminhao_id: id
        },
        success: function(data) {
            $('#reboque').html(data);
        }

    })
}

function FetchEstado1(id) {
    $('#origem_uf').html('');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_estado.php ') ?>',
        data: {
            estado_id: id
        },
        success: function(data) {
            $('#origem_uf').html(data);
        }

    })
}

function FetchEstado2(id) {
    $('#retirada_cheio_vazio_uf').html('');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_estado.php ') ?>',
        data: {
            estado_id: id
        },
        success: function(data) {
            $('#retirada_cheio_vazio_uf').html(data);
        }

    })
}

function FetchEstado3(id) {
    $('#destino_uf').html('');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_estado.php ') ?>',
        data: {
            estado_id: id
        },
        success: function(data) {
            $('#destino_uf').html(data);
        }

    })
}

function FetchEstado4(id) {
    $('#dep_ch_vz_uf').html('');
    $.ajax({
        type: 'post',
        url: '<?= url('
        theme / fragments / geradores / buscar_estado.php ') ?>',
        data: {
            estado_id: id
        },
        success: function(data) {
            $('#dep_ch_vz_uf').html(data);
        }

    })
}
$(document).ready(function() {
    $('#cda_terminal_coleta').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > cda_terminal_coleta)): $cda_terminal_coleta = new DateTime($frete[0] - > cda_terminal_coleta);
        echo $cda_terminal_coleta - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#sda_terminal_coleta').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > sda_terminal_coleta)): $sda_terminal_coleta = new DateTime($frete[0] - > sda_terminal_coleta);
        echo $sda_terminal_coleta - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#prev_cda_cliente').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > prev_chegada_cliente)): $prev_chegada_cliente = new DateTime($frete[0] - > prev_chegada_cliente);
        echo $prev_chegada_cliente - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#cda_cliente').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > cda_cliente)): $cda_cliente = new DateTime($frete[0] - > cda_cliente);
        echo $cda_cliente - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#sda_cliente').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > sda_cliente)): $sda_cliente = new DateTime($frete[0] - > sda_cliente);
        echo $sda_cliente - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#prev_cda_devolucao').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > prev_chegada_devolucao)): $prev_chegada_devolucao = new DateTime($frete[0] - > prev_chegada_devolucao);
        echo $prev_chegada_devolucao - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })
    $('#devolucao_vazio').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'd/m/Y H:i:s',
        value: '<?php
        if (isset($frete[0] - > devolucao_vazio)): $devolucao_vazio = new DateTime($frete[0] - > devolucao_vazio);
        echo $devolucao_vazio - > format("d/m/Y H:i:s");
        endif; ?
        > ',
        hours12 : false,
        step: 15,
        yearStart: 2018,
        yearEnd: 2024
    })

});