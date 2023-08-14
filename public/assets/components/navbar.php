<nav class="navbar">
  <div class="navbar__layout layout">
    <div class="navbar__brand">
      <a href="index.php">
        <img src="assets/images/Logo-PokeChamps.png" alt="Logo de PokeChamps" class="navbar__logo">
      </a>
    </div>

    <div class="navbar__content">
      <!-- <a href="index.php?view=logout" class="navbar__logout">
              <i class="fa-solid fa-right-from-bracket txtw fzl"></i>
            </a> -->

      <?php
        if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['userName'])){
          echo '
            <div class="navbar__pokeballs round">
              <img src="assets/images/pokeball-1.png" alt="Pokeball" class="navbar__pokeballs-ball">
              <h6 class="navbar__pokeball-counter txtw">123</h6>
            </div>

            <a href="index.php?view=logout" class="navbar__logout">
              <i class="fa-solid fa-right-from-bracket txtw fzl"></i>
            </a>
          ';
        }else{
          if(isset($_GET['view']) && $_GET['view']=='login'){
            echo '
              <a href="index.php?view=register" class="login__btn round">
                <h6 class="login-counter txtb">REGISTER</h6>
                <img src="assets/images/pokeball-2.png" alt="" class="navbar__pokeballs-ball">
              </a>
            ';
          }else{
            echo '
              <a href="index.php?view=login" class="login__btn round">
                <h6 class="login-counter txtb">LOGIN</h6>
                <img src="assets/images/pokeball-2.png" alt="" class="navbar__pokeballs-ball">
              </a>
            ';
          }
        };
      ?>
      
      
      
    </div>
  </div>
</nav>