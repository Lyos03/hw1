<?php
require_once "auth.php";
require_once "functions.php";

$allCommunities = getAllCommunities();

if ($userid = checkAuth()) {
  $subscribedCommunities = getSubscribedCommunities($userid);
  $nonSubscribedCommunities = getNonSubscribedCommunities($userid);
} else {
  $nonSubscribedCommunities = $allCommunities;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Weverse</title>


  <link rel="stylesheet" href="src_used/homePage/homePage.css">
  <link rel="stylesheet" href="src_used/footer/footer.css">
  <link rel="stylesheet" href="src_used/hdr/hdr.css">
  <link rel="stylesheet" href="src_used/homePage/homePage_banner/homePage_banner.css">
  <link rel="stylesheet" href="src_used/global/styles.css">

  <script src="src_used/global/GeneralFunctions.js" defer></script>
  <script src="src_used/homePage/homePage_banner/homePage_banner.js" defer></script>
  <script src="src_used/global/dark-mode_controller.js" defer></script>


  <?php if ($userid): ?>
    <script src="src_used/hdr/hdrNotification.js" defer></script>
    <script src="src_used/hdr/hdrSearch.js" defer></script>
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
    <div class="HomePage_container">

      <div id="banner_area">
        <div class="banner_inner_area">
          <div class="banner_slide-show">

            <div class="banner_container font-white">
              <div id="Weverse" class="banner_background_image"></div>
              <div class="banner_badge"></div>
              <div class="banner_title_area">
                Subscribe to <br> Digital Membership
              </div>
            </div>
            <div class="banner_container font-white">
              <div id="RM" class="banner_background_image"></div>
              <div class="banner_badge">BTS</div>
              <div class="banner_title_area">
                RM: Right People <br> Wrong Place
              </div>
            </div>
            <div class="banner_container font-white">
              <div id="WeverseZone" class="banner_background_image"></div>
              <div class="banner_badge">Weverse Zone</div>
              <div class="banner_title_area">
                2nd LINEUP <br> ANNOUNCEMENT
              </div>
            </div>
            <div class="banner_container">
              <div id="JIN" class="banner_background_image"></div>
              <div class="banner_badge">BTS</div>
              <div class="banner_title_area">
                #RUNSEOKJIN <br> EP.TOUR in GOYANG
              </div>
            </div>
          </div>

          <div class="banner_slideIndex_bar_container">
            <div class="banner_slideIndex_bar">
              <div class="banner_slideIndex_progress"></div>
              <div class="banner_slideIndex_progress"></div>
              <div class="banner_slideIndex_progress"></div>
              <div class="banner_slideIndex_progress"></div>
            </div>
          </div>
          <button id="banner_arrow_prev" class="banner_arrow">
            <img id="left_arrow_icon" class="arrow_icon"
              src="media_used/HomePage/Banner/ButtonIcons/banner_arrow_icon_left.png">
          </button>
          <button id="banner_arrow_next" class="banner_arrow">
            <img id="right_arrow_icon" class="arrow_icon"
              src="media_used/HomePage/Banner/ButtonIcons/banner_arrow_icon_right.png">
          </button>
        </div>
      </div>

      <?php if ($userid && count($subscribedCommunities) > 0): ?>
        <div class="HomePage_component_area">
          <div class="HomePage_component_inner_area">
            <h2 class="HomePage_component_inner_area_title">My Communities</h2>
            <div class="HomePage_artist_list_container">
              <div class="HomePage_artist_list">
                <?php foreach ($subscribedCommunities as $community): ?>
                  <div id="<?php echo $community['name']; ?>" class="HomePage_artist_item">
                    <a class="HomePage_artist_link" href="<?php echo $community['community_feed_link'] ?>">
                      <img class="Artist_cover_image" src="<?php echo $community['cover_image'] ?>">
                      <div class="Artist_logo_container">
                        <img class="Artist_logo" src="<?php echo $community['logo'] ?>">
                      </div>
                      <div class="Artist_text_container">
                        <div class="Artist_name"><?php echo $community['name'] ?></div>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (count($nonSubscribedCommunities) !== 0): ?>
        <div class="HomePage_component_area">
          <div class="HomePage_component_inner_area">
            <h2 class="HomePage_component_inner_area_title"> Looking for new artists? </h2>
            <div class="HomePage_artist_list_container">
              <div class="HomePage_artist_list">
                <?php foreach ($nonSubscribedCommunities as $community): ?>
                  <div id="<?php echo $community['name']; ?>" class="HomePage_artist_item">
                    <a class="HomePage_artist_link" href="<?php echo $community['community_feed_link'] ?>">
                      <img class="Artist_cover_image" src="<?php echo $community['cover_image'] ?>">
                      <div class="Artist_logo_container">
                        <img class="Artist_logo" src="<?php echo $community['logo'] ?>">
                      </div>
                      <div class="Artist_text_container">
                        <div class="Artist_name"><?php echo $community['name'] ?></div>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>


      <div class="Footer">
        <footer class="Footer_inner_area">
          <p class="Footer_text_container">
            <span class="Footer_highlight">Company Name</span> Bora Company Inc. <span
              class="Footer_highlight">CEO</span> Kim Nam Joon <br>
            <span class="Footer_highlight">Call Center</span> xxxx-xxxx <span class="Footer_highlight">FAX</span>
            +82
            x-xxxx-xxxx <br>
            <span class="Footer_highlight">Address</span><br> The Magic Shop<br>
            <span class="Footer_highlight">Business Registration Number</span> 061313 <br><br>
            <span class="Footer_highlight">Hosted by</span> Amazon Web Services, Inc., Naver Cloud <br>
          </p>
        </footer>
      </div>

    </div>
  </div>
</body>

</html>