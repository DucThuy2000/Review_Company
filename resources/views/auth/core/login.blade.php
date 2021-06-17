@extends("auth.layout")
@section("login_content")
    <div class="overlay_loading">
        <div class="loading">
            <img src="{{ asset("picture/loading.gif") }}">
        </div>
    </div>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Review</b>Company</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form class="login-form" action="" method="POST" data-url="{{ route("auth.authenticate") }}">
                    @csrf
                    @include("admin.template.error")
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="auth_email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="auth_password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember_token">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button class="btn_login btn btn-primary btn-block" type="submit">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>
@stop
