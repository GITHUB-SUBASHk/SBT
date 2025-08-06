<form method="POST" action="/register">
  @csrf
  <!-- all input fields for first_name, last_name, etc. -->
  <input type="text" name="first_name">
  <!-- ... add the rest -->
  <button type="submit">Register</button>
</form>
