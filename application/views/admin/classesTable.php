<table class="table table-striped custom-tbl-class">
    <tr><th data-col="user_id-checkbox" ><input type="checkbox" id="sel-all-chk"  /></th>
        <th class="sort-col desc" data-col="classId">ID <i class="fa fa-sort-desc"></i></th>
        <th class="sort-col desc" data-col="className">Name <i class="fa fa-sort-desc"></i></th>
        <th class="sort-col desc" data-col="price">Price<i class="fa fa-sort-desc"></i></th>
        <?php if($controller == 'classroomClass'): ?>
            <th class="sort-col desc" data-col="startDate">Start Date<i class="fa fa-sort-desc"></i></th>
            <th class="sort-col desc" data-col="endDate">End Date<i class="fa fa-sort-desc"></i></th>
            <th>Time</th>
        <?php else: ?>    
            <th>Video URL</th>
            <th>Duration</th>
        <?php endif; ?>
        <th>Status</th>
        <th>Action</th>
    </tr><tbody class="table-data">
        <?php
        if (count($userData)) {
            foreach ($userData as $data) {
                $status = ($data['status']) ? '<span class="enabled">Enabled</span>' : '<span class="disabled">Disabled</span>';
                echo'<tr id="tr-' . $data['classId'] . '">'
                        . '<td><input type="checkbox" id="chk-' . $data['classId'] . '" class="chk-mul-del" /></td>'
                        . '<td>' . $data['classId'] . '</td>'
                        . '<td><a class="detail-anchor" href=' . ADMIN_URL . $pageLink.'/view/' . $data['classId'] . '>' . $data['className'] . '</a></td>'
                        . '<td>' . $data['price']. '</td>';
                echo ($controller == 'classroomClass') ? '<td>' . $data['startDate'] . '</td><td>' . $data['endDate'] . '</td><td>' . $data['time'] . '</td>' : '';
                echo ($controller == 'videoClass') ? '<td>'. $data['classVideo'] .'</td><td>'. $data['duration'] .'</td>' : '';
                echo  '<td><span class="clsedit status" id='.$data['classId'].'>'.$status.'</span></td>'
                        . '<td data-id="' . $data['classId'] . '" ><a href=' . ADMIN_URL . $pageLink.'/edit/' . $data['classId'] . '><span class="clsedit cls-edit-city" >Edit</span></a><a href=' . ADMIN_URL . $pageLink.'/delete/' . $data['classId'] . '  onclick="return deleteConfirm();"><span class="clsdel cls-del-agent" >Delete</span></a></td></tr>';
            }
        } else
            echo'<tr><td colspan="6">No Records Exist</td></tr>';
        ?> 
    </tbody> 
</table>
<?php echo count($userData) ? '<div class="pagination-part">'.$links.'</div>' : ''; ?>
<input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">