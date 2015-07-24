
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="frm_add_row">
                            <?php echo form_label('Page Title<span class="astrisk">*</span>:'); ?> <?php echo form_error('title'); ?>
                            <?php echo form_input(array('id' => 'title', 'name' => 'title'), set_value('title', (isset($result['title'])) ? $result['title'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Page Handle<span class="astrisk">*</span>:'); ?> <?php echo form_error('handle'); ?>
                            <?php echo form_input(array('id' => 'handle', 'name' => 'handle'), set_value('handle', (isset($result['handle'])) ? $result['handle'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Add Content :'); ?> <?php echo form_error('content'); ?>
                            <textarea cols="80" id="content" name="content" rows="10"><?php echo set_value('content' , (isset($result['content'])) ? $result['content'] : '') ?></textarea>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton)); ?>
                            <?php echo form_submit(array('id' => 'cancel', 'url' => 'pages', 'value' => 'Cancel')); ?>
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

			CKEDITOR.replace( 'content');

		</script>
</body>
</html>
