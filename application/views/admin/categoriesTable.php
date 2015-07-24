<table class="table table-striped custom-tbl-class">
    <tr><th data-col="user_id-checkbox" ><input type="checkbox" id="sel-all-chk"  /></th><th class="sort-col desc" data-col="categoryId">ID <i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="categoryName">Name <i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="createdBy">Created By<i class="fa fa-sort-desc"></i></th><th data-col="agent">Action</th></tr><tbody class="table-data">
        <?php
        if (count($userData)) {
            foreach ($userData as $data) {
                $createdBy = ($data['userName'] == '') ? 'User Deleted' : $data['userName'];
                echo'<tr id="tr-' . $data['categoryId'] . '"><td><input type="checkbox" id="chk-' . $data['categoryId'] . '" class="chk-mul-del" /></td><td>' . $data['categoryId'] . '</td><td><a class="detail-anchor" href=' . ADMIN_URL . $pageLink.'/view/' . $data['categoryId'] . '>' . $data['categoryName'].'</a></td><td>' . $createdBy. '</td><td data-id="' . $data['categoryId'] . '" ><a href=' . ADMIN_URL . $pageLink.'/edit/' . $data['categoryId'] . '><span class="clsedit cls-edit-city" >Edit</span></a><a href=' . ADMIN_URL . $pageLink.'/delete/' . $data['categoryId'] . '  onclick="return deleteConfirm();"><span class="clsdel cls-del-agent" >Delete</span></a></td></tr>';
            }
        } else
            echo'<tr><td colspan="6">No Records Exist</td></tr>';
        ?> 
    </tbody>
</table>
<?php echo count($userData) ? '<div class="pagination-part">'.$links.'</div>' : ''; ?>
<input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">