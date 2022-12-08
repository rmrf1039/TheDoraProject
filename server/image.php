<?php
include "./header.php";

header('Access-Control-Allow-Origin: *');

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$new_file_name = md5($_FILES['file']['name'] + rand(0, 99999));
$new_file_path = "../src/img/{$new_file_name}.{$ext}";

if (move_uploaded_file($_FILES['file']["tmp_name"], $new_file_path)) {
  echo json_encode([
    'status' => 'OK',
    'img_path' => $new_file_path
  ]);
  exit;
}

echo json_encode([
  'status' => 'FAIL',
  'msg' => 'failed execution'
]);
?>