<?php 

session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Answer All Question | ProApp
		</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="css/proapp_style.css">
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<style>
			select {
				width:100px;
			}
      #result_show {
        background-image: url('img/result.png');
        background-repeat: no-repeat;
      }
      table#score {
          font-size: 40px;
      }
		</style>
	</head>
	<body>
    <?php include 'header-sc.php'; ?>
		<div id="wrapper_app" class="ui-window">

			<div id="main_test_container">
        <div>
          <a href="#" id="top"></a>
          <h4>Test consist of 4 Section</h4>
          <ul>
            <li><a href="#section1">Section 1: APSC</a></li>
            <li><a href="#section2">Section 2: FICE</a></li>
            <li><a href="#section3">Section 3: HSD</a></li>
            <li><a href="#section4">Section 4: FSIR</a></li>
          </ul>
        </div>
			<div>
        <a href="#" id="section1"></a>
				<p><img src="img/sec1.png" alt="sec1" border="0"></p>
				<p>
					<span class="label label-important">Instructions:</span> Read across the page from left to right. Rank the selections in each of the 15 questions that be describes your behavior at work or in school. Choose 4 for the statement that is most like you, choose 3 for the statement that is often like you, choose 2 for the statement that is occasionally like you, and choose 1 for the statement that is least like you.</p>
			</div>
			<div>
				<table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-striped table-hover">
            <tbody>
                <tr height="13">
                    <th height="13" width="10">
                        No
                    </th>
                    <th width="500">
                        Questions
                    </th>
                    <th width="288">
                        A
                    </th>
                    <th width="279">
                        B
                    </th>
                    <th width="278">
                        C
                    </th>
                    <th width="327">
                        D
                    </th>
                </tr>
                <tr>
                    <td>
                        1
                    </td>
                    <th>
                        I am mostly...
                    </th>
                    <td>
                        Results-oriented
                    </td>
                    <td>
                        People-oriented
                    </td>
                    <td>
                        Process/team-oriented
                    </td>
                    <td>
                        Detail-oriented
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC1col1" id="rowAPSC1col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col2" id="rowAPSC1col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col3" id="rowAPSC1col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC1col4" id="rowAPSC1col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <th>
                        I find time always...
                    </th>
                    <td>
                        Is not enough for me
                    </td>
                    <td>
                        Is not that important and will prefer socializing more
                    </td>
                    <td>
                        Is something that I respect but am not pressed by it
                    </td>
                    <td colspan="2">
                        Is something that is valuable to me and I handle my time well
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC2col1" id="rowAPSC2col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col2" id="rowAPSC2col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col3" id="rowAPSC2col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC2col4" id="rowAPSC2col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        3
                    </td>
                    <th>
                        I like to dress...
                    </th>
                    <td>
                        Formally
                    </td>
                    <td>
                        Casually
                    </td>
                    <td>
                        Compliantly
                    </td>
                    <td>
                        Conservatively
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC3col1" id="rowAPSC3col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col2" id="rowAPSC3col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col3" id="rowAPSC3col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC3col4" id="rowAPSC3col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        4
                    </td>
                    <th>
                        I like to talk to others about...
                    </th>
                    <td>
                        My accomplishments
                    </td>
                    <td>
                        Myself and others as well
                    </td>
                    <td>
                        About my relatives and friends
                    </td>
                    <td>
                        About things,systems, or organization
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC4col1" id="rowAPSC4col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col2" id="rowAPSC4col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col3" id="rowAPSC4col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC4col4" id="rowAPSC4col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        5
                    </td>
                    <th>
                        I prefer surroundings where I am surrounded by...
                    </th>
                    <td>
                        Personal accomplishments, rewards, and goal oriented
                    </td>
                    <td>
                        Photos, pictures, documents and 'my belongings'
                    </td>
                    <td>
                        Mementos and souvenirs
                    </td>
                    <td>
                        Organized, efficient and united
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC5col1" id="rowAPSC5col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col2" id="rowAPSC5col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col3" id="rowAPSC5col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC5col4" id="rowAPSC5col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        6
                    </td>
                    <th>
                        I would mostly answer people questions by...
                    </th>
                    <td>
                        Being straight to the point
                    </td>
                    <td>
                        Being helpful and friendly to them
                    </td>
                    <td>
                        Being firm and organized
                    </td>
                    <td>
                        Chill and disconnected
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC6col1" id="rowAPSC6col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col2" id="rowAPSC6col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col3" id="rowAPSC6col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC6col4" id="rowAPSC6col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        7
                    </td>
                    <th>
                        In relationships, I tend to...
                    </th>
                    <td>
                        Direct others
                    </td>
                    <td>
                        Persuade others
                    </td>
                    <td>
                        Acknowledge others
                    </td>
                    <td>
                        Analyze others
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC7col1" id="rowAPSC7col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col2" id="rowAPSC7col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col3" id="rowAPSC7col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC7col4" id="rowAPSC7col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        8
                    </td>
                    <th>
                        My behavior could be explained as...
                    </th>
                    <td>
                        Commanding, visionary and innovative
                    </td>
                    <td>
                        Original, stylish, creative, friendly or outgoing
                    </td>
                    <td>
                        Accommodating or open
                    </td>
                    <td>
                        Assessing or kept back
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC8col1" id="rowAPSC8col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col2" id="rowAPSC8col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col3" id="rowAPSC8col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC8col4" id="rowAPSC8col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        9
                    </td>
                    <th>
                        My gestures are usually...
                    </th>
                    <td>
                        Strong and fast
                    </td>
                    <td>
                        Open and friendly
                    </td>
                    <td>
                        Careful and calculated
                    </td>
                    <td>
                        Restricted and planned
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC9col1" id="rowAPSC9col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col2" id="rowAPSC9col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col3" id="rowAPSC9col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC9col4" id="rowAPSC9col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        10
                    </td>
                    <th>
                        My normal tone of speaking is...
                    </th>
                    <td>
                        Emotional and direct
                    </td>
                    <td>
                        Emotional and passionate
                    </td>
                    <td>
                        Low emotion and low-keyed
                    </td>
                    <td>
                        Without emotion and reserved
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC10col1" id="rowAPSC10col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col2" id="rowAPSC10col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col3" id="rowAPSC10col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC10col4" id="rowAPSC10col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        11
                    </td>
                    <th>
                        My personality is mostly...
                    </th>
                    <td>
                        Instructing and commanding
                    </td>
                    <td>
                        Friendly and communicative
                    </td>
                    <td>
                        Calm and relaxed
                    </td>
                    <td>
                        Blunt and exact
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC11col1" id="rowAPSC11col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col2" id="rowAPSC11col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col3" id="rowAPSC11col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC11col4" id="rowAPSC11col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        12
                    </td>
                    <th>
                        My talk focuses on...
                    </th>
                    <td>
                        Getting to the "bottom line"
                    </td>
                    <td>
                        Stories about myself and others
                    </td>
                    <td>
                        How to's and/or about relationships
                    </td>
                    <td>
                        Details, figures, stats and information
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC12col1" id="rowAPSC12col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col2" id="rowAPSC12col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col3" id="rowAPSC12col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC12col4" id="rowAPSC12col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        13
                    </td>
                    <th>
                        The live a...
                    </th>
                    <td>
                        Fast live
                    </td>
                    <td>
                        Enthusiastic live
                    </td>
                    <td>
                        Steady live
                    </td>
                    <td>
                        Structured and organized live
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC13col1" id="rowAPSC13col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col2" id="rowAPSC13col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col3" id="rowAPSC13col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC13col4" id="rowAPSC13col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        14
                    </td>
                    <th>
                        When decision must be made, usually it will be...
                    </th>
                    <td>
                        Fast and impulsive
                    </td>
                    <td>
                        What I think it should be
                    </td>
                    <td>
                        Studying the circumstances and being careful
                    </td>
                    <td>
                        To gather information and be objective driven
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC14col1" id="rowAPSC14col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col2" id="rowAPSC14col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col3" id="rowAPSC14col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC14col4" id="rowAPSC14col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr>
                    <td>
                        15
                    </td>
                    <th>
                        When I am hearing people speak, I...
                    </th>
                    <td>
                        Usually become impatient
                    </td>
                    <td>
                        Find my attention focusing away
                    </td>
                    <td>
                        Am there to listen toughtfully and carefully
                    </td>
                    <td>
                        Am choosy and focus only on the details
                    </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td><select name="rowAPSC15col1" id="rowAPSC15col1">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col2" id="rowAPSC15col2">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col3" id="rowAPSC15col3">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                  <td><select name="rowAPSC15col4" id="rowAPSC15col4">
                      <option value="0">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select></td>
                </tr>
                <tr height="13">
                    <td>
                      &nbsp;
                    </td>
                    <td>
                      &nbsp;
                    </td>
                    <td>
                        <strong>Authority</strong> <span id="allCol1" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Persuading</strong> <span id="allCol2" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Stable</strong> <span id="allCol3" class="badge badge-info"></span>
                    </td>
                    <td>
                        <strong>Conform</strong> <span id="allCol4" class="badge badge-info"></span>
                    </td>
                </tr>
            </tbody>
        </table>


        <p>
          <form action="#" name="APSC_DATA" id="APSC_DATA">
            <input type="hidden" name="disc_D" id="allAPSCCol1" value="">
            <input type="hidden" name="disc_I" id="allAPSCCol2" value="">
            <input type="hidden" name="disc_S" id="allAPSCCol3" value="">
            <input type="hidden" name="disc_C" id="allAPSCCol4" value="">
            <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
          </form>
          <input type="button" name="getresult" id="getresult" value="Get Result APSC" class="btn btn-success">
        </p>

			</div>
			<!-- #end_disc_question -->
			<hr>
			<div>
        <div>
          <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section2"></a></td>
              <td align="right"><a href="#top">Go to TOP</a></td>
            </tr>
          </table>
        </div>
				<p><img src="img/sec2.png" alt="sec2" border="0"></p>
				<p>
					<span class="label label-important">Instructions:</span> Imagine yourself to be in studying or learning setting. By answering horizontally, chooses the statement that most strongly describes you and choose the number 4 in the space to the left of the statement. Choose the number 3 by the statement that often describes you, choose the number 2 by the statement that occasionally describes you, and choose the number 1 by the statement that least describes you. Working norizontaily, use each number only once.
				</p>
			</div>
      <div>
        <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-striped table-hover">
      <tbody>
        <tr>
          <td>
            No
          </td>
          <td>
            Alpha
          </td>
          <td>
            Beta
          </td>
          <td>
            Gamma
          </td>
          <td>
            Delta
          </td>
        </tr>
        <tr>
          <td>
            1
          </td>
          <td>
            I like to work in a clean and tidy place where everything is in order
          </td>
          <td>
            I can work fine in a messy and disorganized space.
          </td>
          <td>
            I actually prefer working in an efficient environment
          </td>
          <td>
            To me, the environmennt I a working on should be able to inspire my creativity and idea generating
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE1col1" id="rowLITE1col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col2" id="rowLITE1col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col3" id="rowLITE1col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE1col4" id="rowLITE1col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            2
          </td>
          <td>
            I work at my best with others who are responsible and I can rely on
          </td>
          <td>
            I work at my best with friendly people and maintain a friendly relationships
          </td>
          <td>
            I work at my best with people who are goal and mission oriented
          </td>
          <td>
            I work the best with people who can adapt to changes that I made
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE2col1" id="rowLITE2col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col2" id="rowLITE2col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col3" id="rowLITE2col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE2col4" id="rowLITE2col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            3
          </td>
          <td>
            I quickly learn things by following directions and instructions
          </td>
          <td>
            I quickly learn things that I believe and feel
          </td>
          <td>
            I quickly learn things by listening, watching and reading instead of doing
          </td>
          <td>
            I quickly learn things by experiencing it
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE3col1" id="rowLITE3col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col2" id="rowLITE3col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col3" id="rowLITE3col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE3col4" id="rowLITE3col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            4
          </td>
          <td>
            I make sure I know how things work before making a decision
          </td>
          <td>
            I will ask for opinions before making a decision
          </td>
          <td>
            I will collect information first before making a decision
          </td>
          <td>
            I will act immediately when making a decision
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE4col1" id="rowLITE4col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col2" id="rowLITE4col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col3" id="rowLITE4col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE4col4" id="rowLITE4col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            5
          </td>
          <td>
            I am more interested with clear facts rather than the meaning behind it
          </td>
          <td>
            I am more interested in ideas and themes rather than actual details
          </td>
          <td>
            I am more interested to know the integrity of information
          </td>
          <td>
            I am only interested to know essential information, facts or ideas
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE5col1" id="rowLITE5col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col2" id="rowLITE5col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col3" id="rowLITE5col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE5col4" id="rowLITE5col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            6
          </td>
          <td>
            I like following familiar routines
          </td>
          <td>
            I like to work with other people when doing an assignment or a job
          </td>
          <td>
            I would be prefer to be given enough time to complete a job thoroughly
          </td>
          <td>
            I enjoy trying out new things to solve a problem or a task
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE6col1" id="rowLITE6col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col2" id="rowLITE6col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col3" id="rowLITE6col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE6col4" id="rowLITE6col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            7
          </td>
          <td>
            When there is so much to do with no idea where to begin with make me stressed
          </td>
          <td>
            Others that put pressures to me asking me to be more organized will make me stressed
          </td>
          <td>
            Rushing jobs or a quick deadlines will make me stressed
          </td>
          <td>
            Forced outines, restrictions and schedules will make me stressed
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE7col1" id="rowLITE7col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col2" id="rowLITE7col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col3" id="rowLITE7col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE7col4" id="rowLITE7col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>
            8
          </td>
          <td>
            I like to be rewarded tangibly for a job well done
          </td>
          <td>
            I like it when people acknowledge me and telling me that I am a worthy person
          </td>
          <td>
            I like it when people appreciate and praise my work
          </td>
          <td>
            I appreciate the freedom given to me when deciding between projects
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><select name="rowLITE8col1" id="rowLITE8col1">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col2" id="rowLITE8col2">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col3" id="rowLITE8col3">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
          <td><select name="rowLITE8col4" id="rowLITE8col4">
              <option value="0">Choose</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="4">
            <form action="#" name="LITE_DATA" id="LITE_DATA">
              <input type="hidden" name="lite_L" id="allLiteDataCol1" value="">
              <input type="hidden" name="lite_I" id="allLiteDataCol2" value="">
              <input type="hidden" name="lite_T" id="allLiteDataCol3" value="">
              <input type="hidden" name="lite_E" id="allLiteDataCol4" value="">
              <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
            </form>
            <input type="button" id="getResultLITE" value="Get Result LITE" class="btn btn-success" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>L <span id="allLiteCol1" class="badge badge-info"></span></td>
          <td>I <span id="allLiteCol2" class="badge badge-info"></span></td>
          <td>T <span id="allLiteCol3" class="badge badge-info"></span></td>
          <td>E <span id="allLiteCol4" class="badge badge-info"></span></td>
        </tr>
      </tbody>
    </table>
      </div>
			<hr>
			<div>
        <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section3"></a></td>
              <td align="right"><a href="#top">Go to TOP</a></td>
            </tr>
          </table>
				<p><img src="img/sec3.png" alt="sec3" border="0"></p>
				<p>
					<span class="label label-important">Instructions:</span> Following are 20 statements describing the way you react with information. Please complete each question by choosing one statement (A) or (B) or (C) which most portrays your favorite choice. Even if all options describe you, choose ONLY ONE which best describes you. Please tick one letter (A) or (B) or (C) below.
				</p>
			</div>
			<div>
				<table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-hover table-striped">
					<tbody>
						<tr>
							<th colspan="3">
								1. When giving or receiving orders, I like...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer1" class="a" value="A"></label>
							</td>
							<td>
								Telling or be told clearly what needs to be done.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer1" class="b" value="B"></label>
							</td>
							<td>
								Writing/written instructions on what needs to be done.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer1" class="c" value="C"></label>
							</td>
							<td>
								Demonstrating/being guided through what needs to be done.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								2. If I read a novel, I will...
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer2" class="b" value="B"></label>
							</td>
							<td>
								Imagining the surroundings, view, clothing, and characters on how they looked like.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer2" class="c" value="C"></label>
							</td>
							<td>
								Feeling the mood, performance and action of the story.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer2" class="a" value="A"></label>
							</td>
							<td>
								Hear the conversations and dialogue between characters.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								3. If I am meeting a person for the first time, I likely notice their...
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer3" class="c" value="C"></label>
							</td>
							<td>
								Handshake, postures, attitude, and physical traits.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer3" class="a" value="A"></label>
							</td>
							<td>
								Tone of voice, firmness of speech, quality of sounds, and word selections.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer3" class="b" value="B"></label>
							</td>
							<td>
								Style of clothing, tidiness, cleanliness, and visual characteristics.
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								4. When I thought something from the past, I am likely to first recall...
							</th>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer4" class="c" value="C"></label>
							</td>
							<td>
								How I think and was feeling at that time.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer4" class="b" value="B"></label>
							</td>
							<td>
								How everyone and everything looked at the time.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer4" class="a" value="A"></label>
							</td>
							<td>
								What was heard and assumed at the time.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								5. When I have difficulty to forget an unpleasant experience, in my mind:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer5" class="a" value="A"></label>
							</td>
							<td>
								I hear the same words over and over.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer5" class="b" value="B"></label>
							</td>
							<td>
								I see the same images over and over.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer5" class="c" value="C"></label>
							</td>
							<td>
								I feel the same feelings over and over.
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								6.When I have taken an effort to explain something of a significance, the response l would appreciate mostly is:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer6" class="b" value="B"></label>
							</td>
							<td>
								You have drawn a very clear picture for me.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer6" class="a" value="A"></label>
							</td>
							<td>
								You could not have said it more clearly.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer6" class="c" value="C"></label>
							</td>
							<td>
								I feel the same way as well.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								7. When trying to concentrate on homework, I am most distracted by:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer7" class="c" value="C"></label>
							</td>
							<td>
								Changes in room temperature and other physical discomforts.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer7" class="a" value="A"></label>
							</td>
							<td>
								Sounds, voices, and stereos.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer7" class="b" value="B"></label>
							</td>
							<td>
								Sights, images, patterns, pictures, and lighting.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								8.I experience the greatest emotional encouragement from someone important to me if they...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer8" class="a" value="A"></label>
							</td>
							<td>
								Say meaningful words and expressions.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer8" class="b" value="B"></label>
							</td>
							<td>
								Somehow show that they are focusing and give attention towards me.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer8" class="c" value="C"></label>
							</td>
							<td>
								Hold or hug me with love or affection.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								9. My speech will be distracted by someone if they are...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer9" class="a" value="A"></label>
							</td>
							<td>
								Talking while I am talking.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer9" class="c" value="C"></label>
							</td>
							<td>
								Moving around the room while I am talking.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer9" class="b" value="B"></label>
							</td>
							<td>
								Not focusing and watching while I pointed out key ideas.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								10. If I am talking/conversing with others, I tend to concentrate on...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer10" class="a" value="A"></label>
							</td>
							<td>
								My vocals toward them.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer10" class="b" value="B"></label>
							</td>
							<td>
								My appearances toward them.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer10" class="c" value="C"></label>
							</td>
							<td>
								How they are feeling about me.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								11.At a social gathering, I enjoy...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer11" class="b" value="B"></label>
							</td>
							<td>
								Standing back and simply "people watching."
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer11" class="a" value="A"></label>
							</td>
							<td>
								Talking in details, with a good talker, about a subject important to me.
							</td>
						</tr>				
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer11" class="c" value="C"></label>
							</td>
							<td>
								Dancing, activities, and games permitting me to lose myself totally in the action.
							</td>
						</tr>				
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								12.I like the movies that...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer12" class="c" value="C"></label>
							</td>
							<td>
								Display action, physical activity, and portray strong emotions.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer12" class="a" value="A"></label>
							</td>
							<td>
								Convey clever dialogue, conversations, one-liners, and insightful comments.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer12" class="b" value="B"></label>
							</td>
							<td>
								Exhibit beautiful scenes, detailed cinematography, special effects, and camera angles.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								13.If I were asked to explain something new to someone, I am comfortable...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer13" class="b" value="B"></label>
							</td>
							<td>
								Writing it down for him/her.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer13" class="a" value="A"></label>
							</td>
							<td>
								Explaining it to him/her.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer13" class="c" value="C"></label>
							</td>
							<td>
								Showing and demonstrating it for him/her.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								14.When someone wants my feedback to an idea, I would prefer hearing the words...
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer14" class="b" value="B"></label>
							</td>
							<td>
								How does all that look to you?
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer14" class="c" value="C"></label>
							</td>
							<td>
								How does all that feel to you?
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer14" class="a" value="A"></label>
							</td>
							<td>
								How does all that sound to you?
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								15.When talking to somebody, I have the hardest time handling those who:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer15" class="a" value="A"></label>
							</td>
							<td>
								Will not talk back to me.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer15" class="b" value="B"></label>
							</td>
							<td>
								Will not maintain good eye contact with me
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer15" class="c" value="C"></label>
							</td>
							<td>
								Do not show any kind of an emotional response.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								16.If somebody is sending an important message to me, I prefer that..
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer16" class="c" value="C"></label>
							</td>
							<td>
								He/she personally delivers the message to me.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer16" class="b" value="B"></label>
							</td>
							<td>
								He/she sends me a written note.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer16" class="a" value="A"></label>
							</td>
							<td>
								He/she discusses it with me over the telephone.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								17.If somebody does not understand my instructions, I am most likely to:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer17" class="b" value="B"></label>
							</td>
							<td>
								Take out a pencil and paper to the white board, show, or illustrate the instructions.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer17" class="c" value="C"></label>
							</td>
							<td>
								Feel irritated, annoyed, and repeat the instructions again.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer17" class="a" value="A"></label>
							</td>
							<td>
								Start over again with the instructions but try to use a different set of words.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								18. When I am expecting an upcoming event or time, I am generally:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer18" class="b" value="B"></label>
							</td>
							<td>
								Imagining in my mind how everything will look.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer18" class="a" value="A"></label>
							</td>
							<td>
								Talking to myself about how everything will be.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer18" class="c" value="C"></label>
							</td>
							<td>
								Experiencing emotions concerning how I will be feeling.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								19. At bedtime, if I have difficulty falling asleep, I would be because of:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer19" class="a" value="A"></label>
							</td>
							<td>
								Noises or sounds that were occurring nearby.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer19" class="b" value="B"></label>
							</td>
							<td>
								Lights that could not be removed.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer19" class="c" value="C"></label>
							</td>
							<td>
								The rough texture of clothes or bed coverings.
							</td>
						</tr>
						<tr>
							<td colspan="3">
								&nbsp;
							</td>
						</tr>
						<tr>
							<th colspan="3">
								20. In my free time, I am most likely to:
							</th>
						</tr>
						<tr>
							<td>
								<label class="radio" for="C">C <input type="radio" name="answer20" class="c" value="C"></label>
							</td>
							<td>
								Exercise, paint, build, fix, or create something with my hands.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="A">A <input type="radio" name="answer20" class="a" value="A"></label>
							</td>
							<td>
								Talk on the phone, play a musical instrument, listen to music, or a talk show.
							</td>
						</tr>
						<tr>
							<td>
								<label class="radio" for="B">B <input type="radio" name="answer20" class="b" value="B"></label>
							</td>
							<td>
								Watch TV, a movie, a live production, read, or write.
							</td>
						</tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Score: </strong></td>
              <td>
                <strong>A</strong>
                <span class="a_results badge badge-info"></span>

                <strong>B</strong>
                <span class="b_results badge badge-info"></span>

                <strong>C</strong>
                <span class="c_results badge badge-info"></span>

                <form action="#" name="XYZ_DATA" id="XYZ_DATA">
                  <input type="hidden" name="lse_X" class="a_results" value="">
                  <input type="hidden" name="lse_Y" class="b_results" value="">
                  <input type="hidden" name="lse_Z" class="c_results" value="">
                  <input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
                </form>
              </td>
            </tr>
					</tbody>
				</table>
			</div>

			<hr>
			<div>
        <table width="100%">
            <tr>
              <td width="50%"><a href="#" id="section4"></a></td>
              <td align="right"><a href="#top">Go to TOP</a></td>
            </tr>
          </table>
				<p><img src="img/sec4.png" alt="sec4" border="0"></p>
				<p>
          <span class="label label-important">Instructions:</span> Read all four values statements in the horizontal rows while thinking about a particular environment such as school, work, or home.Working across from left to right,prioritize the four values statements in aech horizontal row in the order of importance to you.
          <br>
          <br>
        </p>
			</div>
      <div>
        <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-hover table-striped">
 <tbody><tr> <td>No</td>
  <td>F</td>
  <td>S</td>
  <td>I</td>
  <td>R</td>
 </tr>
 <tr>
  <td>1</td>
  <td>To me, "If you don't stand for something, you will fall for
  anything"</td>
  <td>I will put the best effort in anything that I can achieve personal
  pleasure</td>
  <td>I am strongly driven by gaining recognition and doing things in my own
  way</td>
  <td>Even if I suffer, I am very much concerned for the welfare of others</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ1col1" id="rowLEPJ1col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ1col2" id="rowLEPJ1col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ1col3" id="rowLEPJ1col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ1col4" id="rowLEPJ1col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>2</td>
  <td>I will always be loyal, once I have aligned myself to an organization,
  idea and process</td>
  <td>Maintaining harmony is my top priority rather than personal desires</td>
  <td>I will try my best to achieve goals that will enhance my inner
  satisfaction</td>
  <td>I enjoy sharing with others on ideas to improve quality and productivity</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ2col1" id="rowLEPJ2col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ2col2" id="rowLEPJ2col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ2col3" id="rowLEPJ2col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ2col4" id="rowLEPJ2col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>3</td>
  <td>I will follow rules, see things through, are goals oriented and at the
  same time be recognized by my contributions</td>
  <td>I like it when situations always give me a feeling of a good inner peace</td>
  <td>I will adjust circumstances so that I can improve my feelings of
  accomplishment and well being. I would definitely will make the most of it</td>
  <td>I interact well with people. I will treat them nicely, with dignity and
  respect that they deserve</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ3col1" id="rowLEPJ3col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ3col2" id="rowLEPJ3col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ3col3" id="rowLEPJ3col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ3col4" id="rowLEPJ3col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>4</td>
  <td>I am somehow uneasy to changes and prefer things that has worked all the
  while</td>
  <td>I measure people and situation based on what I believe and feel</td>
  <td>I like it when my strengths and abilities are tested by situations and it
  does not restrict my personal freedom</td>
  <td>I like to bring people and ideas together to gain balance and harmony</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ4col1" id="rowLEPJ4col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ4col2" id="rowLEPJ4col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ4col3" id="rowLEPJ4col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ4col4" id="rowLEPJ4col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>5</td>
  <td>To me, it is important to build people trust. A good reputation is very
  important to me</td>
  <td>"Fair play" is important to me. But I dislike situations that
  restrict my expression</td>
  <td>I am very alert and will look for creative solutions to satisfy my
  objectives</td>
  <td>I think I have achieve and apply a good bit of wisdom for all experiences
  that I gained in life</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ5col1" id="rowLEPJ5col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ5col2" id="rowLEPJ5col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ5col3" id="rowLEPJ5col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ5col4" id="rowLEPJ5col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>6</td>
  <td>I will show my loyalty and faith toward principles I believed in</td>
  <td>No matter what I do, I will always consider the needs, wants and rights
  of other people</td>
  <td>I will exercise my influence in any situations and environments wherever
  I am</td>
  <td>I try not to pre judge people and will always be open-minded without
  loosing my inner balance</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ6col1" id="rowLEPJ6col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ6col2" id="rowLEPJ6col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ6col3" id="rowLEPJ6col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ6col4" id="rowLEPJ6col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>7</td>
  <td>Deadline and keeping promises made are always my top priority. I am
  bonded to my words</td>
  <td>I like it when people are pleased with the concern and warmth toward them</td>
  <td>I believe things are made of a certain ways and try to make situations to
  match to my personal goals</td>
  <td>I will stick to what I believe in, but will also put an effort to
  maintain harmony</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ7col1" id="rowLEPJ7col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ7col2" id="rowLEPJ7col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ7col3" id="rowLEPJ7col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ7col4" id="rowLEPJ7col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>8</td>
  <td>To me ethics, honesty and integrity are important</td>
  <td>When approaching people, I will approach them in and open and non
  threatening manner</td>
  <td>My own priorities that I set myself are more important than others
  influences</td>
  <td>I will try to make my words represent reality and reality to represent my
  words</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ8col1" id="rowLEPJ8col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ8col2" id="rowLEPJ8col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ8col3" id="rowLEPJ8col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ8col4" id="rowLEPJ8col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>9</td>
  <td>I approach situations logically rather that emotionally</td>
  <td>I will try my best to establish relationships with others by considering
  their opinions and perspectives</td>
  <td>I can easily spot opportunities that will benefit me and capitalize them</td>
  <td>I will view people and things positively</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ9col1" id="rowLEPJ9col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ9col2" id="rowLEPJ9col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ9col3" id="rowLEPJ9col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ9col4" id="rowLEPJ9col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>10</td>
  <td>Things and situations should remain unchanged. I don't like suprises</td>
  <td>Harmony and accomplishments are the things that I desired as it provide
  personal fulfillment to me</td>
  <td>I like to challenge myself against others. I have standards of my own</td>
  <td>Sharing accomplishments with others on performing duties are the things
  that matters to me</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><select name="rowLEPJ10col1" id="rowLEPJ10col1">
    <option value="0">Choose</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select></td>
  <td>
    <select name="rowLEPJ10col2" id="rowLEPJ10col2">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ10col3" id="rowLEPJ10col3">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
  <td>
    <select name="rowLEPJ10col4" id="rowLEPJ10col4">
      <option value="0">Choose</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </td>
 </tr>
 <tr>
  <td colspan="5">
    <input type="button" id="getresultLEPJ" value="Get Result FSIR" class="btn btn-success">
  
  </td>
 </tr>
 <tr>
  <th></th>
 <th>Faithful <span class="badge badge-info" id="allLEPJCol1"></span></th>
  <th>Similarity <span class="badge badge-info" id="allLEPJCol2"></span></th>
  <th>Individual Liberty <span class="badge badge-info" id="allLEPJCol3"></span></th>
  <th>Righteousness <span class="badge badge-info" id="allLEPJCol4"></span></th>
 </tr>
</tbody></table>
      </div>


			<div>
        <form action="#" id="testAllValue">
					<input type="hidden" name="lepj_L" id="allLEPJDataCol1" value="">
					<input type="hidden" name="lepj_E" id="allLEPJDataCol2" value="">
					<input type="hidden" name="lepj_P" id="allLEPJDataCol3" value="">
					<input type="hidden" name="lepj_J" id="allLEPJDataCol4" value="">

					<input type="hidden" name="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
				</form>

				<input type="button" class="btn btn-primary" id="showReportBtn" value="Get All Score">
			</div>

			</div>
			<!-- test_container -->

			<div id="result_show" style="display:none">
				<!-- <h4>Your Results is:</h4> -->
				<!-- <strong>DISC RESULT</strong> -->

				<!-- <strong>PLS RESULT</strong>  -->

				<!-- <strong>XYZ RESULT</strong> -->

				<!-- <strong>LEPJ RESULT</strong> -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action="#" id="resultValue">
          <input type="hidden" name="disc" id="discResult_txt" value="" /><br>
          <input type="hidden" name="pls" id="plsResult_txt" value="" /><br>
          <input type="hidden" name="xyz" id="clsResult_txt" value="" /><br>
          <input type="hidden" name="lepj" id="lepjResult_txt" value="" /><br>
          <input type="hidden" name="user_id_tester" id="user_id_tester" value="<?php echo @$_SESSION['usr_id']; ?>">
        </form>
        <table width="100%" cellpadding="2" cellspacing="2" border="0" id="score">
          <tr>
            <td align="center" width="25%" height="160px"><span id="discResult"></span></td>
            <td align="center" width="25%"><span id="plsResult"></span></td>
            <td align="center" width="25%"><span id="clsResult"></span></td>
            <td align="center" width="25%"><span id="lepjResult"></span></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center" valign="middle">
              <input type="button" class="btn btn-primary" id="saveNreports" value="Save Result &amp; Show me report" />
            </td>
          </tr>
        </table>
			</div>
		</div>
		<!-- wrapper -->

    <?php include 'footer-sc.php'; ?>

		<!-- Load js from footer to make load fastest -->
    <script src="js/sysMainProApp.js" type="text/javascript"></script>
    <script src="js/sysLITE.js" type="text/javascript"></script>
    <script src="js/sysAPSC.js" type="text/javascript"></script>
    <script src="js/sysXYZ.js" type="text/javascript"></script>
    <script src="js/sysLEPJ.js" type="text/javascript"></script>
	</body>
</html>