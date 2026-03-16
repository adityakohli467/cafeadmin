<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo base_url(); ?>assets/js/scripts/CloudABIS-Helper.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
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
            width: 515px;
        }
        .commonForm label{
            display: block;
            width: 215px;
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
            width: 66%;
        }
        #serverResult{
            background-color: #fff;
            padding: 10px 15px;
            width: 66%;
            text-align: center;
            margin-top: 15px;
        }
        .commonForm input[type="text"]{
            padding: 14px 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width:95%;
        }
        .commonForm select{
            padding: 14px 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
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
        .mt-10{margin-bottom:10px;}
    </style>

</head>
<body>
    <div class="formWrapper">
        <form class="commonForm" action="<?php echo base_url();?>index.php/Fingerprintapi/registerfinger" method="POST">
            <h1 class="headline">Registration</h1>
            
            <div>
                <label for="registrationID">Registration ID</label>
                <input type="text" name="registrationID" id="registrationID" value="">
            </div>
            <div>
               
                <input type="button" name="biometricCapture" value="Biometric Capture" onclick="captureBiometric('Register')">
                <input type="submit" name="register" value="Register">
            </div>
           <a href="<?php echo base_url();?>index.php/Fingerprintapi/RegisterFingerPrint"> <input type="button" value="Back" ></a>
            
            <input type="hidden" name="templateXML" id="templateXML" value="">
        </form>
        <label id="serverResult"><?php if(isset($msg) && $msg !=''){ echo $msg; }?></label>

       
    </div>
   
</body>
</html>