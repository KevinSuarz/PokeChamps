<?php
  include "../Config/main.php";

//ALMACENANDO DATOS
  $user = limpiar_cadena($_POST['login_user']);
  $pswd = limpiar_cadena($_POST['login_pswd']);

//VERIFICANDO CAMPOS OBLIGATORIOS
  if($user=="" || $pswd==""){
    echo '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        ASEGURATE DE LLENAR TODOS LOS CAMPOS
      </div>
    ';
    exit();
  };

//VERIFICANDO LA INTEGRIDAD DE LOS DATOS
  if(verificar_datos("[a-zA-Z0-9]{4,20}", $user)){
    echo '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL NOMBRE NO CUMPLE CON EL FORMATO SOLICITADO
      </div>
    ';
    exit();
  };

  if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $pswd)){
    echo '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        LA CONTRASEÑA NO CUMPLE CON LOS REQUERIMIENTOS SOLICITADOS POR LA PAGINA
      </div>
    ';
    exit();
  };


  $check_user = conection();
  $check_user = $check_user->query("SELECT * FROM users WHERE user_userName = '$user'");


  if($check_user->rowCount()==1){
    $check_user=$check_user->fetch();

    // ASI QUEDA CUANDO YA LAS CONTRASENIAS E USUARIOS SE REGISTRAN CON LA ENCRIPTACION DE PSWD
    // if($check_user['user_name'] == $usuario && password_verify($clave,$check_user['usuario_clave'])){
    if($check_user['user_userName'] == $user && $check_user['user_password'] == $pswd){
      session_start();

      $_SESSION['id'] = $check_user['user_id'];
      $_SESSION['nombre'] = $check_user['user_name'];
      $_SESSION['lastName'] = $check_user['user_lastName'];
      $_SESSION['userName'] = $check_user['user_userName'];


      //MANEJO DE CABECERAS EN PHP O JS, PERO LO MANEJO DIRECTAMENTE EN EL FETCH 
      // header("location: ../../public/index.php?view=homepage");
      // exit();

      // if(headers_sent()){
      //   echo "<script> window.location.href='../../public/index.php?view=homepage'; </script>";
      // }else{
      //   header("location: ../../public/index.php?view=homepage");
      // }

      echo json_encode(['success' => true]);
      exit();

    }else{
      echo json_encode(['success' => false, 
      'message' => 
      '<div class="">
          USUARIO O CLAVE INCORRECTOS
      </div>'  
    ]);
    }
  }else{
    echo json_encode(['success' => false, 
      'message' => 
      '<div class="">
        EL USUARIO NO SE ENCUENTRA REGISTRADO
      </div>'  
    ]);
  }
  $check_user = null;