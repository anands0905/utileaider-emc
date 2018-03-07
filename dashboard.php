<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
$title = 'Dashboard';
include 'models/make-handshake.php';

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
      margin-top: -25px;
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
    code{
      background-color: #fff;
      color:#000;
    }
    </style>
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
          <a href="dashboard.php" class="list-group-item active">
            <i class="material-icons white">dashboard</i>
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
          <a href="reports.php" class="list-group-item ">
            <i class="material-icons ">assignment</i>
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
          <div class="row">
            <div class="col-sm">
              <div class="card" style="min-height:180px;max-height:200px;">
                <div class="card-header">
                  <span>Consumption <b class="pull-right">360 kWh</b></span>
                </div>
                <div class="card-body">
                    <canvas id="consumption"></canvas>
                    <span style="color:#000;">Live: 700 kWh <b class="pull-right" >&#x20b9; 5300/-</b></span>
                </div>
            </div>
            </div>
            <div class="col-sm">
              <div class="card" style="min-height:180px;max-height:200px;">
                <div class="card-header">
                  <span>demand<b class="pull-right">1 kW</b></span>
                </div>
                <div class="card-body">
                  <canvas id="demand"></canvas>
                  <span style="color:#000;">Live: 1 kW</span>
                </div>
            </div>
            </div>
            <div class="col-sm">
              <div class="card" style="min-height:180px;max-height:200px;">
                <div class="card-header">
                  <span>health<b class="pull-right">2 Meters</b></span>
                </div>
                <div class="card-body">
                  <div class="health-card">
                    <span><i class="material-icons green">signal_cellular_4_bar</i> <b class="pull-right">1 HEALTHY</b></span>
                    <span><i class="material-icons red">signal_cellular_off</i> <b class="pull-right">1 UNHEALTHY</b></span>
                  </div>
                  <span style="display:block;margin-top:20px; color:#000;">Healthy: 1 <b class="pull-right" >Unhealthy: 1</b></span>
                </div>
            </div>
            </div>
            <div class="col-sm">
              <div class="card" style="min-height:180px;max-height:200px;">
                <div class="card-header xd">
                  <span>weather<b class="pull-right">Gandhinagar</b></span>
                </div>
                <div class="card-body">
                  <a class="disabled weatherwidget-io" href="https://forecast7.com/en/23d2272d64/gandhinagar/" data-font="Roboto Slab" data-icons="Climacons Animated" data-mode="Current" data-days="5" data-theme="pure" >Gandhinagar, Gujarat, India</a>
                  <script>
                  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                  </script>
                  <span style="display:block;margin-top:28px; ">
                    <span class="dateTimeClock" >
                    <?php
                    echo "<code class='pull-right'>".date("d M Y")."</code> ";
                    ?>
                    <code id="demo2"></code>
                    </span>
                  </span>
                </div>
            </div>
            </div>
          </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <form action="" method="post">
                  <ul class="list-group">
                    <li>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="filter" id="selectall" class="first" onclick="displayMarkers(this,0);"> PDPU, RAISAN<i class="material-icons big pull-right" data-toggle="collapse" data-target="#demo">expand_more</i>
                        </label>
                      </div>
                    </li>
                    <li id="demo" class="collapse">
                      <ul class="list-group">
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectone" type="checkbox" name="meter_serial_number[]" value="3015" class="second" onclick="displayMarkers(this,1);"> 3015
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selecttwo" type="checkbox" name="meter_serial_number[]" value="3016" class="second" onclick="displayMarkers(this,2);"> 3016
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectthree" type="checkbox" name="meter_serial_number[]" value="3017" class="second" onclick="displayMarkers(this,3);"> 3017
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectfour" type="checkbox" name="meter_serial_number[]" value="3018" class="second" onclick="displayMarkers(this,4);"> 3018
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectfive" type="checkbox" name="meter_serial_number[]" value="3019" class="second" onclick="displayMarkers(this,5);"> 3019
                            </label>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="card">
                <ul class="top nav nav-tabs" style="display:block;" role="tablist">
                  <li class="nav-item sm">
                    <a class="btn btn-raised btn-warning " data-toggle="tab" href="#gis-map" role="tab">MAP VIEW</a>
                  </li>
                  <li class="nav-item sm">
                    <a class="btn btn-raised btn-warning" data-toggle="tab" href="#table" role="tab">TABLE VIEW</a>
                  </li>
                </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="gis-map">
                  <div id="map">
                </div>
              </div>
              <div class="tab-pane fade" id="table">
                <div ng-controller="userCtrl">



                		<div class="">
                			<div class="wrap-table100">
                				<div class="table100 ver1">
                					<div class="table100-firstcol">
                						<table>
                							<thead>
                								<tr class="row100 head">
                									<th class="cell100 column1">METERS</th>
                								</tr>
                							</thead>
                							<tbody ng-repeat="incoming_parameter in incoming_parameters">
                                <tr class="row100 body">
                                  <th class="cell100 column1">{{incoming_parameter.meter_serial_number}}</th>
                                </tr>
                							</tbody>
                						</table>
                					</div>

                					<div class="wrap-table100-nextcols js-pscroll">
                						<div class="table100-nextcols">
                							<table>
                								<thead>
                									<tr class="row100 head" >
                                    <th class="cell100 columnx">RTC</th>
                										<th class="cell100 column2 column0">I<sub>PH</sub></th>
                										<th class="cell100 column3 column0">V<sub>PH</sub></th>
                										<th class="cell100 column4 column0">kW</th>
                										<th class="cell100 column3 column0">PF</th>
                										<th class="cell100 column6 column0">Hz</th>
                										<th class="cell100 column7 column0">kWh</th>
                										<th class="cell100 column8 column0">kVAh</th>
                                    <th class="cell100 column8 column0">STATUS</th>
                                    <th class="cell100 column8 column0">MORE</th>
                									</tr>
                								</thead>
                								<tbody>
                									<tr class="row100 body" ng-repeat="incoming_parameter in incoming_parameters">
                                    <td class="cell100 columnx" ><span class="smalltalk">{{incoming_parameter.rtc}}</span></td>
                										<td class="cell100 column2 column0">{{incoming_parameter.current_a}}</td>
                										<td class="cell100 column3 column0">{{incoming_parameter.voltage_v}}</td>
                										<td class="cell100 column4 column0">{{incoming_parameter.kw}}</td>
                										<td class="cell100 column3 column0">{{incoming_parameter.pf}}</td>
                										<td class="cell100 column6 column0">{{incoming_parameter.frequency_hz}}</td>
                										<td class="cell100 column7 column0">{{incoming_parameter.cumulative_active_energy_kwh}}</td>
                                    <td class="cell100 column8 column0">{{incoming_parameter.apparent_energy_kvah}}</td>
                                    <td class="cell100 column8 column0"><a href="#"><i class="fa fa-circle" style="color:green;" aria-hidden="true"></i></a></td>
                										<td class="cell100 column8 column0"><a href="#id={{ incoming_parameter.incoming_id }}"><i class="fa fa-search-plus" style="color:#ff4d2d;" aria-hidden="true"></i></a></td>
                									</tr>



                								</tbody>
                							</table>
                						</div>
                					</div>
                				</div>
                			</div>
                		</div>




                </div>
              </div>
            </div>
            </div>
          </div>
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
                  labels: ['01-02-18', '02-02-18', '03-02-18', '04-02-18', '05-02-18', '06-02-18', '07-02-18'],
                  datasets: [{
                    label: 'kWh ',
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
                  labels: ['01-02-18', '02-02-18', '03-02-18', '04-02-18', '05-02-18', '06-02-18', '07-02-18'],
                  datasets: [{
                    label: 'kW',
                    data: [18, 13, 11, 15, 16, 19, 17],
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

        $("#selectone").click(function(){
          $(".first").prop("checked",$("#selectone").prop("checked"))
        })
        $("#selecttwo").click(function(){
          $(".first").prop("checked",$("#selecttwo").prop("checked"))
        })
        $("#selectthree").click(function(){
          $(".first").prop("checked",$("#selectthree").prop("checked"))
        })
        $("#selectfour").click(function(){
          $(".first").prop("checked",$("#selectfour").prop("checked"))
        })
        $("#selectfive").click(function(){
          $(".first").prop("checked",$("#selectfive").prop("checked"))
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
        <?php
        // Create connection
        $conn = mysqli_connect($host, $uname, $pass, $db);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql_meter = "SELECT * FROM `meters`";
        $result_meter = mysqli_query($conn, $sql_meter);

        if (mysqli_num_rows($result_meter) > 0) {
            // output data of each row
            while($row_meter = mysqli_fetch_assoc($result_meter)) {

              echo '["<i ';
              echo "class='material-icons smallest'>";
              echo "home</i> ".$row_meter['location_name']."<br><i class='material-icons green smallest'>";
              echo "fiber_smart_record</i> METER NO: ".$row_meter['meter_serial_number']." <br> <i class='material-icons smallest'>access_time</i>";
              echo "RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> ";
              echo 'CD: '.$row_meter['contract_demand'].'",'.$row_meter['meter_location'].','.$row_meter['tree_view_number'].'],';

              echo '["<i ';
              echo "class='material-icons smallest'>";
              echo "home</i> ".$row_meter['location_name']."<br><i class='material-icons green smallest'>";
              echo "fiber_smart_record</i> METER NO: ".$row_meter['meter_serial_number']." <br> <i class='material-icons smallest'>access_time</i>";
              echo "RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> ";
              echo 'CD: '.$row_meter['contract_demand'].'",'.$row_meter['meter_location'].','.$row_meter['all_tree'].'],';
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
        ?>

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
     <script type="text/javascript">
     var myVar = setInterval(function(){myTimer()},1000);
     function myTimer() {
         var d = new Date();
         document.getElementById("demo2").innerHTML = d.toLocaleTimeString();
     }
     </script>

     	<script src="https://colorlib.com/etc/tb/Table_Fixed_Column/js/main.js"></script>
  </body>
</html>
