<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>proautochina - Регистрация</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ customAsset('admin/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ customAsset('admin/assets/vendors/core/core.css') }}">
    <!-- endinject -->
    @include('layouts.sections.favicon')

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ customAsset('admin/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ customAsset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ customAsset('admin/assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="stylesheet" href="{{ customAsset('admin/css/custom.css') }}">
    <style>
        .auth-page .auth-left-wrapper {
            width: 100%;
            height: 100%;
            background-image: url({{ customAsset('admin/img/login.jpg') }});
            background-position: center;
            background-size: cover;
        }

        .img-login {
            margin-top: -10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">PRO<span>auto</span></a>
                                        <h5 class="text-muted font-weight-normal mb-4">Создать новый аккаунт</h5>
                                        @if (session('message'))
                                            <div class="alert alert-danger">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{ route('register') }}" class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Имя:</label>
                                                <input type="text" name="name"
                                                    style="background-color: #f5f5f5; color: #333 !important;"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" autocomplete="off" value="{{ old('name') }}"
                                                    autofocus>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="surname">Фамилия:</label>
                                                <input type="text" name="surname"
                                                    style="background-color: #f5f5f5; color: #333 !important;"
                                                    class="form-control @error('surname') is-invalid @enderror"
                                                    id="surname" autocomplete="off" value="{{ old('surname') }}">
                                                @error('surname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Номер телефона:</label>
                                                <input type="text" name="phone"
                                                    style="background-color: #f5f5f5; color: #333 !important;"
                                                    class="form-control phone-mask @error('phone') is-invalid @enderror"
                                                    id="phone" autocomplete="off" value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Электронная почта: <small class="text-muted">(необязательно)</small></label>
                                                <input type="email" name="email"
                                                    style="background-color: #f5f5f5; color: #333 !important;"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" autocomplete="off" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Пароль:</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        style="background-color: #f5f5f5; color: #333 !important;"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="password">
                                                    <div class="input-group-append">
                                                        <button
                                                            style="background-color: #f5f5f5; border-color: #e9ecef; color: #333 !important;"
                                                            class="btn btn-outline-secondary h-100 d-flex align-items-center"
                                                            type="button" id="togglePassword"
                                                            style="border-color: #e9ecef;">
                                                            <span class="toggle-icon">
                                                                <i data-feather="eye"
                                                                    style="width: 1.2em; height: 1.2em;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Подтверждение пароля:</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        style="background-color: #f5f5f5; color: #333 !important;"
                                                        class="form-control" name="password_confirmation"
                                                        id="password_confirmation">
                                                    <div class="input-group-append">
                                                        <button
                                                            style="background-color: #f5f5f5; border-color: #e9ecef; color: #333 !important;"
                                                            class="btn btn-outline-secondary h-100 d-flex align-items-center"
                                                            type="button" id="toggleConfirmPassword"
                                                            style="border-color: #e9ecef;">
                                                            <span class="toggle-icon">
                                                                <i data-feather="eye"
                                                                    style="width: 1.2em; height: 1.2em;"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="mt-3 d-flex flex-row justify-content-between align-items-center">
                                                <button type="submit"
                                                    class="btn btn-primary mr-2 mb-md-0 text-white">Зарегистрироваться</button>
                                                <a href="{{ route('login') }}" class="d-block text-muted">Уже
                                                    есть аккаунт? Войти</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ customAsset('admin/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ customAsset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ customAsset('admin/assets/js/template.js') }}"></script>
    <script src="{{ customAsset('admin/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ customAsset('admin/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- endinject -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Phone mask initialization
            $('.phone-mask').inputmask('+7 999 9999999');
            feather.replace();

            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle icon
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.setAttribute('data-feather', 'eye-off');
                } else {
                    icon.setAttribute('data-feather', 'eye');
                }
                feather.replace();
            });

            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordConfirmation = document.getElementById('password_confirmation');

            toggleConfirmPassword.addEventListener('click', function() {
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);

                // Toggle icon
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.setAttribute('data-feather', 'eye-off');
                } else {
                    icon.setAttribute('data-feather', 'eye');
                }
                feather.replace();
            });
        });
    </script>
    
    <!-- OTP verification script -->
    <script>
        // Show OTP toast if exists in session
        @if(session('otp'))
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Код подтверждения',
                text: 'Ваш код подтверждения: {{ session('otp') }}',
                icon: 'info',
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 10000
            });
        });
        @endif
    </script>
</body>

</html>
