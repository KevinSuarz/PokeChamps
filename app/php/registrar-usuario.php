<?php
  include "../Config/main.php";

//ALMACENANDO DATOS
  $userName = limpiar_cadena($_POST['register_userName']);
  $email = limpiar_cadena($_POST['register_email']);
  $pswd = limpiar_cadena($_POST['register_pswd']);
  $pswdRptd = limpiar_cadena($_POST['register_pswd-rptd']);

//VERIFICANDO CAMPOS OBLIGATORIOS
  if($userName=="" || $pswd=="" || $email=="" || $pswdRptd==""){
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

  if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $pswdRptd)){
    echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        LA CONTRASEÑA NO CUMPLE CON LOS REQUERIMIENTOS SOLICITADOS POR LA PAGINA
      </div>
    ']);
    exit();
  };

//VERIFICANDO EL EMAIL
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    $check_email = conection();
    $check_email = $check_email->query("SELECT user_email FROM users WHERE user_email ='$email'");
    if($check_email->rowCount() > 0){
      echo json_encode([
      'message' => '
        <div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          EL EMAIL INGRESADO YA SE ENCUENTRA REGISTRADO, POR FAVOR ELIGA OTRO CORREO O INTENTE RECUPERARLO SI ES SUYO EL CORREO ELECTRONICO
        </div>
      ']);
      exit();
    }

    $check_email = null;
  }else{
    echo json_encode([
      'message' => '
      <div class="notification is-danger is-light">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL EMAIL INGRESADO NO ES VALIDO
      </div>
    ']);
  exit();
  }

//VERIFICANDO EL USERNAME
  $check_userName = conection();
  $check_userName = $check_userName->query("SELECT user_userName FROM users where user_userName='$userName'");

  if($check_userName->rowCount() > 0){
    echo json_encode([
      'message' => '
      <div class="notification is-danger is-light">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL NOMBRE DE USUARIO YA SE ENCUENTRA REGISTRADO, POR FAVOR ELIGA OTRO NOMBRE DE USUARIO O INTENTE RECUPERARLO SI ES SUYO EL CORREO ELECTRONICO
      </div>
    ']);
    exit();
  }else {
    if(verificar_datos("[a-zA-Z0-9]{4,30}", $userName)){
      echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL NOMBRE NO CUMPLE CON EL FORMATO SOLICITADO
      </div>
      ']);
      exit();
    }
  };
  $check_userName = null;

//VERIFICANDO CLAVES
  if($pswd != $pswdRptd){
    echo json_encode([
      'message' => '
      <div class="notification is-danger is-light">
        <strong>Ocurrio un error inesperdado</strong><br>
        LAS CONTRASEÑAS NO COINCIDEN
      </div>
    ']);
    exit();
  }else{
    $pswd =password_hash($pswd, PASSWORD_BCRYPT,["COST"=>10]);
  }


//GUARDANDO EL USUARIO
  $guardar_usuario = conection();
  $guardar_usuario = $guardar_usuario->prepare("INSERT INTO users(user_userName, user_email, user_password) VALUES(:userName, :email, :pswrd)");

//AQUI EJECUTAMOS LA CONSULTA PASANDOLE UN ARRAY
  $marcadores =[
    ":userName" => $userName,
    ":email" => $email,
    ":pswrd" => $pswd
  ];
  $guardar_usuario->execute($marcadores);


  if($guardar_usuario->rowCount()==1){

    echo json_encode([
      'register' => true,
      'message' => '
        <div class="">
          <strong>Usuario Registrado Con Exito</strong>
        </div>
      '
    ]);

  }else{
    echo json_encode([
      'message' => '
      <div class="">
        <strong>Ocurrio un error inesperdado</strong><br>
        NO SE PUDO REGISTRAR EL USUARIO, por favor intente de nuevo
      </div>
    ']);
  }
  $guardar_usuario = null;



