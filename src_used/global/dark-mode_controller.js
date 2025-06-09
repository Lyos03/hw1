function applyDarkMode(isDark) {
    const body = document.querySelector("body");
    const header = document.querySelector(".header");
    const searchIcon = document.getElementById("header_bar_search_icon");
    const notificationsIcon = document.getElementById("header_bar_notifications_icon");
    const notificationsMenu = document.querySelector(".header_bar_notifications_menu");
    const accountIcon = document.getElementById("header_bar_account_icon");
    const settingsIcon = document.getElementById("header_bar_settings_icon");
    const artistLinkList = document.querySelectorAll(".HomePage_artist_link");
    const bannerArea = document.getElementById("banner_area");
    const artistItemList = document.querySelectorAll(".HomePage_artist_item");
    const artistLogoContainerList = document.querySelectorAll(".Artist_logo_container");

    const postButtonList = document.querySelectorAll(".Button_group_container");
    const postInputBar = document.querySelector(".Input_bar_container");
    const reactionCountList = document.querySelectorAll(".Reaction_count");
    const closeButtonContainerList = document.querySelectorAll(".CloseButton_container");
    const modalList = document.querySelectorAll(".modal");

    const editorBox = document.getElementById("Editor_box");

    const signinContainer = document.getElementById("Signin_container");

    const promptContainer = document.querySelector(".UserJoinPrompt_container")
    const promptLoginButtonText = document.querySelector(".LoginButton_text");


    if (isDark) {
        body.classList.remove("light-mode_lightgray");
        body.classList.add("dark-mode_gray");

        if (header) {
            header.classList.remove("light-mode_white");
            header.classList.add("dark-mode_darkgray");

            if (searchIcon) {
                searchIcon.classList.remove("search_icon_black");
                searchIcon.classList.add("search_icon_white");

                notificationsIcon.classList.remove("notifications_icon_black");
                notificationsIcon.classList.add("notifications_icon_white");
                notificationsMenu.classList.remove("light-mode_white");
                notificationsMenu.classList.add("dark-mode_darkgray");

                accountIcon.classList.remove("account_icon_black");
                accountIcon.classList.add("account_icon_white");

                settingsIcon.classList.remove("settings_icon_black");
                settingsIcon.classList.add("settings_icon_white");
            }
        }

        if (bannerArea) {
            bannerArea.classList.remove("light-mode_white");
            bannerArea.classList.add("dark-mode_darkgray");
        }

        if (artistItemList) {
            for (const i of artistItemList) {
                i.classList.remove("light-mode_white");
                i.classList.add("dark-mode_darkgray");
            }
        }

        if (artistLinkList) {
            for (const i of artistLinkList) {
                i.classList.remove("light-mode_text");
                i.classList.add("dark-mode_text");
            }
        }

        if (artistLogoContainerList) {
            for (const i of artistLogoContainerList) {
                i.classList.remove("light-mode_white");
                i.classList.add("dark-mode_darkgray");
            }
        }

        if (postButtonList) {
            for (const i of postButtonList) {
                i.classList.remove("light-mode_white");
                i.classList.add("dark-mode_darkgray");
            }
        }

        if (postInputBar) {
            postInputBar.classList.remove("light-mode_white");
            postInputBar.classList.add("dark-mode_darkgray");
        }

        if (reactionCountList) {
            for (const i of reactionCountList) {
                i.classList.remove("light-mode_text");
                i.classList.add("dark-mode_text");
            }
        }

        if (closeButtonContainerList) {
            for (const i of closeButtonContainerList) {
                i.classList.remove("light-mode_white");
                i.classList.add("dark-mode_darkgray");
            }
        }

        if (modalList) {
            for (const i of modalList) {
                i.classList.remove("light-mode_white");
                i.classList.add("dark-mode_darkgray");
            }
        }

        if (editorBox) {
            editorBox.classList.remove("light-mode_text");
            editorBox.classList.add("dark-mode_text");
        }

        if (signinContainer) {
            signinContainer.classList.remove("light-mode_white");
            signinContainer.classList.add("dark-mode_darkgray");
        }

        if (promptContainer) {
            promptContainer.classList.remove("light-mode_white");
            promptContainer.classList.add("dark-mode_darkgray");
        }

        if (promptLoginButtonText) {
            promptLoginButtonText.classList.remove("light-mode_text");
            promptLoginButtonText.classList.add("dark-mode_text");
        }


    } else {
        body.classList.remove("dark-mode_gray");
        body.classList.add("light-mode_lightgray");

        if (header) {
            header.classList.remove("dark-mode_darkgray");
            header.classList.add("light-mode_white");

            if (searchIcon) {
                searchIcon.classList.remove("search_icon_white");
                searchIcon.classList.add("search_icon_black");

                notificationsIcon.classList.remove("notifications_icon_white");
                notificationsIcon.classList.add("notifications_icon_black");
                notificationsMenu.classList.remove("dark-mode_darkgray");
                notificationsMenu.classList.add("light-mode_white");


                accountIcon.classList.remove("account_icon_white");
                accountIcon.classList.add("account_icon_black");

                settingsIcon.classList.remove("settings_icon_white");
                settingsIcon.classList.add("settings_icon_black");
            }
        }

        if (bannerArea) {
            bannerArea.classList.remove("dark-mode_darkgray");
            bannerArea.classList.add("light-mode_white");
        }

        if (artistItemList) {
            for (const i of artistItemList) {
                i.classList.remove("dark-mode_darkgray");
                i.classList.add("light-mode_white");
            }
        }

        if (artistLinkList) {
            for (const i of artistLinkList) {
                i.classList.remove("dark-mode_text");
                i.classList.add("light-mode_text");
            }
        }

        if (artistLogoContainerList) {
            for (const i of artistLogoContainerList) {
                i.classList.remove("dark-mode_darkgray");
                i.classList.add("light-mode_white");
            }
        }

        if (postButtonList) {
            for (const i of postButtonList) {
                i.classList.remove("dark-mode_darkgray");
                i.classList.add("light-mode_white");
            }
        }

        if (postInputBar) {
            postInputBar.classList.remove("dark-mode_darkgray");
            postInputBar.classList.add("light-mode_white");
        }

        if (reactionCountList) {
            for (const i of reactionCountList) {
                i.classList.remove("dark-mode_text");
                i.classList.add("light-mode_text");
            }
        }

        if (closeButtonContainerList) {
            for (const i of closeButtonContainerList) {
                i.classList.remove("dark-mode_darkgray");
                i.classList.add("light-mode_white");
            }
        }

        if (modalList) {
            for (const i of modalList) {
                i.classList.remove("dark-mode_darkgray");
                i.classList.add("light-mode_white");
            }

        }

        if (editorBox) {
            editorBox.classList.remove("dark-mode_text");
            editorBox.classList.add("light-mode_text");
        }

        if (signinContainer) {
            signinContainer.classList.remove("dark-mode_darkgray");
            signinContainer.classList.add("light-mode_white");
        }

        if (promptContainer) {
            promptContainer.classList.remove("dark-mode_darkgray");
            promptContainer.classList.add("light-mode_white");
        }

        if (promptLoginButtonText) {
            promptLoginButtonText.classList.remove("dark-mode_text");
            promptLoginButtonText.classList.add("light-mode_text");
        }
    }
}


function onResponse(response) {
    return response.json();
}

function onJson(data) {
    const darkModePref = data.darkMode;
    applyDarkMode(darkModePref);

    const darkModeButton = document.getElementById("DarkMode_button");
    if (darkModeButton) {
        darkModeButton.dataset.toggled = darkModePref ? "true" : "false";
        darkModeButton.textContent = darkModePref ? "ON" : "OFF";
        if (darkModePref) darkModeButton.classList.add("toggled")
    } 
    
}

function initDarkMode() {
    if (document.querySelector("body").dataset.forceDark === "true") {
        applyDarkMode(true);
        return;
    }

    fetch('functions.php?action=getDarkMode').then(onResponse).then(onJson);
}

initDarkMode();

