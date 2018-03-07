<?php require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
$title = 'Analyse';
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
    <!-- Load c3.css -->
    <link href="style/c3.css" rel="stylesheet">
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
    /* canvas{
      margin: 0 10px 0 10px;
      max-width: 250px;
      height: auto;
    } */
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
    .form-margin{
      margin: 0px auto;
      margin-left: 60px;
      /* max-width: 620px; */
    }
    .label{
      padding-top: 10px;
      margin-bottom: 10px;
      margin-left: 40px;
      display: block;
    }
    .label::before{
      content: "PARAMETER: "
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
          <a href="dashboard.php" class="list-group-item">
            <i class="material-icons ">dashboard</i>
            <span>DASHBOARD</span>
          </a>
          <a href="analyse.php" class="list-group-item active">
            <i class="material-icons white">timeline</i>
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
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <form name="form1" action="models/analyse.php" method="post" ng-required>
                  <input type="hidden" name="ss" value="<?php echo $_GET['meter_serial_number'];?>">
                  <ul class="list-group">
                    <li>
                      <div class="checkbox">
                        <label>

                          <input type="checkbox" name="filter" id="selectall" class="first" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> PDPU, RAISAN<i class="material-icons big pull-right" data-toggle="collapse" data-target="#demo">expand_more</i>
                          <!-- <input type="checkbox" name="filter"  class="second" > PDPU, RAISAN<i class="material-icons big pull-right" data-toggle="collapse" data-target="#demo">expand_more</i> -->
                        </label>
                      </div>
                    </li>
                    <li id="demo" class="collapse">
                      <ul class="list-group">
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectone" type="checkbox" name="meter_serial_number[]" value="3015" class="second" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> 3015
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selecttwo" type="checkbox" name="meter_serial_number[]" value="3016" class="second" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> 3016
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectthree" type="checkbox" name="meter_serial_number[]" value="3017" class="second" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> 3017
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectfour" type="checkbox" name="meter_serial_number[]" value="3018" class="second" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> 3018
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              <input id="selectfive" type="checkbox" name="meter_serial_number[]" value="3019" class="second" <?php if (!empty($_GET['meter_serial_number'])) echo "checked='checked'"; ?>> 3019
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
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->
                  <div class="form-inline form-margin">
                      <div class="form-group">
                        <label for="date-range21" class="bmd-label-floating">Date</label>
                        <br>
                        <input type="text" class="form-control" id="date-range21" size="25" value="" name="dateranged">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail2" class="bmd-label-floating">&nbsp;</label>
                        <br>
                        <select class="form-control" name="parameters" style="min-width:12rem;" id="paraments">
                          <option value="">Choose Parameter</option>
                          <?php
                          // Create connection
                          $conn = mysqli_connect($host, $uname, $pass, $db);
                          // Check connection
                          if (!$conn) {
                              die("Connection failed: " . mysqli_connect_error());
                          }

                          $sql = "SELECT * FROM `parameters`";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                              // output data of each row
                              while($row = mysqli_fetch_assoc($result)) {
                                  // echo "<option name='" . $row["event_parameters_name"]. "'>" . strtoupper($row["event_parameters_name"]). " </option";
                                  // $output_parameter = str_replace('_','', $row[parameter_name]);
                                  // $upper_string = strtoupper($output_parameter);
                                  echo '<option value="'.$row['parameter_name'].'">'.$row['generic_name'].'</option>';
                              }
                          } else {
                              echo "0 results";
                          }

                          mysqli_close($conn);
                          ?>
                          <!-- <option value="voltage_v">VOLTAGE (LN)</option>
                          <option value="current_a">CURRENT</option>
                          <option value="frequency_hz">FREQUENCY</option>
                          <option value="pf">POWER FACTOR</option>
                          <option value="kvar">KVAR</option>
                          <option value="kva">KVA</option>
                          <option value="kvar_rphase">KVA (R PHASE)</option>
                          <option value="kvar_yphase">KVA (Y PAHSE)</option>
                          <option value="kvar_bphase">KVA (B PAHSE)</option>
                          <option value="voltage_ll_v">VOLTAGE (LL)</option>
                          <option value="apparent_energy_kvah">kVAh</option>
                          <option value="cumulative_active_energy_kwh">kWh</option>
                          <option value="kw_rphase">kW (R PHASE)</option>
                          <option value="kw_yphase">kW (Y PHASE)</option>
                          <option value="kw_bphase">kW (B PHASE)</option>
                          <option value="voltage_thd_rphase">VOLTAGE THD (R PHASE)</option>
                          <option value="voltage_thd_yphase">VOLTAGE THD (Y PHASE)</option>
                          <option value="voltage_thd_bphase">VOLTAGE THD (B PHASE)</option>
                          <option value="voltage_thd">VOLTAGE THD</option>
                          <option value="current_thd">CURRENT THD</option> -->
                        </select>
                      </div>

                      <span class="form-group bmd-form-group"> <!-- needed to match padding for floating labels -->
                        <button type="submit" name="submit" class="btn btn-sm btn-warning btn-raised" id="submit">ANALYSE</button>
                        <a class="btn btn-sm" href="analyse.php">reset</a>
                      </span>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <!-- <canvas id="analyse"></canvas> -->
              <div class="card">
                <span class="label"><?php $output = str_replace('_', ' ', $_GET['parameters']); echo strtoupper($output); ?></span>

                <div class="card-body">
                  <!-- <canvas id="analyse"></canvas> -->
                  <!-- <canvas id="speedChart"></canvas> -->
                  <div id="chart"></div>
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
      <!-- <script src="http://tamble.github.io/jquery-ui-daterangepicker/daterangepicker-master/jquery.comiseo.daterangepicker.js"></script>
      <script>
      $("#e1").daterangepicker({
      datepickerOptions : {
          numberOfMonths : 2
      }
      });
      </script> -->
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

     	<script src="https://colorlib.com/etc/tb/Table_Fixed_Column/js/main.js"></script>
      <script type="text/javascript" src="js/moment.js"></script>
      <script type="text/javascript" src="js/jquery.daterangepicker.min.js"></script>
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
      <script type="text/javascript">
      $("#submit").on("click",function(){
          if (($("input[type='checkbox']:checked").length)<=0) {
              alert("You must check atleast 1 Meter in order to analyse");
              return false;
          }
          return true;
      });
</script>
<script type="text/javascript" src="js/d3.v3.min.js"></script>
<script type="text/javascript" src="js/c3.js"></script>
<script type="text/javascript">

var chart = c3.generate({
    data: {
        x: 'x',
//        xFormat: '%Y%m%d', // 'xFormat' can be used as custom format of 'x'
        columns: [
            ['x', <?php
            function getDatesBetween2Dates($startTime, $endTime) {
                $day = 86400;
                $format = 'Y-m-d';
                $startTime = strtotime($startTime);
                $endTime = strtotime($endTime);
                $numDays = round(($endTime - $startTime) / $day) + 1;
                $days = array();

                for ($i = 0; $i < $numDays; $i++) {
                    $days[] = date($format, ($startTime + ($i * $day)));
                }

                return $days;
            }
            // $start_date="2018-02-01";
            // $end_date="2018-02-09";
            $start_date= $_GET['start'];
            $end_date=$_GET['end'];
            $days = getDatesBetween2Dates($start_date, $end_date);

            foreach($days as $key => $value){

                echo "'" .$value . "', ";
                // $xzxz=rtrim ($value , ",'");
                // echo rtrim ($value, ",'");

            }
            // echo $value;
            ?>],
//            ['x', '20130101', '20130102', '20130103', '20130104', '20130105', '20130106'],
            // ['3015', 30, 200, 100, 400, 150, 250,],
            // ['3016', 130, 340, 200, 500, 250, 350,],
            // ['3017', 220, 40, 120, 190, 320,440, ],
            <?php
            $conn = new mysqli($host, $uname, $pass, $db);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $meter_serial_number=$_GET['meter_serial_number'];
            // echo $meter_serial_number;
            $meter_serial_number = (substr($meter_serial_number,-1) == ',') ? substr($meter_serial_number, 0, -1) : $meter_serial_number;
            // echo $meter_serial_number;
            // echo "</br>";
            $p = $_GET['parameters'];

            $start_date= $_GET['start'];
            $end_date=$_GET['end'];
            $array = explode(',', $meter_serial_number);
            $meterCount = count($array);
            // echo $meterCount;
            // $meter=array();
            $c=array();
            for ($i=0; $i < $meterCount ; $i++) {

              $c[$i]=$array[$i];
              $sql_parameter_for_graph=  "SELECT ".$p." FROM incoming_parameters WHERE meter_serial_number='".$c[$i]."' AND rtc BETWEEN '".$start_date."' AND '".$end_date."' ";
              # code...
              echo "[";
              echo "'".$c[$i]."',";

              $result = mysqli_query($conn, $sql_parameter_for_graph);
              // $json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
              // $json =json_encode($json);
              //
              // $someArray = json_decode($json, true);
              //
              // foreach ($someArray as $key => $value) {
              //   echo $value[$p] . ",";
              // }
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
              echo $row[$p].",";

              }
              echo "],";

            }
            ?>

        ]
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%d-%m-%Y'
            }
        }
    }
});
</script>

  </body>
</html>
