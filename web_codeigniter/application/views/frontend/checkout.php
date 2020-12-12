<div class="container" style="margin-top: 100px">
    <div class="row">
    <h1>Compra com Sucesso</h1>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h3>Informação do cliente</h3>
            <p>Nome do cliente: <?php echo $order['shipping_name']?></p>
            <p>Email do cliente: <?php echo $order['user_email']?></p>
            <p>Telemóvel do cliente: <?php echo $order['shipping_contact_number']?></p>
            <p>Morada de faturação: <?php echo $order['shipping_address'].$order['shipping_zip_code']?></p>
            <p>Morada de entrega: <?php echo $order['billing_address'].$order['billing_zip_code']?></p>
            <p></p>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
        <h3>Informação da compra</h3>
        <?php if(!empty($order['items'])){
            foreach($order['items'] as $item){
                ?>
                <p>Nome do produto: <?php echo $item['product_name']?></p>
                <p>Quantidade: <?php echo $item['quantity']?></p>
                <p>Preço (unidade): <?php echo $item['price']?></p>
                <p><b>Total</b>: <?php echo $item['total_price']?></p>
                <p><b>Total do IVA</b>: <?php echo $item['total_iva']?></p>

          <?php  }
        }?>
        </div>
    </div>
</div>