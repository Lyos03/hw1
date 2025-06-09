function enableScroll() {
    document.body.classList.remove("no-scroll");
}

function disableScroll() {
    document.body.classList.add("no-scroll");
}

function clearInput(input) {
    input.value = "";
}

function isInputEmpty(textInput) {
    return textInput.value.trim() === "";
}

function enableHidden(input) {
    input.classList.add("hidden");
}

function disableHidden(input) {
    input.classList.remove("hidden");
}

function isClickInside(event) {
    return event.target === event.currentTarget;
}

function isExpanded(item) {
    return item.dataset.expanded === "true";
}

function reloadPage(){
    window.location.reload();
}

function isValidUsername(username) {
  return /^[a-zA-Z0-9_]{3,10}$/.test(username);
}

function showError(message, container) {
  const existingError = container.querySelector(".error");

  if (existingError) {
    existingError.textContent = message;
    return;
  }

  const errorElement = document.createElement("strong");
  errorElement.className = "error";
  errorElement.textContent = message;
  container.appendChild(errorElement);
}

function clearError() {
  const errorElement = document.querySelector(".error");
  if (errorElement) {
    errorElement.remove();
  }
}