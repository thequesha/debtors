<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>proautochina - Восстановление пароля</title>
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
            background-position: right;
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
                                        <h5 class="text-muted font-weight-normal mb-4">Восстановление пароля</h5>
                                        @if (session('message'))
                                            <div class="alert alert-danger">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <form id="reset-form" method="post" action="{{ route('password.update') }}" class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="phone">Номер телефона:</label>
                                                <input type="text" name="phone"
                                                    style="background-color: #f5f5f5; color: #333 !important;"
                                                    class="form-control phone-mask @error('phone') is-invalid @enderror"
                                                    id="phone" autocomplete="off" value="{{ old('phone') }}"
                                                    autofocus>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <!-- OTP section (hidden initially) -->
                                            <div id="otp-section" style="display: none;">
                                                <div class="form-group">
                                                    <label for="otp">Проверочный код:</label>
                                                    <input type="text" name="otp"
                                                        style="background-color: #f5f5f5; color: #333 !important;"
                                                        class="form-control @error('otp') is-invalid @enderror"
                                                        id="otp" autocomplete="off" value="{{ old('otp') }}">
                                                    @error('otp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <!-- Password fields (shown after OTP is sent) -->
                                                <div class="form-group">
                                                    <label for="password">Новый пароль:</label>
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
                                            </div>
                                            
                                            <div class="mt-3 d-flex flex-row justify-content-between align-items-center">
                                                <div>
                                                    <button type="button" id="send-code-btn" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Получить код</button>
                                                    <button type="submit" id="submit-btn" style="display: none;" class="btn btn-success mr-2 mb-2 mb-md-0 text-white">Сохранить пароль</button>
                                                </div>
                                                
                                                <div>
                                                    <a href="{{ route('login') }}" class="d-block">Вернуться</a>
                                                </div>
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

    <script src="{{ customAsset('admin/assets/vendors/core/core.js') }}"></script>
    <script src="{{ customAsset('admin/assets/js/template.js') }}"></script>
    <script src="{{ customAsset('admin/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ customAsset('admin/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ customAsset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            console.log("DOM fully loaded and parsed");

            // Initialize Feather icons
            feather.replace();

            // Phone mask initialization
            $('.phone-mask').inputmask('+7 999 9999999');
            
            // Password toggle functionality
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const iconWrapper = this.querySelector('.toggle-icon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    iconWrapper.innerHTML =
                        '<i data-feather="eye-off" style="width: 1.2em; height: 1.2em;"></i>';
                } else {
                    passwordInput.type = 'password';
                    iconWrapper.innerHTML =
                        '<i data-feather="eye" style="width: 1.2em; height: 1.2em;"></i>';
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

            // Send code button functionality
            document.getElementById('send-code-btn').addEventListener('click', function(e) {
                e.preventDefault();
                
                const phone = document.getElementById('phone').value;
                if (!phone || phone.includes('_')) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: 'Пожалуйста, введите корректный номер телефона',
                        icon: 'error',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }
                
                // Generate dummy OTP
                const otp = Math.floor(1000 + Math.random() * 9000);
                
                // Show OTP as toast
                Swal.fire({
                    title: 'Код отправлен',
                    text: `Ваш код для восстановления: ${otp}`,
                    icon: 'success',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 5000
                });
                
                // Populate OTP field
                document.getElementById('otp').value = otp;
                
                // Show OTP section and password fields
                document.getElementById('otp-section').style.display = 'block';
                
                // Hide send code button and show submit button
                this.style.display = 'none';
                document.getElementById('submit-btn').style.display = 'inline-block';
                
                // Disable phone field
                document.getElementById('phone').readOnly = true;
            });
            
            // Form submission validation
            document.getElementById('reset-form').addEventListener('submit', function(e) {
                const otp = document.getElementById('otp').value;
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;
                
                // Validate OTP
                if (!otp || otp.length !== 4 || isNaN(otp)) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Ошибка',
                        text: 'Пожалуйста, введите корректный код подтверждения',
                        icon: 'error',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }
                
                // Validate password
                if (!password || password.length < 8) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Ошибка',
                        text: 'Пароль должен быть не менее 8 символов',
                        icon: 'error',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }
                
                // Validate password confirmation
                if (password !== passwordConfirmation) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Ошибка',
                        text: 'Пароли не совпадают',
                        icon: 'error',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }
            });
            
            // Show OTP toast if exists in session
            @if(session('otp'))
            Swal.fire({
                title: 'Код подтверждения',
                text: 'Ваш код подтверждения: {{ session('otp') }}',
                icon: 'info',
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 10000
            });
            
            // Show OTP section if OTP is in session
            document.getElementById('otp-section').style.display = 'block';
            document.getElementById('send-code-btn').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'inline-block';
            document.getElementById('phone').readOnly = true;
            @endif
        });
    </script>
</body>

</html>
