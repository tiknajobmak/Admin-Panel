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
        
    });
</script>
<?php $classType = isset($controller) ? $controller : ''; ?>
<div id="dialog" title="<?php echo ($heading) ? $heading : ''; ?> Details">

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
                            <?php if(!isset($pdf)): ?><a href="<?php echo ADMIN_URL.$pageLink.'/add/'.$classType ; ?>" /><span class="cust_button" id="add_data">Add <?php echo ($heading) ? $heading : ''; ?></span></a><?php endif; ?>
                            <a href="" /><span class="cust_button" id="del_multiple">DELETE MULTIPLE RECORDS</span></a>
                        </div>
                        <div class="right-custom-div col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <?php if(isset($search)): ?>
                            <div class="search-area">
                                <form action="" method="post" id="searchNameForm">
                                    <div class="frm_add_row">
                                        <input id="searchName" placeholder="<?php echo ($search == 'userFName') ? 'Search by Name' : 'Search by User Name or Class Name' ?>" type="text" value="" name="<?php echo isset($search) ? $search : '' ?>">
                                    </div>
                                    <input type="submit" name="submit" value="submit" style="display: none" >
                                </form>
                            </div>
                            <?php endif; ?>
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
                    <?php if(isset($pdf) && $pdf == TRUE): ?>
                    <div class="generatePdf">[<a href="<?php echo ADMIN_URL;?>orders/index/1">Generate PDF</a>]</div>
                    <?php endif; ?>
                    <div class="ajaxData col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $this->load->view('admin/'.$pageLink.'Table'); ?>
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
<input type="hidden" value="<?php echo (isset($pageLink )) ? $pageLink : '';?>" id="pageName" />
<input type="hidden" value="<?php echo (isset($controller)) ? $controller : '';?>" id="pageController" />
<!-- fullbody ends -->
</body>
</html>
