<script>
jQuery(function() {
        jQuery("#dialog").dialog({
            autoOpen: false,
             width: '1000',
             height: '600',
            show: {
                effect: "blind",
                duration: 500
            },
            hide: {
                effect: "explode",
                duration: 800
            }
        });
        jQuery(".ajaxData").on('click' , '.table-data .detail-anchor' , function() {
            var href = jQuery(this).attr('href');
            var data = callAjax('',href , useBaseUrl = 0 );
            jQuery("#dialog").html(data);
            jQuery("#dialog").dialog("open");
            return false;
        });
    });
</script>

<div id="dialog" title="Users Details">

</div>
<!-- content-part starts -->
<div class="content-part">
    <div class="container-fluid">
        <!-- row starts -->
        <div class="row">
            <!-- content -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4><?php echo ($heading) ? $heading : ''; ?></h4>
                <!-- first-part starts -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="message"><?php echo $this->session->flashdata('msg'); ?></div>
                    <div class="cls-btn-div  col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="cls-custbtn">                 
                            <a href="<?php echo ADMIN_URL.($pageLink) ? $pageLink : ''; ?>/add" /><span class="cust_button" id="add_data">Add Category</span></a>          
                            <a href="" /><span class="cust_button" id="del_multiple">DELETE MULTIPLE RECORDS</span></a>
                        </div>
                        <div class="right-custom-div col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <select class="custom-dr page_records" id="pagination_records">
                                <?php 
                                    $options = array(2,5,10,20);
                                    echo "Per Page".$perPage = $this->session->userdata('perPage');
                                    for ($i=0 ; $i < count($options) ; $i++){
                                        if($perPage == $options[$i])
                                            echo "<option value=$options[$i] selected>$options[$i]</option>";
                                        else
                                            echo "<option value=$options[$i]>$options[$i]</option>";
                                    }
                                ?>
                                  
                            </select>
                        </div>
                    </div>
                    <div class="ajaxData col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $this->load->view('admin/adminUsersTable'); ?>
                    </div>
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
