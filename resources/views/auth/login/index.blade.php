<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div>

                    <div class="mt-5">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 text-center text-white">
                        <h2 class="fw-bold">Progres Projek<h2>
                                <hr>
                                <h3>Login</h3>
                    </div>

                    <form action="/auth/login" method="post">
                        @csrf
                        <div class="input-box">

                        </div>
                        <div class=" input-box mb-2">
                            <input type="text" class="input-field" placeholder="Username or Email"
                                @error('email') is-invalid @enderror id="email" name="email"
                                value="{{ old('email') }}"> <i class="bx bx-user"></i>
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="input-box mb-2">
                            <input type="password" class="input-field" placeholder="Password"
                                @error('password') is-invalid @enderror('password') name="password" id="password">
                            <i class="bx bx-lock-alt"></i>
                            <span class="show-password-icon" onclick="togglePasswordVisibility('password')">
                                <i class="bx bx-show" id="passwordIcon"></i>
                            </span>
                            @error('password')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit" class="submit" value="login">Login</button>
                    </form>
                    <div class="two-col my-2">
                        <div class="quest-box">
                            <span>Don't have an account?
                                <a href="/auth/register" onclick="register()">Sign Up</a></span>
                        </div>
                        <div class="two">
                            <label><a href="#">Forgot password?</a></label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="/js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
