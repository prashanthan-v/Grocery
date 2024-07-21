<?php

include 'sqlconnect.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="grocery.css">
    <script> 
             $(document).ready(function(){
                  var count = 0; 
                 $("#select").on("change",function(){
                    count++;
                    var rowid = `row${count}`
                    var row = $(`<tr id="${rowid}"></tr>`);
               
                   $("#table tbody").append(row);
                  $(`#${rowid}`).load("groceryload.php",{selectedoption:$("#select option:selected").text()});
                     
                })
                   
                $("button").click(function(){
                    console.log(`inside button`)
                    var objectarray = []
                    $("#table tbody tr").each(function(){
                        console.log(`inside body`)
                           var productobject = {}
                           console.log["value is "+ productobject]
                           var key;
                        $(this).find("td").each(function(index){
                            console.log(`inside row`)
                            switch(index) {
                              case 0 :key ='products'; break ;
                              case 1 : key='price'; break;
                              case 2 : key= 'quantity';break; 
                            }
                            if (index === 2 && $(this).find('input').length > 0) {
                                             // If the third column contains an input element, get its value
                                productobject[key] = $(this).find('input').val();
                           } 
                           else {
                                                 // Otherwise, get the text content
                                productobject[key] = $(this).text();
                                console.log("value is "+ productobject[key])
                                  }
                                  
                        });
                           
                          objectarray.push(productobject)
                          
                    })
                        console.log(objectarray)
                       console.log($("#tax").val()) 
                    $.post('resultgrocery.php',{
                        productdetails:JSON.stringify(objectarray),
                       
                          tax: $("#tax").val() 
                      },function(response){
                        $('body').html(response);
                     }
                   );
                //    console.log(productdetails);
                //    console.log(tax);
                })

             })



    </script>
</head>
<body>
    <select id="select">
       <option>biscuit</option>
       <option>brush</option>
       <option>paste</option>
       <option>soap</option>
    </select>

    <table id="table">
     <thead> 
    <tr>
        <th>Products</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    </thead>  
    <tbody>


    </tbody>

    </table>

    <select id="tax">
        <option>SGST</option>
        <option>IGST</option>
    </select>

    <button>Genarate Bill</button>
</body>
</html>