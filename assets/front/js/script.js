jQuery(document).ready(function(){
    var pageName = jQuery('#pageName').val();
    /*** category filter start ***/
    jQuery('#categoryOption').on('change' , function(){
        var ajaxData = {dataId : this.value};
        var data = callAjax(ajaxData , '/ajaxCall/'+pageName, 0);
        if(data)
            jQuery('.ajaxData').html(data);
        else
            jQuery('.message').html('<div class="alert alert-danger text-center">Some Error Occured!</div>');
        return false;
    });
    /*** category filter end ***/
    /*** sorting start ***/
    jQuery('.ajaxData').on('click' , '.sort-col' , function(){
        var th=jQuery(this);         
        var orderBy = th.attr('class');
        orderBy = orderBy.substr(orderBy.indexOf(" "));
        var colName = th.attr('data-col');
        var ajaxData = { sortcolumn : colName , orderby : orderBy };
        var data = callAjax(ajaxData , '/ajaxCall/'+pageName ,0);
        if(data != ''){
            var $response=jQuery(data);
            jQuery($response).find('.sort-col').each(function (){
                var th1=jQuery(this);
                if(th1.attr('data-col')==colName)
                {
                    if(jQuery.trim(orderBy) == 'desc'){
                        th1.removeClass('desc').addClass('asc');
                        th1.children().removeClass('fa-sort-desc').addClass('fa-sort-asc');
                    }
                    else{
                        th1.removeClass('asc').addClass('desc');
                        th1.children().removeClass('fa-sort-asc').addClass('fa-sort-desc');
                    }
                }
            });             
            jQuery('.ajaxData').html($response);        
        }
    });
    /*** sorting end ***/
    /*** detail view start **/
    jQuery('.ajaxData').on('click' , '.detail-anchor' , function(){
        var data = callAjax('' , this.href, 0);
        jQuery(".partition-detail").remove();
        jQuery('.custPopup').show().children().append(data);
        return false;
    });
    /*** detail view end**/
    
    /** check for valid user start **/
    jQuery('#userAdmin').on('submit' , function(){
        var ajaxData = {  };
        var data = callAjax( jQuery('#userAdmin').serialize(), 'login', 0);
        if(data == 0)
            window.location.href = '';
        else
            flashMsg(data);
        return false;
    });
    /** check for valid user end **/
    /** forget password start**/
    jQuery('.href_forget').on('click' , function(){
        showPopUp('.custPopup');
    });
    
    jQuery('#forgotPassForm').on('submit', function() {
        var formData = jQuery("#forgotPassForm").serialize();
        if(jQuery("#forgotPass").val() == '' ){
            flashMsg('<div class="alert alert-danger text-center">Please enter some value</div>');
            return false;
        }
        var ajaxData = {postData: formData};
        var ajaxReturn = callAjax(ajaxData, '/forgetPass', 0);
        if (ajaxReturn) {
            if(ajaxReturn.search("Not found") == -1){
                flashMsg('<div class="alert alert-success text-center">Your Password has been send to your email</div>');
            }
            else{
                flashMsg('<div class="alert alert-danger text-center">Email not valid!</div>');
            }
            jQuery("#forgotPass").val('');
        }
        else
            jQuery('.message').html('<div class="alert alert-danger text-center">Some Error Occured!</div>');
        return false;
    });
    /*** forget pass end ***/
});
/*
 * to show popup
 * @param : {string} init (handler)
 */
function showPopUp(init){
    jQuery(init).show();
    return false;
}