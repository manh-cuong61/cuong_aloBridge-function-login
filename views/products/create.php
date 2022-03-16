<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content .header .header-right {
            display: none;
        }
    </style>
</head>

<body>
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
            .content {
                height: 34.5rem;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <?php require(__DIR__ . "/../layouts/sidebar.php") ?>
            <div class="content">
                <?php require(__DIR__ . "/../layouts/header-content.php") ?>
                <div class="form-create">
                    <form action="http://localhost:8082/aloBridge-function-login/public/product" method="POST" enctype="multipart/form-data">
                        <label for="name">Name</label>
                        <div class="div-input">
                            <input id="name" name="product_name" type="text">
                            <span class="error">
                                <?php
                                if (!empty($msg['name'])) {
                                    foreach ($msg['name'] as $err) {
                                        echo $err;
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <label for="price">Price</label>
                        <div class="div-input">
                            <input id="price" name="price" type="text">
                            <span class="error">
                                <?php
                                if (!empty($msg['price'])) {
                                    foreach ($msg['price'] as $err) {
                                        echo $err;
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <label for="image">Image</label>
                        <div class="div-input file">
                            <input id="image" name="image" type="file" onchange="readURL(this);">
                            <img id="picture" src="/aloBridge-function-login/public/img/products/default.PNG"/>
                            
                        </div>
                        <label for="">Tags</label>
                        <div class="div-input tag">
                            <?php
                            foreach ($tags as $tag) {
                                echo "<div>
                                    <input id='" . $tag['name'] . "' type='checkbox' name='check_list[]' value='" . $tag['id'] . "'> 
                                    <label for='" . $tag['name'] . "'>" . $tag['name'] . "</label>
                                    </div>";
                            }
                            ?>
                        </div>
                        <input class="submit" type="submit" value="Save">
                    </form>
                </div>
            </div>
            <script src="/aloBridge-function-login/public/js/home.js"></script>

    </body>

    </html>
</body>

</html>