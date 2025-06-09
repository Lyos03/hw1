function showMusicInfo(event) {
    const clickedContainer = event.currentTarget;
    const albumInfo = clickedContainer.querySelector(".Media_album_info");

    const allContainers = document.querySelectorAll(".Media_album_container");
    for (const container of allContainers) {
        if (container !== clickedContainer && container.dataset.expanded === "true") {
            container.querySelector(".Media_album_info").classList.add("hidden");
            container.dataset.expanded = "false";
        }
    }

    if (isExpanded(clickedContainer)) {
        albumInfo.classList.add("hidden");
        clickedContainer.dataset.expanded = "false";
    } else {
        albumInfo.classList.remove("hidden");
        clickedContainer.dataset.expanded = "true";
    }
}