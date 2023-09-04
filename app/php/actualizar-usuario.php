<?php 
  require_once "../config/session_start.php";
  require_once "../config/main.php";

$id =limpiar_cadena($_POST['user_id']);

//VERIFICAR EL USUARIO
  $check_user = conection();

  $check_user = $check_user->query("SELECT * FROM users WHERE user_id = '$id'");

  if($check_user->rowCount()<=0){
    echo json_encode([
      'message' =>'
      <div class="notification is-danger is-light">
        <strong>Ocurrio un error inesperdado</strong><br>
        EL USUARIO NO EXISTE EN EL SISTEMA
      </div>
    '
    ]);
    exit();
  }else{
    $data = $check_user->fetch();
  }
  $check_user = null;


$userName = limpiar_cadena($_POST['update_username']);
$email = limpiar_cadena($_POST['update_email']);
$status = limpiar_cadena($_POST['update_status']);

$pswd = limpiar_cadena($_POST['update_pswd']);
$pswdR  = limpiar_cadena($_POST['update_pswdR']);

if($userName != ""){
  if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{4,20}", $userName)){
  echo json_encode([
    'message' => 
    '<div class="notification is-danger is-light">
      <strong>Ocurrio un error inesperdado</strong><br>
      EL NOMBRE DE USUARIO NO CUMPLE CON EL FORMATO SOLICITADO
    </div>'
  ]);
  exit();
  };
};


if($email!="" && $email!=$data['user_email']){
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    $check_email = conection();
    $check_email = $check_email->query("SELECT user_email FROM users WHERE user_email = '$email'");
    if($check_email->rowCount()>0){
      echo json_encode([
        'message' => 
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          EL CORREO INGRESADO YA SE ENCUENTRA REGISTRADO
        </div>'
      ]);
      exit();
    }
    $check_email = null;
  }else{
    echo json_encode([
        'message' => 
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          EL EMAIL INGRESADO NO ES VALIDO
        </div>'
      ]);
      exit();
  }
}else {
  $email = $data['user_email'];
}

if($userName!="" && $userName != $data['user_userName']){
  $check_user = conection();
  $check_user = $check_user->query("SELECT user_userName FROM users WHERE user_userName ='$userName'");
  if($check_user->rowCount() > 0){
    echo json_encode([
        'message' => 
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          EL NOMBRE DE USUARIO INGRESADO YA ESTA EN USO POR FAVOR INGRESE OTRO NOMBRE DE USUARIO
        </div>'
      ]);
      exit();
  }
  $check_user = null;
}else {
  $userName = $data['user_userName'];
}

//VERIFICANDO CLAVES
if($pswd !="" && $pswdR !=""){
  if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $pswd)){
    echo json_encode([
        'message' => 
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          LAS CONTRASENIAS NO CUMPLEN CON EL FORMATO SOLICITADO
        </div>'
      ]);
      exit();
  }else{
    if($pswd != $pswdR){
    echo json_encode([
        'message' => 
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          LAS CLAVES INGRESADAS NO COINCIDEN
        </div>'
      ]);
      exit();
    }else{
      $password = password_hash($pswd, PASSWORD_BCRYPT,["COST"=>10]);
    }
  }
}else{
  $password = $data['user_password'];
}


  //DIRECTORIO DE IMAGENES
  $img_dir = "../images/profile-pics/";

  //COMPROBAR SI SELECCIONO UNA IMAGEN
  if($_FILES['update__pic']['name']!="" && $_FILES['update__pic']['size']>0){

    //CREANDO EL DIRECTORIO DE IMAGENES
    if(!file_exists($img_dir)){
      if(!mkdir($img_dir,0777)){
        echo json_encode([
          'message' =>
          '<div class="notification is-danger is-light">
            <strong>Ocurrio un error inesperdado</strong><br>
            ERROR AL CREAR EL DIRECTORIO
          </div>'
        ]);
        exit();
      }
    }

    //VERIFICANDO EL FORMATO DE LAS IMAGENES
    if(
      mime_content_type($_FILES['update__pic']['tmp_name'])!="image/jpeg" &&
      mime_content_type($_FILES['update__pic']['tmp_name'])!="image/png"
      ){
      echo json_encode([
        'message' =>
        '<div class="notification is-danger is-light">
          <strong>Ocurrio un error inesperdado</strong><br>
          LA IMAGEN QUE HA SELECCIONADO NO TIENE UN FORMATO PERMITIDO
        </div>
      ']);
      exit();
    }

    //EXTENSION DE LA IMAGEN
    switch(mime_content_type($_FILES['update__pic']['tmp_name'])){
      case 'image/jpeg':
        $img_ext = ".jpg";
      break;
      case 'image/png':
        $img_ext = ".png";
      break;
    }
    chmod($img_dir,0777);
    $picName = $userName;
    $pic = $picName.$img_ext;

    //MOVIENDO IMAGEN AL DIRECTORIO
    if(!move_uploaded_file($_FILES['update__pic']['tmp_name'],$img_dir.$pic)){
      echo json_encode([
        'message' =>
        '<div class="notification is-danger is-light">
            <strong>Ocurrio un error inesperdado</strong><br>
            NO SE PUDO CARGAR LA IMAGEN, VUELVA A INTENTARLO
          </div>'
      ]);
      exit();
    };
  }else{
    $pic = $data['user_profilePic'];
  }


//ACTUALIZAR DATOS
$user_update = conection();
$user_update = $user_update->prepare("UPDATE users SET user_userName =:nombre, user_password =:clave, user_email=:email, user_profilePic=:foto WHERE user_id=:id");

$marcadores =[
  ":nombre" => $userName,
  ":clave" => $password,
  ":email" => $email,
  ":foto" => $pic,
  "id" => $id
];

if($user_update->execute($marcadores)){
  echo json_encode([
    'message' => 
    '<div class="notification is-danger is-light">
      <strong>Ocurrio un error inesperdado</strong><br>
      LOS DATOS DE USUARIO SE REGISTRARON CON EXITO
    </div>'
  ]);
}else{
  echo json_encode([
    'message' => 
    '<div class="notification is-danger is-light">
      <strong>Ocurrio un error inesperdado</strong><br>
      HUBO UN ERROR EN LA ACTUALIZACION DE USUARIO, INTENTE DE NUEVO
    </div>'
  ]);
  exit();
}

$user_update = null;