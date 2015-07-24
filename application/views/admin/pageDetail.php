<div class="partition-detail">
<div class="hdng-bck hdng-segment-detail">
<h3><?php echo isset($data['title']) ? $data['title']: ''; ?>'s Detail</h3>   

<div class="clearfix"></div>
</div>
<div class="update-text">
    <div class="seg-row">
        <label>Page ID</label>
        <div class="seg-data">
            <p><?php echo isset($data['pageId']) ? $data['pageId'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Page Content</label>
        <div class="seg-data">
            <p><?php echo isset($data['content']) ? $data['content'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Page Handle</label>
        <div class="seg-data">
            <p><?php echo isset($data['handle']) ? $data['handle'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Parent Page ID</label>
        <div class="seg-data">
            <p><?php echo isset($data['parentId']) ? $data['parentId'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Created By</label>
        <div class="seg-data">
            <p><?php echo isset($data['userName']) ? $data['userName']: ''; ?></p>
        </div>
    </div>    
    <div class="seg-row">
        <label>Status</label>
        <div class="seg-data">
            <p><?php echo (isset($data['status']) && $data['status'] == 1) ? 'Enabled' : 'Disabled'; ?></p>
        </div>
    </div>    
    <div class="seg-row">
        <label>Last Updated</label>
        <div class="seg-data">
            <p><?php echo (isset($data['lastUpdated'])) ? $data['lastUpdated'] : ''; ?></p>
        </div>
    </div>
</div>
</div>