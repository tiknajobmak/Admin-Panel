<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="success-msg">
                <?php if($orderCheck): ?>
                    <img src="<?php echo URL; ?>assets/front/images/complete.png" />
                    <h1>
                        Your payment has been completed.<br />
                        Thank you for your order!
                    </h1>
                    <?php if(isset($classVideo)): ?>
                        <h1>
                            You can also watch the video from your account's order section anytime.
                        </h1>
                        <!-- the player -->
                        <div class="flowplayer" data-swf="flowplayer.swf" data-ratio="0.4167">
                           <video>
                              <source type="video/mp4" src="<?php echo $classVideo; ?>">
                           </video>
                        </div>
                    <?php endif; ?>
                <?php 
                    else:
                        echo $msg; 
                    endif;
                ?>
                <p><a href="<?php echo URL; ?>">Click Here</a> to return to the site.</p>
            </div>
            <!-- success msg ends here -->
        </div>
    </div>
</div>
<?php 
    if(isset($js) && !empty($js))
        echo $js;   
    
?>