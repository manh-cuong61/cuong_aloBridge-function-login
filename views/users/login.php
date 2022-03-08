<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/mobile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="main">
        <div class="main-left">
            <img src="./img/melons-4507974__480.jpg" alt="">
        </div>
        <div class="main-right">
            <div class="login-header">
                <h1>
                    Hello Again!
                </h1>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Temporibus praesentium perferendis minima, laboriosam neque
                </p>
            </div>
            <form action="">
                <div class="login-input">
                    <div class="main-email">
                        <div class="input">
                            <label for="email">Email</label>
                            <div class="input-all">
                                <div class="input-left">

                                </div>
                                <div class="input-main">
                                    <input id="email" name="email" type="text" placeholder="Email">
                                </div>
                                <div class="img">
                                    <i class="fas fa-at"></i>
                                </div>
                            </div>
                            <span class="email_error"></span>
                        </div>
                    </div>
                    <div class="main-password">
                        <div class="input">
                            <label for="password">Password</label>
                            <div class="input-all">
                                <div class="input-left">

                                </div>
                                <div class="input-main">
                                    <input id="password" name="password" type="text" placeholder="Password">
                                </div>
                                <div class="img">
                                    <i class="fas fa-unlock-alt"></i>
                                </div>
                            </div>
                            <span class="password_error"></span>
                        </div>
                    </div>
                    <div class="remember">
                        <input id='remember' type="checkbox" value="1" name="remember">
                        <span class="keep-me">Remember me</span>
                        <span class="recovery">Recovery Password</span>
                    </div>
                </div>
                <div class="login-button">
                    <div class="main-login">
                        <div class="input">
                            <div class="input-all">
                                <div class="input-left">
                                </div>
                                <div class="input-main">
                                    <input id="login" name="login" type="submit" value="Login">
                                </div>
                                <div class="img">
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-google">
                        <div class="input">
                            <div class="input-all">
                                <div class="input-left">
                                </div>
                                <div class="input-main">
                                    <img src="./img/google.png" alt="">
                                    <input id="login-google" name="login-google" type="submit" value="Sign in with google">
                                </div>
                                <div class="img">
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="login-footer">
                <span>Dont have an account yet?</span>
                <h4>Sign up</h4>
            </div>
        </div>
    </div>
    <script src="./js/validate-login.js"></script>
</body>

</html>