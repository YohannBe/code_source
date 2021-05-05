<?php 
include_once 'dbconnection.php';
 
session_start();
echo "Current userID: ",$_SESSION['userID']," ||","  " , $_SESSION['full_name']; 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styleSheet.css" />
    <title>Oray</title>
    <!-- Jquery import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }



        function myTimer() {
            document.getElementById("next_slide_auto").click();
        }

        /**-------------------------------------------------------------------------------------------------*/

        var actualTabName;


        function openTab(tabName, elmnt) {

            actualTabName = tabName;
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.color = "";
            }

            // Show the specific tab content
            document.getElementById(tabName).style.display = "flex";
            elmnt.style.color = '#E68235';

        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        /**----------------------------------------------------------------------------------*/
        

        function appendAllMyJson(dataProduct, dataProject, dataTopTenProject, dataTopTenProduct, dataTopTenSeller, dataSellers, dataFavorite){
                    for(var i = 0; i< dataProject.length; i++){
                        var isFavorite = false;
                        for(var j = 0; j<dataFavorite.length; j++){
                            if (dataFavorite[j].projectID == dataProject[i].project_id)
                            isFavorite = true;
                        }
                        createNewCardTopTenProduct("project_link_card_happened","source/produits/project4.jpg", dataProject[i].project_description, dataProject[i].project_budget, isFavorite, dataProject[i].project_name,dataProject[i].project_id,"project");
                    }
                    for(var i = 0; i< dataProduct.length; i++){
                        var isFavorite = false;
                        for(var j = 0; j<dataFavorite.length; j++){
                            if (dataFavorite[j].sales_itemID == dataProduct[i].product_id)
                            isFavorite = true;
                        }
                        createNewCardTopTenProduct("product_link_card_happened",dataProduct[i].item_pic_link, dataProduct[i].product_description, dataProduct[i].product_price, isFavorite, dataProduct[i].product_name,dataProduct[i].product_id,"product");
                    }
                    for(var i = 0; i< dataTopTenProject.length; i++){
                        var isFavorite = false;
                        for(var j = 0; j<dataFavorite.length; j++){
                            if (dataFavorite[j].projectID == dataTopTenProject[i].project_id)
                            isFavorite = true;
                        }
                        createNewCardTopTenProduct("top_ten_project_card_happened","source/produits/project4.jpg", dataTopTenProject[i].project_description, dataTopTenProject[i].project_budget, isFavorite, dataTopTenProject[i].project_name,dataTopTenProject[i].project_id,"project");
                        
                    }
                    for(var i = 0; i< dataTopTenProduct.length; i++){
                        var isFavorite = false;
                        for(var j = 0; j<dataFavorite.length; j++){
                            if (dataFavorite[j].sales_itemID == dataTopTenProduct[i].product_id)
                            isFavorite = true;
                        }
                        createNewCardTopTenProduct("top_ten_card_happened",dataTopTenProduct[i].item_pic_link, dataTopTenProduct[i].product_description, dataTopTenProduct[i].product_price, isFavorite, dataTopTenProduct[i].product_name,dataTopTenProduct[i].product_id,"product");
                    }
                    for(var i = 0; i< dataTopTenSeller.length; i++){
                        createNewCardTopTenProduct("top_ten_sellers_card_happened","source/produits/person3.jfif", dataTopTenSeller[i].address, dataTopTenSeller[i].seller_rating, true, dataTopTenSeller[i].name,dataTopTenSeller[i].id,"user");
                    }

                    for(var i = 0; i< dataSellers.length; i++){
                        createNewCardTopTenProduct("sellers_link_card_happened","source/produits/person3.jfif", dataSellers[i].address, dataSellers[i].seller_rating, true, dataSellers[i].name,dataSellers[i].id,"user");
                    }
        }

        function createNewCardTopTenProduct(tabName, picture, description, price, liked, productName,id,postType) {
            
            const newCard = document.createElement("div");
            newCard.classList.add("card");
            const newPicture = document.createElement("img");
            newPicture.classList.add("img_card");
            var firstImage = picture.split(",");
            newPicture.src = firstImage[0];
            const newNameProduct = document.createElement("h3");
            newNameProduct.innerHTML = productName;
            const newDescription = document.createElement("p");
            newDescription.classList.add("card_product_description");
            newDescription.innerHTML = description;
            const newContainerBottomCard = document.createElement("div");
            newContainerBottomCard.classList.add("container");
            newContainerBottomCard.classList.add("card_bottom");
            const newPrice = document.createElement("p");
            newPrice.classList.add("price");
            if(tabName == "sellers_link_card_happened" || tabName == "top_ten_sellers_card_happened" )
            newPrice.innerHTML = "Rating: " + price;
            else
            newPrice.innerHTML = "$" + price;
            const newLikeParagraph = document.createElement("p");
            const newLikeButton = document.createElement("button");
            newLikeButton.classList.add("heart_button")
            
            const newLikeIcone = document.createElement("img");
            newLikeIcone.classList.add("icon_heart");
            newLikeIcone.id = "a" + id;
            
            if (liked == true) {
                newLikeIcone.src = "source/icones/groupe_22_filled.png";
            } else {
                newLikeIcone.src = "source/icones/groupe_22.png";
            }

            newCard.appendChild(newPicture);
            newCard.appendChild(newNameProduct);
            newCard.appendChild(newDescription);
            newCard.appendChild(newContainerBottomCard);
            newContainerBottomCard.appendChild(newPrice);
            newContainerBottomCard.appendChild(newLikeParagraph);
            newLikeParagraph.appendChild(newLikeButton);
            newLikeButton.appendChild(newLikeIcone);

            // using jquery to give every picture a link
           // $(newPicture).wrap("<a href=test.html></a>");
          
         
          if (postType == "product") // every type of post  gets their own page
            $(newPicture).wrap("<a href=product_page.php?productID="+id+"></a>");
          else if (postType == "project")
            $(newPicture).wrap("<a href=project_page.php?projectID="+id+"></a>");
            else if (postType == "user")
            $(newPicture).wrap("<a href=extern_profile_page.php?userId="+id+"></a>");

            document.getElementById(tabName).appendChild(newCard);
        }
        

        function changeFavorite(element, myHeartsLastList, myId, cleanId, type){
            
            
            console.log(element.childNodes[0].id);
            console.log(document.getElementById(myId).src);
            
            var notExist = true;

            if(document.getElementById(myId).src.includes("source/icones/groupe_22_filled.png")){
                document.getElementById(myId).src = "source/icones/groupe_22.png";
            }
            else
            {document.getElementById(myId).src = "source/icones/groupe_22_filled.png";}

            obj = {
                "id" : myId,
                "src" : document.getElementById(myId).src,
                "type" : type
            };

            for(var i =0; i<myHeartsLastList.length; i++){
                if(myHeartsLastList[i].id == myId){
                    ajaxCall(cleanId, true, type);
                    myHeartsLastList.splice(i, 1);
                    notExist = false;
                }
            }
            if(notExist){
                myHeartsLastList.push(obj);
                ajaxCall(cleanId, false, type);
            }
           

        }

        function ajaxCall(id, action, type) {
            if(type == "'projectID'")
            type = true;
            else if(type == "'sales_itemID'") 
                    type = false;

            $.ajax({
            type: 'POST',
            url: 'favoriteC_changes_to_sql.php',
            dataType: 'json',
            data: {
                id: id,
                action: action,
                type: type
                },
            success: function(response) {
                alert(response);
            }
            });
        }
         


         
    </script>

</head>


 <script>
$(document).ready(function(){
   $(".header_class").load("header.php");
   $("footer").load("footer.html");
 });
</script>

<header class="header_class"> 
     <!-- Header is loaded with jQuery -->
</header>
<body>

    

    <div class="container_advertisement_image">
        <div class="mask_advertisement_image">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer.jfif">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer2.jfif">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer3.png">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer4.jpg">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer5.jfif">
            <img class="advertisement_image mySlides my_fade" src="source/produits/printer6.jfif">
            <script>showSlides(1)</script>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a id="next_slide_auto" class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="dot_container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
            <span class="dot" onclick="currentSlide(6)"></span>
        </div>
        <script>setInterval(myTimer, 3000);</script>
    </div>

    <div class="search_container">
        <input type="text" placeholder="     Search.." class="search_text">
        <button class="search_button" type="submit"><img class="search_img" src="source/icones/search.png"></button>
    </div>

    <div class="tab_container">

        <div class="head_button">
            <button id="defaultOpen" class="tablink" onclick="openTab('top_ten', this)">Top ten</button>
            <button id="products_link" class="tablink" onclick="openTab('products', this)">Products</button>
            <button id="projects_link" class="tablink" onclick="openTab('projects', this)">Projects</button>
            <button id="sellers_link" class="tablink" onclick="openTab('sellers', this)">Sellers</button>
        </div>

        <div class="tab">

            <div id="top_ten" class="tabcontent">
                <div class="top_ten_container">
                    <h3 class="title_top_ten">Products</h3>
                    <div id="top_ten_card_happened" class="product row">
                    </div>
                </div>
                <div class="top_ten_container">
                    <h3 class="title_top_ten">Projects</h3>
                    <div id="top_ten_project_card_happened" class="project row">
                    </div>
                </div>
                <div class="top_ten_container">
                    <h3 class="title_top_ten">Sellers</h3>
                    <div id="top_ten_sellers_card_happened" class="sellers row">
                    </div>
                </div>

            </div>

            <div id="products" class="tabcontent">
                <div class="title_container">
                    <h3 class="title_top_ten">Products</h3>
                    <div id="product_link_card_happened" class="product row">
                    </div>
                </div>

            </div>

            <div id="projects" class="tabcontent">
                <div class="title_container">
                    <h3 class="title_top_ten">Project</h3>
                    <div id="project_link_card_happened" class="product row">
                        

                    </div>
                </div>

            </div>

            <div id="sellers" class="tabcontent">
                <div class="title_container">
                    <h3 class="title_top_ten">Sellers</h3>
                    <div id="sellers_link_card_happened" class="product row">
                       

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
            $sqlProducts ="SELECT * FROM sales_item";
            $sqlProject = "SELECT * FROM project;";
            $sqlTopTenProduct = "CALL get_top10_sales_item_posts();";
            $sqlTopTenProject = "CALL get_top10_projects();";
            $sqlTopTenSeller ="CALL get_top10_sellers();";
            $sqlSeller ="SELECT * FROM users;";
            $sqlFavorite = "SELECT * FROM fav_posts WHERE userID = " .$_SESSION['userID'];
            

            $resultProject = mysqli_query($conn, $sqlProject);
            $resultCheckProject = mysqli_num_rows($resultProject);

            $resultProduct = mysqli_query($conn, $sqlProducts);
            $resultCheckProduct = mysqli_num_rows($resultProduct);

            $resultTopTenProject = mysqli_query($conn, $sqlTopTenProject);
            $resultCheckTopTenProject = mysqli_num_rows($resultTopTenProject);
            // Must restart connection after a CALL.
            mysqli_close($conn);
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            //****************************/
            $resultTopTenProduct = mysqli_query($conn, $sqlTopTenProduct);
            $resultCheckTopTenProduct = mysqli_num_rows($resultTopTenProduct);

            mysqli_close($conn);
            $conn = mysqli_connect($servername, $username, $password, $dbname);
        
            $resultSeller = mysqli_query($conn, $sqlSeller);
            $resultCheckSeller = mysqli_num_rows($resultSeller);

            mysqli_close($conn);
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $resultTopTenSeller = mysqli_query($conn, $sqlTopTenSeller);
            $resultCheckTopTenSeller = mysqli_num_rows($resultTopTenSeller);
            
            mysqli_close($conn);
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $resultFavorite = mysqli_query($conn, $sqlFavorite);
            $resultCheckFavorite = mysqli_num_rows($resultFavorite);
            mysqli_close($conn);
            
            if($resultCheckProduct > 0){
                $mainDataProduct = array();
                while($row = mysqli_fetch_assoc($resultProduct)){
                    $dataProduct = array(
                        "product_name" => $row['item_name'],
                        "product_id" => $row['id'],
                        "product_price" => $row['price'],
                        "product_description" => $row['item_description'],
                        "item_pic_link" => $row['item_pic_link'],
                        "type" => "product"
                    );   
                    array_push($mainDataProduct, $dataProduct);
                    unset($dataProduct);                
                }
                $jsonProduct = json_encode($mainDataProduct); 
            }

            if($resultCheckFavorite > 0){
                $mainDataFavorite = array();
                while($row = mysqli_fetch_assoc($resultFavorite)){
                    $dataFavorite = array(
                        "sales_itemID" => $row['sales_itemID'],
                        "projectID" => $row['projectID']
                    );   
                    array_push($mainDataFavorite, $dataFavorite);
                    unset($dataFavorite);                
                }
                $jsonFavorite = json_encode($mainDataFavorite); 
            } else $jsonFavorite =0;

            if($resultCheckTopTenProduct > 0){
                $mainDataTopTenProduct  = array();
                while($row = mysqli_fetch_assoc($resultTopTenProduct)){
                    $dataTopTenProduct  = array(
                        "product_name" => $row['item_name'],
                        "product_id" => $row['id'],
                        "product_price" => $row['price'],
                        "product_description" => $row['item_description'],
                        "item_pic_link" => $row['item_pic_link'],
                        "type" => "product"
                    );   
                    array_push($mainDataTopTenProduct , $dataTopTenProduct );
                    unset($dataTopTenProduct );                
                }
                $jsonTopTenProduct  = json_encode($mainDataTopTenProduct ); 
            }


            if($resultCheckProject > 0)
            {
                $mainDataProject = array();
                while($row = mysqli_fetch_assoc($resultProject)){
                    $dataProject = array(
                        "project_name" => $row['project_name'],
                        "project_id" => $row['id'],
                        "project_budget" => $row['budget'],
                        "project_description" => $row['project_description'],
                        "type" => "project"
                    );   
                    array_push($mainDataProject, $dataProject);
                    unset($dataProject);                
                }
                $jsonProject = json_encode($mainDataProject);                
            }

            if($resultCheckTopTenProject > 0)
            {
                $mainDataTopTenProject = array();
                while($row = mysqli_fetch_assoc($resultTopTenProject)){
                    $dataTopTenProject = array(
                        "project_name" => $row['project_name'],
                        "project_id" => $row['id'],
                        "project_budget" => $row['budget'],
                        "project_description" => $row['project_description'],
                        "type" => "project"
                    );   
                    array_push($mainDataTopTenProject, $dataTopTenProject);
                    unset($dataTopTenProject);                
                }
                $jsonTopTenProject = json_encode($mainDataTopTenProject);                
            }

            if($resultCheckSeller > 0)
            {
                $mainDataSeller = array();
                while($row = mysqli_fetch_assoc($resultSeller)){
                    $dataSeller = array(
                        "name" => $row['full_name'],
                        "id" => $row['id'],
                        "seller_rating" => $row['seller_rating'],
                        "address" => $row['address'],
                        "type" => "seller"
                    );   
                    array_push($mainDataSeller, $dataSeller);
                    unset($dataSeller);                
                }
                $jsonSeller = json_encode($mainDataSeller);                
            }


            if($resultCheckTopTenSeller > 0)
            {
                $mainDataTopTenSeller = array();
                while($row = mysqli_fetch_assoc($resultTopTenSeller)){
                    $dataTopTenSeller = array(
                        "name" => $row['full_name'],
                        "id" => $row['id'],
                        "seller_rating" => $row['seller_rating'],
                        "address" => $row['address'],
                        "type" => "seller"
                    );   
                    array_push($mainDataTopTenSeller, $dataTopTenSeller);
                    unset($dataTopTenSeller);                
                }
                $jsonTopTenSeller = json_encode($mainDataTopTenSeller);                
            }

        ?>















        <script>
            var jsonJsProduct = <?= $jsonProduct?>;
            
            var jsonJsProject = <?= $jsonProject; ?>;

            var jsonJsTopTenProject = <?= $jsonTopTenProject; ?>;

            var jsonJsTopTenProduct = <?= $jsonTopTenProduct; ?>;

            var jsonJsTopTenSeller = <?= $jsonTopTenSeller; ?>;

            var jsonJsSeller = <?= $jsonSeller; ?>;

            var jsonJsFavorite = <?= $jsonFavorite; ?>;

            
            appendAllMyJson(jsonJsProduct, jsonJsProject, jsonJsTopTenProject, jsonJsTopTenProduct,jsonJsTopTenSeller, jsonJsSeller, jsonJsFavorite);
        
            const myHearts = document.querySelectorAll(".heart_button");
            var myHeartsInitList = [];
            var myHeartsLastList = [];
            
            myHearts.forEach((e) => {
                var myId = e.childNodes[0].id;
                var mySrc = document.getElementById(myId).src;

                var type = "'seller'";
                var realId = myId.replace("a", "");

                for(var i = 0; i<jsonJsProduct.length; i++){
                    if(jsonJsProduct[i].product_id == realId){
                        type = "'sales_itemID'";
                    }
                }
                for(var i = 0; i<jsonJsProject.length; i++){
                    if(jsonJsProject[i].project_id == realId){
                        type = "'projectID'";
                    }
                }

                myObj = {
                    "id":myId,
                    "src":mySrc,
                    "type":type
                };
                myHeartsInitList.push(myObj);

                if(mySrc.includes("source/icones/groupe_22_filled.png"))
                {myHeartsLastList.push(myObj);}


                e.addEventListener('click', function() {changeFavorite(e, myHeartsLastList, myId, realId, type);});
                
            })

        </script>

 
           
    <footer> 
        <!-- jQuery pulls this -->
    </footer>
</body>

</html>