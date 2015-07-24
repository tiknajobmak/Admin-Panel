<div class="partition-detail">
<div class="hdng-bck hdng-segment-detail">
<h3><?php echo isset($data['categoryName']) ? $data['categoryName']: ''; ?>'s Detail</h3>   

<div class="clearfix"></div>
</div>
<div class="update-text">
    <div class="seg-row">
        <label>Category ID</label>
        <div class="seg-data">
            <p><?php echo isset($data['categoryId']) ? $data['categoryId'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Category Name</label>
        <div class="seg-data">
            <p><?php echo isset($data['categoryName']) ? $data['categoryName'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Created By</label>
        <div class="seg-data">
            <p><?php echo isset($data['userName']) ? $data['userName']: ''; ?></p>
        </div>
    </div>    
</div>
</div>