<?php

class NexmoInbound
{
	public $type = '';
	public $to = '';
	public $from = '';
	public $network = '';
	public $message_id = '';
	public $status = '';
	public $text = '';
	public $received_time = 0;    // Format: UNIX timestamp


	public function __construct ($data = false) {
		if (!$data) $data = $_GET;

		if (!isset($data['type'], $data['to'], $data['messageId'])) {
			return;
		}

		// Get the relevant data
		$this->type = $data['type'];
		$this->to = $data['to'];
		$this->from = $data['msisdn'];
		$this->message_id = $data['messageId'];
		$this->text = $data['text'];

		// Format the date into timestamp
		//$dp = date_parse_from_format('ymdGi', $data['message-timestamp']);
		//$this->received_time = mktime($dp['hour'], $dp['minute'], $dp['second'], $dp['month'], $dp['day'], $dp['year']);
	}
}

?>