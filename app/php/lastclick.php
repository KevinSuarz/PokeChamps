<?php
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data == null) {
        http_response_code(400);
        echo json_encode(['message' => 'el fetch esta vacio']);
        exit();
      }else {
        
      $userID = $_SESSION['id'];
        
      // $conn = mysqli_connect('localhost', 'root', '', 'pokechamps');
      // $sql = "SELECT last_click FROM pokebutton WHERE user_id = $userID";
      // if ($result = mysqli_query($conn, $sql)) {
      //   echo json_encode(['message' => 'click actualizado', 'timer' => $result]);
      // } else {
      //   echo json_encode(['message' => 'Error: ' . mysqli_error($conn)]);
      // }
      // mysqli_close($conn);

      $conn = new mysqli('localhost', 'root', '', 'pokechamps');
      if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
      }
      $query = "SELECT last_click FROM pokebutton WHERE user_id = $userID";
      $result = $conn->query($query);
      if ($result) {
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode([
          'message' => 'logrado',
          'timer' => $data
        ]);

      } else {
          echo "Error en la consulta: " . $conn->error;
      }

      // Cerrar la conexión a la base de datos
      $conn->close();
    }
  }

?>