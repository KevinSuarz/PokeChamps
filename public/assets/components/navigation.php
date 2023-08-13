<?php 
  if(isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['lastName']) && isset($_SESSION['userName'])){
    echo '
      <div class="navigation">
        <a href="" class="navigation__item-home navigation__item"><i class="fa-solid fa-house"></i></a>
        <a href="" class="navigation__item-cards navigation__item"><i class="fa-solid fa-clone"></i></a>
        <a href="" class="navigation__item-pokedex navigation__item"><i class="fa-solid fa-mobile"></i></a>
        <a href="" class="navigation__item-multiplayer navigation__item"><i class="fa-solid fa-hand-fist"></i></a>
        <a href="" class="navigation__item-stats navigation__item"><i class="fa-solid fa-chart-simple"></i></a>
        <a href="" class="navigation__item-profile navigation__item"><i class="fa-solid fa-user"></i></a>
      </div>
    ';
  }else {
    echo '';
  }
?>
