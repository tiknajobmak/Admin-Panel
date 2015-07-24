<div class="partition-detail">
<div class="hdng-bck hdng-segment-detail">
<h3><?php echo isset($data['userName']) ? $data['userName']: ''; ?>'s Detail</h3>   

<div class="clearfix"></div>
</div>
<div class="update-text">
    <div class="seg-row">
        <label>Name</label>
        <div class="seg-data">
            <p><?php echo isset($data['userFName']) ? $data['userFName'].$data['userLName'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Name</label>
        <div class="seg-data">
            <p><?php echo isset($data['userName']) ? $data['userName']: ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Email</label>
        <div class="seg-data">
            <p><?php echo isset($data['userEmail']) ? $data['userEmail'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Phone Number</label>
        <div class="seg-data">
            <p><?php echo isset($data['userPhnNo']) ? $data['userPhnNo'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Register Time</label>
        <div class="seg-data">
            <p><?php echo isset($data['userRegTime']) ? $data['userRegTime'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Type</label>
        <div class="seg-data">
            <p><?php echo isset($data['userType']) ? $data['userType'] : ''; ?></p>
        </div>
    </div>
    <div class="seg-row">
        <label>User Last Login</label>
        <div class="seg-data">
            <p><?php echo isset($data['userLastLogin']) ? $data['userLastLogin'] : ''; ?></p>
        </div>
    </div>
</div>
</div>