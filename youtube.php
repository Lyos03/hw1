<?php
require_once "auth.php";

if (!checkAuth()) exit;

header('Content-Type: application/json');

function youtubeThumbnails() {
    $YT_API_KEY = "secret";
    $channelId = "UCLkAepWjdylmXSltofFvsYQ";
    $maxResults = 8;

    $url = 'https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id='.$channelId.'&key='.$YT_API_KEY;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $channelData = json_decode($response, true);
    
    if (!isset($channelData['items'])) {
        echo json_encode(['error' => 'Channel not found']);
        return;
    }

    $uploadsPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

    $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$uploadsPlaylistId.'&maxResults='.$maxResults.'&key='.$YT_API_KEY;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $playlistData = json_decode($response, true);

    echo json_encode($playlistData);
}

youtubeThumbnails();
?>