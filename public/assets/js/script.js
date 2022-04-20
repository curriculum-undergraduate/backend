const signUp = document.querySelector("#signUp");
const signIn = document.querySelector("#signIn");
const passwordIcon = document.querySelectorAll(".password__icon");
const authPassword = document.querySelectorAll(".auth__password");

document.getElementsByName('password')[0].placeholder = 'your password';
if  (document.getElementsByName('confirm_password')[0]) {
  document.getElementsByName('confirm_password')[0].placeholder = 'confirm your password';
}


// change hidden password to visible password

for (var i = 0; i < passwordIcon.length; ++i) {
  passwordIcon[i].addEventListener("click", (i) => {
    const lastArray = i.target.classList.length - 1;
    console.log(lastArray)
    if (i.target.classList[lastArray] == "bi-eye-slash") {
      i.target.classList.remove("bi-eye-slash");
      i.target.classList.add("bi-eye");
      i.currentTarget.parentNode.querySelector("input").type = "text";
    } else {
      i.target.classList.add("bi-eye-slash");
      i.target.classList.remove("bi-eye");
      i.currentTarget.parentNode.querySelector("input").type = "password";
    }
  });
}