function onResponse(response) {
    return response.json();
}

function displayVideoThumbnails(playlistData) {
    const media_list = document.querySelector(".MediaVideo_list");

    for (let i = 0; i < playlistData.items.length; i++) {
        const item = playlistData.items[i];

        const title = item.snippet.title;
        const thumbnails = item.snippet.thumbnails;
        const videoId = item.snippet.resourceId.videoId;

        let thumbnailUrl = (thumbnails.standard && thumbnails.standard.url) || 
                         (thumbnails.high && thumbnails.high.url) || 
                         (thumbnails.medium && thumbnails.medium.url);

        const videoElement = document.createElement("div");
        videoElement.className = "Video_item_container div_as_button";
        videoElement.dataset.videoId = videoId;
        videoElement.addEventListener("click", loadMediaModal);

        const thumbnailContainer = document.createElement("div");
        thumbnailContainer.className = "Video_thumbnail_container";

        const titleElement = document.createElement("div");
        titleElement.className = "Video_title";
        titleElement.textContent = title;

        const thumbnailImg = document.createElement("img");
        thumbnailImg.src = thumbnailUrl;
        thumbnailImg.alt = title;
        thumbnailImg.title = title;
        thumbnailImg.className = "Video_thumbnail_img";

        thumbnailContainer.appendChild(thumbnailImg);
        videoElement.appendChild(thumbnailContainer);
        videoElement.appendChild(titleElement);
        media_list.appendChild(videoElement);
    }
}

fetch("youtube.php")
    .then(onResponse)
    .then(displayVideoThumbnails);

