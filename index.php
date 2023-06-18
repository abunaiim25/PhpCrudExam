<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>

    <div class="container">
        <div>
            <?php if (isset($_SESSION['message'])) { ?>
                <?= $_SESSION['message']; ?>
            <?php unset($_SESSION['message']);
            } ?>
        </div>

        <h1>Add Online Shop</h1>

        <form action="code.php" method="POST">
            <input type="hidden" name="user_id" value="1">

            <table>
                <tr>
                    <td><label>Product Name:</label></td>
                    <td><input type="text" name="name" placeholder="product name" required> </td>
                </tr>

                <tr>
                    <td><label>Type:</label></td>
                    <td><input type="text" name="type" placeholder="type" required></td>
                </tr>

                <tr>
                    <td><label>Quantity:</label></td>
                    <td><input type="number" name="qty" placeholder="quantity" required></td>
                </tr>

                <tr>
                    <td><label>Price:</label></td>
                    <td> <input type="text" name="price" placeholder="Price" required></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" class="btn" name="product_btn" value="Submit"></td>
                </tr>
            </table>
        </form>



        <div class="list" style="margin-top: 60px;">
            <div style="display: flex; align-items:center">
                <h1>Invoice</h1>
                
               <!--Search-->
                <form style="margin-left:100px" action="code.php" method="GET">
                    <input type="text" name="search_text">
                    <input type="submit" value="Search">
                </form>         
             </div>

            <table border="1">
                <thead>
                    <tr>
                        <td>List</td>
                        <td>User</td>
                        <td>Product</td>
                        <td>Type</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Edit</td>
                        <td>Remove</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $DB = mysqli_connect('localhost', 'root', '', 'shop_finalexam');
                    $sql = "SELECT * FROM products";
                    $query = mysqli_query($DB, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        foreach ($query as $data) {
                    ?>
                            <tr>
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['user_id'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['type'] ?></td>
                                <td><?= $data['qty'] ?></td>
                                <td><?= $data['price'] ?></td>
                                <td><a href="edit.php?id=<?= $data['id'] ?>" class="btn">Update</a></td>
                                <td>
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <button type="submit" class="btn" name="delete" style="background: red;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                    <?php
                    $DB = mysqli_connect('localhost', 'root', '', 'shop_finalexam');
                    $sql = "SELECT  SUM(price) as subtotal_sum FROM products";
                    $query = mysqli_query($DB, $sql);
                    $row = mysqli_fetch_array($query);

                    $subtotal = $row['subtotal_sum'];
                    $vat = ($subtotal * (100 + 5)) / 100;
                    $charge = (($subtotal * (100 + 5)) / 100) + 50;
                    ?>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="4">Subtotal= <?= $subtotal ?>TK</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="4">Vat 5%= <?= $vat ?>TK</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="4">Delivery Charge (50) = <?= $charge ?>TK</td>
                    </tr>

                </tbody>

            </table>
        </div>


    </div>

</body>

</html>