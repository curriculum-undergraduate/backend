<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Forgot Password</title>
</head>

<body>
    <div class="container forget__form active d-flex justify-content-center">
        <div class="col-12 col-lg-6 col-xl-6 px-5 forget-auth-login">
            <div class="row vh-100">
                <div class="col align-self-center p-5 w-100">
                    <!-- form Forget Password section -->
                    <form action="" class="mt-4">
                        <div class="card-header-outline-none">
                            <h5 class="card-title text-center text-white fw-bold mt-5">Forgot Password</h5>
                        </div>
                        <div class="mt-3">
                            <label for="InputUsername" class="form-label">Email</label>
                            <input type="email" id="InputUsername"
                                class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3"
                                placeholder="name@example.com" />
                        </div>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-outline-light btn-lg rounded-pill mt-4 w-100">
                                Submit
                            </button>
                        </div>
                        <div class="mt-3">
                            <div id="Privacy" class="form-text">
                                <p>This site is protected by reCAPTCHA and the Google Privacy
                                    Policy and Terms of Service apply.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>