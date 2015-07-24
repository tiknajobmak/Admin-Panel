jQuery(document).ready(function(){
    /** get the conmtroller name **/
    var pageName = jQuery("#pageName").val();
    /*** cancel button functionality ***/
    jQuery("#cancel").on('click',function(){
        var site_url = jQuery("#site-url").val();
        var extendedUrl = jQuery(this).attr('url');
        window.location.href = site_url + extendedUrl;
        return false;
    });
    /*** cancel button functionality end ***/
    
    /**** change collapse image admin panel ****/
    jQuery('.dashbrd-list').on('click', '.collapsable', function() {
        if (jQuery(this).next().hasClass('in')) {
            jQuery(this).removeClass("newCollapsable");
        }else{
            jQuery(this).addClass("newCollapsable");
        }
    });
    /**** change collapse image admin panel end ****/
    
    /** check/uncheck all checkbox  **/
    jQuery('.ajaxData').on('click' , '#sel-all-chk' ,function(){
        var chk=jQuery('#sel-all-chk:checked').length ? true : false;
        jQuery('.chk-mul-del').prop('checked' , chk);
    });
    /** check/uncheck all checkbox end **/
    
    /** pagination start **/
    jQuery(".ajaxData").on('click' , '.pagination-part a' , function(){
        var href = jQuery(this).attr('href');
        var data = callAjax('' , href , useBaseUrl = 0);
        data.success(function (data) {
            jQuery('.ajaxData').html(data);
        });
         
        return false;
    });
    /** pagination end **/
    
    /** set time out start **/
    flashMsg();
    /** set time out end **/ 
    
    jQuery(".ajaxData").on('click' , '.table-data .detail-anchor' , function() {
            var href = jQuery(this).attr('href');
            var data = callAjax('',href , useBaseUrl = 0 );
            data.success(function (data) {
                jQuery("#dialog").html(data);
                jQuery("#dialog").dialog("open");
            });
            return false;
        });
        
        jQuery("#searchNameForm").on('submit' , function(){
            var ajaxData = {postData: jQuery(this).serialize()};
            var data = callAjax(ajaxData, pageName+'/ajaxCall/', useBaseUrl = 1);
            data.success(function (data) {
                jQuery('.ajaxData').html(data);
            });
            return false;
        });
        
});
    
function deleteConfirm(){
    return confirm("Are you sure you want to delete this record");
}
function deleteMultiple(url){
    var i = 0;
    var ids = [];
    jQuery('.chk-mul-del:checked').each(function(){
      var str = jQuery(this).prop('id');
      ids[i] = str.substring(str.lastIndexOf('-')+1);
      i++;
    });
    var jsonEncode = JSON.stringify(ids);
    var ajaxData = { deleteId : jsonEncode };
    if(jQuery('.chk-mul-del:checked').length == 0)
        alert("No Record Selected");
    else if(confirm('Are you sure,you want to delete selected records?')==true){
        var recordsDeleted = jQuery('.chk-mul-del:checked').length;
        var chkSingle = (recordsDeleted == 1) ? '' : 's';
        var PaginationAvail= (jQuery('.pagination-part').has('a').length) ? 1 : 0;
        var msg = '<div class="alert alert-success text-center">'+recordsDeleted +' record'+chkSingle +' has been deleted Successfully</div>' 
        var data = callAjax(ajaxData , url+jQuery('#pageNumber').val() , useBaseUrl = 1);
        data.success(function (data) {
            if(data.search("colspan") != -1 && PaginationAvail == 1)
                jQuery(".pagination-part a").last().trigger('click');
            else
                jQuery('.ajaxData').html(data);
            flashMsg(msg);
        });
    }
    return false;    
}
function callAjax(jsonEncode , extendUrl , useBaseUrl){
    var base_url = (useBaseUrl) ? jQuery('#site-url').val() : '';
    var returnData = '';
    
    return jQuery.ajax({
        url : base_url + extendUrl,
        type: "POST",
        datatype:'json',
        data: jsonEncode,
        beforeSend : function(){
            jQuery('.loader').show();
        },
        success : function(data){
            jQuery('.loader').hide();
        },
    });
}
function flashMsg(msg){
    jQuery('.message').html(msg);
    /** fade out after 10 seconds **/
    setTimeout(function() {
        jQuery('.message').fadeOut();
        jQuery('.message').html('');
        jQuery('.message').fadeIn();
    }, 10000);
    /** fade out after 10 seconds end **/   
}