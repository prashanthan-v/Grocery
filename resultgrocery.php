<?php
    if(isset($_POST['productdetails'])&& isset($_POST['tax'])){
       $productdetails = json_decode($_POST['productdetails'], true);
       $tax = $_POST['tax'];

       $grandTotal = 0;
       $tableRows = '';

       foreach($productdetails as $productdetail){
        $totalAmount = $productdetail['quantity'] * $productdetail['price'];
        $grandTotal += $totalAmount;
        $tableRows .= "<tr>
                          <td>{$productdetail['products']}</td>
                          <td>{$productdetail['quantity']}</td>
                          <td>{$productdetail['price']}</td>
                          <td>{$totalAmount}</td>
                       </tr>";
       }

       if($tax=="IGST"){
        $taxamount = ($grandTotal*6)/100;
        $tableRows .= "<tr>
                      <td colspan='3'>CGST(6%)</td>
                      <td>{$taxamount}</td>
                   </tr>";
        $tableRows .= "<tr>
                   <td colspan='3'>SGST(6%)</td>
                   <td>{$taxamount}</td>
                </tr>";      
             $grandTotal =$grandTotal+ $taxamount*2; 
        $tableRows .= "<tr>
                <td colspan='3'>Grandtotal</td>
                <td>{$grandTotal}</td>
             </tr>";       

       }
       else{
        $taxamount = ($grandTotal*12)/100;

        $tableRows .= "<tr>
            <td colspan='3'>SGST(12%)</td>
            <td>{$taxamount}</td>
                </tr>";  
                $grandTotal =$grandTotal+ $taxamount; 
        $tableRows .= "<tr>
                      <td colspan='3'>Grand Total</td>
                      <td>{$grandTotal}</td>
                   </tr>";

       }

       
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Destination Page</title>
    </head>
    <body>
        <h1>Grocery-Shop</h1>
        <table id='data-table' border='1'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                {$tableRows}
            </tbody>
        </table>
    </body>
    </html>";
    }
    else {
        echo "No data received.";
    }


?>