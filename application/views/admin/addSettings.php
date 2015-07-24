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
                    <div class="message"><?php echo $this->session->flashdata('msg'); ?></div>

                    <?php echo form_open(ADMIN_URL . $formUrl); ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="frm_add_row">
                            <?php echo form_label('Contact Email<span class="astrisk">*</span> :'); ?> <?php echo form_error('contactEmail'); ?>
                            <?php echo form_input(array('id' => 'contactEmail', 'name' => 'contactEmail'), set_value('contactEmail', (isset($result['contactEmail'])) ? $result['contactEmail'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Paypal Payment Gateway API key<span class="astrisk">*</span> :'); ?> <?php echo form_error('gatewayApi'); ?>
                            <?php echo form_input(array('id' => 'gatewayApi', 'name' => 'gatewayApi'), set_value('gatewayApi', (isset($result['gatewayApi'])) ? $result['gatewayApi'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Authorize payment API Login ID<span class="astrisk">*</span> :'); ?> <?php echo form_error('authorizeApiId'); ?>
                            <?php echo form_input(array('id' => 'authorizeApiId', 'name' => 'authorizeApiId'), set_value('authorizeApiId', (isset($result['authorizeApiId'])) ? $result['authorizeApiId'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Authorize payment Tranction Key<span class="astrisk">*</span> :'); ?> <?php echo form_error('authorizeTransKey'); ?>
                            <?php echo form_input(array('id' => 'authorizeTransKey', 'name' => 'authorizeTransKey'), set_value('authorizeTransKey', (isset($result['authorizeTransKey'])) ? $result['authorizeTransKey'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Put Site on Maitainance Mode'); ?> <?php echo form_error('siteOffline'); ?>
                            <?php echo form_checkbox('siteOffline', 1 , $result['siteOffline']); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Maintainance Mode Text:'); ?> <?php echo form_error('siteOfflineDesc'); ?>
                            <textarea cols="80" id="siteOfflineDesc" name="siteOfflineDesc" rows="10"><?php echo set_value('siteOfflineDesc', (isset($result['siteOfflineDesc'])) ? $result['siteOfflineDesc'] : '') ?></textarea>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton)); ?>
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
<script src="<?php echo URL; ?>assets/admin/js/ckeditor/ckeditor.js"></script>

<script>
    CKEDITOR.replace('siteOfflineDesc');
</script>
</body>
</html>
