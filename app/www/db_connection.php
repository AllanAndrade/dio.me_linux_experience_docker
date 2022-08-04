<?php
$dsn = "mysql:host=$serverName;port=3306;dbname=$database;charset=utf8mb4";

$opcoes = array(
  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
  \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
  \PDO::ATTR_EMULATE_PREPARES => FALSE,
  \PDO::ATTR_PERSISTENT => true,
  \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
);


try {
  $con = new PDO(
      $dsn,
      $userName,
      $password,
      $opcoes
  );
} catch (\PDOException $Exception) {
  echo "Erro ao conectar com o banco de dados";
  echo json_encode($Exception);
  exit;
}
