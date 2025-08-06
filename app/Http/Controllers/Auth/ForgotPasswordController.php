<?php
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not registered']);
        }

        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        Mail::to($request->email)->send(new SendOtpMail($otp));

        return redirect('/verify-otp')->with('email', $request->email);
    }

    public function showVerifyOtpForm(Request $request)
    {
        $email = session('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $record = PasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record || Carbon::now()->gt($record->expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        $record->delete();

        return redirect('/login')->with('success', 'Password reset successful.');
    }
}
?>