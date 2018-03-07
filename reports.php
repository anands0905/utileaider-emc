<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
$title = 'Reports';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>:: <?php echo $title ; ?> | Utileaider ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="900">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="style/master.css">
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">
    <script src="https://use.fontawesome.com/36a66efa71.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>
    <script src="https://use.fontawesome.com/36a66efa71.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <!-- <script src = "https://maps.googleapis.com/maps/api/js"></script> -->
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Fixed_Column/vendor/animate/animate.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Fixed_Column/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Fixed_Column/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/tb/Table_Fixed_Column/css/util.css">
    	<link rel="stylesheet" type="text/css" href="style/maintable.css">
    <!--===============================================================================================-->

    <style media="screen">
    .container-o{
        margin: 5px auto;
        max-width: 2200px;
    }
    .card-header{
      text-transform: uppercase;
      max-height: 30px;
      padding: 5px;
      -webkit-box-shadow: 0px 4px 12px -8px rgba(0,0,0,0.45);
      -moz-box-shadow: 0px 4px 12px -8px rgba(0,0,0,0.45);
      box-shadow: 0px 4px 12px -8px rgba(0,0,0,0.45);
    }
    span b{
      text-transform: none;
    }
    .card-header span{
      margin-top: -10px;
      display: block;
    }
    .card-body{
      padding: 10px;
    }
    .card-body span{
      margin: 0px auto;
      max-width: 260px;
      display: block;
    }
    canvas{
      margin: 0 10px 0 10px;
      max-width: 250px;
      height: auto;
    }
    .health-card{
      margin: 40px 10px 0 10px;
      max-width: 250px;
      height: auto;
    }
    .health-card span{
      border-bottom: 1px solid #ddd;
      margin-bottom: 5px;
    }
    .green{
      color:green;
    }
    .big{
      font-size: 20px;
      margin-left: 15px;
    }
    .collapse li, .card-body form{
      margin-top: 5px;
    }
    .deep{
      display: inline-block;
    }
    .fullon{
      margin-top: -10px;
      width: 100%;
    }
    .fullon a{
      width: 50%;
    }
    #gis-map {
      height: 300px;
    }
    .info-window{
      max-width: 220px;
      padding: 20px;
    }
    .top{
      position: sticky;
      display: inline;
      z-index: 2000;
    }
    .red{
      color:red;
    }
    .smallest{
      font-size: 14px;
    }
    a.disabled {
       pointer-events: none;
       cursor: default;
    }
    .smalltalk{
      font-size: 12px;
      min-width: 140px;
    }
    .columnx{
      width: 180px;
        padding-left: 55px;
    }
    .sm{
      float: right;
      margin: 10px;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css"/>

    <link rel="stylesheet" href="style/daterangepicker.min.css">
  </head>
  <body  ng-app='myapp' onload = "loadMap()">
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay-md-down bmd-drawer-in-lg-up">
      <header class="bmd-layout-header">
        <div class="navbar navbar-light bg-faded">
          <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="drawer" data-target="#my-drawer">
            <span class="sr-only">Toggle drawer</span>
            <i class="material-icons">menu</i>
          </button>
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down">
              <button class="btn bmd-btn-icon" title="Drawer force close" id="drawer-visibility">
                <i class="material-icons">chevron_left</i>
              </button>
            </li>
            <li class="nav-item">
              <?php echo strtoupper($title); ?>
            </li>
          </ul>
          <ul class="nav navbar-nav pull-xs-right">
            <li class="nav-item">
              <i class="material-icons">account_circle</i>
            <button class="btn">
              <div class="margin_top"><?php echo htmlspecialchars(strtoupper($_SESSION['username']), ENT_QUOTES); ?></div>
            </button>
            </li>
            <li class="nav-item">
              <div class="bmd-form-group bmd-collapse-inline pull-xs-right">
                <button class="btn bmd-btn-icon" for="search" data-toggle="collapse" data-target="#collapse-search" aria-controls="collapse-search">
                  <i class="material-icons">search</i>
                </button>
                <span id="collapse-search" class="collapse">
                  <input class="form-control" type="text" id="search" placeholder="Enter your query...">
                </span>
              </div>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <button class="btn bmd-btn-icon btn-secondary dropdown-toggle" type="button" id="more-menu" data-toggle="dropdown" aria-haspopup="true" >
                  <i class="material-icons">more_vert</i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more-menu">
                  <button class="dropdown-item" type="button">
                    <i class="material-icons">settings</i>
                        <span>SETTINGS</span>
                  </button>
                  <button onclick="window.location.href='logout.php'" class="dropdown-item" type="button"><i class="material-icons">power_settings_new</i><span>LOGOUT</span></button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </header>
      <!--  main page -->
      <div id="my-drawer" class="bmd-layout-drawer">
        <header>
          <img src="img/logo.png" class="uti_logo">
        </header>
        <ul class="list-group">
          <span class="bb"></span>
          <a href="dashboard.php" class="list-group-item ">
            <i class="material-icons ">dashboard</i>
            <span>DASHBOARD</span>
          </a>
          <a href="analyse.php" class="list-group-item">
            <i class="material-icons">timeline</i>
            <span>ANALYSE</span>
          </a>
          <a href="configure.php" class="list-group-item">
            <i class="material-icons">build</i>
            <span>CONFIGURE</span>
          </a>
          <a href="events.php" class="list-group-item ">
            <i class="material-icons ">today</i>
            <span>EVENTS</span>
          </a>
          <a href="reports.php" class="list-group-item active">
            <i class="material-icons white">assignment</i>
            <span>REPORTS</span>
          </a>
                    <a href="commission.php" class="list-group-item ">
            <i class="material-icons ">edit</i>
            <span>COMMISSION</span>
          </a>
          <br>
        </ul>
      </div>
      <!--  Main page starts -->
      <main class="bmd-layout-content">
        <div class="container-o">
          <div class="row paddedyt">
            <div class="col-sm-3" >
              <div class="card card-block" style="width: 16rem;min-height:720px;">
                <form  class="form-inline" action="model/analyse.php" method="post">
                  <ul class="list-group">
                    <li>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="filter" id="selectall" class="second" onclick="displayMarkers(this,0);"> PDPU, RAISAN<i class="material-icons big pull-right" data-toggle="collapse" data-target="#demo">expand_more</i>
                        </label>
                      </div>
                    </li>
                    <li id="demo" class="collapse">
                      <ul class="list-group">
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number" value="3015" class="second" onclick="displayMarkers(this,1);"> 3015
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number" value="3016" class="second" onclick="displayMarkers(this,2);"> 3016
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number" value="3017" class="second" onclick="displayMarkers(this,3);"> 3017
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number" value="3018" class="second" onclick="displayMarkers(this,4);"> 3018
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number" value="3019" class="second" onclick="displayMarkers(this,5);"> 3019
                            </label>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
              </div>
          </div>

          <div class="col-sm-9">
            <div class="card card-block col-sm-12">
              <div class="row">
                <div class="col-md-6">
                  <h6>DATA RANGE</h6>
                    <!-- <input type="text"id="date" style="min-width:250px;" class="btn btn-raised btn-warning" name="dateranged" value="Feb 21 2018 - Feb 22 2018"/> -->
                    <input class="form-control" type="text" id="date-range21" name="dateranged">
                </div>
                <div class="col-md-6">
                  <h6>PARAMETERS</h6>
                  <select class="form-control" name="parameters" style="min-width:18rem;" id="paraments">
                    <option value="">Choose Parameter</option>
                    <option value="voltage_v">VOLTAGE (LN)</option>
                  	<option value="current_a">CURRENT</option>
                  	<option value="frequency_hz">FREQUENCY</option>
                  	<option value="pf">POWER FACTOR</option>
                  	<option value="kvar">KVAR</option>
                  	<option value="KVA">KVA</option>
                  	<option value="kvar_rphase">KVA (R PHASE)</option>
                  	<option value="kvar_yphase">KVA (Y PAHSE)</option>
                  	<option value="kvar_bphase">KVA (B PAHSE)</option>
                  	<option value="voltage_ll_v">VOLTAGE (LL)</option>
                  	<option value="kvah">kVAh</option>
                  	<option value="kw_rphase">kW (R PHASE)</option>
                  	<option value="kw_yphase">kW (Y PHASE)</option>
                  	<option value="kw_bphase">kW (B PHASE)</option>
                  	<option value="voltage_thd_rphase">VOLTAGE THD (R PHASE)</option>
                  	<option value="voltage_thd_yphase">VOLTAGE THD (Y PHASE)</option>
                  	<option value="voltage_thd_bphase">VOLTAGE THD (B PHASE)</option>
                  	<option value="voltage_thd">VOLTAGE THD</option>
                  	<option value="current_thd">CURRENT THD</option>
                  </select>
                      <!-- changed grid here -->
                    <!-- <button style="margin-left:40px;" type="submit" name="submit"  class="btn btn-raised btn-warning" >Analyse</button> -->
                    <!-- <button type="reset" class="btn btn-raised btn-secondary">Reset</button> -->
                    </div>
                    <div class="col-sm-12">
                      <br>
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Enter Email ID..">
                      <br>
                      <br>
                      <h6>INTERVAL</h6>
                      <div class="form-group sm">
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            1 hour
                          </label>
                        </div>
                      </div>
                      <div class="form-group sm">
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            45 mins
                          </label>
                        </div>
                      </div>
                        <div class="form-group sm">
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            30 mins
                          </label>
                        </div>
                      </div>
                        <div class="form-group sm">
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            15 mins
                          </label>
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                    <hr>
                    <br>
                    <h6>FORMAT</h6>
                    <div class="form-group sm">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios1" id="optionsRadios5" value="option1" checked>
                          CSV
                        </label>
                      </div>
                    </div>
                    <div class="form-group sm">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios1" id="optionsRadios6" value="option1" checked>
                          PDF
                        </label>
                      </div>
                    </div>
                    </div>
              </div>
              <div class="row" style="padding-left:20px;">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-raised btn-warning">SEND MAIL</button>
                  <button type="button" class="btn btn-primary">DOWNLOAD</button>
                  <button type="button" class="btn btn-secondary">RESET</button>
                </div>
              </div>
              </form>
            </div>
            <div style="padding:20px;">

            </div>
            <!-- <div class="card card-block col-sm-12" style="min-height:600px;">
              <h4 style="text-align:center;margin-top:120px;color:#808080;">Please select a meter to analyse</h4>
            </div> -->
          </div>
          <button type="button" id="osx" class="btn btn-secondary" data-toggle="snackbar" data-style="toast" data-content="Analyse consumption meter wise." ></button>

          </div>
        </div>
      </main>
      <!--  main page ends -->
    </div>

      <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
      <script src="https://cdn.rawgit.com/HubSpot/tether/v1.3.4/dist/js/tether.min.js"></script>
      <script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
      <script src="http://rosskevin.github.io/bootstrap-material-design/dist/bootstrap-material-design.iife.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>
      <script>
        $(function() {
          $('body').bootstrapMaterialDesign();
        })
      </script>
      <script src="js/example.js"></script>
      <script type="text/javascript">
              Chart.defaults.global.legend.display = false;
              var ctx = document.getElementById('consumption').getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: ['1/2', '2/2', '3/2', '4/2', '5/2', '6/2', '7/2'],
                  datasets: [{
                    label: '',
                    data: [12, 19, 3, 17, 6, 3, 7],
                    backgroundColor: "rgba(153,255,51,0.4)"
                  }]
                },    options: {
               legend: {
                  display: false
               },
               tooltips: {
                  enabled: true
               },scales: {
              yAxes: [{
                  ticks: {
                      display: false
                  }
              }],          xAxes: [{
                  display: false
                }]
          }
          }
      });
      </script>
      <script type="text/javascript">
              Chart.defaults.global.legend.display = false;
              var ctx = document.getElementById('demand').getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: ['1/2', '2/2', '3/2', '4/2', '5/2', '6/2', '7/2','1/2', '2/2', '3/2', '4/2', '5/2', '6/2', '7/2'],
                  datasets: [{
                    label: '',
                    data: [12, 19, 3, 17, 6, 3, 7,12, 19, 3, 17, 6, 3, 7],
                    backgroundColor: "rgba(234,211,51,0.4)"
                  }]
                },    options: {
               legend: {
                  display: false
               },
               tooltips: {
                  enabled: true
               },scales: {
              yAxes: [{
                  ticks: {
                      display: false
                  }
              }],          xAxes: [{
                  display: false
                }]
          }
          }
      });

      </script>
      <script type="text/javascript">
      $(document).ready(function(){
      	// below code is used to remove all check property if,
          // user select/unselect options with class first options.
      	$(".first").click(function(){
      		$("#checkAll").attr("data-type","uncheck");
      	});

      	// below code is used to remove all check property if,
          // user select/unselect options with name=option2 options.
      	$("input[name=option2]").click(function(){
      		$("#selectall").prop("checked", false);
      	});

      	/////////////////////////////////////////////////////////////
      	//       js for Check/Uncheck all CheckBoxes by Button     //
      	/////////////////////////////////////////////////////////////

      	$("#checkAll").attr("data-type","check");
      	$("#checkAll").click(function(){
      		if($("#checkAll").attr("data-type")==="check")
                {
                  $(".first").prop("checked",true);
      			$("#checkAll").attr("data-type","uncheck");
                }
              else
                {
                  $(".first").prop("checked",false);
      		    $("#checkAll").attr("data-type","check");
                }
      	})

      	/////////////////////////////////////////////////////////////
      	//     js for Check/Uncheck all CheckBoxes by Checkbox     //
      	/////////////////////////////////////////////////////////////

      	$("#selectall").click(function(){
      		$(".second").prop("checked",$("#selectall").prop("checked"))
      	})

      });
      </script>
      <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmUfKutqGZ-VgbD4fwjOFd1EGxLXbxcpQ&sCensor=false"></script> -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmUfKutqGZ-VgbD4fwjOFd1EGxLXbxcpQ&sCensor=false"></script>
      <!-- <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script> -->
      <script type="text/javascript">




      </script>


      <script type="text/javascript">

      var locations = [
        // ["<span ng-repeat='incoming_parameter in incoming_parameters'><i class='material-icons smallest'>home</i> C BLOCK<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3015 <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> CD: 250 kW</span>",23.154237, 72.666674,1],

        ["<i class='material-icons smallest'>home</i> C BLOCK<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3015 <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.154237, 72.666674,1],
        ["<i class='material-icons smallest'>home</i> E BLOCK<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3016 <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 8 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.155948, 72.664800,2],
        ["<i class='material-icons smallest'>home</i> 1 MW POWER PLANT<br><i class='material-icons red smallest'>fiber_smart_record</i> METER NO: 3017  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 6 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.153564, 72.669027,3],
        ["<i class='material-icons smallest'>home</i> UG HOSTEL<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3018  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 10 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.158817, 72.664912,4],
        ["<i class='material-icons smallest'>home</i> HIGH RISE HOSTEL<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3019  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 15 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.157121, 72.670273,5],
        ["<i class='material-icons smallest'>home</i> C BLOCK<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3015  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.154237, 72.666674,0],
        ["<i class='material-icons smallest'>home</i> E BLOCK<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3016  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 8 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.155948, 72.664800,0],
        ["<i class='material-icons smallest'>home</i> 1 MW POWER PLANT<br><i class='material-icons red smallest'>fiber_smart_record</i> METER NO: 3017  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 6 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.153564, 72.669027,0],
        ["<i class='material-icons smallest'>home</i> UG HOSTEL<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3018  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 10 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.158817, 72.664912,0],
        ["<i class='material-icons smallest'>home</i> HIGH RISE HOSTEL<br><i class='material-icons green smallest'>fiber_smart_record</i> METER NO: 3019  <br> <i class='material-icons smallest'>access_time</i> RUNNING HRS: 15 hrs <i class='material-icons smallest'>info</i> CD: 250 kW",23.157121, 72.670273,0]
        ];

      var map = new google.maps.Map(document.getElementById('gis-map'), {
         zoom: 14,
         center: new google.maps.LatLng(23.154981, 72.666964),
         mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var markers = [];

      var i, newMarker;

      for (i = 0; i < locations.length; i++) {
        newMarker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        title: locations[i][0]

      });

      newMarker.category = locations[i][3];
      newMarker.setVisible(true);

      markers.push(newMarker);
      newMarker['infowindow'] = new google.maps.InfoWindow({
            content: locations[i][0]
        });

        google.maps.event.addListener(newMarker, 'mouseover', function() {
        // google.maps.event.addListener(newMarker, 'click', function() {
        this['infowindow'].open(map, this);
        });

        // markerMap.addListener('mouseout', function() {
        //     infowindow.close();
        // });
        google.maps.event.addListener(newMarker, 'mouseout', function() {
        // google.maps.event.addListener(newMarker, 'click', function() {
        this['infowindow'].close(map, this);
        });


      }


       function displayMarkers(obj,category) {
           var i;

           for(i = 0; i < markers.length; i++)
           {

                   if (markers[i].category === category) {
                       if ($(obj).is(":checked")) {

                           markers[i].setVisible(true);
                       } else {
                           markers[i].setVisible(false);
                       }
                   }
                   else
                   {
                       markers[i].setVisible(false);
                   }
               }


       }


      </script>
  <script>
     var fetch = angular.module('myapp', []);

     fetch.controller('userCtrl', ['$scope', '$http', function ($scope, $http) {
      $http({
       method: 'get',
       url: 'getTableData.php'
      }).then(function successCallback(response) {
       // Store response data
       $scope.incoming_parameters = response.data;
      });
     }]);

     </script>


     	<script src="https://colorlib.com/etc/tb/Table_Fixed_Column/js/main.js"></script>
      <script type="text/javascript" src="js/moment.js"></script>
      <script type="text/javascript" src="js/jquery.daterangepicker.min.js"></script>
      <script type="text/javascript">
      $('#date-range1-1').dateRangePicker(
      {
        startOfWeek: 'monday',
        separator : ' ~ ',
        format: 'DD.MM.YYYY HH:mm',
        autoClose: false,
        time: {
          enabled: true
        },
        defaultTime: moment().startOf('day').toDate(),
        defaultEndTime: moment().endOf('day').toDate()
      });


      </script>
      <script type="text/javascript">
      $('#date-range21').dateRangePicker(
      {
        hoveringTooltip: function(days)
        {
          var D = ['','<span style="white-space:nowrap;">Please select another date</span>','Two', 'Three','Four','Five'];
          return D[days] ? D[days] : days+' days';
        }
      });
      </script>
  </body>
</html>
