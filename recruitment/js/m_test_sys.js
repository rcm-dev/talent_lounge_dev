$(document).ready(function(){

	var mainBtn = $('a#mainTest');
	var newBtn = $('a#newTest');
	var createNewQuestion = $('a#createNewQuestion');
	var editQuestion = $('a#editQuestion');

	var submitNewTest = $('input#submitNewTest');

	var newQuestion = $('a.newQuestion');

	var submitNewAndSaveQuestion = $('input#submitNewAndSaveQuestion');

	var cancelNewQuestion = $('a#cancelNewQuestion');

	var testDelete = $('a#testDelete');

	var addNewAnswer = $('a#addNewAnswer');

	var cancelAnswer = $('a#cancelAnswer');

	var submitNewAnswer = $('input#submitNewAnswer');

	var deleteQuestion = $('a#deleteQuestion');

	var deleteAnswer = $('a#deleteAnswer');


	// default loaded
	$('div.mtest_container').html('Loading..').load('ajax/displayTest.php');


	// load default test
	mainBtn.live('click', function(){
		$('div.mtest_container').html('Loading..').load('ajax/displayTest.php');
		return false;
	});


	// load new test page
	newBtn.live('click', function(){
		$('div.mtest_container').html('Loading..').load('create_new_test.php');

		
		//console.log('Load New Test Page');
		return false;
	});


	// save new test
	submitNewTest.live('click', function(){

		var newTestdata = $('form#formNewTest').serialize();

		$('#formNewTest').hide();
		$('.newTestDone').load('ajax/saveNewTest.php?'+newTestdata);

		//console.log('Submit Done ' + newTestdata);
		return false;

	});

	// load new question page
	createNewQuestion.live('click', function(){

		var test_id = $(this).attr('data-id');
		var test_name = $(this).attr('data-name');

		$('div.mtest_container').html('Loading..').load('create_new_question.php?test_id='+test_id);

		// console.log('Load New Question Page ' + test_name + test_id);
		return false;
	});


	// load edit question page
	editQuestion.live('click', function(){

		var test_id = $(this).attr('data-id');
		var test_name = $(this).attr('data-name');

		$('div.mtest_container').html('Loading..').load('create_new_question.php?test_id='+test_id);

		// console.log('Load New Question Page ' + test_name + test_id);
		return false;
	});


	// toggle new question form
	newQuestion.live('click', function(){


		$('div.newQuestionContainer').show('slow');

		// console.log('Toggle new question form');
		return false;
	});


	// submit new question and save
	submitNewAndSaveQuestion.live('click', function(){

		var questionData = $('form#newQuestion').serialize();
		$('.newQuestionDone').load('ajax/saveNewQuestion.php?'+questionData);

		$('textarea#question_name').val("");
		$('input#question_order').val("");

		var test_id = $('input#test_id').val();
		$('ul.ListQuestions').html('Loading..').load('ajax/displayQuestion.php?test_id='+test_id);

		// console.log('saved! '+questionData);
		return false;
	});

	// cancel new question
	cancelNewQuestion.live('click', function(){

		$('textarea#question_name').val("");
		$('input#question_order').val("");

		$('div.newQuestionContainer').hide('slow');
	});


	// master delete all test,question,answer
	testDelete.live('click', function(){

		var id = $(this).attr('data-id');

		// show confirmation
		$('span#alertDelete'+id).show();

		// click no and hide alert
		$('a#alertHideDelete'+id).live('click', function(){
			$('span#alertDelete'+id).hide();			
		});

		// click yes to delete
		$('a#alertConfirmDelete'+id).live('click', function(){
			$('div.doneDeleted').html('Loading..').load('ajax/deleteTestQuesAns.php?test_id='+id);

			$('div.mtest_container').html('Loading..').load('ajax/displayTest.php');

			// console.log('deleted! '+id);
		});

		// console.log('deleted! '+id);
		return false;

	});



	// cancel submit answer
	cancelAnswer.live('click', function(){

		var id = $(this).attr('data-id');
		$('div.containerFormAnswer'+id).hide('slow');

		// clear form
		$('form#newAnswer'+id).find('textarea#answertText').val("");
		$('form#newAnswer'+id).find('input#answerScore').val("");
		$('form#newAnswer'+id).find('input#answerOrder').val("");

		// console.log('Cancel form '+ id);
		return false;
	});


	// display new answer of each question clicked
	addNewAnswer.live('click', function(){

		var id = $(this).attr('data-id');

		$('div.containerFormAnswer'+id).show('slow');

		// console.log('addNewAnswer'+id);
		return false;

	});



	// submit new answer form
	submitNewAnswer.live('click', function(){

		var id = $(this).attr('data-id');

		var answerData = $('form#newAnswer'+id).serialize();

		// clear form
		$('form#newAnswer'+id).find('textarea#answertText').val("");
		$('form#newAnswer'+id).find('input#answerScore').val("");
		$('form#newAnswer'+id).find('input#answerOrder').val("");

		// Save answer
		$('div.containerFormAnswer'+id+' > div.answerSaved'+id).html('Loading').load('ajax/saveNewAnswer.php?'+answerData);

		// Load answer
		$('ul.TotalAnswer'+id).html('Loading..').load('ajax/displayAnswer.php?qid_fk='+id);


		// console.log('Saved! '+id);
		// console.log('Data '+answerData);
		return false;
	});


	// Delete single question
	deleteQuestion.live('click', function(){

		var id = $(this).attr('data-id');

		// display confirmation delete
		$('span#deleteQuestionContainer'+id).show();

		// action delete
		$('a#confirmDeleteQuestion'+id).live('click', function(){

			var test_id = $(this).attr('data-id');

			$('div.mtest_container').html('Loading..').load('ajax/deleteQuestion.php?qid='+id);
			$('div.mtest_container').html('Loading..').load('create_new_question.php?test_id='+test_id);

		});

		// hide delete container
		$('a#cancelDeleteQuestion'+id).live('click', function(){
			$('span#deleteQuestionContainer'+id).hide();			
		});


		// console.log('Open span'+id);
		return false;
	});



	// Delete 1 Answer
	deleteAnswer.live('click', function(){

		var aid = $(this).attr('data-id');
		var qid = $(this).attr('data-qid');

		$('ul.TotalAnswer'+qid).html('Loading..').load('ajax/deleteAnswer.php?aid='+aid);
		$('ul.TotalAnswer'+qid).html('Loading..').load('ajax/displayAnswer.php?qid_fk='+qid);

		// console.log('Answer '+aid);
		return false;
	});



});