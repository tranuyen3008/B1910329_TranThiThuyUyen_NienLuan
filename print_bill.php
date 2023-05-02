<?php include 'sql_conn.php' ?>
<head>
    <link rel="stylesheet" href="../htql-master/assets/css/print.css">

</head>
    <body onload="window.print();">
    <div id="page" class="page">
        <div class="header">
            <div class="logo"><img width="90" height="90" src="./assets/images/images.png"/></div>
            <div class="company">
                <h4>MIN COFFEE</h4>
                <p>Địa chỉ: 123, đường 3/2, quận Ninh Kiều, thành phố Cần Thơ</p>
            </div>
        </div>
    <br/>
    <div class="title">
            HÓA ĐƠN THANH TOÁN
            <br/>
            -------oOo--------
    </div>
    <br/>
    <br/>
    <table class="TableData" >
        <?php
            $billdetail = "select product.name, detail_bill.quantity, detail_bill.total from detail_bill join product on product.id = detail_bill.id_product where detail_bill.id = '".$_GET['id']."'";
            $billdetail_que = mysqli_query($conn, $billdetail);
            if($billdetail_que->num_rows > 0)
                while($rows = mysqli_fetch_assoc($billdetail_que)){
        ?>
        <tr>
            <th>Tên</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        
            <tr>
                
                <th><?php echo $rows['name']; ?></th>
                <th><?php echo $rows['quantity']; ?></th>
                <th><?php echo number_format($rows['total'], 0); ?>đ</th>
            </tr>
            <tr>
                <th></th>
                <th><h4 class="text-right">Tổng tiền:</th>
                <th> <?php echo number_format($rows['total'], 0); ?>đ</h4></th>
            </tr>
        
            <?php
                } 
            ?>
    </table>
    <br>
        <p style="text-align: center;">-------------------</p>
        <div class="footer"> MIN COFEE, chân thành cảm ơn quý khách.<br/>
    Hẹn gặp lại quý khách </div>    
            
          
</body>

