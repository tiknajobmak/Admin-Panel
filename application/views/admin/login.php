<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $base_url = $this->config->item('base_url'); ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logical Expert's Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="<?php echo $base_url; ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/admin/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/admin/css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $base_url; ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $base_url; ?>assets/admin/js/jquery-2.0.2.js"></script>
        <script src="<?php echo $base_url; ?>assets/admin/js/jquery-ui.js"></script>
        <script type="text/javascript">//<![CDATA[ 
            var $jas = jQuery.noConflict();
        </script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="<?php echo $base_url; ?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>assets/admin/js/script.js"></script>
        <?php echo (isset($js) && $js != '' )? $js : ''; ?>
        <script src="<?php echo URL; ?>assets/admin/js/function.js"></script>
        
    </head>

    <body>
         <!-- fullbody starts -->
        <input type="hidden" id="site-url" value="<?php echo URL; ?>" />
        <div class="fullbody">
            <!-- right-content starts -->
            <div class="right-cnt-main">
                <!-- top-header starts -->
                <div class="top-header">
                </div>
                <!-- top-header ends -->
                <!-- content-part starts -->         
                <div class="content-part"> 
                    <div class="container-fluid">
                        <!-- row starts -->
                        <div class="row">
                            <!-- content -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <form action="<?php echo $base_url; ?>adminLogin/form_check" method="post" class="main-form-custom">
                                    <div class="message"><?php echo $this->session->flashdata('msg'); ?></div>
                                    <p><label>Username/Email : </label><input type="text" id="username" name="username" placeholder="Enter Email ID" class="cls-req"   /></p>
                                    <p><label>Password :</label><input type="password" id="passowrd" name="password" placeholder="Enter Password" class="cls-req"   /></p>
                                    <p><input type="submit" value="Login" name="submit"/><span class="not-register"><a id="href_forget" href="javascript:void(0)">Forgot Password?</a></span></P>

                                </form>         
                            </div>
                            <!-- content -->
                            <!-- copyright starts -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="copy-right pull-right">
                                    <ul>
                                        <li>Copyright © 2015 Logical Expert</li>
                                        <li><a href="#">Terms of Usage</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- copyright ends -->
                        </div>
                        <!-- row ends -->
                    </div>
                </div>
            </div>
            <!-- content-part ends -->
        </div>

        <div id="dialog" title="Users Details">
            <div class="partition-detail">
                <div class="message"></div>
                <div class="hdng-bck hdng-segment-detail">
                    <h3>Forgot Password</h3>   
                    <div class="clearfix"></div>
                </div>
                <div class="update-text">
                    <div class="seg-row">
                        <p>Please enter you Email ID and we will send your password in mail.</p>
                        <label>Enter Your Email : </label>
                        <div class="seg-data">
                            <form action="<?php echo URL ?>adminLogin/forgetPassword" method="post" id="forgotPassForm">
                                <input type="text" name="forgotPass" id="forgotPass" />
                                <input type="submit" name="submit" value="Submit" />
                            </form>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
        <!-- right-content ends -->
        <!-- fullbody ends -->
    </body>
</html>