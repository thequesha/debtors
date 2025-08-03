<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>proautochina</title>
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
                                        @if (session('message'))
                                            <div class="alert alert-danger">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{ route('loginPost') }}" class="forms-sample">
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
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Пароль:</label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        style="background-color: #f5f5f5; color: #333 !important;"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="exampleInputPassword1"
                                                        autocomplete="current-password">
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
                                            <div
                                                class="mt-3 d-flex flex-row justify-content-between align-items-center">
                                                <button type="submit"
                                                    class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Войти</button>

                                                <div class="">
                                                    <a href="{{ route('password.request') }}">Забыли пароль?</a>
                                                </div>
                                                <a href="{{ route('register') }}" class="text-decoration-none">Нет
                                                    аккаунта?</a>
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

    <!-- Add modal markup -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Восстановление пароля</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm">
                        <div class="form-group">
                            <label for="reset-phone">Введите номер телефона:</label>
                            <input type="text" class="form-control phone-mask" id="reset-phone" name="reset-phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="send-reset-code">Отправить код</button>
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

            // Password toggle functionality
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('exampleInputPassword1');
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

            // Password toggle functionality is already handled above

            // Phone mask initialization
            $('.phone-mask').inputmask('+7 999 9999999');

            // Reset password code sending
            document.getElementById('send-reset-code').addEventListener('click', function() {
                const phone = document.getElementById('reset-phone').value;
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
                
                // Close modal
                $('#contactModal').modal('hide');
                
                // Show OTP as toast
                Swal.fire({
                    title: 'Код отправлен',
                    text: `Ваш код для сброса пароля: ${otp}`,
                    icon: 'success',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 5000
                });
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
            @endif
        });
    </script>
</body>

</html>
