<section>
    <div class="inner-page-cont">
        <div class="container">
            <h1>Login</h1>
            <div class="entry-content">
                <div class="form-sec">
                    <div class="message1"> 
                    <?php 
                        if($this->input->get('redirect') == 'checkout')
                            echo "<div class='alert alert-danger text-center'>You need to login/register first to join class</div>";
                    ?>
                    <?php echo $this->session->flashdata('msg'); ?>
                   </div>
                    <form role="form" action="<?php echo URL ?>login" method="post" id="userAdmin">
                        <div class="form-group">
                            <label for="email">Email address or UserName:</label>
                            <input type="text" class="form-control" id="email" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="password">
                        </div>
                        <div class="forgetNew">
                            <label><a href="javascript:void(0);" class="href_forget">Forgot Password?</a> or <a href="<?php echo URL; ?>register<?php echo (!($this->input->get('redirect')) && $this->input->get('redirect') != '') ? '?redirect=checkout' : ''; ?>">New User?</a></label>
                        </div>
                        <input type="submit" class="btn btn-default" value="Submit" id="loginSubmit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="display: none;" class="custPopup">
    <div class="custPopup-overlay">
        <div onclick="closePopUp(this);" class="close"><i class="fa fa-times"></i></div>        
        <div class="partition-detail">
            <div class="hdng-bck hdng-segment-detail">
                <h3>Forgot Password</h3>   
                <div class="clearfix"></div>
            </div>
            <div class="update-text form-sec">
                <div class="popUpMessage"></div>
                <form role="form" action="<?php echo URL ?>forgetPass" method="post" id="forgotPassForm">
                    <div class="form-group">
                        <label for="email">Enter Email address</label>
                        <input type="text" class="form-control" id="forgotPass" name="username">
                    </div>
                    <input type="submit" class="btn btn-default" value="Submit" id="loginSubmit"/>
                </form>
            </div>
        </div>
    </div>
</div>
