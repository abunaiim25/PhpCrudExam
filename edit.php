<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Update Online Shop</h1>

        <form action="code.php" method="POST">
            <input type="hidden" name="user_id" value="1">

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $DB = mysqli_connect('localhost', 'root', '', 'shop_finalexam');
                $sql = "SELECT * FROM products WHERE id='$id' ";
                $query = mysqli_query($DB, $sql);
                if (mysqli_num_rows($query) > 0) {
                    $data = mysqli_fetch_array($query);
            ?>
                    <table>
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <tr>
                            <td><label>Product Name:</label></td>
                            <td><input type="text" name="name" placeholder="product name" value="<?=$data['name']?>"> </td>
                        </tr>

                        <tr>
                            <td><label>Type:</label></td>
                            <td><input type="text" name="type" placeholder="type" value="<?=$data['type']?>"></td>
                        </tr>

                        <tr>
                            <td><label>Quantity:</label></td>
                            <td><input type="number" name="qty" placeholder="quantity" value="<?=$data['qty']?>"></td>
                        </tr>

                        <tr>
                            <td><label>Price:</label></td>
                            <td> <input type="text" name="price" placeholder="Price" value="<?=$data['price']?>"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" class="btn" name="product_update_btn" value="Update"></td>
                        </tr>
                    </table>
            <?php
                }
            }
            ?>
            <tr>
                <?php if (isset($_SESSION['message'])) { ?>
                    <?= $_SESSION['message']; ?>
                <?php unset($_SESSION['message']);
                } ?>
            </tr>
        </form>



    </div>
</body>

</html>