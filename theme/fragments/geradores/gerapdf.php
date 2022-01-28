        <?php
        $router = new  \CoffeeCode\Router\Router(URL_BASE);
        $html = '<link href="' . url("assets/landing/css/bootstrap.min.css") . '" rel="stylesheet">
        <div class="col-sm-12">
        <div class="col-sm-6">
            <img src="' . url("assets/img/invoice.png") . '" width="120px" alt="image"/>
        </div>
        <div class="col-sm-3 mb-3" style="border:2px solid gray; position: relative;left:74%;">
        <table class="table-responsive-sm text-center">
            <tr>
                <td>Ref / CTE</td>
                <td> </td>
                <td>Data</td>
            </tr>
            <tr>
                <th>125 / GFD890S</th>
                <th> </th>
                <th>12/10/2021</th>
            </tr>

        </table>
        </div>
        </div>
        <div class="col-lg-12" style="border:2px solid gray;">
        <table class="table-responsive-sm  text-center">
        <tbody>
        <tr>
            <td>QTD. VG</td>
            <td>CONTROLE INTERNO</td>
            <td>MODALIDE</td>
            <td>CLIENTE / TRANSPORTADORA</td>
        </tr>
        <tr>
            <th>1254</th>
            <th>1254</th>
            <th class="">AGENCIAMENTO</th>
            <th class="">GBS SOLUÇÕES EM TI</th>
        </tr>
        <tr>
            <td>TIPO</td>
            <td>SIZE</td>
            <td>TIPO</td>
            <td>IMO</td>
            <td>CONTAINER / QTE.LCL</td>
            <td>RASTREADO</td>
            <td>REF.CLIENTE</td>
        </tr>
        <tr>
            <th>DTA</th>
            <th>40</th>
            <th>HC</th>
            <th class="">ASSDFASDG-4</th>
            <th class="">NÃO</th>
            <th class="">SIM</th>
            <th>ASFD12SD3</th>
        </tr>
        <tr>
            <td>DI / DTA / NF</td>
            <td style="width: 30%">MARCADORIA / PRODUTO</td>
            <td>PESO TOTAL</td>
            <td>VALOR CIF R$</td>
        </tr>
        <tr>
            <th class="text-left">ASFD12SD3</th>
            <th>COPOS DE PLÁSTICO DE 350ML</th>
            <th>4582</th>
            <th>54,864</th>
        </tr>

        </tbody>
        </table>
        </div>

        <table class="text-center">
        <tbody>
        <tr >
        <td>
        INFORMAÇÕES DO MOTORISTA
        </td>
        </tr>
        </tbody>
        </table>
        <div class="col-lg-12 text-center" style="border:2px solid gray;">
        <table class=" table-responsive-sm">
        <tbody>
        <tr>
            <td>NOME</td>
            <td></td>
            <td>CPF</td>
        </tr>
        <tr>
            <th>GUSTAVO BOMFIM ENGEL</th>
            <th></th>
            <th>52*.***.**8-20</th>
        </tr>
        <tr>
            <td>PLACA DO CAMINHÃO</td>
            <td></td>
            <td>RENAVAM</td>
            <td></td>
            <td>MODELO</td>
             <td></td>             
             <td></td>
           <td>COR</td>
            <td></td>
            <td>TIPO</td>
        </tr>
        <tr>
            <th>125A58D</th>
            <th></th>
            <th>654567546545664</th>
            <th>  </th>
            <th>SCANIA</th>
            <th></th>
            <th></th>
            <th class="">PRETO</th>
            <th></th>
            <th></th>
            <th class="">TRUCK</th>
        </tr>
        <tr>
            <td>PLACA DO REBOQUE</td>
             <td></td>
            <td style="width=40%">RENAVAM</td>
             <td></td>
            <td>TIPO REBOQUE</td>
        </tr>
        <tr>
            <th class="text-left">125A58D</th>
            <th></th>
            <th>654567546545664</th>
            <th></th>
            <th>2X 40</th>
        </tr>

        </tbody>
        </table>
        </div>
        <table CLASS="text-center">
        <tbody>
        <tr >
        <td>
            INFORMAÇÕES OPERACIONAIS
        </td>
        </tr>
        </tbody>
        </table>
        <div class="col-lg-12 text-center " style="border:2px solid gray;">
        <table class=" table-responsive-sm col-sm-12">
        <tbody>
        <tr>
            <td>CDA TERMINAL COLETA</td>
            <td>SDA TERMINAL COLETA</td>
            <td>CDA CLIENTE</td>
            <td>SDA CLIENTE</td>
            <td>DEVOLUÇÃO VAZIO/BEM. CHEIO</td>
        </tr>
        <tr>
            <th>12/12/2021 12:32</th>
            <th>12/12/2021 12:32</th>
            <th>12/12/2021 12:32</th>
            <th>12/12/2021 12:32</th>
            <th>12/12/2021 12:32</th>
        </tr>

        </tbody>
        </table>
        </div>
        ';

        use Dompdf\Dompdf;
        use Dompdf\Options;

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4", "landscape");
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('filename.pdf', $output);
        //$router->redirect("/");