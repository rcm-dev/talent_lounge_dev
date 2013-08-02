<?php  


//$curr_idea_edit_id = $_GET['cid'];


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
			$.post("ajax/ajax_upload_preview.php", { name: fileObj.name, ideaId: $('#curr_idea_edit_id').val() }, function(info) {
				//alert(info); // alert UPLOADED FILE NAME
			});
		},

	    'onAllComplete' : function(event,data) {
	      $('#mediaview').html('loading..').load('ajax/ajax-edited-idea-view.php?cid='+$('#curr_idea_edit_id').val());
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
<h3 class="image-plus_color">Upload Picture for this submission</h3>
<br><br>

<form action="upload_preview.php" method="post" accept-charset="utf-8">
	
	<input id="file_upload" type="file" name="file_upload" />

	<input type="hidden" name="curr_idea_edit_id" id="curr_idea_edit_id" value="<?php echo $_GET['cid']; ?>">


	<a href="javascript:$('#file_upload').uploadifyUpload();" class="none">Upload Files</a>

</form>


<p>

<div id="mediaview">

</div>

</p>

<script type="text/javascript">
$(document).ready(function(){


	var curr_idea_edit_id = $('#curr_idea_edit_id').val();

	$('#mediaview').html('loading..').load('ajax/ajax-edited-idea-view.php?cid='+curr_idea_edit_id);

});

</script>
</body>
</html>