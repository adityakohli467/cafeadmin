<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CloudABIS SDK WebForm</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .homeContainer{
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            flex-direction: column;
            background-color: #ff9900;
        }
        .homeContainer div{
            background-color: #f5f5f5;
            width: 190px;
            margin-bottom: 10px;
            text-align: center;
        }
        .homeContainer div a{
            text-decoration: none;
            display: block;
            color: #ff9900;
            font-family: arial;
            font-size: 16px;
            transition: all .3s;
            padding: 12px 0px;
            border:1px solid #f5f5f5;
        }
        .homeContainer div a:hover{
            background-color: #ff9900;
            color: #fff;
        }
        .headline{
            text-align: center;
            margin-top: 0;
            color: #fff;
        }
    </style>
</head>
<body>
  
    
    <div class="container homeContainer">
   <?php if($this->session->userdata('role') =='admin' || $this->session->userdata('role') =='manager') { ?>
        <h1 class="headline">Welcome To Employee Register Portal</h1>
        <div><a href="<?php echo base_url();?>index.php/Fingerprintapi/isregistred">Is Registered</a></div>
        
        <div><a href="<?php echo base_url();?>index.php/Fingerprintapi/registerfinger">Register</a></div>
        <!--<div><a href="Identify.php">Identify</a></div>-->
        <!--<div><a href="Verify.php">Verify</a></div>-->
        <!--<div><a href="Update.php">Update</a></div>-->
        <!--<div><a href="ActiveDevice.php">Change active device</a></div>-->
         <?php }else { ?>
         <div > <h3>You do not have to right to access this page.<h3></div>
         <?php } ?>
    </div>
   
</body>
</html>