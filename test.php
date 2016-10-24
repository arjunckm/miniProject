<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8> <meta content="IE=edge" http-equiv=X-UA-Compatible> <meta content="width=device-width,initial-scale=1" name=viewport>
  <title>Visualization</title>
  <link rel="stylesheet" type="text/css" href="css/c3.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
  <link rel="stylesheet" type="text/css" href="css/ripples.css">

  <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="js/d3.v3.min.js"></script>
  <script type="text/javascript" src="js/c3.min.js"></script>
  <script type="text/javascript" src="js/material.js"></script>
  <script type="text/javascript" src="js/ripples.js"></script>

</head>
<body>
<div class="container">

  
<div id="chart"></div>

</div> <script type="text/javascript">    
var json = [{"noofstudent":"15","start_year":"AUG_1998"},{"noofstudent":"42","start_year":"AUG_1999"},{"noofstudent":"45","start_year":"AUG_2000"},{"noofstudent":"57","start_year":"AUG_2001"},{"noofstudent":"55","start_year":"AUG_2002"},{"noofstudent":"65","start_year":"AUG_2003"},{"noofstudent":"56","start_year":"AUG_2004"},{"noofstudent":"79","start_year":"AUG_2005"},{"noofstudent":"101","start_year":"AUG_2006"},{"noofstudent":"148","start_year":"AUG_2007"},{"noofstudent":"134","start_year":"AUG_2008"},{"noofstudent":"214","start_year":"AUG_2009"},{"noofstudent":"186","start_year":"AUG_2010"},{"noofstudent":"173","start_year":"AUG_2011"},{"noofstudent":"10","start_year":"FEB_1999"},{"noofstudent":"18","start_year":"FEB_2000"},{"noofstudent":"26","start_year":"FEB_2001"},{"noofstudent":"24","start_year":"FEB_2002"},{"noofstudent":"38","start_year":"FEB_2003"},{"noofstudent":"16","start_year":"FEB_2004"},{"noofstudent":"17","start_year":"FEB_2005"},{"noofstudent":"23","start_year":"JAN_2006"},{"noofstudent":"43","start_year":"JAN_2007"},{"noofstudent":"31","start_year":"JAN_2008"},{"noofstudent":"25","start_year":"JAN_2009"},{"noofstudent":"67","start_year":"JAN_2010"},{"noofstudent":"52","start_year":"JAN_2011"},{"noofstudent":"1","start_year":"JAN_2012"}];

    
    
    var valFields = ["noofstudent"];
    var dataIndexField = "data";
    var keyField = "start_year";
    var newMap = {}; // new data will be built up in here
    json.forEach (function (d) {
        // get new data obj for key, which in this case is the day value
        var key = d[keyField];
        var newObj = newMap[key];
        if (!newObj) { // make the obj if it doesn't exist
            newObj =  {key: key};
            newMap[key] = newObj;
        }
        
        // in this obj merge the dataIndexField and valFields to make new datapoints
        var dataIndex = d[dataIndexField]; // either data1 or data2
        valFields.forEach (function (vField) { // vfield will loop value1 then value2
            newObj[vField] = d[vField]; // data1/2value1/2 = the value of value1/2
        });
    });
    var newJson = d3.values(newMap);
    var newDataFields = d3.keys(newJson[0]);
    newDataFields.splice (newDataFields.indexOf("key"), 1);
    
    
    
    var chart = c3.generate({
        data: {
            json: newJson,
            keys: {
                x: 'key',
                value: newDataFields
            }
        },
      axis: {
        x: {
           type: 'category'
        }
      }
    });  

</script>

</div>

</body>
</html>