<thead>
    <tr>
        <th>Order Id</th>
        <th>Order Class</th>
        <th>Order Time</th>
        <th>Order Status</th>
        <th>Order Price</th>
        <th>View Class</th>
    </tr></thead>
<tbody class="table-data">
    <?php if (!empty($listData)): ?>
        <?php foreach ($listData as $order): ?>
        <tr>
            <td><?php echo $order['orderId']; ?></td>
            <td><?php echo $order['className']; ?></td>
            <td><?php echo $order['orderTime']; ?></td>
            <td><?php echo $order['orderStatus']; ?></td>
            <td><?php echo $order['price']; ?></td>
            <td><?php echo (isset($order['classVideo']) && !empty($order['classVideo'])) ? '<span class="watch-video" data-videourl="'.$order['classVideo'].'" >Watch Video</span>' : 'Join Class' ?></td>
        </tr>
        <?php endforeach; ?>
        <tr><td colspan="6"><div class="pagination-part"><?php echo $links; ?></div></td></tr>
            <?php else: ?>
        <tr><td colspan="6">No orders found</td></tr>
    <?php endif; ?>    
</tbody>
<!-- the player -->
<!--<div class="flowplayer" style="display: none;" data-swf="flowplayer.swf" data-ratio="0.4167">
   <video>
      <source type="video/mp4" src="">
   </video>
</div>-->
