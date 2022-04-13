<?php 
require_once 'inc/header.php';
require_once 'config/function.php';
register_user();

?>
  <div>
        <!-- blue circle background -->
    <div class="d-none d-lg-block ball register bg-gradient position-absolute h-75 rounded">
        <h3 class="fw-bolder mt-3 text-center text-white pt-4">Curriculum Undergraduate</h3>
    </div>


    <!-- Register Section -->

    <div class="container register__form active">
        <div class="row vh-100 w-100 align-self-center">
            <div class="col-12 col-lg-6 col-xl-6 px-5 form-auth-register">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder mt-3">REGISTER HERE !</h3>
                        <p class="fw-lighter fs-6">Have an account, <span id="signUp" role="button"
                                class="text-info"><a href="login.php" style="text-decoration: none; color: white;" class="fw-bold">Sign
                                    In</a></span></p>
                        
                        <?php if(isset($_SESSION['MESSAGE'])) { ?>
                            <div class="alert alert-info">
                                <?= display_message(); ?>
                            </div>
                        <?php } ?>

                        <!-- form login section -->
                        <form method="post" class="mt-5">
                            <div class="mb-3">
                                <label for="InputName" class="form-label">Name</label>
                                <input type="text" id="InputName" name="username"
                                    class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3"
                                    placeholder="Your Name">   
                            </div>
                            <div class="mb-3">
                                <label for="InputEmail" class="form-label">Email</label>
                                <input type="email" id="InputEmail" name="email"
                                    class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3"
                                    placeholder="name@example.com">
                            </div>
                            <div class="mb-4">
                                <label for="InputPassword" class="form-label">Password</label>
                                <div class="d-flex position-relative">
                                <input type="password'" id="InputPassword" name="password" placeholder="your password"
                                        class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3">
                                <span class="password__icon text-dark fs-4 fw-bold bi bi-eye-slash" id="togglePassword"></span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="InputConfirmPassword" class="form-label">Confirm Password</label>
                                <div class="d-flex position-relative">
                                <input type="password" id="InputConfirmPassword" name="confirm_password" placeholder="confirm password"
                                        class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3">
                                    <span class="password__icon text-dark fs-4 fw-bold bi bi-eye-slash" id="togglePassword"></span>
                                </div>
                            </div>
                            <div class="pt-3" style="margin-bottom: -10px;">
                                <div class="row mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                        <label class="form-check-label" for="dropdownCheck">
                                            By signing in, I agree to the CU Privacy Statement and Terms of Service.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <button type="submit"
                                    class="btn btn-outline-light btn-lg rounded-pill mt-4 w-100" 
                                    name="btn_register">Register</button>
                            </div>
                        </form>
                        <div class="separator mt-5 text-white">Or Sign up with social platforms</div>
                        <div class="row text-center" style="color:#ffffff;">
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

    <div class="d-none d-lg-block col-lg-6 col-xl-6 position-absolute">
        <div class="row vh-100" style="padding-top: 35%; margin-left: 113%;">
            <div class="col align-self-center text-center">
                <img src="assets/images/welkam1.png" width="350" class="bounce" alt="">
            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php';?>