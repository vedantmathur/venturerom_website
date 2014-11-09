<?php
	if(isset($_POST['email'])) {
		$venture_email = 'hello@venturerom.com';
		if (isset($_POST['subject']) || isset($_POST['description']) || isset($_POST['type'])) {
			if ($_POST['type'] == 'bug') {
				$venture_subject = 'Bugs: ' . $_POST['subject'];
			} elseif ($_POST['type'] == 'feature') {
				$venture_subject = 'Feature: ' . $_POST['subject'];
			} elseif ($_POST['type'] == 'feedback') {
				$venture_subject = 'Feedback: ' . $_POST['subject'];
			}
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			if(!preg_match($email_exp,$_POST['email'])) {
				$mysnackbar = "Sorry, your email is invalid. Please try again.";
			} else {
				$headers = 'From: ' . $_POST['email'] . "\r\n" .
				'Reply-To: ' . $_POST['email'] . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				mail($venture_email, $venture_subject, $_POST['description'], $headers);
				$mysnackbar = "Your message has been sent. We'll be in contact with you as soon as possible! Thank you for contacting us.";
			}
		} else {
			$mysnackbar = "Sorry, you missed a field. Please try completing the form again.";
		}
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

	<title>VentureROM</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="/css/bootstrap-material-design/css-compiled/ripples.min.css" rel="stylesheet" type="text/css">
	<link href="/css/bootstrap-material-design/css-compiled/material-wfont.css" rel="stylesheet" type="text/css">
	<link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
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
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #01579B;">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand page-scroll navbar-goto-top" href="#page-top">
					<i class="fa fa-play-circle"></i>	<span class="light">Go To</span> Top
				</a>
			</div>

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
						<a class="page-scroll" href="http://www.venturerom.com/about.html">About Us</a>
					</li>
					<li>
						<a class="page-scroll" href="http://www.venturerom.com/contact.php">Contact</a>
					</li>
					<li>
						<a class="page-scroll" href="https://plus.google.com/u/0/communities/113182664923280225609">Community</a>
					</li>
					<!-- <li>
						<a class="page-scroll" href="http://www.venturerom.com/blog/">Blog</a>
					</li> -->
					<li>
						<a class="page-scroll" href="https://github.com/VentureROM">Source</a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>


	<!-- Intro Header -->
	<header class="about-intro">
		<div class="intro-body">
			<div class="container">
				<div class="row">
					<div class="col-sm-1 col-sm-offset-2">
						<div class="logo-container">
							<img src="/img/logo.png" class="main-logo" style="width: 150px; height: 150px;" />
						</div>
					</div>
					<div class="col-lg-2">
						<h1 class="brand-heading" style="margin-top: 0px">VentureROM</h1>
						<!-- <p class="intro-text">VentureROM is a Paranoid Android fork that is made to be as customizable as possible without sacrificing any performance or battery life.</p> -->
					</div>
				</div>
				<div class="row">
					<blockquote>
						<p>Based off AOSPA, VentureROM features hand-picked features and is optimized for battery life.</p>
						<!-- <small>Someone famous in <cite title="Source Title">Source Title</cite></small> -->
					</blockquote>
				</div>
			</div>
		</div>
	</header>

	<!-- About Section -->
	<section class="content-section text-center">
		<div class="container contact">
			<div class="row">
				<h1>Contact Us</h1>
				<p style="font-size: 20px;">If in any way you need to contact us, you can use the form below to do so. Make sure to pick the radio option for what you're contacting us for, be it feature requests, bug reports, or just general feedback. We look forward to hearing from you!</p>
				<form id="new-notice" class="form-vertical text-left well well-lg contact-form" method="post" action="contact.php">
					<fieldset>
						<div class="form-group">
							<label for="inputemail" class="col-lg-2 control-label">Email</label>
							<div class="col-lg-10">
								<input class="form-control" id="inputemail" name="email">
							</div>
						</div>
						<div class="form-group">
							<label for="inputsubject" class="col-lg-2 control-label">Subject</label>
							<div class="col-lg-10">
								<input class="form-control" id="inputsubject" placeholder="Subject to be displayed in email. Very brief description of why you are contacting us." name="subject">
							</div>
						</div>
						<div class="form-group">
							<label for="textArea" class="col-lg-2 control-label">Description</label>
							<div class="col-lg-10">
								<textarea class="form-control" rows="3" id="textArea" placeholder="Your text goes here" name="description"></textarea>
								<span class="help-block">Please include a description of the bug you've found, the feature you're requesting, or your general feedback.</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">Type</label>
							<div class="col-lg-10">
								<div class="radio radio-success">
									<label>
										<input name="type" id="optionsRadios1" value="feedback" checked="" type="radio">
										<b class="label label-success">Feedback</b>
									</label>
								</div>
								<div class="radio radio-primary">
									<label>
										<input name="type" id="optionsRadios2" value="feature" type="radio">
										<b class="label label-primary">Feature Request</b>
									</label>
								</div>
								<div class="radio radio-danger">
									<label>
										<input name="type" id="optionsRaios2" value="bug" type="radio">
										<b class="label label-danger">Bug Report</b>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-3 col-lg-offset-8">
								<button class="btn btn-default">Cancel</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer>
		<div class="row">
			<div class="col-md-7 col-md-offset-1">
					<img src="/img/do-logo.png" class="do-logo" />
				<!-- <ul>
					<li>Title - Some text here explaining post.</li>
					<li>Title - Some text here explaining post.</li>
					<li>Title - Some text here explaining post.</li>
					<li>Title - Some text here explaining post.</li>
					<li>Title - Some text here explaining post.</li>
				</ul> -->
			</div>
			<div class="col-md-3">
				<a href="" class="btn btn-social btn-yellow">XDA Thread</a>
				<a href="" class="btn btn-social btn-dark-blue">Twitter</a>
				<a href="https://github.com/VentureROM" class="btn btn-social btn-dark-blue">Github</a>
				<a href="https://plus.google.com/107561896355522955908" class="btn btn-social btn-dark-blue">Google+</a>
				<a href="mailto:support@venturerom.com" class="btn btn-social btn-dark-blue">Email</a>
			</div>
		</div>
		<div class="container text-center credits">
			<p>Copyright &copy; VentureROM 2014</p>
		</div>
	</footer>

	<!-- Bootstrap Core JavaScript -->
	<script src="/js/bootstrap.min.js"></script>

	<!-- Material Bootstrap JS -->
	<script src="/css/bootstrap-material-design/scripts/ripples.js"></script>
	<script src="/css/bootstrap-material-design/scripts/material.js"></script>

	<!-- Plugin JavaScript -->
	<script src="js/jquery.easing.min.js"></script>
	<script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>

	<?php
		if (isset($mysnackbar)) {
			echo '<script>';
			echo '$(function() {';
			echo '$.snackbar({content: "' . $mysnackbar . '", timeout: 5000});';
			echo '});';
			echo '</script>';
		}
	?>
</body>

</html>
