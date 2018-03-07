<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
$title = 'Configure';
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
    <script type="text/javascript">
      $(document).ready(function(){
          $("select").change(function(){
              $(this).find("option:selected").each(function(){
                  var optionValue = $(this).attr("value");
                  if(optionValue){
                      $(".box").not("." + optionValue).hide();
                      $("." + optionValue).show();
                  } else{
                      $(".box").hide();
                  }
              });
          }).change();
      });
</script>
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css"/>

<link rel="stylesheet" href="style/daterangepicker.min.css">

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
          <a href="dashboard.php" class="list-group-item ">
            <i class="material-icons ">dashboard</i>
            <span>DASHBOARD</span>
          </a>
          <a href="analyse.php" class="list-group-item">
            <i class="material-icons">timeline</i>
            <span>ANALYSE</span>
          </a>
          <a href="configure.php" class="list-group-item active">
            <i class="material-icons white">build</i>
            <span>CONFIGURE</span>
          </a>
                    <a href="events.php" class="list-group-item ">
            <i class="material-icons ">today</i>
            <span>EVENTS</span>
          </a>
                    <a href="reports.php" class="list-group-item ">
            <i class="material-icons">assignment</i>
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
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <form action="" method="post">
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
                              <input type="checkbox" name="meter_serial_number[]" value="3015" class="second" onclick="displayMarkers(this,1);"> 3015
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number[]" value="3016" class="second" onclick="displayMarkers(this,2);"> 3016
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number[]" value="3017" class="second" onclick="displayMarkers(this,3);"> 3017
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number[]" value="3018" class="second" onclick="displayMarkers(this,4);"> 3018
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="meter_serial_number[]" value="3019" class="second" onclick="displayMarkers(this,5);"> 3019
                            </label>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>

              </div>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="card">
              <div class="" id="gis-map">
                  <div id="map"></div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <!-- <i class="material-icons">cached</i> -->
                <h1 for="exampleSelect1" style="font-size:21px;margin-bottom:0px;margin-left:15px;"class="bmd-label-floating">MODE</h1>
                <div class="form-group col-sm-3">

                  <i class="material-icons" style="display:inline; max-width:20px; float:right;margin-top:10px;">keyboard_arrow_down</i>
                    <select class="form-control" style="display:inline;max-width:120px;" id="exampleSelect1">
                      <!-- <label for="exampleSelect1" class="bmd-label-floating">MODE</label> -->
                      <option>CHOOSE</option>
                      <option value="redy">STANDARD</option>
                      <option value="greeny">SCHEDULE</option>
                    </select>
                  </div>
                  <div class="redy box">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-inline">
                          <div class="form-group col-sm-4">
                            <label for="datetimepicker" style="margin-left:15px;">START DATE  &  START TIME</label>
                            <input class="form-control" type="text" value="<?php echo date("d/m/Y H:i");?>" id="datetimepicker"/><br><br>

                          </div>
                          <div class="form-group col-sm-4">
                            <label for="datetimepicker2" style="margin-left:15px;">END DATE  &  END TIME</label>
                            <input class="form-control" type="text" value="<?php $date = new DateTime('+1 day');echo $date->format('d/m/Y H:i');?>" id="datetimepicker2"/><br><br>
                          </div>
                          <span class="form-group "> <!-- needed to match padding for floating labels -->
                            <button type="reset" class="btn btn-warning">RESET</button>
                            <button type="submit" id="submit" class="btn btn-raised btn-warning">CONFIGURE</button>
                          </span>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="greeny box">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-inline">
                          <div class="form-group col-sm-4" >
                            <label for="datetimepicker" style="margin-left:15px;">START DATE  &  END DATE</label>
                            <input class="form-control" type="text" value="<?php echo date("d/m/Y"); echo "-"; $date = new DateTime('+1 day');echo $date->format('d/m/Y');?>" size="28" id="date-range21"/><br><br>

                          </div>
                          <div class="form-group col-sm-2">
                            <label for="datetimepicker2" style="margin-left:15px;">START TIME </label>
                            <input class="form-control" type="text" size="10" value="<?php echo date("H:i");?>" id="datetimepicker1"/><br><br>
                          </div>
                          <div class="form-group col-sm-2">
                            <label for="datetimepicker2" style="margin-left:15px;">END TIME </label>
                            <input class="form-control" type="text" size="10" value="<?php $date = new DateTime('+30 minutes');echo $date->format('H:i');?>" id="datetimepicker11"/><br><br>
                          </div>
                          <span class="form-group "> <!-- needed to match padding for floating labels -->
                            <button type="reset" class="btn btn-warning">RESET</button>
                            <button type="submit" id="submit2" class="btn btn-raised btn-warning">CONFIGURE</button>
                          </span>
                        </div>
                      </div>
                    </div>

                  </div>
                </form>
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
              // echo '["<i ';
              // echo "class='material-icons smallest'>";
              // echo "home</i> ".$row_meter['location_name']."<br><i class='material-icons green smallest'>";
              // echo "fiber_smart_record</i> METER NO: ".$row_meter['meter_serial_number']." <br> <i class='material-icons smallest'>access_time</i>";
              // echo "RUNNING HRS: 12 hrs <i class='material-icons smallest'>info</i> ";
              // echo 'CD: '.$row_meter['contract_demand'].'",'.$row_meter['meter_location'].',0],';

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
      <!-- <script src="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.js"></script> -->
      <script src="https://www.jqueryscript.net/demo/Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker();
$('#datetimepicker').datetimepicker({value:'<?php echo date("d/m/Y H:i");?>'});
$('#datetimepicker1').datetimepicker({
  datepicker:false,
  format:'H:i',
  step:5
});
$('#datetimepicker2').datetimepicker();
$('#datetimepicker2').datetimepicker({value:'<?php $date = new DateTime('+1 day');echo $date->format('d/m/Y H:i');?>'});
$('#datetimepicker11').datetimepicker({
  datepicker:false,
  format:'H:i',
  step:5
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00']
});
</script>
<script type="text/javascript">
$("#submit").on("click",function(){
    if (($("input[type='checkbox']:checked").length)<=0) {
        alert("You must check atleast 1 Meter in order to Configurre");
        return false;
    }
    return true;
});
$("#submit2").on("click",function(){
    if (($("input[type='checkbox']:checked").length)<=0) {
        alert("You must check atleast 1 Meter in order to Configurre");
        return false;
    }
    return true;
});
</script>
  </body>
</html>
