<div class="partition-detail">
<div class="hdng-bck hdng-segment-detail">
<h3><?php echo isset($data['className']) ? $data['className']: ''; ?>'s Detail</h3>   

<div class="clearfix"></div>
</div>
<div class="update-text">
    <div class="seg-row">
        <label>Class ID</label>
        <div class="seg-data">
            <p><?php echo isset($data['classId']) ? $data['classId'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Name</label>
        <div class="seg-data">
            <p><?php echo isset($data['className']) ? $data['className'] : ''; ?></p>
        </div>
    </div>
    <?php if(isset($data['classType']) && $data['classType'] == 'classroomClass'): ?>
    <div class="seg-row">
        <label>Class Start Date</label> 
        <div class="seg-data">
            <p><?php echo isset($data['startDate']) ? $data['startDate']: ''; ?></p>
        </div>
    </div>    
    <div class="seg-row">
        <label>Class End Date</label>
        <div class="seg-data">
            <p><?php echo isset($data['endDate']) ? $data['endDate']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Time</label>
        <div class="seg-data">
            <p><?php echo isset($data['time']) ? $data['time'] . ' minutes': ''; ?></p>
        </div>
    </div>
    <?php else: ?>
    <div class="seg-row">
        <label>Class Duration</label>
        <div class="seg-data">
            <p><?php echo isset($data['duration']) ? $data['duration']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Video URL</label>
        <div class="seg-data">
            <p><?php echo isset($data['classVideo']) ? $data['classVideo']: ''; ?></p>
        </div>
    </div>
    <?php endif; ?>
    <div class="seg-row">
        <label>Class Price</label>
        <div class="seg-data">
            <p><?php echo isset($data['price']) ? $data['price']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Type</label>
        <div class="seg-data">
            <p><?php echo isset($data['classType']) ? $data['classType']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Pass Code</label>
        <div class="seg-data">
            <p><?php echo isset($data['privatePassCode']) ? $data['privatePassCode']: 'Not Private Class'; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Class Payment Type</label>
        <div class="seg-data">
            <p><?php echo isset($data['paymentType']) ? $data['paymentType']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Created By</label>
        <div class="seg-data">
            <p><?php echo isset($data['userName']) ? $data['userName']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Description</label>
        <div class="seg-data">
            <p><?php echo isset($data['description']) ? $data['description']: ''; ?></p>
        </div>
    </div>
</div>
</div>