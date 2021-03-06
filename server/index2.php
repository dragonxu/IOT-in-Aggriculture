
<?php
session_start();
	$Upazila = "";
	$union = "";
	$mouza = "";
	$land_type = "";
	$wrf = "";
	$soil_solidness = "";
	$N = "";
	$P = "";
	$K = "";
	$PH = "";
	$myObj = new \stdClass;

    if(isset($_SESSION['Upazila'])){
        $myObj->Upazila = $_SESSION['Upazila'];
    }
	if(isset($_SESSION['union'])){
        $myObj->union = $_SESSION['union'];
    }
	if(isset($_SESSION['mouza'])){
        $myObj->mouza = $_SESSION['mouza'];
    }
	if(isset($_SESSION['land_type'])){
        $myObj->land_type = $_SESSION['land_type'];
    }
	if(isset($_SESSION['wrf'])){
        $myObj->wrf = $_SESSION['wrf'];
    }
	if(isset($_SESSION['soil_solidness'])){
        $myObj->soil_solidness = $_SESSION['soil_solidness'];
    }
	if(isset($_SESSION['N'])){
        $myObj->N = $_SESSION['N'];
    }
	if(isset($_SESSION['P'])){
        $myObj->P = $_SESSION['P'];
    }
	if(isset($_SESSION['K'])){
        $myObj->K = $_SESSION['K'];
    }
	if(isset($_SESSION['PH'])){
        $myObj->PH = $_SESSION['PH'];
    }
	$myJSON = json_encode($myObj);

	$myfile = fopen("dataShare.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $myJSON);
	fclose($myfile);
	
	shell_exec('D:\home\site\wwwroot\Agriculture\dist\jdk1.8.0_73\bin\java -jar "D:\home\site\wwwroot\Agriculture\dist\Agriculture.jar"');
?>
<!doctype html>
<html lang="en">
<head>

	<title>IOT IN AGRICULTURE</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style type="text/css">
			body { background: #5882FA !important; } 
			div.jumbotron{
				word-wrap:break-word;
			}
	</style>
   
</head>
<body>
	
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">IOT In Agriculture</a>
		</div>
		<ul class="nav navbar-nav">
		  <li class="active"><a href="index.php">Home</a></li>
		  <li><a href="index2.php">Outputs</a></li>
		  <li><a href="index4.php">Suggestion</a></li>
		  <li><a href="index3.php">About</a></li>
		</ul>
	  </div>
	</nav>
	
	<div class="container">
		<div class="jumbotron">
			<h1>Welcome To IOT In Agriculture</h1>
		</div>
		<br><br>
		<div id= "result" class="jumbotron">
		
			<?php   
				
					$search = '*';
					$search1 = '>';
					$search2 = 'acid';
					$search3 = 'alkaline';
					$search4 = 'medium suitable';
					$search5 = 'not suitable';
					$search6 = 'CROP NO';
					$lines = file('output.txt');
					foreach($lines as $line)
					{
					  if(strpos($line, $search) !== false)
						{?>
							<div class="panel panel-primary">
							  <div class="panel-heading"><h4><?php  echo $line. "<br />";?></div>
							</div>
						<?php 
						}
						else if(strpos($line, $search1) !== false)
						{?>
							<br><kbd><?php  echo $line. "<br />";?></kbd>
						<?php 
						}
						else if(strpos($line, $search6) !== false)
						{?>
							<h4 class="text-primary"><?php  echo $line. "<br />";?></h4>
						<?php 
						}
						else if((strpos($line, $search2) !== false && strpos($line, $search4) !== false) || (strpos($line, $search2) !== false && strpos($line, $search5) !== false) )
						{
							$str = str_replace(' ', '&nbsp;', $line);
							echo $str. "<br />";
						?>
							<br>
							<div class="alert alert-danger"> 
								<strong>NOTE: </strong> For better production soil pH need to be increased. So please check this out :  
								<button type="button" class="btn btn-info btn-xm" data-toggle="modal" data-target="#myModal2">TIPS</button>
								<div class="modal fade" id="myModal2" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
									 <p class="text-primary">How to Raise the pH in Acidic Soil :</p><br>
										<h5 class="text-muted">1. Lime: <br><br>Limestone is the most common soil additive for raising pH of your soil to make it less acidic. You’ll generally see two types: calcitic limestone (which is mostly calcium carbonate), and dolomitic limestone (which also adds magnesium to the soil). Both work equally well at raising soil pH. Liming products come in granular, hydrated, pelletized, or pulverized forms. Pulverized lime is a fine powder that is faster-acting, but it tends to clog spreaders. The granular or pelletized types of limestone spread more easily and take longer to break down. Hydrated lime is the fastest-acting but is very easy to overdose. All lime products will work much better if they can be worked down into the soil, rather than left on top. This is why applying lime to lawns is often paired with core aeration and fall watering.
										<br><br><br>2. Wood Ash: <br><br>For an organic way to make your soil less acidic, sprinkle about 1/2″ of wood ash over your soil and mix it into the soil about a foot deep. This method takes small applications over several years, but it can be very effective, as well as a great way to recycle fireplace ashes!</p>
									 
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								 </div>
								</div>
							</div>
						<?php
						}
						else if((strpos($line, $search3) !== false && strpos($line, $search4) !== false) || (strpos($line, $search3) !== false && strpos($line, $search5) !== false) )
						{
							$str = str_replace(' ', '&nbsp;', $line);
							echo $str. "<br />";
						?>
							<br>
							<div class="alert alert-danger"> 
								<strong>NOTE: </strong> For better production soil pH need to be decreased. So please check this out :  
								<button type="button" class="btn btn-info btn-xm" data-toggle="modal" data-target="#myModal2">TIPS</button>
								<div class="modal fade" id="myModal2" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
									 <p class="text-primary">How to Lower the pH in Alkaline Soil :</p><br>
										<h5 class="text-muted">1. Sulfur: <br><br>Plain elemental sulfur (or sulphur) is probably the easiest and most common way to make soil more acidic, since it’s cheap, relatively safe, and can be spread on top of the soil. Since sulfur is pretty slow-acting, you shouldn’t apply more than 2 pounds per 100 square feet at a time.
						<br><br><br>2. Sphagnum Peat: <br><br>This is a great organic solution, since sphagnum peat also adds organic matter to your soil and increases water retention. Simply work a 2” layer of sphagnum peat into your soil at least a foot deep. Larger areas will probably require a tiller.
						<br><br><br>3. Aluminum Sulfate and Iron Sulfate: <br><br>These two products are very fast-acting, but they can also be the most damaging by adding salts and elements that can build up in the soil. Be sure not to apply more than about 5 pounds per 100 square feet.
						<br><br><br>4. Acidifying Fertilizer: <br><br>Fertilizers that contain ammonia (such as ammonium nitrate), urea, or amino acids can, over time, have an acidifying effect on the soil in your yard.</p>
									 
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								 </div>
								</div>
							</div>
						<?php
						}
						 else
						{
							$str = str_replace(' ', '&nbsp;', $line);

							echo $str. "<br />";
						}
					}
			?>
		</div>
	</div>
	

</body>
</html>

