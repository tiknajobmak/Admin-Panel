<table class="table table-striped custom-tbl-class">
    <tr>
        <th data-col="user_id-checkbox" >
            <input type="checkbox" id="sel-all-chk"  />
        </th>
        <th class="sort-col desc" data-col="pageId">
            ID 
            <i class="fa fa-sort-desc"></i>
        </th>
        <th class="sort-col desc" data-col="title">
            Title 
            <i class="fa fa-sort-desc"></i>
        </th>
        <th class="sort-col desc" data-col="content">
            Content
            <i class="fa fa-sort-desc"></i>
        </th>
        <th class="sort-col desc" data-col="content">
            Parent
        </th>
        <th class="sort-col desc" data-col="content">
            Created By
        </th>
        <th class="sort-col desc" data-col="content">
            Status
        </th>
        <th data-col="agent">
            Action
        </th>
    </tr>
    <tbody class="table-data">
        <?php
        if (count($userData)) {
            foreach ($userData as $data) {
                $status = ($data['status']) ? '<span class="enabled">Enabled</span>' : '<span class="disabled">Disabled</span>';
                echo'<tr id="tr-' . $data['pageId'] . '"><td><input type="checkbox" id="chk-' . $data['pageId'] . '" class="chk-mul-del" /></td><td>' . $data['pageId'] . '</td><td><a class="detail-anchor" href=' . ADMIN_URL . $pageLink.'/view/' . $data['pageId'] . '>' . $data['title']. '</a></td><td>' . strip_tags(trim(character_limiter($data['content'], 20))). '</td><td>' . $data['parentId'] . '</td><td>'.$data['userName'].'</td><td><span class="clsedit status" id='.$data['pageId'].'>'.$status.'</span></td><td data-id="' . $data['pageId'] . '" ><a href=' . ADMIN_URL . $pageLink.'/edit/' . $data['pageId'] . '><span class="clsedit" >Edit</span></a><a href=' . ADMIN_URL . $pageLink.'/delete/' . $data['pageId'] . '  onclick="return deleteConfirm();"><span class="clsdel" >Delete</span></a></td></tr>';
            }
        } else
            echo'<tr><td colspan="6">No Records Exist</td></tr>';
        ?> 
    </tbody>
</table>
<?php echo count($userData) ? '<div class="pagination-part">'.$links.'</div>' : ''; ?>
<input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">