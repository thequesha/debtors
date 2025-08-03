<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>proautochina - Подтверждение телефона</title>
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

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            margin: 0 5px;
        }

        .otp-container {
            display: flex;
            justify-content: center;
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
                                        <h5 class="text-muted font-weight-normal mb-4">Подтверждение номера телефона</h5>
                                        @if (session('message'))
                                            <div class="alert alert-info">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        @if (session('resent'))
                                            <div class="alert alert-success">
                                                Новый код подтверждения отправлен на ваш телефон.
                                            </div>
                                        @endif
                                        <form method="post" action="{{ route('sms.verify') }}" class="forms-sample">
                                            @csrf
                                            <div class="form-group text-center">
                                                <p>Пожалуйста, введите 4-значный код, отправленный на ваш телефон:</p>
                                                <div class="otp-container">
                                                    <input type="text" name="otp_1" maxlength="1" class="form-control otp-input" style="background-color: #f5f5f5; color: #333 !important;" required>
                                                    <input type="text" name="otp_2" maxlength="1" class="form-control otp-input" style="background-color: #f5f5f5; color: #333 !important;" required>
                                                    <input type="text" name="otp_3" maxlength="1" class="form-control otp-input" style="background-color: #f5f5f5; color: #333 !important;" required>
                                                    <input type="text" name="otp_4" maxlength="1" class="form-control otp-input" style="background-color: #f5f5f5; color: #333 !important;" required>
                                                    <input type="hidden" name="otp" id="otp-hidden">
                                                </div>
                                                @error('otp')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div
                                                class="mt-3 d-flex flex-row justify-content-between align-items-center">
                                                <button type="submit"
                                                    class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">Подтвердить</button>
                                                
                                                <form method="post" action="{{ route('sms.resend') }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">Отправить код повторно</button>
                                                </form>
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

    <script src="{{ customAsset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Feather icons
            feather.replace();
            
            // OTP input handling
            const otpInputs = document.querySelectorAll('.otp-input');
            const otpHidden = document.getElementById('otp-hidden');
            
            // Focus on first input
            otpInputs[0].focus();
            
            otpInputs.forEach((input, index) => {
                input.addEventListener('keyup', function(e) {
                    // If the key pressed is a number
                    if (e.key >= '0' && e.key <= '9') {
                        // Move to next input if available
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    } else if (e.key === 'Backspace') {
                        // Clear current input and move to previous if available
                        if (index > 0 && this.value === '') {
                            otpInputs[index - 1].focus();
                        }
                    }
                    
                    // Update hidden input with combined OTP
                    updateHiddenOtp();
                });
            });
            
            function updateHiddenOtp() {
                let otp = '';
                otpInputs.forEach(input => {
                    otp += input.value;
                });
                otpHidden.value = otp;
            }
            
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
