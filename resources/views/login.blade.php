<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


    <style type="text/css">

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 700;
            color: #f8f8f8;
            text-shadow: 2px 2px 3px rgba(0,0,0,0.6);

        }

        body {
            background: url(../img/main-bg.jpg) no-repeat;
            background-size: cover;
        }

        .error {
            color: red;
        }
        .container{
            width: 800px;
            margin: 0 auto;
        }

        .success {
            color: green;
        }

    </style>
</head>
<body>
    <h1 class="text-center">Login</h1>
    <div class="container">
    <form method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember_me">
                Remember Me
            </label>
        </div>

        <input type="submit" value="Login" class="btn btn-primary">
        <a href = "/signup" class="btn btn-primary">Sign Up</a>
        <a href="/dashboard" class="btn btn-primary">Back to Home</a>

    </form>
    </div>
</body>
</html>