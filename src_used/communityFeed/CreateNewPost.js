function newPost(contentText) {
    const profileImage = document.querySelector(".PersonalProfile_container").querySelector(".ProfileImage");
    const profileName = document.querySelector(".PersonalProfile_container").querySelector(".Profile_nickname").textContent;

    const postList=document.querySelector(".FeedPost_list");
    
    const newPost_item_container = document.createElement("div");
    newPost_item_container.className = "Post_item_container";
    

    
    const newPostHeader_container = document.createElement("div");
    newPostHeader_container.className = "PostHeader_container";

    
    const newPostHeader_profile_container = document.createElement("div");
    newPostHeader_profile_container.className = "PostHeader_profile_container";

    
    const newPostHeader_profileImage_container = document.createElement("a");
    newPostHeader_profileImage_container.className = "PostHeader_profileImage_container";

    
    const newProfileImage = document.createElement("img");
    newProfileImage.className = "ProfileImage";
    newProfileImage.src = profileImage.src;

    
    newPostHeader_profileImage_container.appendChild(newProfileImage);

    
    const newPostHeader_profileText_container = document.createElement("div");
    newPostHeader_profileText_container.className = "PostHeader_profileText_container";

    
    const newProfielLink = document.createElement("a");
    newProfielLink.className = "ProfielLink";

    
    const newProfile_nickname_container = document.createElement("div");
    newProfile_nickname_container.className = "Profile_nickname_container";

    
    const newProfile_nickname = document.createElement("div");
    newProfile_nickname.className = "Profile_nickname";
    newProfile_nickname.textContent = profileName;

    
    newProfile_nickname_container.appendChild(newProfile_nickname);
    newProfielLink.appendChild(newProfile_nickname_container);
    newPostHeader_profileText_container.appendChild(newProfielLink);

    
    newPostHeader_profile_container.appendChild(newPostHeader_profileImage_container);
    newPostHeader_profile_container.appendChild(newPostHeader_profileText_container);

    
    newPostHeader_container.appendChild(newPostHeader_profile_container);

    
    const newPostItem_content_container = document.createElement("div");
    newPostItem_content_container.className = "PostItem_content_container";

    const newPostItem_text_container = document.createElement("div");
    newPostItem_text_container.className = "PostItem_text_container";

    
    const newPostItem_text = document.createElement("p");
    newPostItem_text.className = "PostItem_text";
    newPostItem_text.textContent = contentText;

    
    newPostItem_text_container.appendChild(newPostItem_text);

  
    newPostItem_content_container.appendChild(newPostItem_text_container);

    const newPostItem_button_container = document.createElement("div");
    newPostItem_button_container.className = "PostItem_button_container";

    
    const newButton_group_container = document.createElement("div");
    newButton_group_container.className = "Button_group_container";

   
    const newLikeButton = document.createElement("button");
    newLikeButton.className = "LikeButton Button_item_container";
    newLikeButton.setAttribute("data-liked", "false");
    newLikeButton.setAttribute("data-likes", "0");

    
    const newLikeButton_icon = document.createElement("img");
    newLikeButton_icon.className = "LikeButton_icon Button_icon";
    newLikeButton_icon.src = "media_used/CommunityFeed/CommonIcons/weverse_like_icon_off.png";

    
    const newLikeButton_count = document.createElement("span");
    newLikeButton_count.className = "LikeButton_count Reaction_count";

    
    newLikeButton.appendChild(newLikeButton_icon);
    newLikeButton.appendChild(newLikeButton_count);

    
    const newCommentButton = document.createElement("button");
    newCommentButton.className = "CommentButton Button_item_container";

    
    const newCommentButton_icon = document.createElement("img");
    newCommentButton_icon.className = "CommentButton_icon Button_icon";
    newCommentButton_icon.src = "media_used/CommunityFeed/CommonIcons/weverse_comment_icon.png";

    
    const newCommentButton_count = document.createElement("span");
    newCommentButton_count.className = "CommentButton_count Reaction_count";
    newCommentButton_count.textContent = "0";

    
    newCommentButton.appendChild(newCommentButton_icon);
    newCommentButton.appendChild(newCommentButton_count);

    
    newButton_group_container.appendChild(newLikeButton);
    newButton_group_container.appendChild(newCommentButton);

    
    newPostItem_button_container.appendChild(newButton_group_container);

    
    newPost_item_container.appendChild(newPostHeader_container);
    newPost_item_container.appendChild(newPostItem_content_container);
    newPost_item_container.appendChild(newPostItem_button_container);

    postList.appendChild(newPost_item_container);
}