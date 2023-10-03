<?php
$res = array();

$subject = "";
$name = "";
$tel = "";
$email = "";
$promocode = "";
$comments = "";

if (!empty($_POST['theme'])) {
    $theme = $_POST['theme'];
}

if (!empty($_POST['name'])) {
    $name = "name: " . $_POST['name'] . "\r\n";
}

if (!empty($_POST['tel'])) {
    $tel = "tel: " . $_POST['tel'] . "\r\n";
}

if (!empty($_POST['email'])) {
    $email = "email: " . $_POST['email'] . "\r\n";
}

if (!empty($_POST['promocode'])) {
    $promocode = "promocode: " . $_POST['promocode'] . "\r\n";
}

if (!empty($_POST['comments'])) {
    $comments = "comments: " . $_POST['comments'] . "\r\n";
}

$message = $name . $tel . $email . $promocode . $comments;

// IAM API endpoint to get the IAM token
$iamApiEndpoint = "https://iam.api.cloud.yandex.net/iam/v1/tokens";
$iamTokenData = array(
    "yandexPassportOauthToken" => "y0_AgAEA7qkckjEAATuwQAAAADpzKn7PPMgp-I1Rzm3CmHNJcGiFzJBmK0"
);

$iamCurl = curl_init($iamApiEndpoint);
curl_setopt($iamCurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($iamCurl, CURLOPT_POST, true);
curl_setopt($iamCurl, CURLOPT_POSTFIELDS, json_encode($iamTokenData));
curl_setopt($iamCurl, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json"
));

$iamResponse = curl_exec($iamCurl);
$iamResponseData = json_decode($iamResponse, true);

if (isset($iamResponseData["iamToken"])) {
    $iamToken = $iamResponseData["iamToken"];

    // API endpoint
    $apiEndpoint = "https://api.tracker.yandex.net/v2/issues/";

    // JSON data to be sent in the POST request
    $data = array(
        "summary" => $theme,
        "description" => $message,
        "queue" => array(
            "id" => "5",
            "key" => "SALES"
        )
    );

    // Initialize cURL session for the main API call
    $apiCurl = curl_init($apiEndpoint);
    curl_setopt($apiCurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($apiCurl, CURLOPT_POST, true);
    curl_setopt($apiCurl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($apiCurl, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $iamToken,
        "X-Cloud-Org-Id: bpf02dtv9mfn8ojd7rq1",
        "Content-Type: application/json"
    ));

    // Execute cURL session for the main API call
    $apiResponse = curl_exec($apiCurl);

    // Check for cURL errors
    if (curl_errno($apiCurl)) {
        array_push($res, ["success" => "false"]);
        echo json_encode($res);
    }

    // Close cURL session for the main API call
    curl_close($apiCurl);

    array_push($res, ["success" => "true", "token1" => $iamToken]);
    // Print the response
    echo json_encode($res);
} else {
    array_push($res, ["success" => "false"]);
    echo json_encode($res);
}

// Close cURL session for the IAM API call
curl_close($iamCurl);
?>