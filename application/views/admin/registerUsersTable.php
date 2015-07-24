<table class="table table-striped custom-tbl-class">
    <tr><th data-col="user_id-checkbox" ><input type="checkbox" id="sel-all-chk"  /></th><th class="sort-col desc" data-col="userId">ID <i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="userFName">Name <i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="userName">User Name<i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="userEmail">Email<i class="fa fa-sort-desc"></i></th><th>Status</th><th data-col="agent">Action</th></tr><tbody class="table-data">
        <?php
        if (count($userData)) {
            foreach ($userData as $data) {
                $status = ($data['userStatus']) ? '<span class="enabled">Enabled</span>' : '<span class="disabled">Disabled</span>';
                echo'<tr id="tr-' . $data['userId'] . '"><td><input type="checkbox" id="chk-' . $data['userId'] . '" class="chk-mul-del" /></td><td>' . $data['userId'] . '</td><td><a class="detail-anchor" href=' . ADMIN_URL . $pageLink.'/view/' . $data['userId'] . '>' . $data['userFName'] . ' ' . $data['userLName'] . '</a></td><td>' . $data['userName']. '</td><td>' . $data['userEmail'] . '</td><td><span class="clsedit status" id='.$data['userId'].'>'.$status.'</span></td><td data-id="' . $data['userId'] . '" ><a href=' . ADMIN_URL . $pageLink.'/edit/' . $data['userId'] . '><span class="clsedit cls-edit-city" >Edit</span></a><a href=' . ADMIN_URL . $pageLink.'/delete/' . $data['userId'] . '  onclick="return deleteConfirm();"><span class="clsdel cls-del-agent" >Delete</span></a></td></tr>';
            }
        } else
            echo'<tr><td colspan="6">No Records Exist</td></tr>';
        ?> 
    </tbody>
</table>
<?php echo count($userData) ? '<div class="pagination-part">'.$links.'</div>' : ''; ?>
<input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">