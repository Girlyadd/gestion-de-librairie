<?php
include("bd.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];
    $query = "SELECT * FROM books WHERE title LIKE '{$input}%' OR author LIKE '{$input}%' OR genre LIKE '{$input}%' LIMIT 3 ";
    $result = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result)>0){?>


<table class="table table-bordered table-striped mt-4">
    <thread>
        <tr>
            <th>title</th>
            <th>author</th>
            <th>genre</th>
    </tr>
    </thread>

    <tbody>
        <?php

        while($row = mysqli_fetch_assoc($result)){

            $title = $row['title'];
            $author = $row['author'];
            $genre = $row['genre'];
            ?>
            <tr>

            <td><?php echo $title;?></td>
            <td><?php echo $author;?></td>
            <td><?php echo $genre;?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No data found </h6>";
    }
}
?>