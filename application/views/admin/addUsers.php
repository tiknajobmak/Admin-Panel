<!-- content-part starts -->
<div class="content-part">
    <div class="container-fluid">
        <!-- row starts -->
        <div class="row">
            <!-- content -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4><?php echo ($heading) ? $heading : '' ?></h4>
                <!-- first-part starts -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 frm_add_user">
                    <?php //echo validation_errors(); ?>

                    <?php echo form_open(ADMIN_URL . $formUrl); ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="frm_add_row">
                            <?php echo form_label('First Name<span class="astrisk">*</span> :'); ?> <?php echo form_error('userFName'); ?>
                            <?php echo form_input(array('id' => 'userFName', 'name' => 'userFName'), set_value('userFName', (isset($result['userFName'])) ? $result['userFName'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Last Name :'); ?> <?php echo form_error('userLName'); ?>
                            <?php echo form_input(array('id' => 'userLName', 'name' => 'userLName'), set_value('userLName', (isset($result['userLName'])) ? $result['userLName'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('User Name<span class="astrisk">*</span> :'); ?> <?php echo form_error('userName'); ?>
                            <?php echo form_input(array('id' => 'userName', 'name' => 'userName', 'placeholder' => 'Please enter unique username.'), set_value('userName', (isset($result['userName'])) ? $result['userName'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Email<span class="astrisk">*</span> :'); ?> <?php echo form_error('userEmail'); ?>
                            <?php echo form_input(array('id' => 'userEmail', 'name' => 'userEmail'), set_value('userEmail', (isset($result['userEmail'])) ? $result['userEmail'] : '')); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="frm_add_row">
                            <?php echo form_label('Password<span class="astrisk">*</span> :'); ?> <?php echo form_error('userPass'); ?>
                            <?php echo form_password(array('id' => 'userPass', 'name' => 'userPass')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Confirm Password<span class="astrisk">*</span> :'); ?> <?php echo form_error('ucpass'); ?>
                            <?php echo form_password(array('id' => 'ucpass', 'name' => 'ucpass')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Phone Number :'); ?> <?php echo form_error('userPhnNo'); ?>
                            <?php echo form_input(array('id' => 'userPhnNo', 'name' => 'userPhnNo'), set_value('userPhnNo', (isset($result['userPhnNo'])) ? $result['userPhnNo'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Address :'); ?> <?php echo form_error('userAddress'); ?>
                            <?php echo form_input(array('id' => 'userAddress', 'name' => 'userAddress'), set_value('userAddress', (isset($result['userAddress'])) ? $result['userAddress'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton)); ?>
                            <?php echo form_submit(array('id' => 'cancel', 'url' => $link, 'value' => 'Cancel')); ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- first-part ends -->
            </div>
            <!-- row ends -->
        </div>
    </div>
    <!-- content-part ends -->
</div>
<!-- right-content ends -->
<div class="clearfix"></div>
</div>
<!-- fullbody ends -->
</body>
</html>
