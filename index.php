<?php
/**
 * Campaign: Github - Test
 * Created: 2019-11-06 10:47:07 UTC
 */

require 'leadcloak-ubfzct37f29.php';

// ---------------------------------------------------
// Configuration

// Set this to false if application is properly installed.
$enableDebugging = true;

// Set this to false if you won't want to log error messages
$enableLogging = true;

// Set this to true if want to use landing page rotator
$useLPR = false;

// Set this to the locaiton of the safe page you want to display
$pathToSafePage = 'index1.html';

// Set this to the location of the money page you want to display
$pathToMoneyPage = 'm.html';

// Allows for modded query strings
$myQueryString = [];

parse_str($_SERVER['QUERY_STRING'], $myQueryString);

/**
 *  Add or Modify Query String Variables in the section below.
 *  WARNING: Variables with the same name will be re-written
 */
// Ex.: $myQueryString['my_custom_variable'] = 'my custom variable';

if ($enableDebugging) {
	isApplicationReadyToRun();
}

$data = httpRequestMakePayload($campaignId, $campaignSignature, $useLPR);

$response = httpRequestExec($data);

$handler = httpHandleResponse($response, $enableLogging);

if ($useLPR) {
	if ($handler) {
		require $handler;
		exit();
	}
	header("HTTP/1.0 404 Not Found");
	exit();
} else {
	if ($handler) {
		require $pathToMoneyPage;
		exit();
	} else {
		require $pathToSafePage;
		exit();
	}
}
?>