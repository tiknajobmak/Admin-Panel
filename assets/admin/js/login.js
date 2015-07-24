jQuery(document).ready(function() {
    /*** forget pass start ***/
    jQuery('#forgotPassForm').on('submit', function() {
        var formData = jQuery("#forgotPassForm").serialize();
        if(jQuery("#forgotPass").val() == '' ){
            flashMsg('<div class="alert alert-danger text-center">Please enter some value</div>');
            return false;
        }
        var ajaxData = {postData: formData};
        var data = callAjax(ajaxData, 'adminLogin/forgetPassword', useBaseUrl = 1);
        data.success(function (data) {
            if(data.search("Not found") == -1){
                flashMsg('<div class="alert alert-success text-center">Your Password has been sent to your email</div>');
            }
            else{
                flashMsg('<div class="alert alert-danger text-center">Email not valid!</div>');
            }
            jQuery("#forgotPass").val('');
        });
        return false;
    });
    /*** forget pass end ***/
});
jQuery(function() {
    jQuery("#dialog").dialog({
        autoOpen: false,
        width: '1000',
        height: '600',
        show: {
            effect: "blind",
            duration: 400
        },
        hide: {
            effect: "explode",
            duration: 400
        }
    });
    jQuery("#href_forget").on('click', function() {
        jQuery("#dialog").dialog("open");
        return false;
    });
});