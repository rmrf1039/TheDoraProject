<?php
include "./header.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $last_id = $_GET['last_id'];
  $limit = $_GET['limit'];

  $rows = $db->query("SELECT id, title, cover_img FROM blogs WHERE id > {$last_id} LIMIT {$limit}");

  $return = [];

  if ($rows->rowCount()) {
    foreach ($rows as $row) {
      array_push($return , [
        'id' => $row['id'],
        'title' => $row['title'],
        'cover_img' => $row['cover_img']
      ]);
    }
  }

  echo json_encode([
    'status' => 'OK',
    'results' => $return
  ]);
}
?>