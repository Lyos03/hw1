<?php
require_once "auth.php";
require_once "functions.php";

$community_name = "BTS";
$community_id = searchCommunityId($community_name);
$communityInfo = getCommunityInfo($community_id);

$userId = checkAuth();
if (!$userId || !checkSubscription($userId, $community_id)) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Weverse - <?php echo $community_name ?></title>

    <link rel="stylesheet" href="src_used/communityMedia/communityMedia.css">
    <link rel="stylesheet" href="src_used/hdr/hdr.css">
    <link rel="stylesheet" href="src_used/communityFeed/communityFeed_modals/ReactModal.css">
    <link rel="stylesheet" href="src_used/global/GenericModal.css">
    <link rel="stylesheet" href="src_used/global/communities.css">
    <link rel="stylesheet" href="src_used/global/styles.css">
    
    <link rel="stylesheet" href="src_used/communityMedia/communityMedia_modals/MediaModal.css">


    <script src="src_used/global/GeneralFunctions.js" defer></script>
    <script src="src_used/hdr/hdrNotification.js" defer></script>
    <script src="src_used/hdr/hdrSearch.js" defer></script>
    <script src="src_used/communityMedia/ytPlayer_ThumbnailAPI.js" defer></script>
    <script src="src_used/communityMedia/spotify_API.js" defer></script>
    <script src="src_used/communityMedia/communityMedia_modals/communityMedia_mediaModal.js" defer></script>
    <script src="src_used/communityMedia/musicInfo.js" defer></script>
    <script src="src_used/global/dark-mode_controller.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body data-force-dark="true">
    <div class="Global_header">
        <header class="header">
            <div class="header_service_container">
                <h1 class="header_logo">
                    <a class="logo" href="index.php"></a>
                </h1>
                <h2 class="header_community">
                    <?php echo $community_name ?>
                </h2>
            </div>

            <div class="header_bar">
                <button id="header_bar_search_container" class="containers">
                    <div class="searchBar_container hidden">
                        <div class="searchBar_box">
                            <div class="searchBar_search_button">
                                <div id="searchBar_search_icon" class="header_bar_icon search_icon_black "></div>
                            </div>
                            <input id="search_input" placeholder="Search Artists">
                            <div id="searchBar_search_clear_button">
                                <div class="clearButton_background">
                                    <div class="clearButton_foreground">x</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="header_bar_search_icon" class="header_bar_icon search_icon_black"></div>
                </button>

                <button id="header_bar_notifications_container" class="containers">
                    <div id="header_bar_notifications_icon" class="header_bar_icon notifications_icon_black"></div>
                    <div class="header_bar_notifications_menu hidden">
                        <div class="notifications_menu_container">
                            <h2 class="notifications_menu_title">
                                Notifications
                            </h2>
                            <div class="notifications_menu_area">
                                <div class="notifications_list_container">
                                    <div class="notifications_list_date">
                                        Today
                                    </div>
                                    <div class="notifications_list">
                                        <div class="notifications_item_container">
                                            <img class="Artist_logo"
                                                src="https://phinf.wevpstatic.net/MjAyMzA1MzBfMTkg/MDAxNjg1NDU3ODk5MDE0.FKKdn9RYRUJ25lqMga8pdd42p1Pb335WN9Rgr47uqVcg.LbmfkK-VlDQRN0rKZjuHZuzPZxX78tQr4PvCCef0CGog.JPEG/f6902dd4-b005-466b-921b-5d51aeff4ab5.jpeg?type=s86">
                                            <p class="notifications_text"> this is an example of a notification</p>
                                        </div>
                                        <div class="notifications_item_container">
                                            <img class="Artist_logo"
                                                src="https://phinf.wevpstatic.net/MjAyMzA1MzBfMTkg/MDAxNjg1NDU3ODk5MDE0.FKKdn9RYRUJ25lqMga8pdd42p1Pb335WN9Rgr47uqVcg.LbmfkK-VlDQRN0rKZjuHZuzPZxX78tQr4PvCCef0CGog.JPEG/f6902dd4-b005-466b-921b-5d51aeff4ab5.jpeg?type=s86">
                                            <p class="notifications_text"> this is an example of a notification</p>
                                        </div>
                                        <div class="notifications_item_container">
                                            <img class="Artist_logo"
                                                src="https://phinf.wevpstatic.net/MjAyNDEwMDdfMjgz/MDAxNzI4MjI3MDgzNTkx.HUy2senDpT-jSoMJoFRMARxDukXsQpgqSNM4xxTFHN0g.k5O6yH_F5Wop1dhMzf8nB-rirj2yKh7_eMwZjSz6nikg.JPEG/e67fc3ed-10b4-400e-8534-c26ffd38f8d2.jpeg?type=s86">
                                            <p class="notifications_text"> this is an example of a notification</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>

                <a id="header_bar_account_container" class="containers" href="account.php">
                    <div id="header_bar_account_icon" class="header_bar_icon account_icon_black"></div>
                </a>

                <a id="header_bar_settings_container" class="containers" href="settings.php">
                    <div id="header_bar_settings_icon" class="header_bar_icon settings_icon_black">
                    </div>
                </a>
            </div>
        </header>
    </div>
    <div class="body">
        <div class="Community_navigation_container">

            <nav class="Community_navigation_bar">
                <a class="Community_navigation_link" href="<?php echo $communityInfo["community_feed_link"] ?>">
                    <span class="Community_navigation_tab">
                        Fan
                    </span>
                </a>
                <a class="Community_navigation_link" href="<?php echo $communityInfo["community_media_link"] ?>">
                    <span class="Community_navigation_tab">
                        <span class="Community_navigation_tab-selected">Media</span>
                    </span>

                </a>
            </nav>
        </div>
        <div class="Community_media_container">
            <div class="MediaAudio_content_container Media_content_container">
                <h3 class="MediaAudio_title Media_title"> Latest Albums</h3>
                <div class="MediaAudio_list Media_list">
                </div>
            </div>
            <div class="MediaVideo_content_container Media_content_container">
                <h3 class="MediaVideo_title Media_title"> Latest Videos</h3>
                <div class="MediaVideo_list Media_list">
                </div>
            </div>
        </div>

    </div>
    <div id="MediaModal_container" class="modalOverlay hidden">
        <div class="MediaModal modal">
            <div class="MediaModal_content_container">
                <div class="Player_container">
                    <iframe class="YouTubePlayer_iframe" src="" title="YouTube video player" frameborder="0"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                <div class="MediaModal_content_text"></div>
            </div>

            <button class="CloseButton_container">
                <div class="CloseButton_text">CLOSE</div>
            </button>
        </div>
    </div>
</body>


</html>