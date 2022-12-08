<?php 
include "./header.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') exit;

try {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if (empty($email) || empty($password)) {
      echo json_encode([
        'status' => 'FAIL',
        'msg' => 'empty value'
      ]);
      exit;
    }

    switch ($_GET['action']) {
      case 'login':
        $rows = $db->query("SELECT password FROM users WHERE email='{$email}';");

        if ($rows->rowCount()) {
          foreach ($rows as $r) {
            if ($password == $r['password']) {
              setcookie('login', 1, time()+60*60, '/', 'localhost');
              
              echo json_encode([
                'status' => 'OK',
                'msg' => 'valid'
              ]);
            } else {
              echo json_encode([
                'status' => 'FAIL',
                'msg' => 'invalid'
              ]);
            }
          }
        } else {
          echo json_encode([
            'status' => 'FAIL',
            'msg' => 'email isn\' existed'
          ]);
        }
        break;
    
      case 'signup':
        if (!$db->query("SELECT * FROM users WHERE email='{$email}'")->rowCount()) {
          $sql = "INSERT INTO users (email, password) VALUES (?, ?);";

          if ($db->prepare($sql)->execute([$email, $password])) {
            echo json_encode([
              'status' => 'OK',
              'msg' => 'valid'
            ]);
          } else {
            echo json_encode([
              'status' => 'FAIL',
              'msg' => 'INSERT SQL failure'
            ]);
          }
        } else {
          echo json_encode([
            'status' => 'FAIL',
            'msg' => 'already existed'
          ]);
        }
        break;
      
      default:
        header("HTTP/1.1 500 Internal Server Error");
        echo 'undefined behavior';
    }
} catch (PDOException $e) {
    header("HTTP/1.1 500 Internal Server Error");
    die ("failed DB connection: {$e->getMessage()}");
}
?>