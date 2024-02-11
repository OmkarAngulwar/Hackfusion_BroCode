<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGGSIE&T, Nanded</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <style>
        .container4 {
            margin-top: 10px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .box {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            border-radius: 30px;
            color: black;
            flex: 1;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: black;
        }

        /* .container5{
            display: inline-block;
            margin-left: 80px;
            margin-top: 80px;
            opacity: 0.6;
            font-size: 10px;
        } */
    </style>

</head>

<body>
    <section class="header">
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <label><img src="SGGSlogo.png" width="60px" height="60px" alt=""></label>
                    <label style="font-size: 30px; text-align:left;"><b>SGGSIE&T, Nanded</b></label>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Post/post.html">Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Chat/">Chat Room</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <section class="media-section">
    <?php include('display_media.php'); ?>
</section>

</body>
</html>