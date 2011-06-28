<?php
require_once('../../inc/coreInc.php');
require_once('../../ext_api/twilio/twilio.php');
require_once('main.php');


// Twilio REST API version
    $ApiVersion = "2010-04-01";

    // Set our AccountSid and AuthToken
    $AccountSid = "ACffda44fe4abce0975dd8cbe6f7af7c03";
    $AuthToken = "6afdff337a268221e64c1bbc6b76a43b";

    // Instantiate a new Twilio Rest Client
    $client = new TwilioRestClient($AccountSid, $AuthToken);




$users = good_query_table("SELECT * FROM users WHERE cell_active = 1");

foreach ($users as $user) {
    $asmt = 0; $proj = 0;
    $agenda = todayAgenda($user['id'], 0);
    foreach ($agenda as $entry) {
        if ($entry['type'] == 1) {
            $asmt ++;
        } elseif ($entry['type'] == 2) {
            $proj++;
        }
    }

    if ($asmt != 0 || $proj != 0) {
       $totalStr = 'You have ';
       // if we have at least one asmt
    if ($asmt != 0) {
        if ($proj != 0) {
            $append = 'and ';
        }
        $totalStr .= $asmt . ' assignments ' . $append;
    }

    // if we have at least one project
    if ($proj != 0) {
        $totalStr .= $proj . ' projects ';
    }

    $totalStr .= 'scheduled for today. Login to ClassConnect for more info.';
echo $user['first_name'] . ' ' . $user['last_name'] . ' - ' . $user['cell'] . '<br />';
    echo $totalStr;


            // Send a new outgoinging SMS by POST'ing to the SMS resource
        // YYY-YYY-YYYY must be a Twilio validated phone number
        $response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages",
            "POST", array(
            "To" => $user['cell'],
            "From" => "310-697-8024",
            "Body" => $totalStr
        ));
        if($response->IsError)
            echo "Error: {$response->ErrorMessage}";
        else
            echo "Message sent successfully";



    }

}




?>