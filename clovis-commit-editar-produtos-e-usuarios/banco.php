<?php
//TESTA A CONEXÃO COM O BANCO
   $host        = "localhost";
   $dbname      = "TESTE";
   $user        = "root";
   $pass        = "nikito123";

   $db = mysqli_connect($host, $user, $pass, $dbname);
   if(!$db) 
   {
      echo "Erro : Indisponível para abrir a conexão com o banco de dados\n";
   } else 
   {
      $nl=chr(10);
      $texto = "Conexão com o banco de dados aberta com sucesso";
      //echo nl2br($texto);
      echo $nl;
   }

$myusername=$_REQUEST['username']; 
$mypassword=$_REQUEST['password']; 

$result=mysqli_query($db, "SELECT * FROM USERS WHERE NAME = '$myusername' AND PASSWORD = '$mypassword' AND PERMISSIONTYPE = '0';");
if (mysqli_num_rows($result)==1){
  $redirect = "administrador.php";
   header("location:$redirect");
}

$result=mysqli_query($db, "SELECT * FROM USERS WHERE NAME = '$myusername' AND PASSWORD = '$mypassword' AND PERMISSIONTYPE = '1';");
if (mysqli_num_rows($result)==1){
  $redirect = "produtos.php";
   header("location:$redirect");
}

$result=mysqli_query($db, "SELECT * FROM USERS WHERE NAME = '$myusername' AND PASSWORD = '$mypassword';");
if (mysqli_num_rows($result)==0){
  $redirect = "incorreto.php";
   header("location:$redirect");
}
/*
$sql =<<<EOF
    CREATE TABLE SECTOR   
    (ID SERIAL PRIMARY KEY     NOT NULL,
    NAME              NAME      NOT NULL);
EOF;

$ret = pg_query($db, $sql);
    if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Tabela setor criada com sucesso\n";
   }
  // pg_close($db);

$sql =<<<EOF
  CREATE TABLE USERS
  (ID SERIAL PRIMARY KEY     NOT NULL,
  MAIL              TEXT     NOT NULL,
  NAME              TEXT     UNIQUE,
  PERMISSIONTYPE    INT      NOT NULL,
  ROLE              TEXT, 
  PHONE             CHAR(13),
  PASSWORD          CHAR(32) NOT NULL);
EOF;

$ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Tabela usuário criada com sucesso\n";
   }
   //pg_close($db);

$sql =<<<EOF
    CREATE TABLE PRODUCT
    (ID SERIAL PRIMARY KEY     NOT NULL,
    NAME              TEXT      NOT NULL,
    AMOUNSTINSTOCK    INT,
    EXPIRATIONALERT   INT,
    EXPIRATIONDATE    DATE,
    ISPERISHABLE      BOOLEAN,
    MANUFACTURE       TEXT,
    MINIMUMSTOCK      INT,
    SECTOR             SERIAL REFERENCES SECTOR(ID),
    TYPE              TEXT);
EOF;

$ret = pg_query($db, $sql);
    if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "Tabela produto criada com sucesso\n";
   }
   //pg_close($db);

pg_query($db, "INSERT INTO USERS(MAIL, NAME, PERMISSIONTYPE, ROLE, PHONE, PASSWORD) 
                          VALUES('ranieel@outlook.com', 'raniel', 0, 'Administrador', '034992322116', '102030');");