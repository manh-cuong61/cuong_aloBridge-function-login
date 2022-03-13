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
        .main-bar .content-nav .el2 {
            background-color: #666;
            color: white;
        }

        .main-bar .content-nav .el2 a {
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
                    <th>Name</th>
                    <th>Giá</th>
                    <th>Tags</th>
                    <th class="image">Image</th>
                    <th>DELETE</th>
                    <th>EDIT</th>
                </tr>
                <?php
                // use App\Models\ProductModel;
                // $product = new ProductModel;
                foreach ($products as $product) {
                    $product['tags'] = $this->product->getTags($product['product_id']);
                    echo "<tr>
                        <td id='td1'>" .  $product['product_id'] . "</td>
                        <td>" . $product['product_name'] . "</td>
                        <td>" . $product['price'] . "</td>
                        <td class='tag'>";
                    foreach($product['tags'] as $tag ){
                        echo  "<span>". $tag['name'] ."</span>";
                    }    
                    echo "</td>
                        <td> <img src='/aloBridge-function-login/public/img/".$product['image'] ."' alt=''> </td>
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