function openLoginModal(){
    disableHidden(document.getElementById("LoginModal_container"));
    disableScroll();
}


function closeLoginModal(){
    enableHidden(document.getElementById("LoginModal_container"));
    enableScroll();
}

document.getElementById("LoginModal_button_close").addEventListener("click",closeLoginModal);
document.getElementById("UserJoinPrompt_button").addEventListener("click",openLoginModal);

const buttons=document.querySelectorAll(".LoginRequired_button");
for(const btn of buttons){
    btn.addEventListener("click",openLoginModal);
}