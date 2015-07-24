<section>
    <div class="inner-page-cont">
        <div class="container">
            <h1>Your Profile</h1>            
            <div class="entry-content">
                <div class="profile-sec image">
                    <div class="profile-pic">
                        <img src="<?php echo URL ?>assets/front/images/uploads/<?php echo $userData['userImage']; ?>" alt="<?php echo $userData['userImage']; ?>" title="<?php echo $userData['userImage']; ?>" />
                    </div>
                    <div class="profile-cont">
                        <?php echo $userData['userFName']; ?>
                    </div>
                </div>
                <div class="profile-outer">
                    <div class="profile-inner">

                        <!-- tabs section starts here -->
                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Your Details</a></li>
                            <li><a href="#order" data-toggle="tab">Order Summary</a></li>
                        </ul>
                        <!-- tabs section ends here -->


                        <div id="my-tab-content" class="tab-content">
                            <div class="tab-pane active" id="details">
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>First Name : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userFName']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Last Name : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userLName']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Username : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userName']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Email ID : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userEmail']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Contact : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userPhnNo']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Address : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userAddress']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <div class="profile-heading">
                                        <label>Registration Time : </label>
                                    </div>
                                    <div class="profile-cont">
                                        <?php echo $userData['userRegTime']; ?>
                                    </div>
                                </div>
                                <div class="profile-sec">
                                    <a href="<?php echo URL.'profileEdit/'.$userData['userId'] ?>" class="btn btn-default">Edit</a>
                                </div>
                            </div>
                            <!-- order-tab starts here -->
                            <div class="tab-pane course-listing" id="order">
                                <h1>Order summary</h1>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since ining essentially unchanged.</p>
                                <table class="table table-striped custom-tbl-class ajaxData">
                                    <?php $this->load->view('front/v_ordersTable'); ?>
                                </table>
                                <div class="videoPlayer"></div>
                            </div>
                            <!-- order-tab ends here -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    if(isset($js) && !empty($js))
        echo $js;
    
?> 

