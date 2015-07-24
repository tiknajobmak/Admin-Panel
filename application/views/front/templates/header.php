<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0">
        <title>Home</title>
        <!-- Stylesheets -->

        <link href="<?php echo $base_url; ?>assets/front/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/front/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/front/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/front/css/responsive.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Html5 Hack -->
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
        <!-- scripts-->
        <script type="text/javascript">
            document.createElement("article");
            document.createElement("aside");
            document.createElement("audio");
            document.createElement("canvas");
            document.createElement("command");
            document.createElement("datalist");
            document.createElement("details");
            document.createElement("embed");
            document.createElement("figcaption");
            document.createElement("figure");
            document.createElement("footer");
            document.createElement("header");
            document.createElement("hgroup");
            document.createElement("keygen");
            document.createElement("mark");
            document.createElement("meter");
            document.createElement("nav");
            document.createElement("output");
            document.createElement("progress");
            document.createElement("rp");
            document.createElement("rt");
            document.createElement("ruby");
            document.createElement("section");
            document.createElement("source");
            document.createElement("summary");
            document.createElement("time");
            document.createElement("video");
        </script>
    </head>
    <body>
        <div class="loader" style="display: none"><img src="<?php echo URL ?>assets/front/images/ajax-loader.gif"></img></div>
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="brand"><a href="<?php echo URL; ?>"><img src="<?php echo $base_url; ?>assets/front/images/logo.jpg" alt="logo" width="269" height="104"></a></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="head-top">
                            <ul>
                                <li><a href="<?php echo URL; ?>pages/contactus">Contact Us</a></li>
                                <li><a href="<?php echo URL; ?>checkout">Cart</a></li>
                            </ul>
                            <?php if ($this->session->userdata('user_logged_in') && !($this->session->userdata('user_logged_in'))): ?>
                                <div class="dropLogout">
                                    Hello <a href="<?php echo URL ?>login"><?php echo $this->session->userdata('user_logged_in')[0]['userName']; ?></a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo URL; ?>logout" class="dropLink">Logout</a> 
                                        </li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="<?php echo URL; ?>login"class="theme-btn">Student Login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header ends here -->
        <?php  ?>
