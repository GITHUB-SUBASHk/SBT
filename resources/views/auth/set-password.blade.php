<form method="POST" action="/set-password">
  @csrf
  <input type="hidden" name="user_id" value="{{ $user->id }}">
  <input type="password" name="password">
  <input type="password" name="password_confirmation">
  <button type="submit">Set Password</button>
</form>
