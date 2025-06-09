<?php
require_once "auth.php";
require_once "functions.php";

$community_name = "BTS";
$community_id = searchCommunityId($community_name);
$communityInfo = getCommunityInfo($community_id);
$communityMembersCount = getCommunityMembersCount($community_id);

if ($userid = checkAuth()) {
    $isSubscribed = checkSubscription($userid, $community_id);

    if ($isSubscribed) {
        $memberInfo = getCommunityMemberInfo($userid, $community_id);
        $userPostsCount = getUserPostsCount($userid, $community_id);
    }

    $posts = [];
    $posts = getPosts($community_id);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Weverse - <?php echo $community_name ?></title>

    <link rel="stylesheet" href="src_used/communityFeed/communityFeed.css">
    <link rel="stylesheet" href="src_used/communityFeed/communityFeed_guest.css">
    <link rel="stylesheet" href="src_used/hdr/hdr.css">
    <link rel="stylesheet" href="src_used/global/GenericModal.css">
    <link rel="stylesheet" href="src_used/global/communities.css">
    <link rel="stylesheet" href="src_used/global/styles.css">

    <script src="src_used/global/GeneralFunctions.js" defer></script>
    <script src="src_used/global/visualButton.js" defer></script>
    <script src="src_used/global/dark-mode_controller.js" defer></script>

    <?php if ($userid && $isSubscribed): ?>
        <link rel="stylesheet" href="src_used/communityFeed/communityFeed_modals/ReactModal.css">
        <link rel="stylesheet" href="src_used/communityFeed/communityFeed_modals/EditorModal.css">

        <script src="src_used/communityFeed/communityFeed_modals/communityFeed_postModal.js" defer></script>
        <script src="src_used/communityFeed/communityFeed_modals/communityFeed_editorModal.js" defer></script>

        <script src="src_used/communityFeed/CreateNewPost.js" defer></script>

        <script src="src_used/hdr/hdrNotification.js" defer></script>
        <script src="src_used/hdr/hdrSearch.js" defer></script>

    <?php endif; ?>

    <?php if ($userid && !$isSubscribed): ?>
        <link rel="stylesheet" href="src_used/communityFeed/communityFeed_modals/JoinModal.css">
        <script src="src_used/communityFeed/communityFeed_modals/communityFeed_joinModal.js" defer></script>
    <?php endif; ?>

    <?php if (!$userid): ?>
        <link rel="stylesheet" href="src_used/communityFeed/communityFeed_modals/LoginModal.css">
        <script src="src_used/communityFeed/communityFeed_modals/communityFeed_loginModal.js" defer></script>
    <?php endif; ?>


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
                <?php if ($userid): ?>
                    <h2 class="header_community">
                        <?php echo $community_name ?>
                    </h2>
                <?php endif; ?>
            </div>

            <div class="header_bar">

                <?php if (!$userid): ?>
                    <div id="header_bar_signin_container" class="containers">
                        <a id="signInButton" href="signin.php">Sign In</a>
                    </div>
                <?php endif; ?>

                <?php if ($userid): ?>
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
                <?php endif; ?>
            </div>
        </header>
    </div>
    <div class="body">
        <div class="Community_navigation_container">
            <nav class="Community_navigation_bar">
                <a class="Community_navigation_link" <?php if ($userid): ?>
                        href="<?php echo $communityInfo["community_feed_link"] ?>" <?php endif; ?>>
                    <span class="Community_navigation_tab">
                        <span class="Community_navigation_tab-selected">Fan</span>

                    </span>
                </a>
                <a class="Community_navigation_link" <?php if ($userid && $isSubscribed): ?>
                        href="<?php echo $communityInfo["community_media_link"] ?>" <?php endif; ?>>
                    <span class="Community_navigation_tab">
                        Media
                    </span>
                </a>
            </nav>
        </div>
        <div class="Community_content_container">

            <div class="Community_top_container">
                <div class="Community_welcome_container">
                    <img class="Artist_cover_image" src="<?php echo $communityInfo["cover_image"] ?>">
                    <div class="Community_info_container">
                        <div class="Community_text_container">
                            <?php if ($userid): ?>
                                <div class="Community_members">
                                    <?php echo $communityMembersCount . ' ' . ($communityMembersCount === 1 ? "Member" : "Members") ?>
                                </div>
                            <?php endif; ?>
                            <div class="Community_name"><?php echo $community_name ?> </div>
                        </div>
                    </div>
                </div>

                <div class="PersonalProfile_container">
                    <?php if ($userid): ?>
                        <?php if ($isSubscribed): ?>
                            <div class="ProfileImage_container">
                                <img class="ProfileImage"
                                    src="<?php echo $memberInfo["profile_picture"] ?? 'media_used/ProfileImages/icon_empty_profile.png'; ?>">
                            </div>
                            <div class="Profile_nickname"> <?php echo $memberInfo["display_name"] ?></div>
                            <div class="Profile_userPostsCount">
                                <div class="Profile_userPostsCount">
                                    <?php echo $userPostsCount . ' ' . ($userPostsCount === 1 ? "post" : "posts") ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="NotSubscribed_message">Not yet subscribed</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="LoginRequired_button">
                            <strong class="LoginRequiredButton_text">Log in required for user</strong>
                        </button>
                    <?php endif; ?>
                </div>

            </div>

            <div class="Feed_content_container">
                <?php if ($userid): ?>
                    <?php if ($isSubscribed): ?>
                        <div class="Input_bar_container">
                            <div class="Input_bar_text_container div_as_button">
                                <div class="ProfileImage_container">
                                    <img class="ProfileImage"
                                        src="<?php echo $memberInfo["profile_picture"] ?? 'media_used/ProfileImages/icon_empty_profile.png'; ?>">
                                </div>
                                <div class="Input_bar_text_area">
                                    Write a post on Weverse
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="FeedPost_container">
                        <div class="FeedPost_list">

                            <?php foreach ($posts as $post): ?>
                                <div class="Post_item_container">
                                    <div class="PostHeader_container">
                                        <div class="PostHeader_profile_container">
                                            <a class="PostHeader_profileImage_container">
                                                <img class="ProfileImage"
                                                    src="<?php echo $post['profile_picture'] ?? 'media_used/ProfileImages/icon_empty_profile.png'; ?>">
                                            </a>
                                            <div class="PostHeader_profileText_container">
                                                <a class="ProfielLink">
                                                    <div class="Profile_nickname_container">
                                                        <div class="Profile_nickname">
                                                            <?php echo $post['display_name']; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="PostItem_content_container">
                                        <div class="PostItem_text_container">
                                            <p class="PostItem_text">
                                                <?php echo nl2br($post['content']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="PostItem_button_container">
                                        <div class="Button_group_container">
                                            <button class="LikeButton Button_item_container"
                                                data-liked="<?php echo hasUserLikedPost($userid, $post['id']) ? 'true' : 'false'; ?>"
                                                data-likes="<?php echo getPostLikesCount($post['id']); ?>"
                                                data-post-id="<?php echo $post['id']; ?>">
                                                <img class="LikeButton_icon Button_icon"
                                                    src="<?php echo hasUserLikedPost($userid, $post['id']) ?
                                                        "media_used/CommunityFeed/CommonIcons/weverse_like_icon_on(remastered).png" :
                                                        (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true' ?
                                                            "media_used/CommunityFeed/CommonIcons/weverse_like_icon_off_white.png" :
                                                            "media_used/CommunityFeed/CommonIcons/weverse_like_icon_off.png"); ?>">
                                                <span class="LikeButton_count Reaction_count">
                                                    <?php $postLikeCount = getPostLikesCount($post['id']);
                                                    echo $postLikeCount > 0 ? $postLikeCount : ''; ?>
                                                </span>
                                            </button>
                                            <button class="CommentButton Button_item_container">
                                                <img class="CommentButton_icon Button_icon" src="<?php echo (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true') ?
                                                    'media_used/CommunityFeed/CommonIcons/weverse_comment_icon_white.png' :
                                                    'media_used/CommunityFeed/CommonIcons/weverse_comment_icon.png'; ?>">
                                                <span class="CommentButton_count Reaction_count">
                                                    <?php $commentCount = getCommentsCount($post['id']);
                                                    echo $commentCount > 0 ? $commentCount : ''; ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>
                        <button class="LoginRequired_button">
                            <strong class="LoginRequiredButton_text">You need to log in</strong>
                        </button>
                    <?php endif; ?>


                </div>


            </div>
            <?php if (!$userid || !$isSubscribed): ?>
                <div class="UserJoinPrompt_container">
                    <div class="UserJoinPrompt_content">
                        <div class="UserJoinPrompt_text_area">
                            <p class="UserJoinPrompt_text">
                                <?php if (!$userid): ?>
                                    Only community members can see the content in full!
                                <?php else: ?>
                                    Join the community to access all features!
                                <?php endif; ?>
                            </p>
                        </div>
                        <button id="UserJoinPrompt_button">
                            <span class="UserJoinPromptButton_text">
                                <?php if (!$userid): ?>
                                    Login
                                <?php else: ?>
                                    Join Community
                                <?php endif; ?>
                            </span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!$userid): ?>
            <div id="LoginModal_container" class="modalOverlay hidden">

                <div class="LoginModal modal">
                    <div class="LoginModal_content_area">
                        <div class="LoginModal_title_container">
                            <span class="LoginModal_title_text">Notification</span>
                        </div>
                        <div class="LoginModal_description_container">
                            <p class="LoginModal_description_text">
                                You need to log in.
                                <br>
                                Log in now?
                            </p>
                        </div>
                    </div>
                    <div class="LoginModal_buttons_container">
                        <button id="LoginModal_button_close" class="LoginModal_button">
                            <span class="LoginButton_text">Cancel</span>
                        </button>
                        <a id="LoginModal_button_login" class="LoginModal_button" href="signin.php">
                            <span class="LoginButton_text">Login</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <?php if ($userid && !$isSubscribed): ?>
        <div id="JoinModal_container" class="modalOverlay hidden">

            <div class="JoinModal modal">
                <div class="JoinModal_profileImage_container">
                    <img class="ProfileImage"
                        src="<?php echo $memberInfo["profile_picture"] ?? 'media_used/ProfileImages/icon_empty_profile.png'; ?>">
                </div>
                <form id="joinForm" method="post">
                    <input type="hidden" name="community_id" value="<?php echo $community_id; ?>" id="communityId">
                    <div class="JoinModal_nickname_container">
                        <div class="JoinModal_nickname_title">Nickname</div>
                        <div class="JoinModal_username_input_container">
                            <input type="text" name="nickname" id="join_username_input">
                        </div>
                    </div>
                    <div class="JoinModal_submit_container">
                        <button type="submit" id="join_submit_button">Sign up now</button>
                    </div>
                </form>

            </div>

        </div>
    <?php endif; ?>

    <?php if ($userid && $isSubscribed): ?>
        <div id="WriteModal_container" class="modalOverlay hidden">

            <div class="WriteModal modal">
                <form id="postForm" method="post">
                    <input type="hidden" name="community_id" value="<?php echo $community_id; ?>" id="communityId">
                    <div class="WriteModal_title_area">
                        <div class="title">Write a post</div>
                        <div class="WriteModal_artist"><?php echo $community_name ?></div>
                    </div>
                    <div class="WriteModal_content_container">
                        <div class="Editor">
                            <textarea id="Editor_box" type="text" name="postText"></textarea>
                        </div>
                    </div>
                    <div class="WriteModal_footer_container">
                        <div class="WriteModal_footer_area">
                            <div class="WriteModalFooter_button_area">
                                <button id="WriteModalFooter_button_submit" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                    <button class="CloseButton_container">
                        <div class="CloseButton_text">CLOSE</div>
                    </button>
                </form>
            </div>
        </div>

        <div id="ReactModal_container" class="modalOverlay hidden">

            <div class="ReactModal modal">
                <div class="Modal_post_container">

                    <div class="PostHeader_container">
                        <div class="PostHeader_profile_container">
                            <a class="PostHeader_profileImage_container">
                                <img class="ProfileImage" src="">
                            </a>
                            <div class="PostHeader_profileText_container">
                                <a class="ProfielLink">
                                    <div class="Profile_nickname_container">
                                        <div class="Profile_nickname"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="Modal_post_body"></div>

                    <div class="Modal_action_container">
                        <button class="LikeButton Button_item_container" data-liked="false" data-likes="0">
                            <img class="LikeButton_icon Button_icon" src="">
                            <span class="LikeButton_count Reaction_count"></span>
                        </button>
                    </div>
                </div>

                <div class="Modal_comment_container">
                    <div class="Comment_title_container">
                        <div class="Comment_title_text">0 comments</div>
                    </div>
                    <div class="Comment_scrollable_container">
                        <div class="Comment_list_container">
                        </div>
                    </div>
                    <div class="Comment_input_container">
                        <div class="Comment_input_area">
                            <div class="Comment_input_box">
                                <div class="Comment_text_area_container">
                                    <textarea id="comment_text_area" placeholder="Write a comment"></textarea>
                                </div>
                                <button class="Comment_input_send_button">
                                    <img id="comment_send_arrow_icon"
                                        src="media_used/CommunityFeed/ReactModal/ButtonIcons/comment_arrow_icon_OFF.png">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <button class="CloseButton_container">
                    <div class="CloseButton_text">CLOSE</div>
                </button>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>