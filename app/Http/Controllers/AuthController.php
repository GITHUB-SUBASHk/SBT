<?php 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailLink;
use App\Models\User;

public function show()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'dob' => 'required|date',
        'languages' => 'required|array',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
    ]);

    $token = Str::random(64);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'username' => $request->username,
        'email' => $request->email,
        'dob' => $request->dob,
        'languages' => $request->languages,
        'country' => $request->country,
        'state' => $request->state,
        'city' => $request->city,
        'verification_token' => $token,
    ]);

    Mail::to($user->email)->send(new VerifyEmailLink($user));

    return back()->with('message', 'Verification link sent to your email.');
}
?>