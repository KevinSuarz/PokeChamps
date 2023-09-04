<?php
  require_once '../app/Config/main.php';

  function timed(){
    $userID = $_SESSION['id'];
    $check_time = conection();
    $check_time = $check_time->query("SELECT * FROM pokeButton WHERE user_id = '$userID'");

    if($check_time->rowCount()==1){

      $check_time=$check_time->fetch();
      $lastClick = $check_time['last_click'];

      if($lastClick != ''){

        $ultimoClick = strtotime($lastClick);
        $ahora = time();
        $diferenciaHoras = ($ahora - $ultimoClick)/3600;

        if ($diferenciaHoras >= 24) {
          $check_time=null;
          return 0;
        } else {
          $check_time=null;
          return 1;
        }
      }else{
      
        $check_time=null;
        return 1;
      }
    }else{
      $now = 1;
      $conn = mysqli_connect('localhost', 'root', '', 'pokechamps');
      $sql = "INSERT INTO pokebutton (user_id, last_click) VALUES ($userID, $now)";
      if (mysqli_query($conn, $sql)) {
        echo json_encode(['message' => 'pokemon registrado con exito']);
      } else {
        echo json_encode(['message' => 'Error: ' . mysqli_error($conn)]);
      }
      mysqli_close($conn);
      return 0;
    };
  };

  $timed = timed();
?>