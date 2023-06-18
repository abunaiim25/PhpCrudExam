<?php
session_start();

//connect db
$DB = mysqli_connect('localhost', 'root', '', 'shop_finalexam');
if(!$DB){
    echo "Database connected failed";
}


if(isset($_POST['product_btn'])){
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (user_id, name, type, qty, price) VALUES ('$user_id', '$name', '$type', '$qty', '$price')";
    $query = mysqli_query($DB, $sql);

    if($query){
        $_SESSION['message'] = "Thank you for your order";
        header('Location: index.php');
    }
}

elseif(isset($_POST['product_update_btn'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name='$name', type='$type', qty='$qty', price='$price' WHERE id='$id' AND user_id='$user_id'";
    $query = mysqli_query($DB, $sql);

    if($query){
        $_SESSION['message'] = "Update your product";
        header('Location: index.php');
    }
}

else if(isset($_POST['delete'])){
    $id = $_POST['id'];  

    $sql = "DELETE FROM products WHERE id='$id'" ;
    $query = mysqli_query($DB, $sql);

    if($query){
        $_SESSION['message'] = "Deleted product";
        header('Location: index.php');
    }
}

if(isset($_GET['search_text'])){
    $search_text = $_GET['search_text'];

    $DB = mysqli_connect('localhost', 'root', '', 'shop_finalexam');
    $sql = "SELECT * FROM products WHERE name LIKE '$search_text'";
    $query = mysqli_query($DB, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        while($data=mysqli_fetch_assoc($query))
        {
            $id = $data['id'];
            $name = $data['name'];
            $type = $data['type'];
            $qty = $data['qty'];
            $price = $data['price'];

            echo 
            "<table border=1>
            <td> $id </td>
            <td> $name </td>
            <td> $type </td>
            <td> $qty </td>
            <td> $price </td>
            </table>";
        }
    }
}
?>