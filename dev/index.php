<?php
	// user has clicked a delete hyperlink
	$notice_priority_rm = $notice_date_rm = $notice_notice_rm = '';
	if(isset($_GET['action'])) {
		if($_GET['action'] == "delete") {
			$notice_priority_rm = $_GET['index'];
			$notice_date_rm = $notice_priority_rm + 1;
			$notice_notice_rm = $notice_priority_rm + 2;
			$f = '/srv/http/venturerom.com/api.venturerom.com/notices/notice';
			$arr = file($f);
			unset($arr[$notice_priority_rm]);
			unset($arr[$notice_date_rm]);
			unset($arr[$notice_notice_rm]);
			$arr = array_values($arr);
			file_put_contents($f,$arr);
		}
	}

	if (isset($_POST["date"])) {
		if (empty($_POST['date'])) {
			$dateErr = "You must supply a valid date.";
		} else {
			$mydate = test_input($_POST['date']);
		}
	}
	if (isset($_POST["notice"])) {
		$mynotice = test_input($_POST['notice']);
	}
	if (isset($_POST["priority"])) {
		$mypriority = test_input($_POST['priority']);
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if (isset($mydate, $mynotice, $mypriority)) {
		$myfile = "/srv/http/venturerom.com/api.venturerom.com/notices/notice";
		$txt = file_get_contents($myfile);
		if (empty($txt)) {
			$txt = "priority : " . $mypriority . "\ndate : " . $mydate . "\nnotice : " . $mynotice . "\n";
		} else {
			$txt .= "priority : " . $mypriority . "\ndate : " . $mydate . "\nnotice : " . $mynotice . "\n";
		}
		file_put_contents($myfile, $txt);
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="VentureROM Main Site">
	<meta name="author" content="Brett Bohnenkamper (aka KittyKatt)">

	<title>Venture ROM</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="/css/bootstrap-material-design/css-compiled/ripples.min.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap-material-design/css-compiled/material-wfont.css" rel="stylesheet" type="text/css">
	<link href="/css/venture.css" rel="stylesheet" type="text/css">

	<!-- Custom Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="/css/bootstrap-material-design/icons/icons-material-design.css" rel="stylesheet" type="text/css">
	<link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery Version 1.11.0 -->
	<script src="/js/jquery-1.11.0.js"></script>

	<!-- <link href="/js/ninja-slider/ninja-slider.css" rel="stylesheet" type="text/css" /> 
	<script src="/js/ninja-slider/ninja-slider.js" type="text/javascript"></script> -->

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<!-- Navigation -->
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				<ul class="nav navbar-nav">
					<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
					<li class="hidden">
						<a href="#page-top"></a>
					</li>
					<li>
						<a class="page-scroll" href="http://www.venturerom.com/">Home</a>
					</li>
					<li>
						<a class="page-scroll" href="https://github.com/VentureROM">Source</a>
					</li>
						<li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">API <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="http://api.venturerom.com/notices/">Notices</a></li>
								<li><a href="http://api.venturerom.com/changelog/">Changelog</a></li>
								<li><a href="http://api.venturerom.com/updates/">Updates</a></li>
							</ul>
						</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>

	<header>
		<br /><br /><br /><br />
	</header>

	<section class="main">
		<div class="container">
			<ul class="nav nav-tabs nav-stacked col-sm-2 main-nav">
				<li class="active"><a href="#notices" data-toggle="tab">Notices</a></li>
				<li><a href="#builds" data-toggle="tab">Builds</a></li>
				<li class="disabled"><a>Disabled</a></li>
				<div id="uploader_div"></div>
			</ul>
			<section class="content col-sm-offset-3">
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade active in text-left" id="notices">
						<h1>Notices</h1>
						<?php
							$noticefile = '/srv/http/venturerom.com/api.venturerom.com/notices/notice';
							if (file_exists($noticefile)) {
								echo "<h2>Current Notice(s):</h2>";
								$lines = file($noticefile);
								$numlines = count($lines);
								for($i=0;$i<$numlines;)
								{
									$notice_priority = preg_replace('/priority : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
									$notice_date = preg_replace('/date : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
									$notice_data = preg_replace('/notice : /', '', trim(preg_replace('/\s\s+/', ' ', array_shift($lines))));
									echo "<div class='alert alert-dismissable notice priority-" . $notice_priority . "'>";
									echo "	<a href='/index.php?action=delete&index=" . $i . "'><button type='button' class='close'>×</button></a>";
									echo "	<h4>" . $notice_date . "</h4>";
									echo "	<p>" . $notice_data . "</p>";
									echo "</div>";
									// echo "<div class=\"btn btn-lg btn-flat btn-primary text-left btn-priority-" . $notice_priority . "\"><p class=\"notice-date\">" . $notice_date . "</p><br /><p class=\"notice-text\">" . $notice_data . "</p><a class=\"btn btn-danger btn-raised\ notice-remove\" href=\"/index.php?action=delete&index=" . $i . "\">Remove</a></div>";
									$i++;
									$i++;
									$i++;
								}
							}
						?>

						<div id="snackbar"></div>

						<form class="form-vertical text-left" method="post" action="/index.php">
							<fieldset>
								<legend>New Notice</legend>
								<div class="form-group">
									<label for="inputdate" class="col-lg-2 control-label">Date</label>
									<div class="col-lg-10">
										<input class="form-control" id="inputdate" name="date" placeholder="YYYYMMDD" type="date">
									</div>
								</div>
								<div class="form-group">
									<label for="textArea" class="col-lg-2 control-label">Notice</label>
									<div class="col-lg-10">
										<textarea class="form-control" rows="3" id="textArea" placeholder="Your notice goes here" name="notice"></textarea>
										<span class="help-block">This is the notice that will be displayed to the user on the OTA.</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Priority</label>
									<div class="col-lg-10">
										<div class="radio radio-success">
											<label>
												<input name="priority" id="optionsRadios1" value="low" checked="" type="radio">
												<b class="label label-success">Low</b>
											</label>
										</div>
										<div class="radio radio-primary">
											<label>
												<input name="priority" id="optionsRadios2" value="normal" type="radio">
												<b class="label label-primary">Normal</b>
											</label>
										</div>
										<div class="radio radio-warning">
											<label>
												<input name="priority" id="optionsRadios2" value="warning" type="radio">
												<b class="label label-warning">Warning</b>
											</label>
										</div>
										<div class="radio radio-danger">
											<label>
												<input name="priority" id="optionsRaios2" value="urgent" type="radio">
												<b class="label label-danger">Urgent</b>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<button class="btn btn-default">Cancel</button>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="tab-pane fade" id="builds">

					<?php
						function formatSizeUnits($bytes)
						{
							if ($bytes >= 1073741824) { $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
							elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
							elseif ($bytes >= 1024) { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
							elseif ($bytes > 1) { $bytes = $bytes . ' bytes'; }
							elseif ($bytes == 1) { $bytes = $bytes . ' byte'; }
							else { $bytes = '0 bytes'; }
							return $bytes;
						}

						$device = "bacon";
						$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
						$webRoot = "http://get.venturerom.com/" . $device;
						$json_array = array();
						echo "<div class='panel panel-primary panel-files'>";
						echo "	<div class='panel-heading'>";
						echo "		<h3 class='panel-title'>" . $device . "</h3>";
						echo "	</div>";
						echo "	<div class='panel-body'>";
						// Open a known directory, and proceed to read its contents
						foreach (glob("$devicedir/*.zip") as $file) {
							$filename = basename($file);

							$fileversion = preg_replace('#\D#', '', $filename);

							$filesize = formatSizeUnits(filesize($file));

							$turl = $webRoot. "/" . $filename;
							$url = str_replace('\/', "/", $turl);

							$filesum = md5_file($file);

							echo "<div class='list-group'>";
							echo "	<div class='list-group-item'>";
							echo "		<div class='row-action-primary'>";
							echo "			<i class='icon-material-folder'></i>";
							echo "		</div>";
							echo "		<div class='row-content'>";
							echo "			<div class='least-content'>" . $filesize . "</div>";
							echo "			<h4 class='list-group-item-heading'>" . $fileversion . "</h4>";
							echo "			<p class='list-group-item-text'><a href='" . $url . "'>" . $url . "</a><br />" . $filesum . "</p>";
							echo "		</div>";
							echo "</div>";
							echo "<div class='list-group-separator'></div>";

						}
						echo "	</div>";
						echo "</div>";
						echo "</div>";

						$device = "flo";
						$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
						$webRoot = "http://get.venturerom.com/" . $device;
						$json_array = array();
						echo "<div class='panel panel-primary panel-files'>";
						echo "	<div class='panel-heading'>";
						echo "		<h3 class='panel-title'>" . $device . "</h3>";
						echo "	</div>";
						echo "	<div class='panel-body'>";
						// Open a known directory, and proceed to read its contents
						foreach (glob("$devicedir/*.zip") as $file) {
							$filename = basename($file);

							$fileversion = preg_replace('#\D#', '', $filename);

							$filesize = formatSizeUnits(filesize($file));

							$turl = $webRoot. "/" . $filename;
							$url = str_replace('\/', "/", $turl);

							$filesum = md5_file($file);

							echo "<div class='list-group'>";
							echo "	<div class='list-group-item'>";
							echo "		<div class='row-action-primary'>";
							echo "			<i class='icon-material-folder'></i>";
							echo "		</div>";
							echo "		<div class='row-content'>";
							echo "			<div class='least-content'>" . $filesize . "</div>";
							echo "			<h4 class='list-group-item-heading'>" . $fileversion . "</h4>";
							echo "			<p class='list-group-item-text'><a href='" . $url . "'>" . $url . "</a><br />" . $filesum . "</p>";
							echo "		</div>";
							echo "</div>";
							echo "<div class='list-group-separator'></div>";

						}
						echo "	</div>";
						echo "</div>";
						echo "</div>";

						$device = "hammerhead";
						$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
						$webRoot = "http://get.venturerom.com/" . $device;
						$json_array = array();
						echo "<div class='panel panel-primary panel-files'>";
						echo "	<div class='panel-heading'>";
						echo "		<h3 class='panel-title'>" . $device . "</h3>";
						echo "	</div>";
						echo "	<div class='panel-body'>";
						// Open a known directory, and proceed to read its contents
						foreach (glob("$devicedir/*.zip") as $file) {
							$filename = basename($file);

							$fileversion = preg_replace('#\D#', '', $filename);

							$filesize = formatSizeUnits(filesize($file));

							$turl = $webRoot. "/" . $filename;
							$url = str_replace('\/', "/", $turl);

							$filesum = md5_file($file);

							echo "<div class='list-group'>";
							echo "	<div class='list-group-item'>";
							echo "		<div class='row-action-primary'>";
							echo "			<i class='icon-material-folder'></i>";
							echo "		</div>";
							echo "		<div class='row-content'>";
							echo "			<div class='least-content'>" . $filesize . "</div>";
							echo "			<h4 class='list-group-item-heading'>" . $fileversion . "</h4>";
							echo "			<p class='list-group-item-text'><a href='" . $url . "'>" . $url . "</a><br />" . $filesum . "</p>";
							echo "		</div>";
							echo "</div>";
							echo "<div class='list-group-separator'></div>";

						}
						echo "	</div>";
						echo "</div>";
						echo "</div>";
						echo "</div>";

						$device = "m8";
						$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
						$webRoot = "http://get.venturerom.com/" . $device;
						$json_array = array();
						echo "<div class='panel panel-primary panel-files'>";
						echo "	<div class='panel-heading'>";
						echo "		<h3 class='panel-title'>" . $device . "</h3>";
						echo "	</div>";
						echo "	<div class='panel-body'>";
						// Open a known directory, and proceed to read its contents
						foreach (glob("$devicedir/*.zip") as $file) {
							$filename = basename($file);

							$fileversion = preg_replace('#\D#', '', $filename);

							$filesize = formatSizeUnits(filesize($file));

							$turl = $webRoot. "/" . $filename;
							$url = str_replace('\/', "/", $turl);

							$filesum = md5_file($file);

							echo "<div class='list-group'>";
							echo "	<div class='list-group-item'>";
							echo "		<div class='row-action-primary'>";
							echo "			<i class='icon-material-folder'></i>";
							echo "		</div>";
							echo "		<div class='row-content'>";
							echo "			<div class='least-content'>" . $filesize . "</div>";
							echo "			<h4 class='list-group-item-heading'>" . $fileversion . "</h4>";
							echo "			<p class='list-group-item-text'><a href='" . $url . "'>" . $url . "</a><br />" . $filesum . "</p>";
							echo "		</div>";
							echo "</div>";
							echo "<div class='list-group-separator'></div>";

						}
						echo "	</div>";
						echo "</div>";
						echo "</div>";

						$device = "mako";
						$devicedir = "/srv/http/venturerom.com/get.venturerom.com/" . $device . "/";
						$webRoot = "http://get.venturerom.com/" . $device;
						$json_array = array();
						echo "<div class='panel panel-primary panel-files'>";
						echo "	<div class='panel-heading'>";
						echo "		<h3 class='panel-title'>" . $device . "</h3>";
						echo "	</div>";
						echo "	<div class='panel-body'>";
						// Open a known directory, and proceed to read its contents
						foreach (glob("$devicedir/*.zip") as $file) {
							$filename = basename($file);

							$fileversion = preg_replace('#\D#', '', $filename);

							$filesize = formatSizeUnits(filesize($file));

							$turl = $webRoot. "/" . $filename;
							$url = str_replace('\/', "/", $turl);

							$filesum = md5_file($file);

							echo "<div class='list-group'>";
							echo "	<div class='list-group-item'>";
							echo "		<div class='row-action-primary'>";
							echo "			<i class='icon-material-folder'></i>";
							echo "		</div>";
							echo "		<div class='row-content'>";
							echo "			<div class='least-content'>" . $filesize . "</div>";
							echo "			<h4 class='list-group-item-heading'>" . $fileversion . "</h4>";
							echo "			<p class='list-group-item-text'><a href='" . $url . "'>" . $url . "</a><br />" . $filesum . "</p>";
							echo "		</div>";
							echo "</div>";
							echo "<div class='list-group-separator'></div>";

						}
						echo "	</div>";
						echo "</div>";
						echo "</div>";
					?>
					</div>
					<div class="tab-pane fade" id="dropdown1">
						<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
					</div>
					<div class="tab-pane fade" id="dropdown2">
						<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
					</div>
				</div>
			</section>
		</div>
	</section>

	<!-- Footer -->
	<!-- <footer>
		<div class="container text-center credits">
			<p>Copyright &copy; VentureROM 2014</p>
		</div>
	</footer> -->

	<!-- Bootstrap Core JavaScript -->
	<script src="/js/bootstrap.min.js"></script>

	<script src="/css/bootstrap-material-design/scripts/ripples.js"></script>
	<script src="/css/bootstrap-material-design/scripts/material.js"></script>

	<?php
		if(isset($dateErr)) {
			echo "<script>";
			echo "document.getElementById('snackbar').innerHTML = '<p class=\"inner\">You must supply a valid date.</p>';";
			echo "</script>";
		}
	?>
</body>

</html>
