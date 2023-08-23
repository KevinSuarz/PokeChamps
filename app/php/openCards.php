<?php
require_once "../Config/main.php";
include '../app/Config/session_start.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the data was successfully decoded
    if ($data === null) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
        exit;
    }
    $pokeID = $data['cardID'];
    $userID = $_SESSION['id'];

    //GUARDANDO EL USUARIO
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

      echo json_encode([
        'register' => true,
        'message' => '
          <div class="">
            <strong>nuevo pokemon adquirido</strong>
          </div>
        '
      ]);

    }else{
      echo json_encode([
        'message' => '
        <div class="">
          <strong>Ocurrio un error inesperdado</strong><br>
          NOCURRIO UN ERROR, CONTACTE CON SOPORTE
        </div>
      ']);
    }
    $newCard = null;

    // Send a success response
    echo json_encode(['status' => 'success', 'message' => 'Card added successfully']);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
