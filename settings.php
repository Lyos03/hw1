<?php
require_once "auth.php";
require_once "functions.php";

if (!$userid = checkAuth()) {
    header("Location: index.php");
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Weverse</title>

    <link rel="stylesheet" href="src_used/hdr/hdr.css">
    <link rel="stylesheet" href="src_used/settings/settings.css">
    <link rel="stylesheet" href="src_used/global/styles.css">


    <script src="src_used/hdr/hdrNotification.js" defer></script>
    <script src="src_used/hdr/hdrSearch.js" defer></script>
    <script src="src_used/settings/settings.js" defer></script>
    <script src="src_used/global/dark-mode_controller.js" defer></script>
    <script src="src_used/global/GeneralFunctions.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="Global_header">
        <header class="header">
            <div class="header_service_container">
                <h1 class="header_logo">
                    <a class="logo" href="index.php"></a>
                </h1>
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
                    <div id="header_bar_settings_icon" class="header_bar_icon settings_icon_black"></div>
                </a>


            </div>
        </header>
    </div>
    <div class="body">
        <div class="Settings_container">
            <div class="Settings_inner_area">
                <h2 class="Settings_title">Settings</h2>
                <div class="Settings_groups_container">
                    <div id="Display_settings" class="Settings_group">
                        <span class="Settings_group_sub_title">Display</span>
                        <div class="Settings_group_options">
                            <span id="DarkMode" class="Group_option_text">Dark Mode</span>
                            <button id="DarkMode_button" class="Group_option_button" data-toggled="false">OFF</button>
                        </div>

                    </div>
                    <div id="Other_settings" class="Settings_group">
                        <span class="Settings_group_sub_title">Other Options</span>
                        <div id="MoreOptions" class="Settings_group_options">
                            <p> More Options are in development </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>