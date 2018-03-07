<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
$title = 'Commission';
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

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
    input[type="search"]{
      border: none;
      border-bottom: 1px solid orange;
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

          <a href="reports.php" class="list-group-item ">
            <i class="material-icons ">today</i>
            <span>REPORTS</span>
          </a>
          <a href="commission.php" class="list-group-item active">
            <i class="material-icons white">edit</i>
            <span>COMMISSION</span>
          </a>
          <br>
        </ul>
      </div>
      <!--  Main page starts -->
      <main class="bmd-layout-content">
        <div class="container-o">
          <div class="row ">
            <div class="col-sm-4">
              <div class="card card-block" style="width: 100%;height: 8rem;">
                <div class="mar">
                  COMMISSIONED METERS
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card-block" style="width: 100%;height: 8rem;">
                <div class="mar">
                  NEW METERS
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card-block" style="width:100%;height: 8rem;">
                <div class="mar">
                  DISAPPROVED METERS
                </div>
              </div>
            </div>
          </div>
          <div class="row paddedyt">
          <div class="col-sm-12">
            <div class="card card-block col-sm-12">
              <div id="gis-map"></div>
              <br>
          <br>
          <div class="table-responsive spaced">
          <table id="example4" class="bordered">
          	<thead>
          		<tr>
          			<th>
          				DATE
          			</th>
          			<th>
          				METER ID
          			</th>
          			<th>
          				COMMISSIONER ID
          			</th>
          			<th>
          				SUMMARY
          			</th>
          			<th>
          				EDIT
          			</th>
          			<th>
          				ACTION
          			</th>
          		</tr>
          	</thead>
          	<tbody>
          		<tr>
          			<td>
          				31 JAN 2018
          			</td>
          			<td>
          				3018
          			</td>
          			<td>
          				PDPU_12
          			</td>
          			<td>
          				Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          			<td>
          				<a href="#"><i class="fa fa-1x fa-pencil" aria-hidden="true" style="color:green"></i></a>
          			</td>
          			<td>
          				<a href="#"><i class="fa fa-1x fa-times-circle" aria-hidden="true" ></i></a>
          				<a href="#"><i class="fa fa-1x fa-check-circle" aria-hidden="true"></i></a>
          			</td>
          		</tr>
          	</tbody>
          </table>
          </div>
            </div>
          </div>
          <button type="button" id="osx" class="btn btn-secondary" data-toggle="snackbar" data-style="toast" data-content="Welcome NEERAJ , Check and approve commisioned meters." ></button>
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
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
      </script>
      <script type="text/javascript">
      $(document).ready(function() {
          $('#example2').dataTable( {
             "iDisplayLength": 5,
          "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

             } );
           } );
      </script>
      <script type="text/javascript">
      $(document).ready(function() {
          $('#example3').dataTable( {
             "iDisplayLength": 5,
          "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

             } );
           } );
      </script>
      <script type="text/javascript">
      $(document).ready(function() {
          $('#example4').dataTable( {
             "iDisplayLength": 5,
          "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]

             } );
           } );
      </script>
  </body>
</html>
