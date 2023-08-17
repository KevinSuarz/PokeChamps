<?php 
  if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['userName'])){
    if(headers_sent()){
    echo "<script> window.location.href='index.php?view=homepage'; </script>";
  }else{
    header("location: index.php?view=homepage");
  }
  }
?>
<section class="login">
  <div class="form-rest"></div>
  <div class="login__layout"> 
  <form class="login__form" action="../app/php/iniciar-sesion.php" method="POST" autocomplete="off">

    <div class="login__username">
      <label class="login__username-label">USERNAME OR EMAIL</label>
      <div class="login__username-field">
        <i></i>
        <input class="login__username-input" type="text" name="login_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
      </div>
    </div>

    <div class="login__password">
        <label class="login__password-label">PASSWORD</label>
        <div class="login__password-field">
          <input class="login__password-input" type="password" name="login_pswd" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
        </div>
    </div>
    <p class="has-text-centered mb-4 mt-3">
      <button type="submit" class="login__submit">LOGIN</button>
    </p>

    <a href="index.php?view=register" class="login__register">
      no tienes cuenta? registrate
    </a>
  </form>

  </div>
</section>