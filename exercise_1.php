<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            padding-top: 25px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php
            echo "<p>Hello World!</p>";
        
            if(array_key_exists("val", $_GET)){
                echo "<p>You have send to the server: <b>" . htmlspecialchars($_GET["val"]) . "</b></p>";
                // echo "<p>You have send to the server: <b>" . $_GET["val"] . "</b></p>";
            }
        ?>
    </div>
</body>

</html>