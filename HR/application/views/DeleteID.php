
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeleteID Form</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .formWrapper{
            display: flex;
            justify-content: center;
            height: 100vh;
            align-items: center;
            flex-flow: column;
            background-color: #ff9900;
        }
        .commonForm{
            border: 1px solid #f5f5f5;
            padding: 50px;
            min-width: 515px;
        }
        .commonForm label{
            display: block;
            color: #fff;
        }
        .headline{
            text-align: center;
            margin-top: 0;
            color: #fff;
        }
        .sresponse{
            background-color: #fff;
            padding: 15px;
            text-align: center;
            width: 28%;
        }
        .commonForm input[type="text"]{
            padding: 14px 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 95%;
        }
        .commonForm input[type="submit"],
        .commonForm input[type="button"]{
            border-radius: 5px;
            padding: 12px 0px;
            cursor: pointer;
            margin: 0px;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            border:1px solid #f5f5f5;
            transition: all .3s;
            color: #ff9900;
        }
        .commonForm input[type="submit"]:hover,
        .commonForm input[type="button"]:hover{
            background-color: #ff9900;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="formWrapper">
        <form class="commonForm" action="" method="POST">
            <h1 class="headline">Delete ID</h1>
            <div>
                <label for="deleteID">ID</label>
                <input type="text" name="deleteID" id="deleteID" value="">
            </div>
            <div>
                <input type="submit" name="delete" value="Delete ID">
            </div>
            <a href="<?php echo base_url();?>index.php/Fingerprintapi/deltefngr"> <input type="button" value="Back" ></a>
        </form>
        <label id="serverResult"></label>

    </div>
   
     
</body>
</html>