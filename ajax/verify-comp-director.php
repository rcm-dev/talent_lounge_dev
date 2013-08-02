<?php 

/**
 * Database
 */

include '../db/db-connect.php';

if ($_POST) {


	$icdirector 	= $_POST['icdirector'];
	$conum 			= $_POST['conum'];


	/**
	 * 
	 * 
	 * 
	 */
	$sqlconum = "SELECT
	  _company.comp_name,
	  _company.comp_id As CompanyID,
	  _company.comp_co_num
	From
	  _company
	Where
	  _company.comp_co_num = '$conum'";



	$result = mysql_query($sqlconum);
	$rowconum = mysql_fetch_object($result);

	// Set FK companyID to vefiry the company_fk in director table
	$com_id = $rowconum->CompanyID;


	/**
	 * 
	 * 
	 * 
	 */
	$sqlDIrector = "SELECT
	  _company_director._cd_name,
	  _company_director._cd_ic,
	  _company_director._comp_id_fk
	From
	  _company_director
	Where
	  _company_director._cd_ic = '$icdirector' And
	  _company_director._comp_id_fk = '$com_id'";

	 $resultsqlDirector = mysql_query($sqlDIrector);
	 $numrow = mysql_num_rows($resultsqlDirector);


	if ($numrow == 1) {
		
		echo $numrow;

	} else {
		
		echo 0;

	}


}


?>