<div class="container" style="margin-top:100px; margin-bottom:100px">
    <div class="row">
        <h1>Detalhes da compra</h1>

        <p>Nome do cliente</p>
        <p><?php echo $sales['shipping_name']; ?></p>

        <p>Morada de faturação</p>
        <p><?php echo $sales['billing_address_id']; ?></p>

        <p>Morada de envio</p>
        <p><?php echo $sales['shipping_address_id']; ?></p>

        <p>Preço total</p>
        <p><?php echo $sales['total_price']; ?></p>

        <p>Total IVA</p>
        <p><?php echo $sales['total_iva']; ?></p>

        <p>Data de compra</p>
        <p><?php echo $sales['created_date']; ?></p>

        <p>Estado</p>
        <p><?php echo $sales['status']; ?></p>

        <p>NIF de envio</p>
        <p><?php echo $sales['shipping_nif']; ?></p>

        <p>Número de telemóvel de envio</p>
        <p><?php echo $sales['shipping_contact']; ?></p>

        <p>Cidade de envio</p>
        <p><?php echo $sales['shipping_city']; ?></p>

        <p>Morada de envio</p>
        <p><?php echo $sales['shipping_address']; ?></p>

        <p>Código de postal de envio</p>
        <p><?php echo $sales['shipping_zip']; ?></p>

        <p>Nome de cliente de faturação</p>
        <p><?php echo $sales['billing_name']; ?></p>

        <p>Nif de faturação</p>
        <p><?php echo $sales['billing_nif']; ?></p>

        <p>Número de telemóvel de faturação</p>
        <p><?php echo $sales['billingg_contact']; ?></p>

        <p>Cidade de faturação</p>
        <p><?php echo $sales['billing_city']; ?></p>

        <p>Morada de faturação</p>
        <p><?php echo $sales['billing_address']; ?></p>

        <p>Código postal de faturação</p>
        <p><?php echo $sales['billing_zip']; ?></p>
    </div>
</div>

