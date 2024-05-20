<?php

@include 'bd.php';

$id = $_GET['edit'];

if(isset($_POST['update_book'])){

   $book_name = $_POST['book_name'];
   $author_name = $_POST['author_name'];
   $genre_name = $_POST['genre_name'];
   $book_image = $_FILES['book_image']['name'];
   $book_image_tmp_name = $_FILES['book_image']['tmp_name'];
   $book_image_folder = 'uploaded_img/'.$book_image;

   if(empty($book_name) || empty($author_name) || empty($genre_name) || empty($book_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE books SET title='$book_name', author='$author_name', genre='$genre_name',image='$book_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($book_image_tmp_name, $book_image_folder);
         header('location:addbook.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM books WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">editer le livre</h3>
      <input type="text" class="box" name="book_name" value="<?php echo $row['title']; ?>" placeholder="entrer le titre du livre">
      <input type="text" class="box" name="author_name" value="<?php echo $row['author']; ?>" placeholder="entrer le nom de l'auteur">
      <input type="text" class="box" name="genre_name" value="<?php echo $row['genre']; ?>" placeholder="entrer le genre ">
      
      <input type="file" class="box" name="book_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="edit" name="update_book" class="btn">
      <a href="addbook.php" class="btn">retour!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>