<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your page title</title>
    <?php include_once './inc/head.php' ?>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.14.0/css/ui.jqgrid.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.14.0/jquery.jqgrid.min.js"></script>
    <script>
    //<![CDATA[
    $(function () {
        "use strict";
        $("#grid").jqGrid({
            colModel: [
                { name: "firstName" },
                { name: "fkl" },
                { name: "line" },
                { name: "unit" },
                { name: "building" },
                { name: "lastName" }
            ],
            data: [
                { id: 10, fkl:"jfdls",line:"lfjlas",unit:"jfdlsjfl",building:"jfl",firstName: "Angela", lastName: "Merkel" },
                { id: 20, fkl:"jfdls",line:"lfjlas",unit:"jfdlsjfl",building:"jfl",firstName: "Vladimir", lastName: "Putin" },
                { id: 30, fkl:"jfdls",line:"lfjlas",unit:"jfdlsjfl",building:"jfl",firstName: "David", lastName: "Cameron" },
                { id: 40, fkl:"jfdls",line:"lfjlas",unit:"jfdlsjfl",building:"jfl",firstName: "Barack", lastName: "Obama" },
                { id: 50, fkl:"jfdls",line:"lfjlas",unit:"jfdlsjfl",building:"jfl",firstName: "François", lastName: "Hollande" }
            ]
        });
    });
    //]]>
    </script>
</head>
<body>
<table id="grid"></table>

<form id="example" name="example">
        <select id="sensor" onchange="updateText('sensor')">
        <option value="J">J</option>
        <option value="K">K</option>
    </select>

    <select id="voltage" onchange="updateText('voltage')">
        <option value="120V">120V</option>
        <option value="240V">240V</option>
    </select>

    <br />
    <input type="text" value="" id="sensorText" /> <input type="text" value="" id="voltageText" />
</form>






<div class="dialog mt-5 ml-5" data-role="dialog" data-close-button=true id="demoDialog1">
    <div class="dialog-title">Write a new organization name</div>
    <div class="dialog-content">
  <div class="form-group">
      <input type="text" name="org_name" data-role="input" placeholder="BGMEA">
    </div>
    </div>
    <div class="dialog-actions">
        <button class="button success js-dialog-close">Agree</button>
    </div>
</div>
<button class="button success mt-5 ml-5"
    onclick="Metro.dialog.open('#demoDialog1')"><span class="mif-plus"></span>

</button>








<?php include_once './inc/footer.php'; ?>
<script type="text/javascript">
function updateText(type) { 
 var id = type+'Text';
 document.getElementById(id).value = document.getElementById(type).value;
}

</script>

</body>
</html>