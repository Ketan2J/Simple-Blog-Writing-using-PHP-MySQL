<?php require './server/conn.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <!-- Font Awesome CDN V.6 Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap 5 CSS CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/style.css" type="text/css" rel="stylesheet"></link>

    <style>
        .container .row .col-lg-4 .blog-wrapper {
            border: 2px solid #007aff;
            border-radius: 10px;
            height: auto;
            background-color: #007aff;
            box-shadow: none;
            transform: none;
            transition: all .5s;
        }
        .container .row .col-lg-4 .blog-wrapper:hover {
            box-shadow: 5px 5px 0 0 #007aff;
            transform: translate(-5px, -5px);
        }
        .container .row .col-lg-4 .blog-wrapper .blog-head {
            width: 98%;
            border-bottom: 2px solid #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
        }
        .container .row .col-lg-4 .blog-wrapper .blog-head h3 {
            color: #fff;
            font-weight: 700;
        }
        .container .row .col-lg-4 .blog-wrapper .blog-head div {
            color: rgba(255, 255, 255, 0.7);
        }
        .container .row .col-lg-4 .blog-wrapper .blog-head div i {
            color: #fff;
        }
        .container .row .col-lg-4 .blog-wrapper .blog-head div span {
            color: #fff;
            font-weight: 500;
        }
        .container .row .col-lg-4 .blog-wrapper p {
            font-weight: 500;
            font-size: 13px;
            color: #fff;
        }
        .container .row .col-lg-4 .action-box {
            border: 2px solid #000;
            border-radius: 10px;
            background-color: #000;
            display: grid;
            place-items: center;
        }
        .container .row .col-lg-4 .action-box .btn {
            font-weight: 600;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Main Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Creating Form (Inserting new blog) -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h1 class="text-center">Personal Blog Page</h1>
                <form class="p-3 mt-2 mb-2" action="./server/blogCreate.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="blog-title" class="form-control" placeholder="Blog Title..." required>
                    </div>
                    <div class="mb-3">
                        <textarea type="text" name="blog-text" class="form-control" placeholder="Blog Text..." rows="5"  required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="blog-date" class="form-control" required>
                    </div>
                    <button class="btn" type="submit" name="blog_create">CREATE</button>
                </form>
            </div>

            <!-- Displaying Blogs -->
            <?php
            
            require './server/conn.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-blog'])) {
                $blog_id = $_POST['blogID'];
                $deleteQuery = "DELETE FROM blog_tbl WHERE id = $blog_id";
                if ($conn->query($deleteQuery) === TRUE) {
                    header("location: ./index.php");
                } else {
                    echo "Error!";
                }
            }

            $dataFetchQuery = "SELECT * FROM blog_tbl ORDER BY id ASC";
            $runQuery = $conn->query($dataFetchQuery);

            if ($runQuery->num_rows > 0) {
                while($row = $runQuery->fetch_assoc()) {
                    echo '<div class="col-lg-4 col-md-12 col-sm-12 col-12 mt-3 mb-3">
                            <div class="blog-wrapper p-2">
                                <div class="blog-head mb-2">
                                    <h3>' . $row["blog_title"] . '</h3>
                                    <div>
                                        <i class="fa-solid fa-user"></i> by admin &nbsp;<span>' . $row["blog_date"] . '</span>
                                    </div>
                                </div>
                                <p>' . $row["blog_text"] . '</p>
                            </div>
                            <form class="action-box mt-1 mb-1 p-2" method="POST">
                                <input type="hidden" name="blogID" value=' . $row["id"] . '>
                                <button class="btn btn-danger" type="submit" name="delete-blog" style="border-radius: 8px;">DELETE</button>
                            </form>
                        </div>
                        ';
                }
            } else {
                echo '<hr class="mt-3">';
                echo '<h4 class="text-center" style="color: #007aff;">No Blogs... :(</h4>';
            }

            $conn->close();

            ?>
        </div>
    </div>

    <!-- Bootstrap 5 CDN Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Main Javascript File -->
    <script type="text/javascript" src="./js/main.js" async></script>
</body>
</html>
