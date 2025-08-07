<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>debtors - Подтверждение электронной почты</title>
    <!-- core:css -->
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
                                        <a href="#" class="noble-ui-logo d-block mb-2">LAW<span>yer</span></a>
                                        <h5 class="text-muted font-weight-normal mb-4">Подтвердите свой адрес
                                            электронной почты</h5>

                                        @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                Новая ссылка для подтверждения была отправлена на ваш адрес электронной
                                                почты.
                                            </div>
                                        @endif

                                        <p>Прежде чем продолжить, пожалуйста, проверьте свою электронную почту на
                                            наличие ссылки для подтверждения.</p>
                                        <p>Если вы не получили письмо, нажмите кнопку ниже, чтобы запросить повторную
                                            отправку.</p>

                                        @if (auth()->check())
                                            <form method="POST" action="{{ route('verification.resend') }}"
                                                class="mt-4">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                                                    Отправить повторно
                                                </button>
                                            </form>

                                            <div class="mt-3">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        Выход
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            @if (session('email_for_verification'))
                                                <form method="POST" action="{{ route('verification.resend-guest') }}"
                                                    class="mt-4">
                                                    @csrf
                                                    <input type="hidden" name="email"
                                                        value="{{ session('email_for_verification') }}">
                                                    <button type="submit"
                                                        class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">
                                                        Отправить повторно
                                                    </button>
                                                </form>
                                            @endif
                                            <div class="mt-3">
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                                    Вернуться к входу
                                                </a>
                                            </div>
                                        @endif
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
    <!-- endinject -->
</body>

</html>
