<form action="/forgot-password" method="POST">
  @csrf
  <input type="email" name="email" placeholder="Enter your email" required>
  <button type="submit">Send OTP</button>
</form>
<h2>Forgot Password</h2>