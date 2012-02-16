<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* Volunteer class for Homecheck
* @author Alex Edison
* @version February 12, 2012
*/

class Report{
	private $id;  //Date span for the report: "yy-mm-dd to yy-mm-dd"
	private $status;  //Status of report: "unpublished", "published", "archived"
	private $startDate;
	private $endDate;
	//Other fields may need to be added
	
	/**
	 * 
	 * Constructor for Report
	 */
	
	function __construct($startDate, $endDate, $reportStatus){
		$this->id = $startDate.' to '.$endDate;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
		$this->status = $reportStatus;
	}
	
	//Getters
	function get_id(){
		return $this->id;
	}
	
	function get_status(){
		return $this->status;
	}
	
}

?>