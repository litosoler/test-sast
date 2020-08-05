
<?php 
    if(array_key_exists("value", $_GET)){
        $myfile = fopen($_GET["value"], "r") or die("Unable to open file!");
        echo fread($myfile,filesize($_GET["value"]));
        fclose($myfile);
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        
        html {
            width: 100%;
            height: 100%;
        }

        body {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 0px;
        }

        .wrapper {
            width: 80%;
            height: 95%;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            justify-items: stretch;
        }

        .file {
            border:none;
            resize: none;
            width: 99.3%;
            height: 100%;
        }

        .fade-in {
            visibility: visible;
            opacity: 1;
            transition: opacity 0.5s linear;
        }

        .fade-out {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s .5s, opacity 0.5s linear;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form class="flex-grow-0">
            <div class="form-group">
            <label for="myList" >Archivos Disponibles: </label>
            <select id="myList" class="form-control">
                <option value="0">select a value</option>
                <?php
                    function dirToArray($dir) {

                        $result = array();
                        
                        $cdir = scandir($dir);
                        foreach ($cdir as $key => $value)
                        {
                            if (!in_array($value,array(".","..")))
                            {
                                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                                {
                                    $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                                }
                                else
                                {
                                    $result[] = $value;
                                }
                            }
                        }
                        
                        return $result;
                    }
                    
                    $files = dirToArray("./");
                    
                    foreach ($files as $key => $value)
                    {
                        echo '<option value="' . $value . '">' . $value . '</option>';
                    }

                ?>
            </select>  
            </div>          
        </form>
        <div class="flex-grow-1">
            <textarea  class="file"></textarea>
        </div>
    </div>
</body>

<script>

const select = document.querySelector("#myList")
const file = document.querySelector(".file")

select.onchange = function () {
    file.classList.remove("fade-in");
    file.classList.add("fade-out");
    if(select.value == 0){
        return;
    }

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", "/example_2_v1.php?value=" + select.value, true);
    xmlHttp.send(null);

}   

function callback (value) {
    file.classList.remove("fade-out")
    file.classList.add("fade-in")
    file.innerHTML = value
}
</script>

</html>