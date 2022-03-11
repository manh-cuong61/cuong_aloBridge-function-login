<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="/aloBridge-function-login/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        .main-bar .content-nav .el1 {
            background-color: #666;
            color: white;
        }

        .main-bar .content-nav .el1 a {
            color: white;
        }
    </style>
</head>

<body>
    <div class="main">
        <?php require(__DIR__ . "/../layouts/sidebar.php") ?>
        <div class="content">
            <?php require(__DIR__ . "/../layouts/header-content.php") ?>
            <table>
                <tr class="tr1">
                    <th id="th1">#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Email Address</th>
                    <th>Email Address</th>
                    <th>Email Address</th>
                </tr>
                <?php
                foreach ($products as $product) {
                    echo "<tr>
                        <td id='td1'>" .  $product['id'] . "</td>
                        <td>" . $product['name'] . "</td>
                        <td>" . $product['slug'] . "</td>
                        <td>" . $product['price'] . "</td>
                        <td>" . $product['image'] . "</td>
                        <td><a class= 'button-delete' href=''>DELETE</a></td>
                        <td><a class= 'button-edit' href=''>EDIT</a></td>
                        </tr>";
                }
                ?>


            </table>
            <div class="footer">
                <?php
                require(__DIR__ . "/../../core/Paginator.php");
                $pagination = new Paginator($limit, $total, $page);
                echo $pagination->createLinks(2, 'paginate');
                ?>
            </div>
        </div>
        <script src="/aloBridge-function-login-demo/public/js/home.js"></script>

</body>

</html>