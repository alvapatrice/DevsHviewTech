<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Devs@HviewTech - 404 Page</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,300,700,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            background: #333 url('http://devartisans.com/images/uploads/img55de079d978dd.png') top center no-repeat;
            color : white;
            background-size : 100%;
        }
        .not-found-page {
            width : 1280px;
            margin-left : auto;
            margin-right: auto;
            margin-top : 200px;
        }
        .content {
            display : table;
            margin : 0 auto;
            text-align : center;
            background: rgba(30, 30, 30, .97);
            padding: 20px;
            border-radius: 10px;
        }
        h1.title {
            font-size : 50px;
            font-weight: 100;
            text-align: center;
        }
        h2.subtitle {
            font-size : 40px;
            font-weight: 300;
        }
        .fa {
            font-size : 80px;
            text-align: center;
            color : yellow;
        }
        .lead {
            font-size : 50px!important;
            font-weight: 400!important;
            text-align : center!important;
        }
        .btn {
            padding: 10px;
            outline: 0;
            /*border: 1px solid #222222;*/
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: white;
            color : #222222;
        }
        .btn-primary:hover {
            background-color: #39f;
            color : white;
        }

    </style>
</head>
<body>
    <div class="not-found-page">
        <div class="content">
            <div>
                <div>
                    <img src="/images/logos/logo-top.png" alt="Devartisans Site Logo"/>
                </div>
                <div>
                    <span class="fa fa-exclamation-triangle"></span>
                </div>
            </div>
            <h1 class="title">
                404 ( Not Found )
            </h1>
            <h2 class="subtitle">Sorry, The page you are looking for</h2>
            <h2 class="subtitle lead">Does not exist</h2>
            <div>
            <a class="btn btn-primary" href="{{ route('home') }}">Go Back to our site here</a>
            </div>
        </div>
    </div>
</body>
</html>
