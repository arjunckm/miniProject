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
<div class="col-md-12" style="top:15px">
  <div class="col-md-3" style="top: 19px;">
    <img src="images/logo.png">
  </div>
  <div class="col-md-8">
  <h3 style="text-align:center">School of Information Sciences</h3>
  <h4 style="text-align:center">Data Analysis & Visualization - Students Academic Performance Analysis </h4>
  </div>
</div>
<div class="col-md-12">
<div class="form-inline">
  <div class="form-group label-floating">
      <label for="listofdata" class="">Select Data List</label><br/>
      <select id="listofdata" class="form-control ">
        <option value="" data-btn="dataType">Select Option</option>
        <option value="status" data-btn="dataType">Status</option>
        <option value="genderratio" data-btn="dataType">Gender Ratio</option>
        <option value="resultall" data-btn="dataType">All Result (Final Totals)</option>
        <option value="oddevenenroll" data-btn="dataType">Odd/Even Sem Enroll Ratio</option>
        <option value="statewiselist" data-btn="dataType">state wise list of Students</option>
        <option value="yearenroll" data-btn="yearenrolls">Student Enrollment by Year</option>        
      </select>
  </div>
  <div class="form-group" style="margin-left:20px" >
      <label>Select Chart type</label><br/>
      <button class="btn btn-raised btn-primary dataType" value="line">Line Chart</button>
      <button class="btn btn-raised btn-success dataType" value="bar">Bar Chart</button>
      <button class="btn btn-raised btn-info dataType" value="scatter">Scatter Chart</button>
      <button class="btn btn-raised btn-danger dataType" value="pie">Pie Chart</button>
      <button class="btn btn-raised btn-warning dataType" value="donut">Donut Chart</button>
      <button class="btn btn-raised btn-primary dataType" value="gauge">Gauge Chart</button>
      <button class="btn btn-raised btn-primary yearenrolls" value="plotyear">Plot year wise</button>      
      <button class="btn btn-raised btn-primary yearenrolls" value="plotaddmission">Plot Admission wise</button>      
  </div>
  
</div>
</div>
<div class="col-md-12">
  
<div id="chart"></div>

</div>
<script type="text/javascript">
$('.dataType,.yearenrolls').hide();
$('#listofdata').change(function(){

	var listdata=$("#listofdata :selected").attr('data-btn');	
	if(listdata=="dataType"){
		$('.dataType').show();
		$('.yearenrolls').hide();
	}else if(listdata=="yearenrolls"){
		$('.dataType').hide();
		$('.yearenrolls').show();
	}
});


$(".dataType").click(function(){
  var datalist=$("#listofdata").val();
  dataType=$(this).val();

  if(datalist==""){
      $("#chart").html('<span class="alert alert-warning">Please Select Data List</span>');
  }else if(dataType==undefined){
    $("#chart").html('<span class="alert alert-warning">Please Select Chart Type</span>');
  }else{

    if(datalist=="status"){
      d3.json("response.php?data=status", function(dataRes) {
         data = {};
         val=[];
        dataRes.forEach(function(e) {
            val.push('COMPLETED');
            val.push('INCOMPLETE');
            val.push('EXPIRED');
            data['COMPLETED'] = e.COMPLETED;
            data['INCOMPLETE'] = e.INCOMPLETE;
            data['EXPIRED'] = e.EXPIRED;
        });
        console.log(data);
        var chart = c3.generate({
          data: {
              json: [ data ],
              keys: {
                  value: val,
              },
              type: dataType
          },
          tooltip: {
              grouped: false
          }
          });
      });
  }else if(datalist=="genderratio"){
    d3.json("response.php?data=genderratio", function(dataRes) {
         data = {};
         val=[];
        dataRes.forEach(function(e) {
            val.push('MALE');
            val.push('FEMALE');
            data['MALE'] = e.MALE;
            data['FEMALE'] = e.FEMALE;
        });
        var chart = c3.generate({
          data: {
              json: [ data ],
              keys: {
                  value: val,
              },
              type: dataType
          },
          tooltip: {
              grouped: false
          }
          });
      });
  }else if(datalist=="resultall"){
    d3.json("response.php?data=resultall", function(dataRes) {
         data = {};
         val=[];
        dataRes.forEach(function(e) {
            val.push('Distinction');
            val.push('First');
            val.push('Second');
            val.push('Just Pass');
            data['Distinction'] = e.Distinction;
            data['First'] = e.First;
            data['Second'] = e.Second;
            data['Just Pass'] = e.JustPass;
        });
        console.log(data);
        var chart = c3.generate({
          data: {
              json: [ data ],
              keys: {
                  value: val,
              },
              type: dataType
          },
          tooltip: {
              grouped: false
          }
          });
      });
  }else if(datalist=="oddevenenroll"){
    d3.json("response.php?data=oddevenEnroll", function(dataRes) {
         data = {};
         val=[];
         console.log(dataRes);
        dataRes.forEach(function(e) {
            val.push('ODD');
            val.push('EVEN');
            data['ODD'] = e.ODD;
            data['EVEN'] = e.EVEN;
        });
        console.log(data);
        var chart = c3.generate({
          data: {
              json: [ data ],
              keys: {
                  value: val,
              },
              type: dataType
          },
          tooltip: {
              grouped: false
          }
          });
      });
  }else if(datalist=="statewiselist"){
    d3.json("response.php?data=statewiselist", function(dataRes) {
         data = {};
         val=[];
         console.log(dataRes);
         $(dataRes.states).each(function(k,v){
          console.log(k,v);
          val.push(v);
         });
         $(dataRes.count).each(function(k,v){
          console.log(k,v);
          data[dataRes.states[k]]=v;
         });        
        console.log(data);
        var chart = c3.generate({
          data: {
              json: [ data ],
              keys: {
                  value: val,
              },
              type: dataType
          },
          tooltip: {
              grouped: false
          }
          });
      });
  }
}
});

$(".yearenrolls").click(function(){
	var btndata=$(this).val();
	d3.json("response.php?data=yearenroll", function(dataRes) {
		console.log(dataRes[0].noofstudent);
    var valFields = ["noofstudent"];
    var dataIndexField = "data";
    var keyField = "start_year";
    var newMap = {}; 
    var key;
    dataRes.forEach (function (d) {
    	if(btndata=="plotaddmission"){
    		key = d[keyField].split("_")[1]+" "+d[keyField].split("_")[0];
    	}else if(btndata=="plotyear"){
    		key = d[keyField].split("_")[1];
    	}
                
        var newObj = newMap[key];
        if (!newObj) { 
            newObj =  {key: key};
            newMap[key] = newObj;
        }       
       
        var dataIndex = d[dataIndexField];
        valFields.forEach (function (vField) { 
            newObj[vField] = d[vField];
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
        zoom: {
            enabled: true
        },
        axis: {
          x: {
             type: 'category'
          }
        }
    });  



         /*noofstudent= [];
         year=[];
         data={};
         val=[];

        for(var i=0;i<dataRes.length;i++){
			noofstudent.push(dataRes[i].noofstudent);
			year.push(dataRes[i].start_year.split("_")[1]);
      	}
      	
        dataRes.forEach(function(e) {
            val.push('No. of Students');
            val.push('year');
            data['noofstudent']=noofstudent;
            data['year']=year;
        });
        var chart = c3.generate({
          data: {
              json: [ dataRes ],
              keys: {
                  value: val,
              },
              type: dataType
          }
          });*/
      });
});

  

</script>
<hr/>
<footer class="navbar-fixed-bottom" style="padding: 19px;background: black;color: aliceblue;">
  <div class="col-md-12"><span>Semester Project - Monsoon 2016 | Executed by Arjun JS & Chethan GS</span>
  <span class="pull-right">Github Repo Link: <a href="https://github.com/arjunckm">https://github.com/arjunckm</a></span>
  </div>
</footer>
</div>

</body>
</html>