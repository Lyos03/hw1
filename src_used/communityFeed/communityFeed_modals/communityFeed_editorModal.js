const editor = document.querySelector(".Editor");

function loadEditorModal() {
    clearError();
    disableHidden(document.getElementById("WriteModal_container"));
    disableScroll();
    

    enableEditorSubmitButton();
}

function clearInputEditor() {
    clearInput(document.getElementById("Editor_box"));
    enableEditorSubmitButton();
}


function onResponse(response) {
    return response.json();
}

function onJson(json) {
    const newText = document.getElementById("Editor_box");
    if (json.success) {
        newPost(newText.value);

        closeEditorModal();
    }else{
        showError(json.error,editor);
    }
}

function publishPost(event) {
    event.preventDefault();
    clearError();

    const newText = document.getElementById("Editor_box");
    const maxChar = 50;

    if (isInputEmpty(newText)) {
        showError("there is no text to post", editor);
        return;
    }

    
    if (newText.value.length > maxChar) {
        showError("Max: " + maxChar, editor);
        return;
    }
    

    const postText = newText.value;
    const communityId = document.getElementById("communityId").value;

    fetch("handle_post.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "community_id=" + encodeURIComponent(communityId) + "&postText=" + encodeURIComponent(postText)
    })
        .then(onResponse)
        .then(onJson)

}

function isClickInsideEditorModal(event) {
    if (!isClickInside(event)) return;
    closeEditorModal();
}

function closeEditorModal() {
    enableHidden(document.getElementById("WriteModal_container"));
    enableScroll();
    clearInputEditor();
    
}

document.querySelector(".Input_bar_text_container").addEventListener("click", loadEditorModal);

document.getElementById("Editor_box").addEventListener("input", enableEditorSubmitButton);

document.getElementById("WriteModal_container").addEventListener("click", isClickInsideEditorModal);

document.getElementById("postForm").addEventListener("submit", publishPost);

document.querySelector("#WriteModal_container .CloseButton_container").addEventListener("click", closeEditorModal);

