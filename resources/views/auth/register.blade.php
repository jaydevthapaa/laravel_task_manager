<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="{{ $errors->has('name') ? 'input-error' : '' }}">
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       class="{{ $errors->has('password') ? 'input-error' : '' }}">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%">
                Register
            </button>
        </form>

        <div class="form-footer">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>
</div>

</body>
</html>