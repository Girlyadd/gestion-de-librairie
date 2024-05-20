<?php

@include 'bd.php';

if(isset($_POST['add_book'])){

   $book_name = $_POST['book_name'];
   $author_name = $_POST['author_name'];
   $genre_name = $_POST['genre_name'];
   $book_image = $_FILES['book_image']['name'];
   $book_image_tmp_name = $_FILES['book_image']['tmp_name'];
   $book_image_folder = 'uploaded_img/'.$book_image;

   if(empty($book_name) || empty($author_name) || empty($book_image)|| empty($genre_name)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO books(title, author, genre,image) VALUES('$book_name', '$author_name', '$genre_name','$book_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($book_image_tmp_name, $book_image_folder);
         $message[] = 'new book added successfully';
      }else{
         $message[] = 'could not add the book';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM books WHERE id = $id");
   header('location:addbook.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ajouter livre</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Ajouter un livre</h3>
         <input type="text" placeholder="entrez le titre du livre" name="book_name" class="box">
         <input type="text" placeholder="entrez le nom de l'auteur" name="author_name" class="box">
         <input type="text" placeholder="entrez le genre du livre" name="genre_name" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="book_image" class="box">
         <input type="submit" class="btn" name="add_book" value="add book">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM books");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>couverture du livre</th>
            <th>Titre </th>
            <th>Auteur</th>
            <th>Genre</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td>
               <a href="editbook.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> editer </a>
               <a href="addbook.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> supprimer </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>