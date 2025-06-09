<?php
require_once "auth.php";

if (!checkAuth()) exit;

header('Content-Type: application/json');

function spotify() {
    $client_id = "secret";
    $client_secret = "secret";
    $artist_name = "BTS";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
    $token = json_decode(curl_exec($ch), true);
    curl_close($ch);    

    if (!isset($token['access_token'])) {
        echo json_encode(['error' => 'Failed to get access token']);
        return;
    }

    $query = urlencode($artist_name);
    $url = 'https://api.spotify.com/v1/search?type=artist&q='.$query.'&limit=1';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $artist_res = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $artist_id = $artist_res['artists']['items'][0]['id'];

    $limit = 6;
    $url = 'https://api.spotify.com/v1/artists/'.$artist_id.'/albums?limit='.$limit.'&include_groups=album,single&market=US';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $albums_res = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $albums_with_details = [];
    foreach ($albums_res['items'] as $album) {
        $url = 'https://api.spotify.com/v1/albums/'.$album['id'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
        $album_details = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $image_url = '';
        foreach ($album['images'] as $image) {
            if ($image['height'] == 640 || $image['height'] == 300) {
                $image_url = $image['url'];
                break;
            }
        }
        if (empty($image_url) && !empty($album['images'])) {
            $image_url = $album['images'][0]['url'];
        }
    
        $total_ms = 0;
        foreach ($album_details['tracks']['items'] as $track) {
            $total_ms += $track['duration_ms'];
        }
        $total_seconds = floor($total_ms / 1000);
        $minutes = floor($total_seconds / 60);
        $seconds = $total_seconds % 60;
        $paddedSeconds = ($seconds < 10) ? "0" . $seconds : "" . $seconds;

        $duration = $minutes . ":" . $paddedSeconds;

        $albums_with_details[] = [
            'album' => $album,
            'albumInfo' => [
                'tracks' => $album_details['tracks'],
                'duration' => $duration,
                'track_count' => count($album_details['tracks']['items']),
                'image_url' => $image_url
            ]
        ];
    }

    echo json_encode($albums_with_details);
}

spotify();
?>