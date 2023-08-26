<?php
require_once "../Config/main.php";
require_once '../Config/session_start.php'; 


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

    $newCard = conection();
    $newCard = $newCard->prepare(
      "INSERT INTO user_pokemons (user_id, pokemons_id) VALUES (:userID, :pokeID)"
    );

    $marcadores =[
      ":pokeID" => $pokeID,
      ":userID" => $userID
    ];
    
    $newCard->execute($marcadores);

    if($newCard->rowCount()==1){
      echo json_encode($pokeID);

    }else{
      echo json_encode($pokeID);
    }
    $newCard = null;

} else {
  http_response_code(405);
  echo json_encode(['message' => 'Invalid request method']);
}

?>
