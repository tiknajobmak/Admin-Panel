<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="partition-detail">
        <div class="hdng-bck">
            <h3>Notifications</h3>
            <div class="clearfix"></div>
        </div>
        <?php foreach ($userData as $notData): ?>
        <div class="notification">
            <div class="activity-detail">
                
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                    <?php if(!empty($notData['userImage'])): ?>
                    <img src="<?php echo URL ?>/assets/front/images/uploads/<?php echo $notData['userImage']; ?>">
                    <?php endif; ?>
                </div>
                
                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                    <label>
                        <?php 
                        
                            switch ($notData['notType']){
                                case 'user':
                                    echo "<a target='_blank' href=".ADMIN_URL.$notData['notSlug'].">".$notData['userName']." - New User has been created </a>";
                                    break;
                                case 'page' : 
                                    echo "<a target='_blank' href=".URL.$notData['notSlug'].">".$notData['title']." - New Page has been created </a>";
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