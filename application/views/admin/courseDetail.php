<div class="partition-detail">
<div class="hdng-bck hdng-segment-detail">
<h3><?php echo isset($data['courseName']) ? $data['courseName']: ''; ?>'s Detail</h3>   

<div class="clearfix"></div>
</div>
<div class="update-text">
    <div class="seg-row">
        <label>Course Name</label>
        <div class="seg-data">
            <p><?php echo isset($data['courseName']) ? $data['courseName'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Course Duration</label>
        <div class="seg-data">
            <p><?php echo isset($data['courseDuration']) ? $data['courseDuration']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Created By</label>
        <div class="seg-data">
            <p><?php echo isset($data['userName']) ? $data['userName'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>Categories</label>
        <div class="seg-data">
            <p><?php 
            $cat = unserialize($data['categoryId']);
            for($i = 0 ; $i < count($categories) ; $i++){
                if(in_array($categories[$i]['categoryId'], $cat) ){
                    echo $categories[$i]['categoryName'].'<br>';
                }
            }
            //echo isset($data['userPhnNo']) ? $data['userPhnNo'] : ''; ?>
            </p>
        </div>
    </div>
</div>
</div>