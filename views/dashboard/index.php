<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                </tr>
                <tr>
                    <td id="td1">1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>markOtto@gmail.com</td>
                </tr>
                <tr>
                    <td id="td1">2</td>
                    <td>Jacob</td>
                    <td>thrmton</td>
                    <td>Jacobthorton@gmail.com</td>
                </tr>
                <tr>
                    <td id="td1">3</td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>larrybird@gmail.com</td>
                </tr>
                <tr>
                    <td id="td1">4</td>
                    <td>John</td>
                    <td>Doe</td>
                    <td>johndoe@gmail.com</td>
                </tr>
                <tr>
                    <td id="td1">5</td>
                    <td>Garry</td>
                    <td>Bird</td>
                    <td>Garrybrid@gmail.com</td>
                </tr>
            </table>
            <div class="footer">
                <div class="paginate">
                    <div class="el el-start">
                        <span><</span>
                    </div>
                    <div class="el">
                        <span>1</span>
                    </div>
                    <div class="el">
                        <span>2</span>
                    </div>
                    <div class="el dot">
                        <span>....</span>
                    </div>
                    <div class="el">
                        <span>3</span>
                    </div>
                    <div class="el">
                        <span>4</span>
                    </div>
                    <div class="el el-end">
                        <span>></span>
                    </div>
                </div>
            </div>
        </div>
        <script src="/aloBridge-function-login-demo/public/js/home.js"></script>
</body>

</html>