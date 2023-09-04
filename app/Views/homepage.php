<section class="hero">
  <div class="form-rest"></div>
  <div class="hero__layout">
    <img class="hero__img" src="assets/images/homepage-hero.png" alt="group of pokemons">
  <div class="hero__timer">
    <?php 
      if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])){
        require_once '../app/php/24Button.php';
        if($timed==1){
          echo'
            <div>
              <p>next card in</p>
              <h4 class="timer_js">20:15:07</h4>
            </div>
            <a class="hero__timer-lock">
              <i class="fa-solid fa-lock"></i>
            </a>
          ';
        }else{
          echo'
            <div>
              <h4>puse 0</h4>
            </div>
            <a class="hero__timer-lock hero__timer-unlock">
              <i class="fa-solid fa-unlock"></i>
            </a>
          ';
        }
      }else {
        echo'
          <div>
            <h4>Claim Daily gift</h4>
          </div>
          <a class="hero__timer-lock" href="index.php?view=login">
            <i class="fa-solid fa-unlock"></i>
          </a>
        ';
      }
    ?>
  </div>
  </div>
  <script src="assets/js/clickOpenCard.js"></script>
  <script src="assets/js/backwardstimer.js"></script>
</section>