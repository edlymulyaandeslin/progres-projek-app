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

                <div class="mt-5 mb-3 text-center text-white d-flex flex-column">
                    <h2 class="fw-bold">Progres Projek<h2>
                            <h3 class="border-top pt-3 pb-3">Login</h3>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('github.redirect') }}">
                                    <img src="/img/github.png" class="img-thumbnail rounded-circle" width="50px" alt="">
                                </a>
                                <a href="#">
                                    <img src="/img/google.png" width="50px" class="img-thumbnail rounded-circle" alt="">
                                </a>
                            </div>
                            <p class="pt-3">Or</p>
                </div>

                <form action="/auth/login" method="post">
                    @csrf
                    <div class=" input-box">
                        <input type="text" class="input-field @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                        <i class="bx bx-user"></i>
                    </div>
                    @error('email')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                    @enderror

                    <div class="input-box">
                        <input type="password" class="input-field @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password">
                        <i class="bx bx-lock"></i>
                        <span class="show-password-icon " onclick="togglePasswordVisibility('password')">
                            <i class="bx bx-show" id="passwordIcon"></i>
                        </span>
                    </div>
                    @error('password')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                    @enderror

                    <div>
                        <label for="remember" class="text-white">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="submit">Login</button>
                    </div>
                </form>
                <div class="two-col my-2">
                    <div class="quest-box">
                        <span>Don't have an account?
                            <a href="/auth/register">Sign Up</a></span>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('sweetalert::alert')

    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>