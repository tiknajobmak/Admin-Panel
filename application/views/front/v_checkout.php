<section>
    <div class="inner-page-cont">
        <div class="container">
            <h1>Checkout</h1>            
            <div class="entry-content">
                <div class="profile-outer">
                    <div class="profile-inner">
                        <?php
                        $cid = $this->session->userdata('checkout');
                        if (!empty($cid)) :
                            ?>
                            <?php echo isset($msg) ? $msg : '' ?>
                            <div class="details">
                                <table>
                                    <tr>
                                        <td> Class Name :</td>
                                        <td> <span><?php echo $classData['className'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount : </td>
                                        <td><span><?php echo $classData['price'] ?></span> </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- tabs section starts here -->
                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                <li ><a href="#details" data-toggle="tab">Direct Payment</a></li>
                                <li class="active"><a href="#order" data-toggle="tab">Credit Card Payment</a></li>
                            </ul>
                            <!-- tabs section ends here -->
                            <div id="my-tab-content" class="tab-content">
                                <div class="tab-pane " id="details">
                                    <div class="checkout-form">
                                        <form action="checkout" method="post">
                                            <label>Select Your payment method :</label>
                                            <select name="payment">
                                                <option>----Select Payment Method-----</option>
                                                <option value="paypal">Paypal</option>
                                                <option value="authorize">Authorize.net</option>
                                                <option value="wireframe">Wire Frame</option>
                                            </select>
                                            <input type="submit" name="submit" class="btn btn-default" value="Pay">
                                        </form>  
                                    </div>
                                </div>
                                <!-- order-tab starts here -->
                                <div class="tab-pane course-listing active" id="order">
                                    <form action="checkout" method="post">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <?php echo form_label('First Name :'); ?> <?php echo form_error('userFName'); ?>
                                                <?php echo form_input(array('id' => 'userFName', 'name' => 'userFName', 'class' => 'form-control'), set_value('userFName', (isset($result['userFName'])) ? $result['userFName'] : '')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Last Name :'); ?> <?php echo form_error('userLName'); ?>
                                                <?php echo form_input(array('id' => 'userLName', 'name' => 'userLName', 'class' => 'form-control'), set_value('userLName', (isset($result['userLName'])) ? $result['userLName'] : '')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Select State :'); ?> <?php echo form_error('state'); ?>
                                                <?php
                                                $options = array(
                                                    -1 => '----select state----',
                                                    'AK' => 'Alaska',
                                                    'AR' => 'Arkansas',
                                                    'KY' => 'Kentucky',
                                                    'CT' => 'Connecticut'
                                                );
                                                ?>
                                                <?php echo form_dropdown('state', $options, set_value('state')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('City:'); ?> <?php echo form_error('city'); ?>
                                                <?php echo form_input(array('id' => 'city', 'name' => 'city', 'class' => 'form-control'), set_value('city')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Street:'); ?> <?php echo form_error('street'); ?>
                                                <?php echo form_input(array('id' => 'street', 'name' => 'street', 'class' => 'form-control'), set_value('street')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Zip Code:'); ?> <?php echo form_error('zip_code'); ?>
                                                <?php echo form_input(array('id' => 'zip_code', 'name' => 'zip_code', 'class' => 'form-control'), set_value('zip_code')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Select Card Type<span class="astrisk">*</span> :'); ?> <?php echo form_error('card_type'); ?>
                                                <?php
                                                $options = array(
                                                    -1 => '----select card type----',
                                                    'Visa' => 'Visa',
                                                    'MasterCard' => 'Master',
                                                    'Discover' => 'Discover',
                                                );
                                                ?>
                                                <?php echo form_dropdown('card_type', $options, set_value('card_type')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Enter Card Number<span class="astrisk">*</span> :'); ?> <?php echo form_error('card_number'); ?>
                                                <?php echo form_input(array('id' => 'card_number', 'name' => 'card_number', 'class' => 'form-control'), set_value('card_number')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Expiration Date (mm / yyyy)<span class="astrisk">*</span>:'); ?>
                                                <?php echo form_error('month'); ?>
                                                <?php echo form_input(array('id' => 'month', 'name' => 'month', 'class' => 'form-control' , 'placeholder' => 'enter month in mm format'), set_value('month')); ?>
                                                <?php echo form_error('year'); ?>
                                                <?php echo form_input(array('id' => 'year', 'name' => 'year', 'class' => 'form-control', 'placeholder' => 'enter year in yyyy format'), set_value('year')); ?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo form_label('Enter CVV Number<span class="astrisk">*</span> :'); ?> <?php echo form_error('cvv_num'); ?>
                                                <?php echo form_input(array('id' => 'cvv_num', 'name' => 'cvv_num', 'class' => 'form-control'), set_value('cvv_num')); ?>
                                            </div>
                                            <input type="hidden" name="payment" value="creditCard" />
                                            <div class="form-group">
                                                <?php echo form_submit(array('id' => 'submit', 'value' => 'Pay', 'class' => 'btn btn-default')); ?>
                                            </div>
                                    </form>
                                </div>
                                <!-- order-tab ends here -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            else:
                echo "<div class='alert alert-danger text-center'>There is no class in your cart!</div>"
                . "<a href='pages/courses'>Click here</a> to select class";
            endif;
            ?>
        </div>
    </div>
</div>
</section>