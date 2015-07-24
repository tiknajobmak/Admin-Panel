jQuery(document).ready(function(){
    
    /** multiple delete **/
    jQuery('#del_multiple').on('click',function(){
        deleteMultiple('orders/multipleDelete/');
        return false;
    });
    /** multiple delete end **/
    
    /*** record per page start ***/
    jQuery('#pagination_records').on('change',function(){
        var perPage = jQuery(this).val();
        var ajaxData = { perPage : perPage };
        var data = callAjax(ajaxData,'orders/ajaxCall/' , useBaseUrl = 1 );
        data.success(function (data) {
            jQuery('.ajaxData').html(data);
        });
    });
    /*** record per page end ***/
    

    /*** sorting start ***/
    jQuery('.ajaxData').on('click' , '.sort-col' , function(){
        var th=jQuery(this);         
        var orderBy = th.attr('class');
        orderBy = orderBy.substr(orderBy.indexOf(" "));
        var colName = th.attr('data-col');
        var ajaxData = { sortcolumn : colName , orderby : orderBy };
        var data = callAjax(ajaxData , 'orders/ajaxCall/' , useBaseUrl = 1);
        data.success(function (data) {
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
        });
    });
    /*** sorting end ***/  
});
