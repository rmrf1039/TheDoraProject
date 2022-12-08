<?php 
include "./header.php";

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $id = $_GET['id'];

    if (!empty($id)) {
      $rows = $db->query("SELECT * FROM blogs WHERE id={$id};");

      if ($rows->rowCount()) {
        foreach ($rows as $row) {
          echo json_encode([
            'status' => 'OK',
            'result' => [
              'id' => $row['id'],
              'title' => $row['title'],
              'cover_img' => $row['cover_img'],
              'tag_color' => $row['tag_color'],
              'sections' => $row['sections']
            ]
          ]);
        }
      } else {
        echo json_encode([
          'status' => 'FAIL',
          'msg' => 'not existed'
        ]);
      }
    } else {
      echo json_encode([
        'status' => 'FAIL',
        'msg' => 'empty value'
      ]);
    }
    break;

  case 'POST':
    $id = $_POST['id'];
    $title = $_POST['inputTitle'];
    $coverImg = $_POST['inputCoverImg'];
    $tagColor = $_POST['tagColor'];
    $sections = $_POST['inputSections'];

    if (empty($title) || empty($coverImg) || empty($tagColor) || empty($sections)) {
      echo json_encode([
        'status' => 'FAIL',
        'msg' => 'empty value'
      ]);
      exit;
    }

    if (empty($id)) {
      //create a blog
      $sql = "INSERT INTO blogs (title, cover_img, tag_color, sections, views) VALUES (?, ?, ?, ?, 0);";
      
      if(!$db->prepare($sql)->execute([$title, $coverImg, $tagColor, $sections])) {
        echo json_encode([
          'status' => 'FAIL',
          'msg' => 'INSERT SQL failure'
        ]);
        exit;
      }

      $id = $db->lastInsertId();
    } else {
      //update a blog with specific id
      $sql = "UPDATE blogs SET title=?, cover_img=?, tag_color=?, sections=? WHERE id=?;";
      
      if (!$db->prepare($sql)->execute([$title, $coverImg, $tagColor, $sections, $id])) {
        echo json_encode([
          'status' => 'FAIL',
          'msg' => 'UPDATE SQL failure'
        ]);
        exit;
      }
    }

    echo json_encode([
      'status' => 'OK',
      'id' => $id
    ]);
    break;

  case 'DELETE':
    $id = $_POST['id'];

    $sql = "DELETE FROM blogs WHERE id=?;";

    if ($db->prepare($sql)->execute([$id])) {
      echo json_encode([
        'status' => 'OK'
      ]);
    } else {
      echo json_encode([
        'status' => 'FAIL',
        'msg' => 'DELETE SQL failure'
      ]);
    }
    break;
  
  default:
    header("HTTP/1.1 500 Internal Server Error");
    echo 'undefined behavior';
}
?>