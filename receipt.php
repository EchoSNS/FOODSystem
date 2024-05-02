<?php 
require_once('layout/header.php');

$rowData = $orderObj->getLastOrderData($_SESSION['user_id']);
$orderDetailsArr = $orderDetailsObj->getOrderDetailsByOrderIDAllData($_GET['orderid']);

?>

        <div id="printableArea">
            <div id="invoice">
                <div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
                    <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;" width="100%">
                        <tbody>
                            <tr>
                                <td width="5px" style="padding: 0;"></td>
                                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                                    <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0;">
                                                    <a
                                                        href="#"
                                                        style="color: #348eda;"
                                                        target="_blank"
                                                    >
                                                        <img
                                                            src="dashboard/images/logo.png"
                                                            alt="logo"
                                                            style="height: 50px; max-width: 100%;"
                                                            height="50"
                                                        />
                                                    </a>
                                                </td>
                                                <td style="color: #999; font-size: 12px; padding: 0; text-align: right;" align="right">
                                                    F.O.O.D.S<br />
                                                    Invoice #<?php echo $rowData['OrderID']; ?><br />
                                                    <?php echo $rowData['Order_DateTime']; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="5px" style="padding: 0;"></td>
                            </tr>
                
                            <tr>
                                <td width="5px" style="padding: 0;"></td>
                                <td bgcolor="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                                    <table width="100%" style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                                        <tbody>
                                            <tr>
                                                <td width="50%" style="padding: 20px;"><strong style="color: #333; font-size: 24px;">F.O.O.D.S.</strong> (Invoice)</td>
                                                <td align="right" width="50%" style="padding: 20px;">Thank you <span class="il">for your purchase</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="padding: 0;"></td>
                                <td width="5px" style="padding: 0;"></td>
                            </tr>
                            <tr>
                                <td width="5px" style="padding: 0;"></td>
                                <td style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                                    <table cellspacing="0" style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                                        <tbody>
                                            <tr>
                                                <td valign="top"  style="padding: 20px;">
                                                    <h3
                                                        style="
                                                            border-bottom: 1px solid #000;
                                                            color: #000;
                                                            font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                                                            font-size: 18px;
                                                            font-weight: bold;
                                                            line-height: 1.2;
                                                            margin: 0;
                                                            margin-bottom: 15px;
                                                            padding-bottom: 5px;
                                                        "
                                                    >
                                                        Summary
                                                    </h3>
                                                    <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 5px 0; padding-right: 150px;"><b><i>Qty - Product</i></b></td>
                                                                <td align="right" style="padding: 5px 0;"><b><i>Price</i></b></td>
                                                            </tr>
                                                            <?php 
                                                                $totalPrice = 0;
                                                                foreach($orderDetailsArr as $row){
                                                                    echo 
                                                                    '<tr>
                                                                        <td style="padding: 5px 0; padding-right: 150px;">x'.$row['OrderQuantity'].' - '.$row['ProductName'].'</td>
                                                                        <td align="right" style="padding: 5px 0;">₱'.$row['ProductPrice'].'</td>
                                                                    </tr>';
                                                                    $totalPrice += ($row['OrderQuantity']*$row['ProductPrice']);
                                                                }
                                                            ?>
                                                            <tr>
                                                                <td style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">Amount to be paid</td>
                                                                <td align="right" style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">₱<?php echo $totalPrice; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="5px" style="padding: 0;"></td>
                            </tr>
                
                            <tr style="color: #666; font-size: 12px;">
                                <td width="5px" style="padding: 10px 0;"></td>
                                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                                    <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td width="40%" valign="top" style="padding: 10px 0;">
                                                    <h4 style="margin: 0;">Questions?</h4>
                                                    <p style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                                        Please visit our
                                                        <a
                                                            href="#"
                                                            style="color: #666;"
                                                            target="_blank"
                                                        >
                                                            Support Center
                                                        </a>
                                                        with any questions.
                                                    </p>
                                                </td>
                                                <td width="10%" style="padding: 10px 0;">&nbsp;</td>
                                                <td width="40%" valign="top" style="padding: 10px 0;">
                                                    <h4 style="margin: 0;"><span class="il">F.O.O.D.S.</span> inc.</h4>
                                                    <p style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                                        <a href="#">Adamson University. Manila, Philippines</a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="5px" style="padding: 10px 0;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <button type="button" onclick="printDiv('printableArea')" class="btn btn-info btn-icon-text mt-5" value="Print Receipt">
            Print
            <i class="ti-printer btn-icon-append"></i>                                                                              
        </button>


        
        <script src="js/script.js" async defer></script>
<?php
require_once('layout/footer.php');
?>