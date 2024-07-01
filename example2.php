<?php
declare (strict_types = 1);

use Ax7Cmd\Sumsub\SumsubClient;

require_once __DIR__ . '/vendor/autoload.php';

// The description of the authorization method is available here: https://developers.sumsub.com/api-reference/#app-tokens
// Don't forget to change token and secret key values to production ones when switching to production
const SUMSUB_SECRET_KEY = '8LDsUq0zglOSe1igaETW9gWPOuc8QKoN'; // Example: Hej2ch71kG2kTd1iIUDZFNsO5C1lh5Gq
const SUMSUB_APP_TOKEN = 'sbx:ogAXnzjReZZzR9uZKiJTIwBh.IkbdJLJhBs3I19U33CiDQopdN71TVz2b'; // Example: sbx:uY0CgwELmgUAEyl4hNWxLngb.0WSeQeiYny4WEqmAALEAiK2qTC96fBad

// The description of the flow can be found here: https://developers.sumsub.com/api-flow/#api-integration-phases

// Such actions are presented below:
// 1) Creating an applicant
// 2) Adding a document to the applicant
// 3) Getting applicant status
// 4) Getting access token

$applicantId = '668258b602f4316688d07f48';
$testObject = new SumsubClient(SUMSUB_APP_TOKEN, SUMSUB_SECRET_KEY);

$applicantData = $testObject->getApplicantData($applicantId);
echo 'Applicant data (json): ' . json_encode($applicantData, JSON_PRETTY_PRINT) . PHP_EOL;
echo '<hr>';
echo $applicantData['inspectionId'];
echo '<hr>';
$applicantStatus = $testObject->getApplicantStatus($applicantId);
echo 'Applicant status (json): ' . json_encode($applicantStatus, JSON_PRETTY_PRINT) . PHP_EOL;
echo '<hr>';
echo $applicantStatus['IDENTITY']['imageIds'][0];
echo '<hr>';
$getDocumentImage = $testObject->getDocumentImage($applicantData['inspectionId'], (string) $applicantStatus['IDENTITY']['imageIds'][0]);
echo '<img src="data:image/png;base64,' . $getDocumentImage . '" alt="An elephant" />';
