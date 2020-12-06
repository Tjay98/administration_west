<div  class="container" style="margin-top:100px; margin-bottom:100px" >
    <div class="row">
        <table style="border: 1px solid black;
    border-collapse: collapse;">
            <tr>
                <th>Ordem</th>
                <th>Nome</th>
                <th>NIF</th>
                <th>Data da compra</th>
                <th>Número de telemóvel</th>
                <th>Estado</th>
                <th>Preço total</th>
                <th>Iva total</th>
                <th>Detalhes</th>
            </tr>
            <?php 
              if(!empty($sales)){
                  foreach($sales as $sale){
                    foreach($sale as $s){
                    
                    $sa=1;
                   
                        //print_r($s);
            ?>
            <br><br>
            <tr>
                <td><?php echo $sa; ?></td>
                <td><?php echo $s['shipping_name']; ?></td>
                <td><?php echo $s['shipping_nif']; ?></td>
                <td><?php echo $s['created_date']; ?></td>
                <td><?php echo $s['shipping_contact']; ?></td>
                <td><?php if($s['status']==0){
                    echo 'Por pagar';
                    } else if($s['status']==1) {
                        echo 'Pago';
                    } else {
                        echo 'Cancelado';
                    }
                    ?></td>
                <td><?php echo $s['total_price']; ?></td>
                <td><?php echo $s['total_iva']; ?></td>
                <td><a href="<?php echo base_url('sales/history/').$s['id'];; ?>">Ver detalhes</a></td>
            </tr>
            <?php
                         $sa++;
                        }
                    }
                }
                else {
                    return "Sem compras por agora.";
                }
            ?>
            
        </table>
    </div>
</div>
