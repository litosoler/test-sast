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

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form class="flex-grow-0">
            <div class="form-group">
            <label for="myList" >Archivos Disponibles: </label>
            <select name="value" id="myList" class="form-control">
                <option value="0">select a value</option>
                <?php
                    function dirToArray($dir) {

                        $result = array();
                        
                        $cdir = scandir($dir);
                        foreach ($cdir as $key => $value){
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
                    
                    foreach ($files as $key => $value){
                        echo '<option value="' . $value . '">' . $value . '</option>';
                    }
                ?>
            </select>  
            </div>   
            <button type="submit" class="btn btn-primary">  submit </button>       
        </form>
        <div class="flex-grow-1  p-4">
            <?php 
                if(array_key_exists("value", $_GET) && $_GET["value"] != "0"){
                    $url = "http://localhost/" . $_GET["value"];
                    echo '<iframe src="' . $url . '" title="example 2 version 2"></iframe>';
                }
            ?>
        </div>
    </div>
</body>
</html>