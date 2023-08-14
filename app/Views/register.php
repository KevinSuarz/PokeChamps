<section class="register">
  <div class="form-rest"></div>
  <div class="register__layout">
    <form class="login__form" action="../app/php/registrar-usuario.php" method="POST" autocomplete="off">

    <div class="register__username">
      <label class="register__username-label">USERNAME</label>
      <div class="register__username-field">
        <i></i>
        <input class="register__username-input" type="text" name="register_userName" pattern="[a-zA-Z0-9]{4,0}" maxlength="20" required>
      </div>
    </div>

    <div class="register__email">
      <label class="register__email-label">EMAIL</label>
      <div class="register__email-field">
        <i></i>
        <input class="register__email-input" type="email" name="register_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="40" required>
      </div>
    </div>

    <div class="register__password">
        <label class="register__password-label">PASSWORD</label>
        <div class="register__password-field">
          <input class="register__password-input" type="password" name="register_pswd" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
        </div>
    </div>

    <div class="register__passwordRepeated">
        <label class="register__passwordRepeated-label">REPEAT PASSWORD</label>
        <div class="register__passwordRepeated-field">
          <input class="register__passwordRepeated-input" type="password" name="register_pswd-rptd" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
        </div>
    </div>

    <p class="has-text-centered mb-4 mt-3">
      <button type="submit" class="register__submit">REGISTER</button>
    </p>

  </form>
  </div>
</section>