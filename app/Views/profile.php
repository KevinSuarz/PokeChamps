<?php 
  require_once "assets/components/verify-session.php";
  require_once "../app/config/main.php";

  $id = $_SESSION['id'];
  $check_user = conection();
  $check_user = $check_user->query("SELECT * FROM users WHERE user_id = '$id'");

  if($check_user->rowCount()>0){
    $data = $check_user->fetch();
?>
<section class="profile">
  <div class="form-rest"></div>
  <div class="profile__layout">
    <div class="profile__info">
      <div class="profile__info-foto">
        <div class="profile__info-fotoIMG">
          <img src="assets/images/profile.webp" alt="" class="profile__info-IMG">
          <input type="file" name="update__pic" accept="image/*" class="update__pic" form="update__form">
        </div>
        <h4><strong><?php echo $_SESSION['userName'];?></strong>#<?php echo $_SESSION['id'];?></h4>
        <div class="profile__info-status">
          <h5>voy a ser el mejor entrenador pokemon, lo juro.</h5>
        </div>
        <div class="profile__info-trophies">
          <div>
            <i class="fa-solid fa-trophy"></i>
            <i class="fa-solid fa-trophy"></i>
            <i class="fa-solid fa-trophy"></i>
            <i class="fa-solid fa-trophy"></i>
          </div>
          <div class="profile__info-points">
            <i class="fa-solid fa-chart-simple"></i>
            <h4>1600</h4>
          </div>
        </div>
      </div>
      <div class="profile__info-changes">
          <form id="update__form" class="login__form update__form" action="../app/php/actualizar-usuario.php" method="POST" autocomplete="off">
		      <input type="hidden" value = "<?php echo $data['user_id']; ?>" name="user_id" required>

          <div class="update__username df">
            <label class="update__username-label">USERNAME</label>
            <div class="update__username-field">
              <input class="update__username-input" type="text" name="update_username" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" placeholder="<?php echo $data['user_userName'];?>">
            </div>
          </div>

          <div class="update__email df">
            <label class="update__email-label">EMAIL</label>
            <div class="update__email-field">
              <input class="update__email-input" type="text" name="update_email" maxlength="40" placeholder="<?php echo $data['user_email'];?>">
            </div>
          </div>

          <div class="update__status df">
            <label class="update__status-label">STATUS</label>
            <div class="update__status-field">
              <input class="update__status-input" type="text" name="update_status" pattern="[a-zA-Z0-9]{4,20}" maxlength="60" placeholder="">
            </div>
          </div>

          <div class="update__password df">
              <label class="update__password-label">PASSWORD</label>
              <div class="update__password-field">
                <input class="update__password-input" type="password" name="update_pswd" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
              </div>
          </div>
          <div class="update__passwordR df">
              <label class="update__passwordR-label">REPEAT PASSWORD</label>
              <div class="update__passwordR-field">
                <input class="update__passwordR-input" type="password" name="update_pswdR" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
              </div>
          </div>
          <div class="update__buttons">
            <button type="submit" class="update__submit">
              <i class="fa-solid fa-circle-check fzm"></i>
              SAVE CHANGES
            </button>
            <button type="reset" value="reset" class="update__discard">
              <i class="fa-solid fa-circle-xmark fzm"></i>
              DISCARD CHANGES
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="profile__stats">
      <h5 class="txtw"><strong>se unio desde el 17 de agosto  del 2023</strong> </h5>
      <img src="assets/images/logo-PokeChamps.png" alt="Pokechamps logo" class="profile__stats-img">
      <div class="profile__stats-pokemons">
        <i class="fa-solid fa-hippo txtw fzl"></i>
        <h4 class="txtw">123/151</h4>
      </div>
      <div class="profile__stats-stats">
        <div class="profile__stats-item">
          <h3>123</h3>
          <h5>BATALLAS</h5>
        </div>
        <div class="profile__stats-item">
          <h3>12</h3>
          <h5>VICTORIAS</h5>
        </div>
        <div class="profile__stats-item">
          <h3>3.34</h3>
          <h5>KD</h5>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
  }else{
    include "errors/404.html";
  }
  $check_usuario = null;
?>