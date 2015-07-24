<section>
    <div class="inner-page-cont">
        <div class="container">
            <h1>Register</h1>
            <div class="entry-content">
                <div class="form-sec register">
                    <div class="message"><?php echo $this->session->flashdata('msg'); ?></div>
                    <?php echo isset($imageError) ? $imageError : ''; ?>
                    <form action="<?php echo URL . $formUrl; ?>" method="post" enctype="multipart/form-data">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('First Name<span class="astrisk">*</span> :'); ?> <?php echo form_error('userFName'); ?>
                            <?php echo form_input(array('id' => 'userFName', 'name' => 'userFName', 'class'=> 'form-control'), set_value('userFName', (isset($result['userFName'])) ? $result['userFName'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Last Name :'); ?> <?php echo form_error('userLName'); ?>
                            <?php echo form_input(array('id' => 'userLName', 'name' => 'userLName', 'class'=> 'form-control'), set_value('userLName', (isset($result['userLName'])) ? $result['userLName'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('User Name<span class="astrisk">*</span> :'); ?> <?php echo form_error('userName'); ?>
                            <?php echo form_input(array('id' => 'userName', 'name' => 'userName', 'placeholder' => 'Please enter unique username.', 'class'=> 'form-control'), set_value('userName', (isset($result['userName'])) ? $result['userName'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Email<span class="astrisk">*</span> :'); ?> <?php echo form_error('userEmail'); ?>
                            <?php echo form_input(array('id' => 'userEmail', 'name' => 'userEmail', 'class'=> 'form-control'), set_value('userEmail', (isset($result['userEmail'])) ? $result['userEmail'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Profile Picture :'); ?> <?php echo form_error('useImage'); ?>
                            <input type="file" name="useImage" size="20" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('Password<span class="astrisk">*</span> :'); ?> <?php echo form_error('userPass'); ?>
                            <?php echo form_password(array('id' => 'userPass', 'name' => 'userPass', 'class'=> 'form-control')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Confirm Password<span class="astrisk">*</span> :'); ?> <?php echo form_error('ucpass'); ?>
                            <?php echo form_password(array('id' => 'ucpass', 'name' => 'ucpass', 'class'=> 'form-control')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Phone Number :'); ?> <?php echo form_error('userPhnNo'); ?>
                            <?php echo form_input(array('id' => 'userPhnNo', 'name' => 'userPhnNo', 'class'=> 'form-control'), set_value('userPhnNo', (isset($result['userPhnNo'])) ? $result['userPhnNo'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Address :'); ?> <?php echo form_error('userAddress'); ?>
                            <?php echo form_input(array('id' => 'userAddress', 'name' => 'userAddress', 'class'=> 'form-control'), set_value('userAddress', (isset($result['userAddress'])) ? $result['userAddress'] : '')); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton, 'class'=> 'btn btn-default')); ?>
                            <?php echo form_submit(array('id' => 'cancel', 'url' => $link, 'value' => 'Cancel', 'class'=> 'cancel')); ?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
