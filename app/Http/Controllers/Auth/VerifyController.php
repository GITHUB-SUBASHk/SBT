<?php 
public function showForm($token)
{
    $user = User::where('verification_token', $token)->firstOrFail();
    return view('auth.set-password', compact('user'));
}

public function savePassword(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::find($request->user_id);
    $user->password = bcrypt($request->password);
    $user->verification_token = null;
    $user->save();

    return redirect('/login')->with('success', 'Password set successfully! Please login.');
}
?>