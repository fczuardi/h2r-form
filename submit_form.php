<?php
$uploaddir = './formularios/';

if ($_POST){
  if (!is_dir($uploaddir)){
    if (!mkdir($uploaddir, 0777, true)) {
        die('Failed to create folders...');
    }
  }
  echo ('<br>POST<br>');
  var_dump(json_encode($_POST));
  $uploaddir .=  '/' . $_POST['form_id'];
  $uploaddir .=  '/' . substr(str_replace(':','.', date(DATE_ATOM)), 0, -6) . '_' . $_POST['nome'];
  if (!is_dir($uploaddir)){
    if (!mkdir($uploaddir, 0777, true)) {
        die('Failed to create folders...');
    }
  }
  $formfile = $uploaddir . '/form.txt';
  file_put_contents($formfile, json_encode($_POST));
  if ($_FILES){
    echo ('<br><br>FILES<br>');
    // var_dump($_FILES);
    foreach($_FILES as $fieldname => $value){
      var_dump($fieldname);
      echo '<br><br>';
      var_dump($value);
      echo '<br><br>';
      $dir =  $uploaddir . '/' . $fieldname;
      if (!is_dir($dir)){
        if (!mkdir($dir, 0777, true)) {
            die('Failed to create folders...');
        }
      }
      $uploadfile = $dir . '/' . basename($value['name']);
      if (move_uploaded_file($value['tmp_name'], $uploadfile)) {
          echo "File is valid, and was successfully uploaded.\n";
      } else {
          echo "Possible file upload attack!\n";
      }
    }
  }
}
?>
/*
$file = 'people.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= "John Smith\n";
// Write the contents back to the file
file_put_contents($file, $current);
*/