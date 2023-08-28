<?php
require_once "../Config/main.php";
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents("php://input"), true);

  
    if ($data == null) {
        http_response_code(400);
        echo json_encode(['message' => 'el fetch esta vacio']);
        exit();
    }else {
      $pokeID = $data['cardID'];
      $userID = $_SESSION['id'];
    }

    $conn = mysqli_connect('localhost', 'root', '', 'pokechamps');
    $sql = "INSERT INTO pokemons (user_id, pokemons_cards) VALUES ($userID, $pokeID)";
    if (mysqli_query($conn, $sql)) {
      echo json_encode(['message' => 'pokemon registrado con exito']);
    } else {
      echo json_encode(['message' => 'Error: ' . mysqli_error($conn)]);
    }
    mysqli_close($conn);

} else {
  http_response_code(405);
  echo json_encode(['message' => 'Invalid request method']);
}

?>
