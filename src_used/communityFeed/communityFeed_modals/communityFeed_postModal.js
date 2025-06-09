let currentPost = null;
let currentOriginalLikeButton = null;
const commentError = document.querySelector(".Comment_input_container");


function loadPostModal(event) {
    clearError();
    const button = event.currentTarget;

    const currentPost = button.closest(".Post_item_container");
    const textContainer = currentPost.querySelector(".PostItem_text");

    currentOriginalLikeButton = currentPost.querySelector(".LikeButton");

    const profilePic = currentPost.querySelector(".ProfileImage");
    const profileName = currentPost.querySelector(".Profile_nickname");

    const modal = document.querySelector(".ReactModal");
    modal.querySelector(".ProfileImage").src = profilePic.src;
    modal.querySelector(".Profile_nickname").textContent = profileName.textContent;

    const postId = currentOriginalLikeButton.dataset.postId;
    loadComments(postId);

    if (currentPost.querySelector(".PostItem_text_container")) {
        const mainText = textContainer.childNodes[0].textContent;
        let fullText = undefined;

        if (currentPost.querySelector(".Text_more")) {
            const dots = textContainer.querySelector(".Text_dots");
            const moreText = textContainer.querySelector(".Text_more");

            enableHidden(dots);
            fullText = mainText + moreText.textContent;
        } else {
            fullText = mainText;
        }

        const modalBody = document.querySelector(".Modal_post_body");
        const newText = document.createElement("div");
        newText.className = "ModalBody_fullText";
        newText.textContent = fullText;
        modalBody.appendChild(newText);

    }

    const modalLikeButton = modal.querySelector(".LikeButton");
    syncLikeButton(currentOriginalLikeButton, modalLikeButton);

    disableScroll();
    disableHidden(document.getElementById("ReactModal_container"));
}

function syncLikeButton(source, target) {
    if (!source || !target) return;

    target.dataset.liked = source.dataset.liked;
    target.dataset.likes = source.dataset.likes;
    target.querySelector(".LikeButton_icon").src = source.querySelector(".LikeButton_icon").src;
    target.querySelector(".LikeButton_count").textContent =
        source.dataset.likes === "0" ? "" : source.dataset.likes;
}

function onLikeResponse(response) {
    return response.json();
}

function onLikeJson(data) {
    if (data.success) {
        const originalButton = currentOriginalLikeButton;
        const modalButton = document.querySelector(".ReactModal .LikeButton");

        const likeIcon = originalButton.querySelector(".LikeButton_icon");
        const likeCounterElement = originalButton.querySelector(".LikeButton_count");

        originalButton.dataset.liked = data.liked ? "true" : "false";
        originalButton.dataset.likes = data.likes_count;

        if (data.liked) {
            likeButtonTrue(likeIcon);
        } else {
            likeButtonFalse(likeIcon);
        }

        if (data.likes_count > 0) {
            likeCounterElement.textContent = data.likes_count;
        } else {
            likeCounterElement.textContent = "";
        }

        syncLikeButton(originalButton, modalButton);
    }
}

function handleLike(event) {
    event.preventDefault();

    const clickedButton = event.currentTarget;
    const isModalButton = clickedButton.parentNode.classList.contains("Modal_action_container");

    currentOriginalLikeButton = isModalButton ? currentOriginalLikeButton : clickedButton;
    const postId = currentOriginalLikeButton.dataset.postId;
    if (!postId) return;

    fetch('like_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `post_id=${postId}`
    })
        .then(onLikeResponse)
        .then(onLikeJson)
}

function createCommentElement(comment) {
    const commentElement = document.createElement("div");
    commentElement.className = "Comment_item_container";

    const headerContainer = document.createElement("div");
    headerContainer.className = "CommentItem_header_container";

    const profileImageContainer = document.createElement("a");
    profileImageContainer.className = "CommentItemHeader_profileImage_container";

    const profileImage = document.createElement("img");
    profileImage.className = "ProfileImage";
    profileImage.src = comment.profile_picture || 'media_used/ProfileImages/icon_empty_profile.png';
    profileImageContainer.appendChild(profileImage);

    const profileTextContainer = document.createElement("div");
    profileTextContainer.className = "CommentItemHeader_profileText_container";

    const nicknameContainer = document.createElement("div");
    nicknameContainer.className = "Profile_nickname_container";

    const nickname = document.createElement("div");
    nickname.className = "Profile_nickname";
    nickname.textContent = comment.display_name;

    nicknameContainer.appendChild(nickname);
    profileTextContainer.appendChild(nicknameContainer);
    headerContainer.appendChild(profileImageContainer);
    headerContainer.appendChild(profileTextContainer);

    const commentText = document.createElement("div");
    commentText.className = "CommentItem_comment_text";
    commentText.textContent = comment.content;

    commentElement.appendChild(headerContainer);
    commentElement.appendChild(commentText);

    return commentElement;
}

function onCommentsResponse(response) {
    return response.json();
}

function updateCommentCount(count) {
    const countElement = document.querySelector(".Comment_title_text");
    countElement.textContent = count + " comment" + (count === 1 ? '' : 's');
}

function onCommentsJson(data) {
    const container = document.querySelector(".Comment_list_container");
    container.innerHTML = '';

    for (const comment of data) {
        const commentElement = createCommentElement(comment);
        container.appendChild(commentElement);
    }

    updateCommentCount(data.length);
}

function loadComments(postId) {
    fetch(`get_comments.php?post_id=${postId}`)
        .then(onCommentsResponse)
        .then(onCommentsJson)
}

function onPublishCommentResponse(response) {
    console.log(response);
    return response.json();
}

function onPublishCommentJson(data) {
    if (data.success) {
        const postId = currentOriginalLikeButton.dataset.postId;
        loadComments(postId);
        clearInputComment();
    } else {
        showError(data.error, commentError);
    }
}

function publishComment() {
    clearError();
    const commentInput = document.getElementById("comment_text_area");
    const postId = currentOriginalLikeButton.dataset.postId;

    const maxChar=25;
    
    if (isInputEmpty(commentInput)) {
        showError("the comment is empty", commentError);
        return;
    }

    if(commentInput.value.length > maxChar){
        showError("Max:"+ maxChar,commentError);
        return
    }

    if (!postId) {
        showError("error retrieving the original post", commentError);
        return;
    }
    


    fetch('add_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `post_id=${postId}&content=${encodeURIComponent(commentInput.value)}`
    })
        .then(onPublishCommentResponse)
        .then(onPublishCommentJson)

}


function clearInputComment() {
    clearInput(document.getElementById("comment_text_area"));
    enableCommentButton();
}

function handleCommentClick(event) {
    event.preventDefault();
    publishComment();
}

function isClickInsidePostModal(event) {
    if (!isClickInside(event)) return;
    closePostModal();
}

function closePostModal() {
    const modalBody = document.querySelector(".Modal_post_body");

    enableHidden(document.getElementById("ReactModal_container"));
    const dotsElements = document.querySelectorAll(".Text_dots");
    for (let i = 0; i < dotsElements.length; i++) {
        disableHidden(dotsElements[i]);
    }

    enableScroll();
    modalBody.innerHTML = '';
    clearInputComment();

    currentPost = null;
    currentOriginalLikeButton = null;

}

const moreButtons = document.querySelectorAll(".Text_more_button");
for (const button of moreButtons) {
    button.addEventListener("click", loadPostModal);
}

const commentButtons = document.querySelectorAll(".Post_item_container .CommentButton");
for (const button of commentButtons) {
    button.addEventListener("click", loadPostModal);
}

const likeButtons = document.querySelectorAll(".PostItem_button_container .LikeButton");
for (const button of likeButtons) {
    button.addEventListener("click", handleLike);
}

document.querySelector(".ReactModal .LikeButton").addEventListener("click", handleLike);

document.querySelector(".Comment_input_send_button").addEventListener("click", publishComment);

document.querySelector("#ReactModal_container .CloseButton_container").addEventListener("click", closePostModal);

document.getElementById("ReactModal_container").addEventListener("click", isClickInsidePostModal);

document.getElementById("comment_text_area").addEventListener("input", enableCommentButton);

enableCommentButton();

document.getElementById("comment_text_area").addEventListener("click", handleCommentClick);


