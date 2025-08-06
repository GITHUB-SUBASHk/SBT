<form action="/verify-otp" method="POST">
  @csrf
  <input type="hidden" name="email" value="{{ $email }}">
  <input type="text" name="otp" placeholder="Enter OTP" required>
  <input type="password" name="password" placeholder="New Password" required>
  <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
  <button type="submit">Reset Password</button>
</form>
