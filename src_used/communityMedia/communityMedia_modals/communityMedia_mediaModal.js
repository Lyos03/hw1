function loadMediaModal(event) {
    const clickedVideo = event.currentTarget;
    const videoId = clickedVideo.dataset.videoId;
    const mediaModalContainer = document.getElementById("MediaModal_container");
    const ytTitleContainer = mediaModalContainer.querySelector(".MediaModal_content_text");
    const ytPlayer = mediaModalContainer.querySelector(".YouTubePlayer_iframe");
    
    ytPlayer.src = `https://www.youtube.com/embed/${videoId}?autoplay=0`;
    ytTitleContainer.textContent = clickedVideo.querySelector(".Video_title").textContent;

    disableHidden(mediaModalContainer);
}

function isClickInsideMediaModal(event){
    if(!isClickInside(event)) return;
    closeMediaModal();
    
}

function closeMediaModal() {
    const mediaModalContainer = document.getElementById("MediaModal_container");
    const ytPlayer = mediaModalContainer.querySelector(".YouTubePlayer_iframe");
    
    ytPlayer.src = '';
    enableHidden(mediaModalContainer);
}


document.querySelector("#MediaModal_container .CloseButton_container").addEventListener("click", closeMediaModal);
document.getElementById("MediaModal_container").addEventListener("click", isClickInsideMediaModal);