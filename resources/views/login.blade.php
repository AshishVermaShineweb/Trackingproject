<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Company</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ url('alert.css') }}">

    <style>

        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: 'Roboto', sans-serif;
}

.container {
  position: relative;
  width: 100%;
  min-height: 100vh;
  background-color: var(--bg-color);
  overflow: hidden;
  background-image: url(https://photoshop-kopona.com/uploads/posts/2019-02/1550441916_32.jpg);
  background-repeat: no-repeat;
  background-size: cover;

}

.container:before {
  content: "";
  position: absolute;
  width: 2000px;
  height: 2000px;
  border-radius: 50%;
  background: linear-gradient(-45deg, var(--bg-round-a), var(--bg-round-b));
  top: -10%;
  right: 48%;
  transform: translateY(-50%);
  z-index: 6;
  transition: 1.8s ease-in-out;
  background: #820f2a;
    /* opacity: 0.3; */
  /* background-image: url(./assets/images/banner/banner2.png); */
}

.forms-container {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.signin-signup {
  position: absolute;
  top: 50%;
  left: 75%;
  transform: translate(-50%, -50%);
  width: 50%;
  display: grid;
  grid-template-columns: 1fr;
  z-index: 5;
  transition: 1s 0.7s ease-in-out;
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 5rem;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
  transition: 0.2s 0.7s ease-in-out;
}

form.sign-in-form {
  z-index: 2;
}

form.sign-up-form {
  z-index: 1;
  opacity: 0;
}

/* MODAL */

.btn-modal {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: pink;
  font-size: 20px;
  color: white;
  padding: 10px 30px;
  cursor: pointer;
}

#popUpBox {
  width: 500px;
  overflow: hidden;
  background: pink;
  box-shadow: 0 0 10px black;
  border-radius: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
  padding: 10px;
  text-align: center;
  display: none;
}

.title {
  font-size: 1.5rem;
  color: var(--title);
  margin-bottom: 10px;
  font-weight: bold;
}

.input-field {
  width: 85%;
  height: 55px;
  /* background-color: var(--bg-input); */
  margin: 10px 0;
  border-radius: 55px;
  display: grid;
  grid-template-columns: 15% 70% 15%;
  padding: 0 0.4rem;
  background: #fdfbfe;
  box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
    background: #ffffff26;
}

.input-field i {
  text-align: center;
  line-height: 55px;
  color: var(--input-icon);
  font-size: 1.1rem;
}

.key {
  color: var(--key-color);
  text-decoration: none;
}

.key:hover {
  color: var(--pass-hover-color);
}

.pass {
  margin: 12px 0;
  color: var(--pass-color);
}

.pass:hover {
  color: var(--pass-hover-color);
}

#togglePassword {
  text-align: center;
  color: var(--input-icon);
}

#toggleReg {
  text-align: center;
  color: var(--input-icon);
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: var(--input);
}

.input-field input::placeholder {
  color: var(--input-hover);
  font-weight: 500;
}

.btn {
  width: 150px;
  height: 49px;
  border: none;
  outline: none;
  border-radius: 49px;
  cursor: pointer;
  /* background-color: var(--btn-color); */
  color: var(--btn-text);
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  transition: 0.5s;
  background-color: #820f4a;
  color: #fff;
}

.btn:hover {
  /* background-color: var(--btn-hover); */
  background-color: #820f4a;
}

.check {
  display: block;
  position: relative;
  margin: 12px 0;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.checkmark {
  color: var(--check-text);
}

.checkmark a {
  color: var(--check-link);
  text-decoration: underline;
}

.checkmark a:hover {
  color: var(--check-hover);
}

.social-text {
  padding: 0.7rem 0;
  font-size: 1rem;
  color: var(--social-text);
}

.social-media {
  display: flex;
  justify-content: center;
}

.social-icon {
  height: 46px;
  width: 46px;
  border: 1px solid var(--icon-color);
  margin: 0 0.45rem;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  color: var(--icon-color);
  font-size: 1.1rem;
  border-radius: 50%;
  transition: 0.3s;
}

.social-icon:hover {
  color: var(--social-icon);
  border-color: var(--social-icon);
}

.icon-mode {
  height: 32px;
  width: 32px;
  border: 1px solid var(--icon-color);
  margin: 40px 5px 0 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  color: var(--icon-color);
  font-size: 1rem;
  border-radius: 50%;
  transition: 0.3s;
}

.icon-mode:hover {
  color: var(--social-icon);
  border-color: var(--social-icon);
}

.text-mode {
  padding: 0.5rem 0;
  font-size: 0.8rem;
  font-style: italic;
  color: var(--social-text);
}

.panels-container {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.panel {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-around;
  text-align: center;
  z-index: 7;
}

.left-panel {
  pointer-events: all;
  padding: 3rem 17% 2rem 12%;
}

.right-panel {
  pointer-events: none;
  padding: 3rem 12% 2rem 17%;
}

.panel .content {
  /* color: var(--panel-color); */
  transition: 0.9s 0.6s ease-in-out;
  color: #fff;
}

.panel h3 {
  font-weight: 600;
  line-height: 1;
  font-size: 1.5rem;
}

.panel p {
  font-size: 0.95rem;
  padding: 0.7rem 0;
}

.btn.transparent {
  margin: 0;
  background: none;
  border: 2px solid #fff;
  width: 130px;
  height: 41px;
  font-weight: 600;
  font-size: 0.8rem;
}

.image {
  width: 90%;
  margin-top: 10px;
  transition: 1.1s 0.4s ease-in-out;
}

.right-panel .content,
.right-panel .image {
  transform: translateX(800px);
}

/* ANIMATION */

.container.sign-up-mode:before {
  transform: translate(100%, -50%);
  right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
  transform: translateX(-800px);
}

.container.sign-up-mode .right-panel .content,
.container.sign-up-mode .right-panel .image {
  transform: translateX(0px);
}

.container.sign-up-mode .left-panel {
  pointer-events: none;
}

.container.sign-up-mode .right-panel {
  pointer-events: all;
}

.container.sign-up-mode .signin-signup {
  left: 25%;
}

.container.sign-up-mode form.sign-in-form {
  z-index: 1;
  opacity: 0;
}

.container.sign-up-mode form.sign-up-form {
  z-index: 2;
  opacity: 1;
}

/* KEYBOARD */

.keyboard {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  padding: 5px 0;
  background: var(--keyboard-color);
  box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
  user-select: none;
  transition: bottom 0.4s;
  z-index: 999;
}

.keyboard--hidden {
  bottom: -100%;
}

.keyboard__keys {
  text-align: center;
}

.keyboard__key {
  height: 45px;
  width: 6%;
  max-width: 90px;
  margin: 3px;
  border-radius: 4px;
  border: none;
  background: rgba(255, 255, 255, 0.2);
  color: var(--key-letter);
  font-size: 1.05rem;
  outline: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  vertical-align: top;
  padding: 0;
  -webkit-tap-highlight-color: transparent;
  position: relative;
}

.keyboard__key:active {
  background: rgba(255, 255, 255, 0.12);
}

.keyboard__key--wide {
  width: 12%;
}

.keyboard__key--extra-wide {
  width: 36%;
  max-width: 500px;
}

.keyboard__key--activatable::after {
  content: "";
  top: 10px;
  right: 10px;
  position: absolute;
  width: 8px;
  height: 8px;
  background: rgba(0, 0, 0, 0.4);
  border-radius: 50%;
}

.keyboard__key--active::after {
  background: #08ff00;
}

.keyboard__key--dark {
  background: rgba(0, 0, 0, 0.25);
}

/* MEDIA SCREEN */

@media (max-width: 870px) {
  .container {
    min-height: 800px;
    height: 100vh;
  }

  .container::before {
    width: 1500px;
    height: 1500px;
    left: 30%;
    bottom: 68%;
    transform: translateX(-50%);
    right: initial;
    top: initial;
    transition: 2s ease-in-out;
  }

  .signin-signup {
    width: 100%;
    left: 50%;
    top: 95%;
    transform: translate(-50%, -100%);
    transition: 1s 0.8s ease-in-out;
  }

  .panels-container {
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 2fr 1fr;
  }

  .panel {
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    padding: 2.5rem 8%;
  }

  .panel .content {
    padding-right: 15%;
    transition: 0.9s 0.8s ease-in-out;
  }

  .panel h3 {
    font-size: 1.2rem;
  }

  .panel p {
    font-size: 0.7rem;
    padding: 0.5rem 0;
  }

  .btn.transparent {
    width: 110px;
    height: 35px;
    font-size: 0.7rem;
  }

  .image {
    display: none;
  }

  /*.image {
        width: 200px;
        transition: 0.9s 0.6s ease-in-out;
    }*/

  .left-panel {
    grid-row: 1 / 2;
  }

  .right-panel {
    grid-row: 3 / 4;
  }

  .right-panel .content,
  .right-panel .image {
    transform: translateY(300px);
  }

  .container.sign-up-mode:before {
    transform: translate(-50%, 100%);
    bottom: 32%;
    right: initial;
  }

  .container.sign-up-mode .left-panel .image,
  .container.sign-up-mode .left-panel .content {
    transform: translateY(-300px);
  }

  .container.sign-up-mode .signin-signup {
    top: 5%;
    transform: translate(-50%, 0);
    left: 50%;
  }

  .keyboard,
  .key {
    opacity: 0;
    visibility: hidden;
    font-size: 0.1px;
  }
}

@media (max-width: 570px) {
  form {
    padding: 0 1.5rem;
  }

  .image {
    display: none;
  }

  .panel .content {
    padding: 0.5rem 1rem;
  }

  .panel p {
    opacity: 0;
  }

  .container:before {
    bottom: 75%;
    left: 50%;
  }

  .container.sign-up-mode:before {
    bottom: 24%;
    left: 50%;
  }

  .field-icon {
    float: right;
    margin-left: 300px;
    margin-top: -55px;
    position: relative;
    z-index: 1;
  }
}

@media (max-width: 385px) {
  .field-icon {
    float: right;
    margin-left: 260px;
    margin-top: -55px;
    position: relative;
    z-index: 1;
  }
}

@media (max-width: 350px) {
  .field-icon {
    float: right;
    margin-left: 200px;
    margin-top: -55px;
    position: relative;
    z-index: 1;
  }
}
body{
    font-family: 'Poppins', sans-serif;
}
h1,h2,h3,h4,h5,h6{
    font-family: 'Poppins', sans-serif !important;
    font-weight: bolder;
}
button{
    font-family: 'Poppins', sans-serif !important;
}
input{
    font-family: 'Poppins', sans-serif !important;
    font-size: 15px !important;
}
input:focus{
    font-family: 'Poppins', sans-serif !important;
    font-size: 15px !important;
}
a{
    text-decoration: none;
    font-family: 'Poppins', sans-serif !important;
}
p{
    font-family: 'Poppins', sans-serif !important;
}
input:-internal-autofill-selected {
    appearance: menulist-button;
    background-color: initial !important;

}
input::placeholder{
    font-family: 'Poppins', sans-serif !important;

}
/* loader csss */
.loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  border: 3px solid;
  border-color: #FFF #FFF transparent transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px solid;
  border-color: transparent transparent #FF3D00 #FF3D00;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-sizing: border-box;
  animation: rotationBack 0.5s linear infinite;
  transform-origin: center center;
}
.loader::before {
  width: 32px;
  height: 32px;
  border-color: #FFF #FFF transparent transparent;
  animation: rotation 1.5s linear infinite;
}

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}

/*loader css */

#loader-box{
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;;
    background:rgba(0,0,0,0.5);
z-index: 999999999;;

}
#loader-box div{
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.d-none{
    display: none;
}
    </style>

</head>
<body>
    <div class="loader-box d-none" id="loader-box">
        <div>
            <span class="loader"></span>

        </div>
      </div>
    <div class="container">
        <div class="forms-container">
          <div class="signin-signup">
            <form action="" class="sign-in-form" id="login-form">
              <h4 class="title">Company Login Here</h4>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="email" autocomplete="username" placeholder="Username" required="yes">
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" autocomplete="current-password" placeholder="Password" id="id_password" required="yes">
                <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
              </div>

              <a class="pass" href="#">Forgot your password?</a>
              <input type="submit" value="Sign in" class="btn solid">

            </form>
            <form action="" class="sign-up-form">
              <h2 class="title">Register Now!..</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" autocomplete="username" placeholder="Username" required="yes">
              </div>
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="correo" autocomplete="email" placeholder="Email" required="yes">
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="contraseña" autocomplete="current-password" placeholder="Password" id="id_reg" required="yes">
                <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
              </div>

              <input type="submit" value="Create account" class="btn solid">

            </form>
          </div>
        </div>
        <div class="panels-container">
          <div class="panel left-panel">
            <div class="content">
              <h3>You don't have an account?</h3>
              <p>Create your account right now to follow people and like publications</p>
              <button class="btn transparent" id="sign-up-btn">Register</button>
            </div>
            <img src="img/log.svg" class="image" alt="">
          </div>

          <div class="panel right-panel">
            <div class="content">
              <h3>Already have an account?</h3>
              <p>Login to see your notifications and post your favorite photos</p>
              <button class="btn transparent" id="sign-in-btn">Sign in</button>
            </div>
            <img src="img/register.svg" class="image" alt="">
          </div>
        </div>
      </div>


      <script>
          const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

const htmlEl = document.getElementsByTagName("html")[0];
const currentTheme = localStorage.getItem("theme")
  ? localStorage.getItem("theme")
  : null;
if (currentTheme) {
  htmlEl.dataset.theme = currentTheme;
}
const toggleTheme = (theme) => {
  htmlEl.dataset.theme = theme;
  localStorage.setItem("theme", theme);
};

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#id_password");

togglePassword.addEventListener("click", function (e) {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const toggleReg = document.querySelector("#toggleReg");
const pass = document.querySelector("#id_reg");

toggleReg.addEventListener("click", function (e) {
  const type = pass.getAttribute("type") === "password" ? "text" : "password";
  pass.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

// KEYBOARD

const Keyboard = {
  elements: {
    main: null,
    keysContainer: null,
    keys: []
  },

  eventHandlers: {
    oninput: null,
    onclose: null
  },

  properties: {
    value: "",
    capsLock: false
  },

  init() {
    // Create main elements
    this.elements.main = document.createElement("div");
    this.elements.keysContainer = document.createElement("div");

    // Setup main elements
    this.elements.main.classList.add("keyboard", "keyboard--hidden");
    this.elements.keysContainer.classList.add("keyboard__keys");
    this.elements.keysContainer.appendChild(this._createKeys());

    this.elements.keys = this.elements.keysContainer.querySelectorAll(
      ".keyboard__key"
    );

    // Add to DOM
    this.elements.main.appendChild(this.elements.keysContainer);
    document.body.appendChild(this.elements.main);

    // Automatically use keyboard for elements with .use-keyboard-input
    document.querySelectorAll(".use-keyboard-input").forEach((element) => {
      element.addEventListener("focus", () => {
        this.open(element.value, (currentValue) => {
          element.value = currentValue;
        });
      });
    });
  },

  _createKeys() {
    const fragment = document.createDocumentFragment();
    const keyLayout = [
      "1",
      "2",
      "3",
      "4",
      "5",
      "6",
      "7",
      "8",
      "9",
      "0",
      "backspace",
      "q",
      "w",
      "e",
      "r",
      "t",
      "y",
      "u",
      "i",
      "o",
      "p",
      "caps",
      "a",
      "s",
      "d",
      "f",
      "g",
      "h",
      "j",
      "k",
      "l",
      "enter",
      "done",
      "z",
      "x",
      "c",
      "v",
      "b",
      "n",
      "m",
      ",",
      ".",
      "?",
      "space"
    ];

    // Creates HTML for an icon
    const createIconHTML = (icon_name) => {
      return `<i class="material-icons">${icon_name}</i>`;
    };

    keyLayout.forEach((key) => {
      const keyElement = document.createElement("button");
      const insertLineBreak =
        ["backspace", "p", "enter", "?"].indexOf(key) !== -1;

      // Add attributes/classes
      keyElement.setAttribute("type", "button");
      keyElement.classList.add("keyboard__key");

      switch (key) {
        case "backspace":
          keyElement.classList.add("keyboard__key--wide");
          keyElement.innerHTML = createIconHTML("⌫");

          keyElement.addEventListener("click", () => {
            this.properties.value = this.properties.value.substring(
              0,
              this.properties.value.length - 1
            );
            this._triggerEvent("oninput");
          });

          break;

        case "caps":
          keyElement.classList.add(
            "keyboard__key--wide",
            "keyboard__key--activatable"
          );
          keyElement.innerHTML = createIconHTML("⇪");

          keyElement.addEventListener("click", () => {
            this._toggleCapsLock();
            keyElement.classList.toggle(
              "keyboard__key--active",
              this.properties.capsLock
            );
          });

          break;

        case "enter":
          keyElement.classList.add("keyboard__key--wide");
          keyElement.innerHTML = createIconHTML("↵");

          keyElement.addEventListener("click", () => {
            this.properties.value += "\n";
            this._triggerEvent("oninput");
          });

          break;

        case "space":
          keyElement.classList.add("keyboard__key--extra-wide");
          keyElement.innerHTML = createIconHTML("⎵");

          keyElement.addEventListener("click", () => {
            this.properties.value += " ";
            this._triggerEvent("oninput");
          });

          break;

        case "done":
          keyElement.classList.add(
            "keyboard__key--wide",
            "keyboard__key--dark"
          );
          keyElement.innerHTML = createIconHTML("✓");

          keyElement.addEventListener("click", () => {
            this.close();
            this._triggerEvent("onclose");
          });

          break;

        default:
          keyElement.textContent = key.toLowerCase();

          keyElement.addEventListener("click", () => {
            this.properties.value += this.properties.capsLock
              ? key.toUpperCase()
              : key.toLowerCase();
            this._triggerEvent("oninput");
          });

          break;
      }

      fragment.appendChild(keyElement);

      if (insertLineBreak) {
        fragment.appendChild(document.createElement("br"));
      }
    });

    return fragment;
  },

  _triggerEvent(handlerName) {
    if (typeof this.eventHandlers[handlerName] == "function") {
      this.eventHandlers[handlerName](this.properties.value);
    }
  },

  _toggleCapsLock() {
    this.properties.capsLock = !this.properties.capsLock;

    for (const key of this.elements.keys) {
      if (key.childElementCount === 0) {
        key.textContent = this.properties.capsLock
          ? key.textContent.toUpperCase()
          : key.textContent.toLowerCase();
      }
    }
  },

  open(initialValue, oninput, onclose) {
    this.properties.value = initialValue || "";
    this.eventHandlers.oninput = oninput;
    this.eventHandlers.onclose = onclose;
    this.elements.main.classList.remove("keyboard--hidden");
  },

  close() {
    this.properties.value = "";
    this.eventHandlers.oninput = oninput;
    this.eventHandlers.onclose = onclose;
    this.elements.main.classList.add("keyboard--hidden");
  }
};

window.addEventListener("DOMContentLoaded", function () {
  Keyboard.init();
});
      </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script src="{{ url('alert.js') }}"></script>
<script>
// triggerAlert('Login successfully redirecting',"success");
$(function(){
    $("#login-form").submit(function(e){

        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"/login-data",
            data:{
                email:$("#login-form").find("input[name='email']").val(),
                password:$("#login-form").find("input[name='password']").val(),
                _token:"{{ csrf_token() }}",

            },
            beforeSend:function(){

            $(".loader-box").removeClass("d-none");
            },
            success:function(response){
                console.log(response);
                $(".loader-box").addClass("d-none");
                if(response=="success"){
                // triggerAlert(`${response}`,"error");
                triggerAlert('Login successfully redirecting',"success");
                setTimeout(function(){
                    window.location.href="/company/dashboard";

                },5000);

                }
                else{
                    triggerAlert(`${response}`,"error");
                }

            },
            error:function(response,messg){
                console.log(response);
            }
        });

    });

    function message(){
        alert();
    }

});

</script>

</body>
</html>
