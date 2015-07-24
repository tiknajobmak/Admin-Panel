jQuery(document).ready(function(){
    /*** cancel button functionality ***/
    jQuery("#cancel").on('click',function(){
        
        var extendedUrl = jQuery(this).attr('url');
        window.location.href = extendedUrl;
        return false;
    });
    /*** cancel button functionality end ***/
    
    /** pagination start **/
    jQuery(".ajaxData").on('click' , '.pagination-part a' , function(){
        var href = jQuery(this).attr('href');
        var data = callAjax('' , href , useBaseUrl = 0);
        if(data){
            jQuery('.ajaxData').html(data);
        }
        else
            jQuery('.message').html('<div class="alert alert-danger text-center">Some Error Occured!</div>');
        return false;
    });
    /** pagination end **/
    
    /** set time out start **/
    flashMsg();
    /** set time out end **/ 
});
/*
 * popup confirm message
 * @returns {Boolean}
 */    
function deleteConfirm(){
    return confirm("Are you sure you want to delete this record");
}
/* call ajax and give response
 * @param {string} jsonEncode
 * @param {string} extendUrl
 * @param {number} useBaseUrl
 * @returns {HTML String}
 */

function callAjax(jsonEncode , extendUrl , useBaseUrl){
    // use base url or not
    var base_url = (useBaseUrl) ? jQuery('#site-url').val() : '';
    var returnData = '';
    jQuery.ajax({
        url : base_url + extendUrl,
        type: "POST",
        datatype:'json',
        context: this,
        async: false,
        data: jsonEncode,
        beforeSend : function(){
            jQuery('.loader').show();
        },
        complete : function(){
            jQuery('.loader').hide();
        }
    }).done(function(data){
        returnData = data;
    }).fail(function(jqXHR, textStatus){
        jQuery('.message').html("<div class='alert alert-danger text-center'>Error : " + textStatus + "</div>");
    });
    return returnData;
}
/*
 * remove message after 10 seconds
 * @param {string} msg
 * @returns {none}
 */
function flashMsg(msg){
    jQuery('.message').html('');
    jQuery('.message').html(msg);
    /** fade out after 10 seconds **/
    setTimeout(function() {
        jQuery('.message').fadeOut();
        jQuery('.message').fadeIn();
    }, 10000);
    /** fade out after 10 seconds end **/   
}
/*
 * close popup
 * @param : this object
 */
function closePopUp(val){
        jQuery(val).parent().parent().hide();
        return false;
    }