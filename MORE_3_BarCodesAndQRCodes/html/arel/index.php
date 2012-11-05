<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport"
	content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<script type="text/javascript"
	src="http://dev.junaio.com/arel/js/arel.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

	torchStarted = false;
	
	arel.sceneReady(function()
	{
		//set the listener to the scene to check when the user is tracking something
		arel.Events.setListener(arel.Scene, function(type, param){trackingHandler(type, param);});	
	});
	
	function trackingHandler(type, param)
	{
		//check if there is tracking information available
		if(param[0] !== undefined)
		{
			//if the pattern is found, hide the information to hold your phone over the pattern
			if(type && type == arel.Events.Scene.ONTRACKING && param[0].getState() == arel.Tracking.STATE_TRACKING)
			{
				//get the content in the code
				var content = param[0].getContent();

				if(content != "")
				{
					//if the return is a website, create a link
					if(content.indexOf("http") !== -1)
						$('#result').html("<a onclick=\"javascript: arel.Media.openWebsite('" + content + "')\">" + content + "</a>");
					else //otherwise just display the return
						$('#result').html(content);

					$('#resultCenter').fadeIn("slow");
				}
			}			
		}
	};

	function toggleTorch()
	{
		if(torchStarted)
		{
			torchStarted = false;
			arel.Scene.stopTorch();
		}
		else
		{
			torchStarted = true;
			arel.Scene.startTorch();
		}
	}

</script>

<style type="text/css">
* {
	-webkit-highlight: none;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
}

body {
	margin: 0px;
	padding: 0;
	-webkit-text-size-adjust: 100%;
	background-color: transparent;
}

#center {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 70%;
	height: 70%;
	margin-top: -35%;
	margin-left: -35%;
}

#info {
	border-color: #aaa;
	border-style: solid;
	border-width: 2px;
	-webkit-border-radius: 8px;
	display: block;
	position: absolute;
	height: auto;
	bottom: 0;
	top: 0;
	left: 0;
	right: 0;
	padding: 10px;
	color: #fff;
	font: normal normal bold 12px/normal Helvetica, Arial, sans-serif;
	text-align: center;
	opacity: 0.8;
}

#resultCenter {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 70%;
	height: 2.3em;
	margin-top: 37%;
	margin-left: -35%;
	display: none;
}

#result {
	border-style: solid;
	border-width: 2px;
	-webkit-border-radius: 8px;
	display: block;
	position: absolute;
	height: auto;
	bottom: 0;
	top: 0;
	left: 0;
	right: 0;
	padding: 2px;
	color: #aaa;
	background-color: #333;
	border-color: #000;
	font: normal normal bold 1em/normal Helvetica, Arial,
		sans-serif;
	text-align: center;
	opacity: 0.8;	
}
</style>

<title>Arel GLUE Barcode and QR Code Scanner</title>
</head>
<body>
	<div id="center" ontouchstart="toggleTorch()">
		<div id="info">Searching for QR Codes and Barcodes.<br />Touch for light</div>
	</div>
	<div id="resultCenter">
		<div id="result"></div>
	</div>
</body>
</html>
