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
	    'folder'    : 'uploads/ideas',
	    'multi'		: true,
	    'auto'      : true,
	    'queueSizeLimit': 4,

	    'onQueueFull': function(event, queueSizeLimit) {
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},

		'onComplete': function(event, ID, fileObj, response, data) {
			// you can use here jQuery AJAX method to send info at server-side.
			$.post("ajax/ajax_upload_preview.php", { name: fileObj.name, ideaId: $('#ideaId').val() }, function(info) {
				//alert(info); // alert UPLOADED FILE NAME
			});
		},

	    'onAllComplete' : function(event,data) {
	      $('#mediaview').html('loading..').load('ajax/ajax-media-idea-view.php?midfk='+$('#ideaId').val());
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
<h3 class="image-plus_color">Upload Pictures</h3>

<form action="upload_preview.php" method="post" accept-charset="utf-8">
	<label>You can upload 1 or more picture up to 10 pictures. Select picture and automatically upload.</label><br><br>
	
	<input id="file_upload" type="file" name="file_upload" />

	<input type="hidden" name="ideaId" id="ideaId" value="<?php echo $_GET['ideaid']; ?>">


	<a href="javascript:$('#file_upload').uploadifyUpload();" class="none">Upload Files</a>

</form>


<p>



<div id="mediaview">

</div>

</p>
</body>
</html>