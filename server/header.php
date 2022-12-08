<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 1000');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
      header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
  }

  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
      header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
  }
  
  exit(0);
}

$username='root';
$password='Ed291333';
$db = null;

try {
    $db = new PDO("mysql:dbname=web_class;host=127.0.0.1", $username, $password);
    $_POST = json_decode(file_get_contents("php://input"), true);
} catch (PDOException $e) {
    die ("failed DB connection: {$e->getMessage()}");
}
?>