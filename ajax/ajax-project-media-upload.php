<?php  


//echo "Upload media idea id = ".$_GET['ideaid'];


?>


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
	    'folder'    : 'uploads/project',
	    'multi'		: true,
	    'auto'      : true,
	    'queueSizeLimit': 1,

	    'onQueueFull': function(event, queueSizeLimit) {
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},

		'onComplete': function(event, ID, fileObj, response, data) {
			// you can use here jQuery AJAX method to send info at server-side.
			$.post("ajax/ajax_upload_project_preview.php", { name: fileObj.name, projID: $('#projID').val() }, function(info) {
				//alert(info); // alert UPLOADED FILE NAME
			});
		},

	    'onAllComplete' : function(event,data) {
	      $('#mediaview').html('loading..').load('ajax/ajax-media-project-view.php?projID='+$('#projID').val());
	      $.jnotify("Uploaded.", 5000);
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
<h3 class="image-plus_color">Section 10 :: Upload your cover</h3>

<form action="upload_preview.php" method="post" accept-charset="utf-8">
	<label>You can multiple upload in edit mode section</label><br><br>
	
	<input id="file_upload" type="file" name="file_upload" />

	<input type="hidden" name="projID" id="projID" value="<?php echo $_GET['projID']; ?>">


	<a href="javascript:$('#file_upload').uploadifyUpload();" class="none">Upload Files</a>

</form>


<p>



<div id="mediaview">

</div>

</p>
</body>
</html>