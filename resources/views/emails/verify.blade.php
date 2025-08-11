<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $user->first_name ?? $user->email }},</h2>
    <p>Thank you for registering. Click below to set your password:</p>
    <p>
        <a href="{{ url('/verify/'.$user->verification_token) }}">Set your password</a>
    </p>
</body>
</html>
