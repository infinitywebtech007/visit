@extends('adminlte::auth.login')

@section('auth_body')
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3" id="password-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text" style="cursor: pointer;" id="toggle-password">
                <span class="fa fa-eye"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
    </div>
</form>

<style>
    .login-logo>a {
        color: transparent;
        font-size: 0px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('span').classList.toggle('fa-eye');
            this.querySelector('span').classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
