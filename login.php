<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login</title>
        <meta name="description" content="MOOC bot GUI">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            body {
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left:   50px;
                padding-right:  50px;

                background-color: #000;
            }
        </style>
    </head>
    <body>
        <div id = "container">
            <h1 class="customFontColor"><strong>Coding the MOOC</strong></h1>
            <h3 class="customFontColor" style="padding-bottom : 10px;"> Twitter Bot GUI</h3>
            <h3 class="customFontColor" style="padding-bottom : 10px;"><span class="glyphicon glyphicon-eye-open"></span></h3>
            <div class="bottom"></div>
            <div class="center-block col-lg-12 col-md-12 col-sm-12">
                <div class="h1 customFontColor"><strong>Team Login</strong></div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 0px;">
                    <input type="text" class="form-control" id="ruleName" placeholder="Team name (Must be Unique)">
                </div>
                <div class="input-group input-group-lg" >
                    <input type="text" class="form-control" id="who" placeholder="Team Password (Something secure and also everyone in your team can remember)">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 0px;"><button class="btn btn-lg customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="Login()">Login <i class="fa fa-sign-in "></i></button>
                <button class="btn btn-lg customFontColor" style="padding: 10px 10px 10px 10px; margin-left: 20px; background-color: #2d6ca2; color: #fee;" onclick="window.location = 'register.php';">Register <i class="fa fa-paw "></i></button></div>
            </div>
        </div>
    </body>
</html>
