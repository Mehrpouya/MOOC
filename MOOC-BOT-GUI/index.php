<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Twitter Bot GUI</title>
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

            <div class="tabbable attachTop" style="margin-bottom: 18px;">
                <ul class="nav nav-tabs attachTop">
                    <li class="active"><a href="#newRule" data-toggle="tab">New Rule</a></li>
                    <li class=""><a href="#updateRules" data-toggle="tab">Edit Rules</a></li>
                    <li class="disabled"><a href="#tab3" data-toggle="tab">Settings</a></li>
                    <li class="disabled"><a href="#tab4" data-toggle="tab">Help</a></li>
                </ul>
                <div class="tab-content" style="padding-bottom: 9px; padding-top: 20px;">
                    <div class="tab-pane fade-in active" id="newRule" style="padding-bottom: 50px;">
                        <button class="btn btn-lg center-block customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="clearRule()">Clear Rule <i class="fa fa-recycle"></i></button>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="ruleName" placeholder="Name of this rule!">
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="who" placeholder="Who is making this rule!">
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="catName" placeholder="Category Name">
                        </div>
                        <h3 class="customFontColor">If</h3>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="containsThis" placeholder="Tweet Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                        </div>

                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="containsThat" placeholder="And Tweet Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon">& <i class="fa fa-twitter"></i></span>
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="notThis" placeholder="And Tweet NOT Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon">NOT <i class="fa fa-twitter"></i></span>
                        </div>
                        <h3 class="customFontColor">Then tweet:</h3>
                        <h6 class="customFontColor"><small>(Maximum of 15 responses for now)</small></h6>
                        <div id="listOfResponses"  style="padding: 9px 9px 80px 9px;">
                            <div class="input-group input-group-lg" style="padding-top: 9px; padding-bottom: 9px;">
                                <input type="text" class="form-control answersToStore" placeholder="Tweet this message or you can add more and the Bot will choose one randomly" onkeyup="javascript: updateCharCount(this)">
                                <span class="input-group-addon customFontColor charCount" style="color: #888; padding: 5px;">130</span>
                                <span class="input-group-addon customFontColor" style="color: #000; padding: 5px;" onclick="addMoreResponses()"><i class="fa fa-plus-square"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="display: block;" id="successMessage"><h1 class="customFontColor">Thank you Master</h1></div>
                        <button class="btn btn-lg center-block customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="saveData()">Save <i class="fa fa-floppy-o"></i></button>
                        
                    </div>
                    <!----------------------------------------------------Edit rule------------------------------------------------------>                        
                    <div class="tab-pane fade-in " id="updateRules" style="padding-bottom: 50px;">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="filter-dropdownMenu1" data-toggle="dropdown">
                                Filter Rules
                                <span class="caret"></span>
                            </button>
                            <button class="btn btn-lg customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="filterRules()"><i id="filter-refreshIcon"  class="fa fa-refresh"></i></button>
                            <ul id="filter-ruleList" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1"  style="max-height: 500px; overflow: scroll;">
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="edit-dropdownMenu1" data-toggle="dropdown">
                                Rules List
                                <span class="caret"></span>
                            </button>
                            <button class="btn btn-lg customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="loadRules()"><i id="edit-refreshIcon"  class="fa fa-refresh"></i></button>
                            <ul id="edit-ruleList" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1"  style="max-height: 500px; overflow: scroll;">
                            </ul>
                        </div>
                        <button class="btn btn-lg center-block customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="removeRule()">Remove Rule <i class="fa fa-times"></i></button>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">

                            <input type="text" class="form-control" id="edit-ruleName" placeholder="Name of this rule!">
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="edit-who" placeholder="Who made it">
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="edit-catName" placeholder="Category Name">
                        </div>
                        <h3 class="customFontColor">If</h3>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="edit-containsThis" placeholder="Tweet Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                        </div>

                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="edit-containsThat" placeholder="And Tweet Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon">& <i class="fa fa-twitter"></i></span>
                        </div>
                        <div class="input-group input-group-lg" style="padding: 9px 9px 9px 9px;">
                            <input type="text" class="form-control" id="edit-notThis" placeholder="And Tweet NOT Contains(Seperate;words;by;semi;colon)">
                            <span class="input-group-addon">NOT <i class="fa fa-twitter"></i></span>
                        </div>
                        <h3 class="customFontColor">Then tweet:</h3>
                        <h6 class="customFontColor"><small>(Maximum of 15 responses for now)</small></h6>
                        <div id="edit-listOfResponses"  style="padding: 9px 9px 80px 9px;">
                            <div class="input-group input-group-lg" style="padding-top: 9px; padding-bottom: 9px;">
                                <input type="text" class="form-control edit-answersToStore" placeholder="Tweet this message or you can add more and the Bot will choose one randomly" onkeyup="javascript: updateCharCount(this)">
                                <span class="input-group-addon customFontColor charCount" style="color: #888; padding: 5px;">110</span>
                                <span class="input-group-addon customFontColor" style="color: #000; padding: 5px;" onclick="addMoreEditResponses()"><i class="fa fa-plus-square"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-lg center-block customFontColor" style="padding: 10px 10px 10px 10px; background-color: #2d6ca2; color: #fee;" onclick="updateData()">Update <i id="updateIcon" class="fa fa-floppy-o"></i></button>
                    </div>
                </div>
                <small class="center-block text-center" style="color: #777;">Version 0.5</small>
            </div>
            <hr>
            <footer>
                <p class="customFontColor">&copy; Coding the MOOC - University of Edinburgh 2014</p>
            </footer>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>     
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/raphael-min.js"></script>
        <script src="js/main.js"></script>

    </body> 
</html>