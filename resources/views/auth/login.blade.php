<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%">
                Login
            </button>
        </form>

        <div class="form-footer">
            No account yet? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
</div>

</body>
</html>