let fadeTarget = document.querySelector(".overlay");

function show_loading() {
    fadeTarget.style.display ="block";
    fadeTarget.style.opacity = 1;
}
function hide_loading() {
    let fadeEffect = setInterval(() => {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        else {
            clearInterval(fadeEffect);
            fadeTarget.style.display = "none";
        }
    },1000)
}


function validateForm(){
    let username = $('#username').val();
    if(!username){
        console.log("username belum terisi");
        return false;
    }

    let email = $('#email').val();
    if(!email){
        console.log("email belum terisi");
        return false;
    }

    let password = $('#password').val();
    if(!password){
        console.log("password belum terisi");
        return false;
    }
    if (!(password.length >= 8 && password.length <= 16)) {
        console.log("password harus lebih dari 8 karakter dan kurang dari 16 karakter");
        return false;
    }

    let password_verify = $('#password_verify').val();
    if(!password_verify){
        console.log("password verify belum terisi");
        return false;
    }
    if (password_verify != password){
        console.log("password tidak sama");
        return false;
    }

    return true;
}

function postData(){
    let username = $('#username').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let password_verify = $('#password_verify').val();
    let submit = $('btn-submit').val();

    // console.log(username, email, password, password_verify);

    $.ajax({
        url: 'register.php',
        type: 'POST',
        data: {
            username: username,
            email: email,
            password: password,
            password_verify: password_verify,
            submit: submit
        },
        success: function(res){
            console.log("berhasil registrasi");
        },
        error: function(){
            console.log("gagal registrasi");
        }
    });
}

function sukses(){
    if (validateForm()) {
        console.log("form sudah benar");
        show_loading();
        postData();
        window.location.href = "login.php";
    }
    else{
        console.log("isi form dengan benar");
    }
}