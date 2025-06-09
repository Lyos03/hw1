const formContainer = document.getElementById("Form_content_container");

function onResponse(response) {
  return response.json();
}

function onJson(json) {
  return json.exists;
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPassword(password) {
  return password.length >= 6;
}

function checkEmail() {
  const emailInput = document.getElementById("Form_email_input");
  if (!emailInput) return;

  const email = emailInput.value.trim();

  if (isInputEmpty(emailInput)) {
    showError("Please enter an email", formContainer);
    return;
  }

  if (!isValidEmail(email)) {
    showError("Please enter a valid email", formContainer);
    return;
  }

  clearError();

  return true;
}

function checkLoginPassword() {
  const passwordInput = document.getElementById("login_password");
  const password = passwordInput.value;

  if (isInputEmpty(passwordInput)) {
    showError("Please enter your password", formContainer);
    return false;
  }

  if (!isValidPassword(password)) {
    showError("Password must be at least 6 characters", formContainer);
    return false;
  }

  clearError();
  return true;
}

function checkUsernameExists(username) {
  return fetch("check_username.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `username=${encodeURIComponent(username)}`
  })
    .then(onResponse)
    .then(onJson);
}

function checkEmailExists(email) {
  return fetch('check_email.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `userEmail=${encodeURIComponent(email)}`
  })
    .then(onResponse)
    .then(onJson)
}


function createButton(text, className, id = null, clickHandler = null) {
  const button = document.createElement("button");
  button.type = id ? "button" : "submit";
  if (id) button.id = id;
  button.className = className;

  const span = document.createElement("span");
  span.className = className + '_text';
  span.textContent = text;

  button.appendChild(span);
  if (clickHandler) {
    button.addEventListener("click", clickHandler);
  }

  return button;
}

function createInput(labelText, inputType, inputName, placeholder, required = true) {
  const container = document.createElement("div");

  const label = document.createElement("label");
  label.textContent = labelText;
  label.id = 'Form_' + inputName + '_label';

  const inputDiv = document.createElement("div");
  inputDiv.id = "Form_input_container";

  const input = document.createElement("input");
  input.type = inputType;
  input.name = inputName;
  input.id = inputName;
  input.placeholder = placeholder;
  input.required = required;

  fetch('functions.php?action=getDarkMode').then(onResponse).then(function (data) {
    const isDark = data.darkMode;
    if (isDark) input.classList.add("dark-mode_text");
  });

  inputDiv.appendChild(input);
  container.appendChild(label);
  container.appendChild(inputDiv);

  return container;
}

function createEmailDisplay(email, prefix = "") {
  const p = document.createElement("p");
  p.className = "email-display";
  p.textContent = prefix;

  const strong = document.createElement("strong");
  strong.textContent = email;

  p.appendChild(strong);

  return p;
}



function onEmailSubmitResponse(emailExists) {
  const submitButton = document.querySelector(".SigninButton");
  const originalText = submitButton.querySelector(".SigninButton_text").textContent;

  submitButton.querySelector(".SigninButton_text").textContent = originalText;

  if (emailExists === null) {
    showError("Error checking email. Please try again.", formContainer);
    return;
  }

  if (emailExists) {
    showLoginForm(currentEmail);
  } else {
    showSignupPrompt(currentEmail);
  }
}

function handleEmailSubmit(event) {
  event.preventDefault();
  clearError();

  const emailInput = document.getElementById("Form_email_input");
  if (emailInput) {
    currentEmail = emailInput.value.trim();

    if (isInputEmpty(emailInput)) {
      showError("Please enter an email", formContainer);
      return;
    }

    if (!isValidEmail(currentEmail)) {
      showError("Please enter a valid email", formContainer);
      return;
    }
  }

  if (document.getElementById("login_password")) {
    document.getElementById("loginForm").submit();
    return;
  }

  const submitButton = document.querySelector(".SigninButton");
  submitButton.querySelector(".SigninButton_text").textContent = "Checking...";

  checkEmailExists(currentEmail).then(onEmailSubmitResponse);
}

function onAuthLoginJson(json) {
  return json;
}

function authLogin(email, password) {
  return fetch("auth_login.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `userEmail=${encodeURIComponent(email)}&login_password=${encodeURIComponent(password)}`
  })
    .then(onResponse)
    .then(onAuthLoginJson);
}

function onLoginSubmitResponse(userData) {
  if (userData.success) {
    document.getElementById("loginForm").submit();
  } else {
    showError("Invalid password", formContainer);
  }
}

function handleLoginFormSubmit(event) {
  event.preventDefault();
  clearError();

  const form = event.target;
  const email = form.userEmail.value.trim();
  const password = form.login_password.value;

  if (!password) {
    showError("Please enter your password", formContainer);
    return;
  }

  if (!checkLoginPassword()) {
    return;
  }

  authLogin(email, password)
    .then(onLoginSubmitResponse);
}

function showLoginForm(email) {
  const formContainer = document.getElementById("Form_content_container");
  formContainer.innerHTML = "";

  const emailInput = document.createElement("input");
  emailInput.type = "hidden";
  emailInput.name = "userEmail";
  emailInput.value = email;
  formContainer.appendChild(emailInput);

  const emailDisplay = createEmailDisplay(email, "Sign in as: ");

  const passwordContainer = createInput(
    "Password",
    "password",
    "login_password",
    "Enter your password"
  );

  const buttonsWrapper = document.createElement("div");
  buttonsWrapper.className = "buttons_wrapper";

  const loginButton = createButton("Log in", "SigninButton");
  const backButton = createButton("Back", "GoBackButton", "goBackButton", showInitialForm);

  buttonsWrapper.appendChild(loginButton);
  buttonsWrapper.appendChild(backButton);

  formContainer.appendChild(emailDisplay);
  formContainer.appendChild(passwordContainer);
  formContainer.appendChild(buttonsWrapper);

  const form = document.createElement("form");
  form.method = "POST";
  form.id = "loginForm";
  form.addEventListener("submit", handleLoginFormSubmit);

  form.appendChild(emailInput);
  form.appendChild(emailDisplay);
  form.appendChild(passwordContainer);
  form.appendChild(buttonsWrapper);

  formContainer.appendChild(form);

  document.getElementById("login_password").addEventListener("blur", checkLoginPassword);
}

function showSignupPrompt(email) {
  const formContainer = document.getElementById("Form_content_container");
  formContainer.innerHTML = "";

  const heading = document.createElement("h1");
  heading.className = "email_display_text";

  const strong = document.createElement("strong");
  strong.textContent = email;
  heading.appendChild(strong);

  const message = document.createElement("p");
  message.className = "signup_message";
  message.textContent = "You can use this email to create a new account. Do you want to continue?";

  const buttonsWrapper = document.createElement("div");
  buttonsWrapper.className = "buttons_wrapper";

  function handleSignupClick() {
    showSignupForm(email);
  }

  const signupButton = createButton(
    "Sign Up",
    "SigninButton",
    "continueSignupButton",
    handleSignupClick
  );

  const backButton = createButton("Back", "GoBackButton", "goBackButton", showInitialForm);

  buttonsWrapper.appendChild(signupButton);
  buttonsWrapper.appendChild(backButton);

  formContainer.appendChild(heading);
  formContainer.appendChild(message);
  formContainer.appendChild(buttonsWrapper);
}

function checkUserName() {
  const usernameInput = document.getElementById("signup_username");
  const username = usernameInput.value.trim();
  if (isInputEmpty(usernameInput)) {
    showError("Please enter a Username", formContainer);
    return false;
  }

  if (!isValidUsername(username)) {
    showError("Username must be 3-10 characters and can only contain letters, numbers, or underscores", formContainer);
    return false;
  }

  clearError();
  return true;
}

function checkPasswords() {
  const password = document.getElementById("signup_password").value;
  const confirmPassword = document.getElementById("signup_password_confirm").value;

  if (!password || !confirmPassword) {
    showError("Please fill in both password fields", formContainer);
    return false;
  }

  if (password.length < 6) {
    showError("Password must be at least 6 characters", formContainer);
    return false;
  }

  if (password !== confirmPassword) {
    showError("Passwords don't match", formContainer);
    return false;
  }

  clearError();
  return true;
}

function onUserNameExistsError() {
  showError("Network error. Please try again.", formContainer);
}

function onUserNameSubmitResponse(userNameExist) {
  if (userNameExist === null) {
    showError("Error checking username. Please try again.", formContainer);
  } else if (userNameExist) {
    showError("Username already in use.", formContainer); r
  } else {
    document.getElementById("signupForm").submit();
  }
}

function handleSignupFormSubmit(event) {
  event.preventDefault();
  clearError();

  if (!checkPasswords() || !checkUserName()) {
    return;
  }

  const username = document.getElementById("signup_username").value;
  checkUsernameExists(username).then(onUserNameSubmitResponse, onUserNameExistsError);
}

function showSignupForm(email) {
  const formContainer = document.getElementById("Form_content_container");
  formContainer.innerHTML = "";

  const form = document.createElement("form");
  form.method = "POST";
  form.id = "signupForm";

  const emailInput = document.createElement("input");
  emailInput.type = "hidden";
  emailInput.name = "signup_email";
  emailInput.value = email;
  form.appendChild(emailInput);

  const usernameContainer = createInput(
    "Create Username",
    "text",
    "signup_username",
    "Enter your username"
  );

  const passwordContainer = createInput(
    "Create Password",
    "password",
    "signup_password",
    "Enter your password"
  );

  const confirmPasswordContainer = createInput(
    "Confirm Password",
    "password",
    "signup_password_confirm",
    "Confirm your password"
  );


  const buttonsWrapper = document.createElement("div");
  buttonsWrapper.className = "buttons_wrapper";

  function handleBackButtonClick(event) {
    event.preventDefault();
    showSignupPrompt(email);
  }

  const submitButton = createButton("Complete Sign Up", "SigninButton");
  const backButton = createButton(
    "Back",
    "GoBackButton",
    "goBackButton",
    handleBackButtonClick
  );

  buttonsWrapper.appendChild(submitButton);
  buttonsWrapper.appendChild(backButton);

  form.appendChild(usernameContainer);
  form.appendChild(passwordContainer);
  form.appendChild(confirmPasswordContainer);
  form.appendChild(buttonsWrapper);
  formContainer.appendChild(form);

  document.getElementById("signup_username").addEventListener("blur", checkUserName);
  document.getElementById("signup_password").addEventListener("blur", checkPasswords);
  document.getElementById("signup_password_confirm").addEventListener("blur", checkPasswords);
  form.addEventListener("submit", handleSignupFormSubmit);
}


function showInitialForm() {
  const formContainer = document.getElementById("Form_content_container");
  formContainer.innerHTML = "";

  const emailContainer = createInput(
    "Email",
    "text",
    "Form_email_input",
    "your@email.com",
    true
  );

  const emailInput = emailContainer.querySelector('input');

  const buttonsWrapper = document.createElement("div");
  buttonsWrapper.className = "buttons_wrapper";

  const submitButton = createButton("Continue with this email", "SigninButton");

  buttonsWrapper.appendChild(submitButton);

  formContainer.appendChild(emailContainer);
  formContainer.appendChild(buttonsWrapper);

  emailInput.addEventListener("input", checkEmail);
  document.getElementById("authForm").addEventListener("submit", handleEmailSubmit);
}

const authForm = document.getElementById("authForm");
if (authForm) {
  showInitialForm();
  authForm.addEventListener("submit", handleEmailSubmit);
}