<?php 
include_once 'dbconnection.php';
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styleSheet.css" />
    <title>Oray</title>

    <script>
    
    function appendData(profileData){
        document.getElementById("product_name").innerHTML = profileData["name"];
        document.getElementById("product_desc").innerHTML = profileData["description"];
        document.getElementById("price").innerHTML = profileData["price"];
        document.getElementById("amount_sold").innerHTML = profileData["sold"];
        document.getElementById("print_duration").innerHTML = profileData["print_duration"]+" days";
        document.getElementById("delivery_price").innerHTML = profileData["delivery_price"]+ " $";
        document.getElementById("filament_type").innerHTML = profileData["filament_type"];
        document.getElementById("rating").innerHTML = profileData["rating"];
    }


    </script>

</head>
<body>
    <header>
        <header class="header_class">
            <div>
                <img class="logo" src="source/icones/logo.png">
            </div>

            <div class="header_link">
                <a class="header_specific_link" href="index.php">Home</a>
                <a class="header_specific_link" href="#">Shop</a>
                <a class="header_specific_link" href="#">Forum</a>
                <a class="header_specific_link" href="#">Partner</a>
            </div>

            <div class="profile_container">
                <div class="mask_circle">
                    <img class="img_profile" src="source/produits/profil_picture.jpg">
                </div>
                <div class="cart_container">
                    <a class="cart_link" href="#"><span class="number_item">0</span><img class="cart_img"
                            src="source/icones/cart.png"></a>
                </div>
            </div>
        </header>



<div id="principal_profile" class="profile_container">

<div class="profile_table">

    <table id="table_data">
        <tr>
            <th >
                product name
            </th>
            <td id="product_name">
            product name here
            </td>
        </tr>
        <tr>
            <th>
                product description:
                </th>
                <td id="product_desc">
                    Product text here
                </td>
            
        </tr>
        <tr>
            <th>
                product type:
            </th>
            <td id="product_type">
                    product type here
            </td>
        </tr>
        <tr>
            <th>
                price
            </th>
            <td id="price">
                    price here
            </td>
        </tr>
        <tr>
            <th>
               sold so far:
            </th>
            <td id="amount_sold">
                   amount_sold here
            </td>
        </tr>
        <tr>
            <th>
                print duration:
            </th>
            <td id="print_duration">
                    print duration here
            </td>
        </tr>
        <tr>
            <th>
                delivery price:
            </th>
            <td id="delivery_price">
              delivery price here
            </td>
        </tr>
        <tr>
            <th>
                filament type:
            </th>
            <td id="filament_type">
              filament type here
            </td>
        </tr>
        <tr>
            <th>
                Item rating:
            </th>
            <td id="rating">
              item rating here
            </td>
        </tr>
    </table>
    <!-- Currently static but should come from database in the future -->
    <img id="profile_picture_principal" src="source/produits/pikachu.jpg">
</div>





    <?php
            $sqlProductInfo ="SELECT item_name,item_description,item_type,price,amount_sold,
            print_duration,delivery_price,filament_type,item_rating
            FROM sales_item WHERE sales_item.id = 52;";
           
            $resultProduct = mysqli_query($conn, $sqlProductInfo);
                           
                $row = mysqli_fetch_assoc($resultProduct);
                    $productData = array(
                        "name" => $row['item_name'],
                        "description" => $row['item_description'],
                        "type" => $row['item_type'],
                        "price" => $row['price'],
                        "sold" => $row['amount_sold'],
                        "print_duration" => $row['print_duration'],
                        "delivery_price" => $row['delivery_price'],
                        "filament_type" => $row['filament_type'],
                        "rating" => $row['item_rating']
                        
                    );   
            
        ?>
<script>
// Populate table with data 
jsonJsProduct = {
            "name" : <?php echo json_encode($productData["name"], JSON_HEX_TAG); ?>,
            "description" : <?php echo json_encode($productData["description"], JSON_HEX_TAG); ?>,
            "type" : <?php echo json_encode($productData["type"], JSON_HEX_TAG); ?>,
            "price" : <?php echo json_encode($productData["price"], JSON_HEX_TAG); ?>,
            "sold" : <?php echo json_encode($productData["sold"], JSON_HEX_TAG); ?>,
            "print_duration" : <?php echo json_encode($productData["print_duration"], JSON_HEX_TAG); ?>,
            "delivery_price" : <?php echo json_encode($productData["delivery_price"], JSON_HEX_TAG); ?>,
            "filament_type" : <?php echo json_encode($productData["filament_type"], JSON_HEX_TAG); ?>,
            "rating" : <?php echo json_encode($productData["rating"], JSON_HEX_TAG); ?>

        };   
console.log(jsonJsProduct);
appendData(jsonJsProduct);
</script>








</div>

<img >
</div>








        
</body>
</html>