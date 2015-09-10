<?php

namespace opensrs\domains\lookup;

use OpenSRS\Base;
use OpenSRS\Exception;

/*
 *  Required object values:
 *  - none -
 *
 *  Optional Data:
 *  data - owner_email, admin_email, billing_email, tech_email, del_from, del_to, exp_from, exp_to, page, limit
 */

class GetDeletedDomains extends Base {
	private $_dataObject;
	private $_formatHolder = "";
	public $resultFullRaw;
	public $resultRaw;
	public $resultFullFormatted;
	public $resultFormatted;

	public function __construct($formatString, $dataObject) {
		parent::__construct();
		$this->_dataObject = $dataObject;
		$this->_formatHolder = $formatString;
		$this->_validateObject();
	}

	public function __destruct() {
		parent::__destruct();
	}

	// Validate the object
	private function _validateObject(){
		// Maybe all attribute array should be compiled here
		if (isset($this->_dataObject->data->owner_email)) {
			// Verify proper email
		}
		if (isset($this->_dataObject->data->admin_email)) {
			// Verify proper email
		}
		if (isset($this->_dataObject->data->billing_email)) {
			// Verify proper email
		}
		if (isset($this->_dataObject->data->tech_email)) {
			// Verify proper email
		}
		if (isset($this->_dataObject->data->del_from)) {
			// verify format - "2000-10-10" - YYYY-MM-DD
		}
		if (isset($this->_dataObject->data->del_to)) {
			// verify format - "2000-10-10" - YYYY-MM-DD
		}
		if (isset($this->_dataObject->data->exp_from)) {
			// verify format - "2000-10-10" - YYYY-MM-DD
		}
		if (isset($this->_dataObject->data->exp_to)) {
			// verify format - "2000-10-10" - YYYY-MM-DD
		}
		if (isset($this->_dataObject->data->page)) {
			// verify format - positive number
		}
		if (isset($this->_dataObject->data->limit)) {
			// verify format - postive number
		}

		// Execute the command
		$this->_processRequest();
	}

	// Post validation functions
	private function _processRequest(){
		$cmd = array(
			"protocol" => "XCP",
			"action" => "GET_DELETED_DOMAINS",
			"object" => "domain",
			"attributes" => array()
			);
		
		// Command optional values
		if (isset($this->_dataObject->data->owner_email) && $this->_dataObject->data->owner_email != "") {
			$cmd['attributes']['owner_email'] = $this->_dataObject->data->owner_email;
		}
		if (isset($this->_dataObject->data->admin_email) && $this->_dataObject->data->admin_email != "") {
			$cmd['attributes']['admin_email'] = $this->_dataObject->data->admin_email;
		}
		if (isset($this->_dataObject->data->billing_email) && $this->_dataObject->data->billing_email != "") {
			$cmd['attributes']['billing_email'] = $this->_dataObject->data->billing_email;
		}
		if (isset($this->_dataObject->data->tech_email) && $this->_dataObject->data->tech_email != "") {
			$cmd['attributes']['tech_email'] = $this->_dataObject->data->tech_email;
		}
		if (isset($this->_dataObject->data->del_from) && $this->_dataObject->data->del_from != "") {
			$cmd['attributes']['del_from'] = $this->_dataObject->data->del_from;
		}
		if (isset($this->_dataObject->data->del_to) && $this->_dataObject->data->del_to != "") {
			$cmd['attributes']['del_to'] = $this->_dataObject->data->del_to;
		}
		if (isset($this->_dataObject->data->exp_from) && $this->_dataObject->data->exp_from != "") {
			$cmd['attributes']['exp_from'] = $this->_dataObject->data->exp_from;
		}
		if (isset($this->_dataObject->data->exp_to) && $this->_dataObject->data->exp_to != "") {
			$cmd['attributes']['exp_to'] = $this->_dataObject->data->exp_to;
		}
		if (isset($this->_dataObject->data->page) && $this->_dataObject->data->page != "") {
			$cmd['attributes']['page'] = $this->_dataObject->data->page;
		}
		if (isset($this->_dataObject->data->limit) && $this->_dataObject->data->limit != "") {
			$cmd['attributes']['limit'] = $this->_dataObject->data->limit;
		}

		// Flip Array to XML
		$xmlCMD = $this->_opsHandler->encode( $cmd );
		// Send XML
		$XMLresult = $this->send_cmd( $xmlCMD );
		// Flip XML to Array
		$arrayResult = $this->_opsHandler->decode( $XMLresult );

		// Results
		$this->resultFullRaw = $arrayResult;
		if ( isset( $arrayResult['attributes'] ) ) {
			$this->resultRaw = $arrayResult['attributes'];
		} else {
			$this->resultRaw = $arrayResult;
		}
		$this->resultFullFormatted = $this->convertArray2Formatted( $this->_formatHolder, $this->resultFullRaw );
		$this->resultFormatted = $this->convertArray2Formatted( $this->_formatHolder, $this->resultRaw );
	}
}