<!-- content-part starts -->
<div class="content-part">
    <div class="container-fluid">
        <!-- row starts -->
        <div class="row">
            <!-- content -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4>Dashboard</h4>
                <div class="message"><?php echo $this->session->flashdata('msg'); ?></div>
                <!-- first-part starts -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="partition-detail">
                        <div class="hdng-bck">
                            <h3>How many Visits</h3>
                            <div class="clearfix"></div>
                        </div>
                        <img src="<?php echo URL; ?>assets/admin/images/no-visitors.png" alt="visitors" />
                        <label><?php echo $totVisitors; ?> <span>Visits</span></label>
                    </div>
                </div>
                <!-- first-part ends -->
                 
                <!-- fourth-part starts -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="partition-detail">
                        <div class="hdng-bck">
                            <h3>Notifications</h3>
                            <div class="clearfix"></div>
                        </div>
                        <?php foreach ($userData as $notData): ?>
                            <div class="notification">
                                <div class="activity-detail">

                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                        <?php if (!empty($notData['userImage'])): ?>
                                            <img src="<?php echo URL ?>/assets/front/images/uploads/<?php echo $notData['userImage']; ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                        <label>
                                            <?php
                                            switch ($notData['notType']) {
                                                case 'user':
                                                    echo "<a target='_blank' href=" . ADMIN_URL . $notData['notSlug'] . ">" . $notData['userName'] . " - New User has been created </a>";
                                                    break;
                                                case 'page' :
                                                    echo "<a target='_blank' href=" . URL . $notData['notSlug'] . ">" . $notData['title'] . " - New Page has been created </a>";
                                                    break;
                                                Default :
                                                    echo "New Notification";
                                            }
                                            ?>
                                            </a></label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        <?php endforeach; ?> 

                    </div>
                </div>
                <!-- fourth-part ends -->
                
                 
               
            </div>
            <!-- content -->
            <!-- copyright starts -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="copy-right pull-right">
                    <ul>
                        <li>Copyright © 2014 CS Soft Solutions</li>
                        <li><a href="#">Terms of Usage</a></li>
                    </ul>
                </div>
            </div>
            <!-- copyright ends -->
        </div>
        <!-- row ends -->
    </div>
</div>
<!-- content-part ends -->
<!-- right-content ends -->
<div class="clearfix"></div>
</div>
<!-- fullbody ends -->

</body>
</html>
