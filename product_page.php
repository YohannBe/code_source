<?php 
include_once 'dbconnection.php';
?>

<!DOCTYPE html>
<html>

<script>
    
 
    function appendData(profileData){
       
        var price = profileData["price"];
        var print_duration = profileData["print_duration"];
        var delivery_price = profileData["delivery_price"];

        /** Set product title,description,author and related tags **/
       document.getElementById("product_title").innerHTML = profileData["name"];
       document.getElementById("product_desc").innerHTML ="Description: " + profileData["description"];
       document.getElementById("author").innerHTML ="Author: " + profileData["author"];
       document.getElementById("tags").innerHTML = profileData["tags"];
       /** set prices and print duration display */
       if(!print_duration) // if no duration specified it's digital probably 
         document.getElementById("print_duration").innerHTML = "Print time: User did not specify or this is a digital item";
       else
         document.getElementById("print_duration").innerHTML = "Print time: "+print_duration+" days";    
       if(!delivery_price) // if no delivery price specified it's digital probably
       {
        document.getElementById("delivery_price").innerHTML = "Delivery price: Free";
        document.getElementById("price").innerHTML = "Total:" +price+" $";
       } 
       else
       {
          document.getElementById("delivery_price").innerHTML = "Delivery price: "+delivery_price+ " $";
        
          // price = Number(price)  + Number(delivery_price);
          document.getElementById("price").innerHTML = "Price:" +price+"$ + " + "Delivery: " + delivery_price+"$ "
          +"\n Total price: " + (Number(price)  + Number(delivery_price) + "$");
       }
    
        /** Set stars ***/
        var author_rating = profileData["author_rating"];
        var product_rating =  profileData["rating"];
        
        for(i = 1 ; i<=  author_rating;i++) // set author stars
            document.getElementById("sstar"+i).className = "fa fa-star checked";
        for(i = 1 ; i<=  product_rating;i++) // set item stars
            document.getElementById("pstar"+i).className = "fa fa-star checked";
        /****************/
        
        



    }


    function appendReview(reviewData){
     /*   var review_count = 0;
        while(reviewData[review_count]) // build the review list 
        {
            document.getElementById("review_user").innerHTML = reviewData[review_count]["review_user"] ;
            document.getElementById("review_text").innerHTML = reviewData[review_count]["review"];
            var score  = reviewData[review_count]["score"];
           
            document.getElementById("stars").innerHTML = score;
            for (i=1;i<=score;i++)
                document.getElementById("rstar"+i).className = "fa fa-star checked";
            review_count++;            
        }
*/
       const reviewPost = document.createElement("div");
       reviewPost.classList.add("review_wrapper");
       const reviewUser = document.createElement("div");
       reviewUser.classList.add("col comment review_user");
       const reviewRating = document.createElement("div");
       reviewRating.classList.add("col review_stars");


    }



    </script>

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styleSheet.css" />
    <!-- import stylesheet for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Oray</title>
    <style>
    .checked { /* set star color */
    color: orange;
    }
</style>


</head>


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


<body>


<div class="container ">
    <div class="row ">
        <div class="col-4">
        <img class="img-fluid" src="source/produits/project3.jpg">
        </div>
        <div class="col-8 "> 
            <div class="row product_page_text ">
                <div class="col-7 ">
                    <p  id="product_title"></p>
                </div>
                <div class="col-5 ">
                    <span id="pstar1"class="fa fa-star"></span>
                    <span id="pstar2"class="fa fa-star"></span>
                    <span id="pstar3"class="fa fa-star"></span>
                    <span id="pstar4"class="fa fa-star"></span>
                    <span id="pstar5"class="fa fa-star"></span>
                </div>
            </div>  
            
            <div class="row product_page_text">   
                <div class="col-7">
                    <p id="author"></p> 
                </div>
                <div class="col-5">
                    
                    <span id="sstar1"class="fa fa-star"></span>
                    <span id="sstar2"class="fa fa-star"></span>
                    <span id="sstar3"class="fa fa-star"></span>
                    <span id="sstar4"class="fa fa-star"></span>
                    <span id="sstar5"class="fa fa-star"></span>

                </div>
            </div>  
            <p class="product_page_text"  id="product_desc"></p>  
            <p class="product_page_text"  id="tags"></p>    
            <div class="row ">
                <div class="col delivery_price_text product_page_text">
                    <p class="delivery_price_text" id="delivery_price"></p>
                </div>
                <div class="col product_page_text">
                    <p class="delivery_price_text" id="print_duration"></p>
                </div>
            </div>
            <div class="row product_page_text">
                <div class="col">
                    <p id="price"></p>
                </div>

            </div>
        </div>    
    </div>

</div>

<div class="container">
   
    <div class="review_wrapper">
    
        <div class="col comment review_user"> </div>
        <div class="col review_stars"> </div> 
        <div class="col review_text"></div>
    
    </div> 
   
 </div>






    
    
    
            
</body>
    
    
    
    <?php 
            $sqlProductInfo ="CALL get_sales_item_page_info(64)";
            $sqlFetchTags = "CALL get_tags_for_post(64,'sales_item')";
            $sqlFetchReviews = "CALL get_post_reviews(64)";
            $resultProduct = mysqli_query($conn, $sqlProductInfo); // 1st query
            $row = mysqli_fetch_assoc($resultProduct); // store 1st results
            
            
            mysqli_close($conn); // close connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);    // restart
                      
            
            $tags = mysqli_query($conn, $sqlFetchTags); // tag query

            mysqli_close($conn); // close connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);    // restart

            $reviews = mysqli_query($conn, $sqlFetchReviews);
           
            $productData = array(
                "name" => $row['item_name'],
                "description" => $row['item_description'],
                "type" => $row['item_type'],
                "price" => $row['price'],
                "sold" => $row['amount_sold'],
                "print_duration" => $row['print_duration'],
                "delivery_price" => $row['delivery_price'],
                "filament_type" => $row['filament_type'],
                "rating" => $row['item_rating'],
                "author" => $row['full_name'],
                "author_rating" => $row['seller_rating']
                );   
            // Now handle only tags
            $tag_array = array();
            while($row = mysqli_fetch_assoc($tags))
            {
               array_push($tag_array,$row['tag']);  
            }
            // now handle only reviews 
            $review_array = array();
            while($row = mysqli_fetch_assoc($reviews) )
            {
                $temp_review = array(
                "review_user" => $row['full_name'],
                "review" => $row['review'],
                "timestamp" => $row['review_timestamp'],
                "score" => $row['reviewer_score']
                );
                array_push($review_array, $temp_review);
                unset( $temp_review);
                
            }
            $jsonReviews = json_encode($review_array);
        ?>

<script>


    // Populate page with data 
    jsonJsProduct = {
            "name" : <?php echo json_encode($productData["name"], JSON_HEX_TAG); ?>,
            "description" : <?php echo json_encode($productData["description"], JSON_HEX_TAG); ?>,
            "type" : <?php echo json_encode($productData["type"], JSON_HEX_TAG); ?>,
            "price" : <?php echo json_encode($productData["price"], JSON_HEX_TAG); ?>,
            "sold" : <?php echo json_encode($productData["sold"], JSON_HEX_TAG); ?>,
            "print_duration" : <?php echo json_encode($productData["print_duration"], JSON_HEX_TAG); ?>,
            "delivery_price" : <?php echo json_encode($productData["delivery_price"], JSON_HEX_TAG); ?>,
            "filament_type" : <?php echo json_encode($productData["filament_type"], JSON_HEX_TAG); ?>,
            "rating" : <?php echo json_encode($productData["rating"], JSON_HEX_TAG); ?>,
            "author" : <?php echo json_encode($productData["author"], JSON_HEX_TAG); ?>,
            "author_rating" : <?php echo json_encode($productData["author_rating"], JSON_HEX_TAG); ?>,
            "tags" : <?php echo json_encode($tag_array, JSON_HEX_TAG); ?>
        };   

    var jsonReviews = <?= $jsonReviews; ?>;
    console.log(jsonReviews);
    console.log(jsonJsProduct);

   appendData(jsonJsProduct);
   appendReview(jsonReviews);
</script>














</html>