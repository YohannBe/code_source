<?php 
include_once 'dbconnection.php';
include_once 'user_params.php';
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
</head>

<body>


<div class="head_button">
    <button id="defaultOpen" class="tablink" onclick="openTab('principal_profile', this, 'tabcontent')">3D item</button>
    <button id="buyer_profile_link" class="tablink" onclick="openTab('buyer_profile', this, 'tabcontent')">3D schema</button>
    <button id="seller_profile_link" class="tablink" onclick="openTab('seller_profile', this, 'tabcontent')">2D sketch</button>
</div>  



<div class="totalContainer">
    <ul class="progressbar">
        <li class="actual_step">Files</li>
        <li id="secondStepList">Details</li>
    </ul>









    
        <div id="firstStepAddProduct" class="dropSide content">
            <div class="dropZone" id="dropZonePicture">
                <p>drop files' picture here to upload <br/> <img class="logoDropZone" src="source/icones/piclogo.png"></p>
            </div>
            <div id="uploadsPicture"></div>

            <div class="dropZone" id="dropZoneFileType">
                <p>drop 3D files here to upload <br/>  <img class="logoDropZone" src="source/icones/filelogo.png"></p>
            </div>
            <div id="uploadsFilesType"></div>

        </div>

        <form id="secondStepAddProduct" class="content" method="POST" action="add_product_to_sql.php">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="description">Description:</label><br>
            <textarea name="description" rows="10" cols="30">
            </textarea><br>
            <label for="tags">Tag:</label><br>
            <input type="text" class="tags" name="tags"><br>
            <label for="price">price:</label><br>
            <input type="number" id="price" name="price" min="0" step="10"><br>

            <label for="duration">Print duration (days/hours/minutes):</label><br>
            <input type="range" id="dayDuration" name="duration" min="0" value="0" max="99">
            <span id="demo">0 days</span>
            <input type="range" id="timeDuration" name="duration" min="0" value="0" max="23">
            <span id="demo2">0 hours</span><br>
            <script>
                var slider = document.getElementById("dayDuration");
                var output = document.getElementById("demo");
                // Update the current slider value (each time you drag the slider handle)
                slider.oninput = function() {
                    output.innerHTML = this.value+ " days";
                }
                var slider2 = document.getElementById("timeDuration");
                var output2 = document.getElementById("demo2");
                // Update the current slider value (each time you drag the slider handle)
                slider2.oninput = function() {
                    output2.innerHTML = this.value+ " hours";
                }
            </script>

            <label for="filament">Choose a filament:</label><br> 
            <select id="filament" name="filament">
                <option value="PLA">PLA</option>
                <option value="ABS">ABS</option>
                <option value="PETG">PETG</option>
                <option value="Nylon">Nylon</option>
            </select><br>
            <input class="my_button_add_product" type="submit" value="Submit">
        </form>

    


</div>







<script>
    var myPicture = false;
    var myFiles = false;
    (function(){
        var dropZonePicture = document.getElementById('dropZonePicture');
        var dropZoneFileType = document.getElementById('dropZoneFileType');

        var upload = function(files, dropZoneName){
            
            var displayUploads = function(data){
                var uploads = document.getElementById(dropZoneName),
                list,
                x;
                list = document.createElement('ul');
                for(x=0; x<data.length; x++){
                    item = document.createElement('li')
                    item.innerText = data[x].name;
                    list.appendChild(item);
                }
                uploads.appendChild(list);
            }
            
            var formData = new FormData (),
                xhr = new XMLHttpRequest(),
                x;
            for(x=0; x<files.length; x = x+1){
                formData.append('file[]', files[x]);
            }
            xhr.onload = function(){
                var data = JSON.parse(this.responseText);

                displayUploads(data);
            }
            xhr.open('post', 'upload.php');
            xhr.send(formData);

            console.log(myPicture);
            console.log(myFiles);

            if(myPicture == true && myFiles == true){
                document.getElementById('firstStepAddProduct').style.display = "none";
                document.getElementById('secondStepAddProduct').style.display = "flex";
                document.getElementById('secondStepAddProduct').classList.add("secondStepAddProductDisplayed");
                document.getElementById('secondStepList').classList.add("actual_step");
            }

        }

        dropZonePicture.ondrop = function (e){
            e.preventDefault();
            this.className = 'dropZone';
            console.log(e.dataTransfer.files);
            var allName = null;

            for(var x=0; x<e.dataTransfer.files.length; x++){
                if(allName == null)
                    allName = e.dataTransfer.files[x].name + "\n";
                else
                    allName = allName + e.dataTransfer.files[x].name  + "\n";
                }

                if(confirm("you are about to upload: \n" + allName + "\n" +"Do you confirm the upload ?"))
                    {myPicture = true;
                     upload(e.dataTransfer.files, 'uploadsPicture');
                    }

        };

        dropZonePicture.ondragover = function (){
            this.className = 'dropZone dragover';
            return false;
        };

        dropZonePicture.ondragleave = function (){
            this.className = 'dropZone';
            return false;
        };

        dropZoneFileType.ondrop = function (e){
            e.preventDefault();
            this.className = 'dropZone';
            console.log(e.dataTransfer.files);
            var allName = null;

            for(var x=0; x<e.dataTransfer.files.length; x++){
                if(allName == null)
                    allName = e.dataTransfer.files[x].name + "\n";
                else
                    allName = allName + e.dataTransfer.files[x].name  + "\n";
                }

                if(confirm("you are about to upload: \n" + allName + "\n" +"Do you confirm the upload ?"))
                   { myFiles = true;
                     upload(e.dataTransfer.files, 'uploadsFilesType');
                    }
        };

        dropZoneFileType.ondragover = function (){
            this.className = 'dropZone dragover';
            return false;
        };

        dropZoneFileType.ondragleave = function (){
            this.className = 'dropZone';
            return false;
        };

        
    }());


    function openTab(tabName, elmnt, tab) {

        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName(tab);
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
        document.getElementById(tabName).style.color = '#707070';

        if(tabName=="seller_profile"){
            document.getElementById("defaultProductOpen").click();
            document.getElementById(tabName).style.color = '#707070';
        }
    }

        // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    document.getElementById("principal_profile").style.color = '#707070';

</script>

</body>

</html>
    