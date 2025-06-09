const nicknameContainer = document.querySelector(".JoinModal_nickname_container");

function openJoinModal() {
    disableHidden(document.getElementById("JoinModal_container"));
    disableScroll();

    document.getElementById("join_username_input").addEventListener("input", enableJoinSubmitButton);
    document.getElementById("joinForm").addEventListener("submit",recordUsername);
}

function onResponse(response) {
    return response.json();
}

function recordUsername(event) {
    event.preventDefault();
    clearError();
    
    const newUsernameInput=document.getElementById("join_username_input");
    const newUsername = newUsernameInput.value.trim();
    const communityId = document.getElementById("communityId").value;

    if (isInputEmpty(newUsernameInput)) {
        showError("Please enter a nickname",nicknameContainer);
        return;
    }

    if (!isValidUsername(newUsername)) {
        showError("Username must be 3-10 characters and can only contain letters, numbers, or underscores",nicknameContainer);
        return;
    }

    joinCommunity(newUsername,communityId);
}

function onJoinJson(json) {
    if(!json.success){
        showError(json.error,nicknameContainer);
        return false;
    }else{ return true;}
}


function updatePage(response) {
    if(response){
        closeJoinModal();
        reloadPage();
    }
    
}


function joinCommunity(nickname, communityId) {
    fetch('join_community.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "nickname=" + encodeURIComponent(nickname) + "&community_id=" + communityId
    })
        .then(onResponse)
        .then(onJoinJson)
        .then(updatePage)
}


function isClickInsideJoinModal(event) {
    if (!isClickInside(event)) return;
    closeJoinModal();

}

function clearInputJoin() {
    clearInput(document.getElementById("join_username_input"));
}

function closeJoinModal() {
    enableHidden(document.getElementById("JoinModal_container"));
    enableScroll();
    clearInputJoin();
    clearError();
}

document.getElementById("UserJoinPrompt_button").addEventListener("click", openJoinModal);
document.getElementById("JoinModal_container").addEventListener("click", isClickInsideJoinModal);

enableJoinSubmitButton();


