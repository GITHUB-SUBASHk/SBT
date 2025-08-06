<h2>Hello {{ $user->first_name }},</h2>

<p>Thank you for registering. Click below to set your password:</p>

<a href="{{ url('/verify/'.$user->verification_token) }}">
    Set your password
</a>
