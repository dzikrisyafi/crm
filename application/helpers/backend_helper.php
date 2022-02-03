<?php

if (!function_exists("rupiah")) {
	function rupiah($number)
	{
		$format = "Rp " . number_format($number, 2, '.', ',');
		return $format;
	}
}

if (!function_exists("checkSchedule")) {
	function checkSchedule($opportunity_id, $activity_id)
	{
		$ci = get_instance();

		$data = [
			'opportunity_id' => $opportunity_id,
			'activity_id' => $activity_id,
			'is_done' => 0,
		];
		$schedule = $ci->mdl->getWhere('opportunity_id, activity_id', $data, 'activity_schedule');
		return $schedule->num_rows();
	}
}

if (!function_exists("scheduleDate")) {
	function scheduleDate($opportunity_id, $activity_id)
	{
		$ci = get_instance();

		$data = [
			'opportunity_id' => $opportunity_id,
			'activity_id' => $activity_id,
			'is_done' => 0
		];
		$schedule = $ci->mdl->getWhere('expected_closing', $data, 'activity_schedule');
		return $schedule->row_array()['expected_closing'];
	}
}

if (!function_exists("xml_to_array")) {
	function xml_to_array($xml)
	{
		$xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml);
		$xml = simplexml_load_string($xml);
		return json_decode(json_encode($xml), true);
	}
}

if (!function_exists("req_init")) {
	function req_init($ch, $request, $url)
	{
		$ci = get_instance();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8", "Content-Length: " . strlen($request)));
	}
}
