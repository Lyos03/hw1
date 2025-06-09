const headerSearchContainer=document.querySelector("#header_bar_search_container");
const barIcon=headerSearchContainer.childNodes[3];
const searchBar=headerSearchContainer.querySelector(".searchBar_container");

function openBar(event){
    event.stopPropagation();
    
    if(!noti.classList.contains("hidden")) closeNotifications();
    enableHidden(barIcon);
    disableHidden(searchBar);

}

function clearBar(){
    clearInput(document.getElementById("search_input"));
}

function isClickInsideSearchBar(event){
    if(isClickInside(event)) return;
    closeSearchBar();
}
function closeSearchBar(){
    enableHidden(searchBar);
    disableHidden(barIcon);
    clearBar();
}

document.getElementById("header_bar_search_container").addEventListener("click",openBar);

document.addEventListener("click",isClickInsideSearchBar);

document.getElementById("searchBar_search_clear_button").addEventListener("click",clearBar);
    

