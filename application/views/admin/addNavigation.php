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
                    <?php echo form_open(ADMIN_URL . $formUrl ); ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="frm_add_row">
                            <?php echo form_label('Navigation Title<span class="astrisk">*</span> :'); ?> <?php echo form_error('menuName'); ?>
                            <?php echo form_input(array('id' => 'menuName', 'name' => 'menuName'), set_value('menuName', (isset($result['menuTitle'])) ? $result['menuTitle'] : '')); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php $pageArr = array(); ?>
                            <?php
                            // make default pages array
                            $menuArr = array();
                            if(isset($selPages)){
                                for ($index = 0;$index < count($selPages);$index++) {
                                    array_push($menuArr , $selPages[$index]['menuPageId']);
                                }
                            }
                            ?>
                            <?php foreach ($pages as $page): ?>
                            <?php $pageArr[$page['pageId']] = $page['title']; ?>
                            <?php endforeach; ?>
                            <?php echo form_label('Add Pages :'); ?> <?php echo form_error('pages'); ?>
                            <?php echo form_multiselect('pages[]', set_value('pages',$pageArr) , $menuArr); ?>
                        </div>
                        <div class="frm_add_row">
                            <?php echo form_submit(array('id' => 'submit', 'value' => $submitButton)); ?>
                            <?php echo form_submit(array('id' => 'cancel', 'url' => 'navigations', 'value' => 'Cancel')); ?>
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
