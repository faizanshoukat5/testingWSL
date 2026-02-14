<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <?php
        $url = basename($_SERVER['REQUEST_URI']);
        if (strpos($url, '?') !== false) {
            // Remove everything after and including the question mark
            $url = strstr($url, '?', true);
        }
        $url = trim($url, '/');
        $url = preg_replace('/-+/', ' ', $url);
    ?>
    <title><?php echo ucwords($url);?> | <?php echo ucwords($_SESSION['com_name']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="robots" content="noindex">
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/logo-sm.png">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

</head>
<style>
    body {
        background-image: url("images/bg.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;

        /*background-image: radial-gradient(circle at bottom center, rgb(84, 13, 239),rgb(79, 34, 84));*/
    }
</style>
<body class="authentication-bg authentication-bg-pattern d-flex align-items-center pb-0 vh-100">