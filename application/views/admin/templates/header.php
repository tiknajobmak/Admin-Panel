	<!-- right-content starts -->
    <div class="right-cnt-main">
        <!-- top-header starts -->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="navigation pull-left">
                            <ul>
                                <li><a href=""><img src="<?php echo URL; ?>assets/admin/images/refresh.png" /></a></li>
                                <li class="search-area"><input type="submit" value="submit" /><input type="text" value="Search Dashboard"/></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="profile-info pull-right">
                            <ul>
                                <li class="dropdown-log"><a href="#" class="dash-arrow" onclick=""><?php $data = $this->session->userdata('logged_in'); echo $data[0]['userName'];?><img src="<?php echo URL; ?>assets/admin/images/drop-arrow.png" /></a>
                                    <ul class="dropdown-menu-log" >
                                        <li><a href="<?php echo URL;?>admin/adminLogout">Logout</a></li>                                         
                                    </ul>
                                </li>
                                <li class="profile-pic"><a href="#"><!--<img src="<?php echo URL; ?>assets/admin/images/profile-pic.png" />--></a></li>
                                <li><a href="<?php echo ADMIN_URL ?>settings"><img src="<?php echo URL; ?>assets/admin/images/setting.png" /></a></li>
                                <li class="profile"><a href="<?php echo ADMIN_URL ?>user/<?php echo $this->session->userdata('logged_in')[0]['userId']; ?>"><img src="<?php echo URL; ?>assets/admin/images/profile-set.png" /></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </div>
        </div>
        <!-- top-header ends -->
        <script>
            jQuery(document).ready(function(){
                jQuery(".dropdown-log").hover(function () {
                    jQuery(".dropdown-menu-log").show();
                },function(){
                    jQuery(".dropdown-menu-log").hide();
                });
            });
        </script>