<?php
session_start();
$meeting_time=$_POST['meeting_time'];

var_dump($meeting_time);

require_once 'vendor/autoload.php';
 
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
 
define('ZOOM_API_KEY', 'b6cmPJIuTdCFU0vLOTKU8Q');
define('ZOOM_SECRET_KEY', '8tOFEncOZPvDX371GiO5iKVmkefhOCjsfASt');


function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
    return JWT::encode($payload, $key);    
}

function createZoomMeeting() {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.zoom.us',
    ]);
 
    $response = $client->request('POST', '/v2/users/me/meetings', [
        "headers" => [
            "Authorization" => "Bearer " . getZoomAccessToken()
        ],
        'json' => [
            "topic" => "面談",
            "type" => 2,
            "start_time" =>$meeting_time,
            // "start_time" => "2021-04-01T20:30:00",もともとの設定
            "duration" => "60", // 30 mins
            "password" => "123456"
        ],
    ]);
 
    $data = json_decode($response->getBody());
    // echo "Join URL:". $data->join_url;
    $url=$data->join_url;
    echo "<a href=",$url,">$url</a>";
    echo "<br>";
    echo "Meeting Password: ". $data->password;
    echo "<br>";

    echo "Meeting ID: ".$data->id;

    // $meeting_id = $data->id;
}
 
createZoomMeeting();

$client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
 
$response = $client->request('GET', '/v2/users/me/meetings', [
    "headers" => [
        "Authorization" => "Bearer ". getZoomAccessToken()
    ]
]);
 



//現在のMEETINGをリスト化。今は使わないので無効化にしておく
// $data = json_decode($response->getBody());
 
// if ( !empty($data) ) {
//     foreach ( $data->meetings as $d ) {
//         $topic = $d->topic;
//         $join_url = $d->join_url;
//         echo "<div>";
//         echo "<h3>Topic: $topic</h3>";
//         echo "Join URL: <a href=".$join_url;"> $join_url</a>";
//         echo "</div>";

//         // echo "Join URL: $join_url";
//     }
// }


//MEETINGの削除機能
function deleteZoomMeeting($meeting_id) {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.zoom.us',
    ]);
 
    $response = $client->request("DELETE", "/v2/meetings/$meeting_id", [
        "headers" => [
            "Authorization" => "Bearer " . getZoomAccessToken()
        ]
    ]);
 
    if (204 == $response->getStatusCode()) {
        echo "Meeting deleted.";
    }
}
 
deleteZoomMeeting('MEETING_ID_HERE');
