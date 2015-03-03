

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
            <h3 class="customFontColor" style="padding-bottom : 10px;"> Register your team</h3>
            <h3 class="customFontColor" style="padding-bottom : 10px;"><span class="glyphicon glyphicon-eye-open"></span></h3>
            <div class="bottom"></div>
            <div class="h1 customFontColor"><strong>Register Team</strong></div>
            <div class="center-block col-lg-7 col-md-7 col-sm-7">
                
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px; width:100%; ">
                    <input type="text" class="form-control" id="teamName" placeholder="Unique Team Name">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;  width:100%; ">
                    <input type="password" class="form-control" id="password"  placeholder="Team Password (Something secure and also everyone in your team can remember)">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;  width:100%; ">
                    <input type="password" class="form-control" id="confirmpassword"  placeholder="Confirm team Password">
                </div>
                
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px; width:100%; ">
                    <input type="text" class="form-control" id="projectURL" placeholder="Project URL">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px; width:100%; ">
                    <input type="text" class="form-control" id="notThis" placeholder="University Project">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px; width:100%; ">
                    <input type="text" class="form-control" id="notThis" placeholder="And Tweet NOT Contains(Seperate;words;by;semi;colon)">
                </div>
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;  width:100%; ">
                    <input type="email" class="form-control" id="yourEmail"  placeholder="Your email address+">
                </div>

                
                <div class="input-group input-group-lg" style="padding: 9px 9px 9px 0px;">
                    <button class="btn btn-lg customFontColor" style="padding: 10px 10px 10px 10px; margin-left: 9px; background-color: #2d6ca2; color: #fee;" onclick="register();">
                        Register 
                        <i class="fa fa-paw ">
                        </i>
                    </button>
                </div>
                </div>
                <div class="center-block col-lg-5 col-md-5 col-sm-5">
                    <h4 class="text-left" style="color: #ccc">
                        This project developed by ....
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                    </h4>
                </div>
        </div>
        <script type="text/javascript" src="js/register.js"></script>
</body>
</html>

