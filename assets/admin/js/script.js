jQuery(document).ready(function(){
    /** check/uncheck all checkbox  **/
    jQuery('.ajaxData').on('click' , '#sel-all-chk' ,function(){
        var chk=jQuery('#sel-all-chk:checked').length ? true : false;
        jQuery('.chk-mul-del').prop('checked' , chk);
    });
    /** check/uncheck all checkbox end **/
    jQuery('#del_multiple').on('click',function(){
        deleteMultiple('adminUsers/multipleDelete/');
        return false;
    });
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
    /*** record per page start ***/
    jQuery('#pagination_records').on('change',function(){
        var perPage = jQuery(this).val();
        var ajaxData = { perPage : perPage };
        var data = callAjax(ajaxData,'adminUsers/ajaxCall/' , msg = 0 , useBaseUrl = 1 );
        if(data != ''){
            jQuery('.ajaxData').html(data);
        }
        else
            jQuery('.message').html('<div class="alert alert-success text-center">Some Error Occured!</div>');
    });
    /*** record per page end ***/
    /*** cancel button functionality ***/
    jQuery("#cancel").on('click',function(){
        var site_url = jQuery("#site-url").val();
        var extendedUrl = jQuery(this).attr('url');
        window.location.href = site_url + extendedUrl;
        return false;
    });
    /*** cancel button functionality end ***/

    /*** sorting start ***/
    jQuery('.ajaxData').on('click' , '.sort-col' , function(){
        var th=jQuery(this);         
        var orderBy = th.attr('class');
        orderBy = orderBy.substr(orderBy.indexOf(" "));
        var colName = th.attr('data-col');
        var ajaxData = { sortcolumn : colName , orderby : orderBy };
        var data = callAjax(ajaxData , 'adminUsers/ajaxCall/' , useBaseUrl = 1);
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
    
    
});
