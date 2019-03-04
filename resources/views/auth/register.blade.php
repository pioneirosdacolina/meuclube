<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/dist/css/adminlte.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/iCheck/square/blue.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="http://www.pioneirosdacolina.com.br">
                    <img src="./img/logo.png" alt="{{ config('app.name', 'Laravel') }} Logo" class="brand-image img-circle" style="opacity: 0.8; float: unset"> <br />
                    <b>{{ config('app.name', 'Laravel') }}</b>
                </a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">{{__('messages.createUser')}}</p>

                    <form action="{{ route('register') }}" method="post">
                        @csrf

                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   placeholder="{{ __('label.fullName') }}" required autofocus>
                            <div class="input-group-append">
                                <span class="fa fa-user input-group-text"></span>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  placeholder="{{__( 'label.email' )}}" required>
                            <div class="input-group-append">
                                <span class="fa fa-envelope input-group-text"></span>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('label.password')}}" required>
                            <div class="input-group-append">
                                <span class="fa fa-lock input-group-text"></span>
                            </div>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('label.passwordConfirm')}}" required>
                            <div class="input-group-append">
                                <span class="fa fa-lock input-group-text"></span>
                            </div>
                        </div>
                        <div class="row">
                            {{--<div class="col-8">--}}
                                {{--<div class="checkbox icheck">--}}
                                    {{--<label>--}}
                                        {{--<div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> I agree to the <a href="#">terms</a>--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{__('label.register')}}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    {{----}}
                    {{--<div class="social-auth-links text-center">--}}
                        {{--<p>- OR -</p>--}}
                        {{--<a href="#" class="btn btn-block btn-primary">--}}
                            {{--<i class="fa fa-facebook mr-2"></i>--}}
                            {{--Sign up using Facebook--}}
                        {{--</a>--}}
                        {{--<a href="#" class="btn btn-block btn-danger">--}}
                            {{--<i class="fa fa-google-plus mr-2"></i>--}}
                            {{--Sign up using Google+--}}
                        {{--</a>--}}
                    {{--</div>--}}

                    <a href="{{route('login')}}" class="text-center">{{__('label.userExists')}}</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- iCheck -->
        <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass   : 'iradio_square-blue',
                    increaseArea : '20%' // optional
                })
            })
        </script>


    </body>
</html>