<thead>
    <tr>
        <th class="sort-col desc" data-col="courseName">Name <i class="fa fa-sort-desc"></i></th>
        <th class="sort-col desc" data-col="createdBy">Created By<i class="fa fa-sort-desc"></i></th>
        <th>Classes</th>
    </tr>
</thead>
<tbody class="table-data">
    <?php
    if (count($listData)) {
        foreach ($listData as $data) {
            echo'<tr id="tr-' . $data['courseId'] . '">'
            . '<td><a class="detail-anchor" href=' . URL .'detail/'. $pageLink .'/'. $data['courseId'] . '>' . $data['courseName'] . '</a></td>'
            . '<td>' . $data['userName'] . '</td>'
            . '<td><a href="'.URL . 'pages/classes/'.$data['courseId'].'">View Classes</a></td></tr>';
        }
    } else
        echo'<tr><td colspan="6">No Records Exist</td></tr>';
    ?>
</tbody>
<tfoot>
<tr><td colspan="2"><?php echo count($listData) ? '<div class="pagination-part">' . $links . '</div>' : ''; ?></td></tr>
</tfoot>