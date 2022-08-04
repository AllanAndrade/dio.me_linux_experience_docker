<html>

<head>
<title>Exemplo PHP</title>
</head>
<body>

<?php
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=iso-8859-1');


echo 'Versao Atual do PHP: ' . phpversion() . '<br>';

require_once './db_params.php';
require_once './db_connection.php';

// Prepara o SQL

$sql = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (? , ?, ?, ?, ?, ?)";
try{
  $stmt = $con->prepare($sql);
}catch(PDOException $Exception){
  echo "<br/>Erro ao preparar a query no banco de dados";
  echo json_encode($Exception);
  exit;
}

// Executa o SQL

$valor_rand1 =  rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
$host_name = gethostname();

$args = [$valor_rand1 , $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2,$host_name];
try{
  $stmt->execute($args);
  echo "<br/>Registro inserido com sucesso!";
}catch(PDOException $Exception){
  echo "<br/>Erro ao executar a query no banco de dados";
  echo json_encode($Exception);
  exit;
}

// Exibe os dados
$sql = 'select id,AlunoID, Nome, Sobrenome, Endereco, Cidade, Host from dados order by id desc limit 30';
try{
  $stmc = $con->prepare($sql);
}catch(PDOException $Exception){
  echo "Erro ao preparar a consulta no banco de dados";
  echo json_encode($Exception);
  exit;
}
try{
  $stmc->execute([]);
  $rs = $stmc->fetchAll();
  $stmc->closeCursor();
  
  echo utf8_decode('<br/><br/>Exibindo os últimos 30 cadastros');
  
  echo '<table>';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>AlunoID</th>';
  echo '<th>Nome</th>';
  echo '<th>Sobrenome</th>';
  echo '<th>Endereco</th>';
  echo '<th>Cidade</th>';
  echo '<th>Host</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  for ($i=0; $i < count($rs); $i++) { 
    echo '<tr>';
    echo '<td>' . $rs[$i]['id'] . '</td>';
    echo '<td>' . $rs[$i]['AlunoID'] . '</td>';
    echo '<td>' . $rs[$i]['Nome'] . '</td>';
    echo '<td>' . $rs[$i]['Sobrenome'] . '</td>';
    echo '<td>' . $rs[$i]['Endereco'] . '</td>';
    echo '<td>' . $rs[$i]['Cidade'] . '</td>';
    echo '<td>' . $rs[$i]['Host'] . '</td>';
    echo '</tr>';
  }
  echo '</tbody>';
  echo '<table>';
  
}catch(PDOException $Exception){
  echo "Erro ao executar a consulta no banco de dados";
  echo json_encode($Exception);
  exit;
}

?>

</body>
</html>
