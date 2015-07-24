<?php
    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
    $paypal_id = 'ankitphp-facilitator@csgroupchd.com'; // Business email ID
?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="checkoutForm">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="<?php echo $merchantId; ?>" />

    <!-- Specify details about the item that buyers will purchase. -->
    <input type="hidden" name="item_name" value="<?php echo $classData['className']; ?>">
    <input type="hidden" name="item_number" value="<?php echo $classData['classId']; ?>">
    <input type="hidden" name="amount" value="<?php echo $classData['price']; ?>" /> 
    <input type="hidden" name="currency_code" value="USD">

    <!-- Specify URLs -->
    <input type='hidden' name='cancel_return' value='<?php echo URL ?>cancelOrder'>
    <input type='hidden' name='return' value='<?php echo URL ?>successOrder'>
    <input type="hidden" name="rm" value="2" />
    <input type="submit" style="display:none;" id="btntest" value="Buy with additional parameters!" /> 
   
    <div style="display: block;" class="loader payment-loader"><img src="<?php echo URL; ?>assets/front/images/ajax-loader.gif">
    <p class="plz-wait"> Please wait.You are redirecting to paypal for payment.............</p>
    </div>
</form>
