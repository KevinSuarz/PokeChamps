<?php
  // require_once '../app/Config/main.php';
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data == null) {
        http_response_code(400);
        echo json_encode(['message' => 'el fetch esta vacio']);
        exit();
    }else {

      
      $Date = $data['clickTime'];
      $userID = $_SESSION['id'];
      // echo json_encode(['message' => 'si']);

      // $update_click = conection();
      // $update_click = $update_click->query("UPDATE pokebutton SET last_click = $Date WHERE user_id = '$userID'");
      // echo json_encode(['message' => 'click actualizado']);
      // exit();

        $conn = mysqli_connect('localhost', 'root', '', 'pokechamps');
        $sql = "UPDATE pokebutton SET last_click = $Date WHERE user_id = '$userID'";

        if (mysqli_query($conn, $sql)) {
          echo json_encode(['message' => 'click actualizado']);
        } else {
          echo json_encode(['message' => 'Error: ' . mysqli_error($conn)]);
        }
        mysqli_close($conn);

    }
  }

?>