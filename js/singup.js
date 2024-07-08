const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input");

continueBtn.onclick = () => {
  // Ajax starts
  let xhr = new XMLHttpRequest(); // this creates an XML object
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {};
  xhr.send();
};
