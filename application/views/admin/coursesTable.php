<table class="table table-striped custom-tbl-class">
    <tr><th data-col="user_id-checkbox" ><input type="checkbox" id="sel-all-chk"  /></th><th class="sort-col desc" data-col="courseId">ID <i class="fa fa-sort-desc"></i></th><th class="sort-col desc" data-col="courseName">Name <i class="fa fa-sort-desc"></i></th><th>Duration</th><th class="sort-col desc" data-col="createdBy">Created By<i class="fa fa-sort-desc"></i></th><th>Classes</th><th data-col="agent">Action</th></tr>
    <tbody class="table-data">
        <?php
        if (count($userData)) {
            foreach ($userData as $data) {
                $createdBy = (!isset($data['userName']) && $data['userName'] == '' ) ? 'User Deleted' : $data['userName'];
                echo'<tr id="tr-' . $data['courseId'] . '"><td><input type="checkbox" id="chk-' . $data['courseId'] . '" class="chk-mul-del" /></td><td>' . $data['courseId'] . '</td><td><a class="detail-anchor" href=' . ADMIN_URL . $pageLink.'/view/' . $data['courseId'] . '>' . $data['courseName'].'</a></td><td>'. $data['courseDuration'] .'</td><td>' . $createdBy. '</td><td><a href="'.ADMIN_URL.'classes/'.$data['courseId'].'"><span class="clsedit">View Classes</span></a></td><td data-id="' . $data['courseId'] . '" ><a href=' . ADMIN_URL . $pageLink.'/edit/' . $data['courseId'] . '><span class="clsedit cls-edit-city" >Edit</span></a><a href=' . ADMIN_URL . $pageLink.'/delete/' . $data['courseId'] . '  onclick="return confirm(\'Are you sure you want to delete this record.It will delete inner classes also.\');"><span class="clsdel cls-del-agent" >Delete</span></a></td></tr>';
            }
        } else
            echo'<tr><td colspan="6">No Records Exist</td></tr>';
        ?>
    </tbody>
</table>
<?php echo count($userData) ? '<div class="pagination-part">'.$links.'</div>' : ''; ?>
<input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">