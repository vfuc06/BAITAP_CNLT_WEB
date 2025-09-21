<?php
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if ($category_id ==NULL || $category_id== false){
    $error = "Invalid category id. Check category id and try again.";
    include('error.php');
}
else {
    require_once('database.php');
     
    $query ='DELETE FROM categories
              WHERE categoryID = :category_id';
    $stm=$db->prepare($query);
    $stm->bindValue(':category_id', $category_id);
    $stm->execute();
    $stm->closeCursor();
    include('category_list.php');
}

?>