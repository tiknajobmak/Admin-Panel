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
                            <?php echo form_label('Course Name<span class="astrisk">*</span> :'); ?> <?php echo form_error('courseName'); ?>
                            <?php echo form_input(array('id' => 'courseName', 'name' => 'courseName'), set_value('courseName', (isset($result['courseName'])) ? $result['courseName'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Duration (in days)<span class="astrisk">*</span> :'); ?> <?php echo form_error('courseDuration'); ?>
                            <?php echo form_input(array('id' => 'courseDuration', 'name' => 'courseDuration'), set_value('courseDuration', (isset($result['courseDuration'])) ? $result['courseDuration'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Select Category<span class="astrisk">*</span> :'); ?> <?php echo form_error('categoryId'); ?>
                            <?php //echo form_input(array('id' => 'categoryId', 'name' => 'categoryId'), set_value('courseDuration', (isset($result['courseDuration'])) ? $result['courseDuration'] : '')); ?>
                            <?php
                                $catId = (isset($result)) ? explode(',' , $result['categoryId']) : '';
                                for($i = 0 ; $i < count($categories) ; $i++){
                                    $cat[$categories[$i]['categoryId']] = $categories[$i]['categoryName'];
                                }
                                $js = 'class=multipleSelect multiple="multiple" ';

                                echo form_multiselect('categoryId[]' , $cat , $catId , $js ); 
                            ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_label('Description :'); ?> <?php echo form_error('courseDesc'); ?>
                            <?php echo form_textarea(array('id' => 'courseDesc', 'name' => 'courseDesc'), set_value('courseDesc', (isset($result['courseDesc'])) ? $result['courseDesc'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton)); ?>
                            <?php echo form_submit(array('id' => 'cancel', 'url' => 'courses', 'value' => 'Cancel')); ?>
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
