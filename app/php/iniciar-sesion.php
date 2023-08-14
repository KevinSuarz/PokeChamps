<?php
  include "../Config/main.php";

//ALMACENANDO DATOS
  $user = limpiar_cadena($_POST['login_user']);
  $pswd = limpiar_cadena($_POST['login_pswd']);

//VERIFICANDO CAMPOS OBLIGATORIOS
  if($user=="" || $pswd==""){
    echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        ASEGURATE DE LLENAR TODOS LOS CAMPOS
      </div>
    ']);
    exit();
  };

//VERIFICANDO LA INTEGRIDAD DE LOS DATOS
  if(verificar_datos("[a-zA-Z0-9]{4,20}", $user)){
    echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL NOMBRE NO CUMPLE CON EL FORMATO SOLICITADO
      </div>
    ']);
    exit();
  };

  if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $pswd)){
    echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        LA CONTRASEÑA NO CUMPLE CON LOS REQUERIMIENTOS SOLICITADOS POR LA PAGINA
      </div>
    ']);
    exit();
  };


  $check_user = conection();
  $check_user = $check_user->query("SELECT * FROM users WHERE user_userName = '$user'");


  if($check_user->rowCount()==1){
    $check_user=$check_user->fetch();

    if($check_user['user_userName'] == $user && password_verify($pswd,$check_user['user_password'])){
      session_start();

      $_SESSION['id'] = $check_user['user_id'];
      $_SESSION['userName'] = $check_user['user_userName'];
      $_SESSION['email'] = $check_user['user_email'];

      echo json_encode(['success' => true]);
      exit();

    }else{
      echo json_encode([
      'message' => '<div class="">
          USUARIO O CLAVE INCORRECTOS
      </div>'])
    ;
    }
  }else{
    echo json_encode([
      'message' => '<div class="">
        EL USUARIO NO SE ENCUENTRA REGISTRADO
      </div>'])
    ;
  }
  $check_user = null;