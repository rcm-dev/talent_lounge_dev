<html>
<head>
	<title>Upload</title>

	<script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="uploadify/swfobject.js"></script>
	<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
	<script type="text/javascript">



	// <![CDATA[
	$(document).ready(function() {
	  $('#file_upload').uploadify({
	    'uploader'  : 'uploadify/uploadify.swf',
	    'script'    : 'uploadify/uploadify.php',
	    'cancelImg' : 'uploadify/cancel.png',
	    'folder'    : 'media',
	    'multi'		: true,
	    'auto'      : true,
	    'queueSizeLimit': 4,

	    'onQueueFull': function(event, queueSizeLimit) {
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},

		'onComplete': function(event, ID, fileObj, response, data) {
			// you can use here jQuery AJAX method to send info at server-side.
			$.post("upload_preview.php", { name: fileObj.name }, function(info) {
				alert(info); // alert UPLOADED FILE NAME
			});
		},

	    'onAllComplete' : function(event,data) {
	      $('#mediaview').html('loading..').load('mediaview.php');
	    }

	  });
	});
	// ]]>
	</script>

	<style type="text/css">
	label {
		display: block;
	}
	</style>

</head>
<body>
<h3>Upload</h3>

<form action="upload_preview.php" method="post" accept-charset="utf-8">
	<label>Multiple Picture</label>
	
	<input id="file_upload" type="file" name="file_upload" />


	<input type="submit" value="submit" />

</form>


<p>



<div id="mediaview">

</div>

</p>
</body>
</html>