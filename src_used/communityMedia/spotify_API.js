const MEDIA_AUDIO_LIST = document.querySelector(".MediaAudio_list");
const ARTIST_NAME = "BTS";

function onResponse(response) {
    return response.json();
}

function onJson(data) {
    if (data.error) {
        console.log(data.error);
        return;
    }

    for (const item of data) {
        createAlbumElement(item.album, item.albumInfo);
    }
}


function createAlbumElement(album, albumInfo) {
    const newMedia_album_container = document.createElement("div");
    newMedia_album_container.className = "Media_album_container";
    newMedia_album_container.setAttribute("data-expanded", "false");
    newMedia_album_container.addEventListener("click", showMusicInfo);

    const albumElement = document.createElement("div");
    albumElement.className = "Media_album";

    const coverImg = document.createElement("img");
    coverImg.className = "Media_album_cover";
    coverImg.src = albumInfo.image_url;

    const infoDiv = document.createElement("div");
    infoDiv.className = "Media_album_info";
    infoDiv.classList.add("hidden");

    const titleElement = document.createElement("div");
    titleElement.className = "Media_album_title";
    titleElement.textContent = album.name;

    const artistElement = document.createElement("span");
    artistElement.className = "Media_album_artist";
    artistElement.textContent = album.artists[0].name;

    const releaseDateElement = document.createElement("span");
    releaseDateElement.className = "Media_album_release_date";
    releaseDateElement.textContent = "Release: " + album.release_date;

    const detailsDiv = document.createElement("div");
    detailsDiv.className = "Media_album_details";

    const trackCountElement = document.createElement("span");
    trackCountElement.className = "Media_album_track_count";
    trackCountElement.textContent = "Tracks: " + albumInfo.track_count;
    detailsDiv.appendChild(trackCountElement);

    const durationElement = document.createElement("span");
    durationElement.className = "Media_album_duration";
    durationElement.textContent = "Duration: " + albumInfo.duration;
    detailsDiv.appendChild(durationElement);

    infoDiv.appendChild(titleElement);
    infoDiv.appendChild(artistElement);
    infoDiv.appendChild(releaseDateElement);
    infoDiv.appendChild(detailsDiv);

    albumElement.appendChild(coverImg);
    albumElement.appendChild(infoDiv);

    newMedia_album_container.appendChild(albumElement);
    MEDIA_AUDIO_LIST.appendChild(newMedia_album_container);
}

fetch(`spotify.php?artist=${encodeURIComponent(ARTIST_NAME)}`).then(onResponse).then(onJson);

