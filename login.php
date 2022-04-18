<?php 
require_once 'inc/header.php';
require_once 'config/function.php';
login_user();
?>

<div>
        <div class="d-none d-lg-block ball login position-absolute h-75 rounded">
            <h3 class="fw-bolder mt-3 text-center text-white pt-4">
                Curriculum Undergraduate
            </h3>
        </div>

        <!-- Login Section -->

        <div class="container login__form active">
            <div class="row vh-100 w-100 align-self-center">
                <div class="col-md-6"></div>
                <div class="col-12 col-lg-6 col-xl-6 px-5 form-auth-login">
                    <div class="row vh-100">
                        <div class="col align-self-center p-5 w-100">
                            <h3 class="fw-bolder mt-3">WELCOME BACK !</h3>
                            <p class="fw-lighter fs-6">
                                Don't have an account,
                                <span id="signUp" role="button"><a href="register.php" class="text-light"
                                        style="text-decoration: none"><b>Sign Up</b></a></span>
                            </p>
                            <?php if(isset($_SESSION['MESSAGE'])) { ?>
                                <div class="alert alert-info">
                                    <?= display_message(); ?>
                                </div>
                            <?php } ?>
                            <!-- form login section -->
                            <form method="post" class="mt-5">
                                <div class="mb-3">
                                    <label for="InputEmail" class="form-label">Email</label>
                                    <input type="email" id="InputEmail" name="email"
                                        class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3"
                                        placeholder="name@example.com" />
                                </div>
                                <div class="mb-4">
                                    <label for="InputPassword" class="form-label">Password</label>
                                    <div class="d-flex position-relative">
                                        <input type="password" id="password"
                                            name="password"
                                            class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3"
                                            />
                                        <span class="password__icon text-dark fs-4 fw-bold bi bi-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="pt-3" style="margin-bottom: -10px">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="dropdownCheck" />
                                                <label class="form-check-label" for="dropdownCheck">
                                                    Stay Sign In
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="text-center">
                                                <a href="forgotpassword.php" class="mt-5"
                                                    style="text-decoration: none">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" name="btn_login" class="btn btn-outline-light btn-lg rounded-pill mt-4 w-100">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="separator mt-5 text-white">
                                Or Sign in with social platforms
                            </div>
                            <div class="row text-center">
                                <div class="col mt-3">
                                    <a href="" class="btn btn-outline-light border-2 rounded-thumbnail"><i
                                            class="bi bi-facebook fs-5"></i></a>
                                </div>
                                <div class="col mt-3">
                                    <a href="" class="btn btn-outline-light border-2 rounded-thumbnail"><i
                                            class="bi bi-linkedin fs-5"></i></a>
                                </div>
                                <div class="col mt-3">
                                    <a href="" class="btn btn-outline-light border-2 rounded-thumbnail"><i
                                            class="bi bi-twitter fs-5"></i></a>
                                </div>
                                <div class="col my-3">
                                    <a href="" class="btn btn-outline-light border-2 rounded-thumbnail"><i
                                            class="bi bi-google fs-5"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-none d-lg-block col-lg-6 col-xl-6">
            <div class="row vh-100" style="padding-top: 13%; margin-left: -50px">
                <div class="col align-self-center text-center">
                    <img src="assets/images/laptop.png" width="300" class="bounce" alt="" />
                </div>
            </div>
        </div>
    </div>

  <?php require_once 'inc/footer.php';?>