<section class="hero">
  <div class="form-rest"></div>
  <div class="hero__layout">
    <img class="hero__img" src="assets/images/homepage-hero.png" alt="group of pokemons">
  <div class="hero__timer">
    <?php 
      if(isset($_SESSION['id']) && isset($_SESSION['userName']) && isset($_SESSION['email'])){
        echo'
          <div>
            <h4>OPEN IT</h4>
          </div>
          <a class="hero__timer-lock">
            <i class="fa-solid fa-unlock"></i>
          </a>
        ';

        // <div>
        //   <p>next card in</p>
        //   <h4>20:15:06</h4>
        // </div>
        // <a class="hero__timer-lock">
        //   <i class="fa-solid fa-lock"></i>
        // </a>

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
</section>