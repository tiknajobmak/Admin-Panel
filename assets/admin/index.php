<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet" type="text/css" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.0.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">//<![CDATA[ 
 var $jas = jQuery.noConflict();
$jas(window).load(function(){
	
$jas("#myButton").click(function () {
 // Set the effect type
    var effect = 'slide';
    // Set the options for the effect type chosen
    var options = { direction: 'left' };
 // Set the duration (default: 400 milliseconds)
    var duration = 600;
  $jas('#myDiv').toggle(effect, options, duration);
  $jas(".right-cnt-main").toggleClass('highlight');

 
  
  
});

});//]]>  

</script>
</head>

<body>
<!-- fullbody starts -->
<div class="fullbody">
	<!-- left-content starts -->
    <div class="left-cnt-main">
    	<!-- dashboard starts -->
    	<div class="dashboard-area" id="myDiv">
    	<div class="dash-header">
        	<div class="logo-dash">
        		<a href="#"><img src="images/logo.jpg" alt="logo" /></a>
            </div>
            <div class="right-nav">
                <ul>
                    <li><a href="#"><img src="images/home.png" alt="home" /></a></li>
                    <li class="mail-chk"><a href="#"><img src="images/mail.png" /> <span>3</span></a></li>
                </ul>
        	</div>
            <div class="clearfix"></div>
        </div>
        <div class="dashbrd-list">
        	<ul>
            	<li id="accordion"><img src="images/dashbrd-sign.png" /><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Dashboard <img src="images/add.png" /></a>
                	<ul class="sub-menu panel-collapse collapse in" id="collapseOne">
                    	<li><a href="#">Sidebar Menu Dark</a></li>
                        <li><a href="#">Sidebar Menu Light</a></li>
                        <li><a href="#">Top Menu Dark</a></li>
                        <li><a href="#">Top Menu Ligh</a></li>
                        <li><a href="#">Top Menu Primary</a></li>
                    </ul>
                </li>
                <li><img src="images/posts.png" /> <a href="#">Posts </a></li>
                <li id="accordion"><img src="images/listings.png" /> <a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo">Listings <img src="images/add.png" /></a>
                	<ul class="sub-menu panel-collapse collapse" id="collapsetwo">
                    	<li><a href="#">Sidebar Menu Dark</a></li>
                        <li><a href="#">Sidebar Menu Light</a></li>
                        <li><a href="#">Top Menu Dark</a></li>
                        <li><a href="#">Top Menu Ligh</a></li>
                        <li><a href="#">Top Menu Primary</a></li>
                    </ul>
                </li>
                <li id="accordion"><img src="images/media.png" /><a data-toggle="collapse" data-parent="#accordion" href="#collapsethree">Media <img src="images/add.png" /></a>
                	<ul class="sub-menu panel-collapse collapse" id="collapsethree">
                    	<li><a href="#">Sidebar Menu Dark</a></li>
                        <li><a href="#">Sidebar Menu Light</a></li>
                        <li><a href="#">Top Menu Dark</a></li>
                        <li><a href="#">Top Menu Ligh</a></li>
                        <li><a href="#">Top Menu Primary</a></li>
                    </ul>
                </li>
                <li id="accordion"><img src="images/links.png" /><a data-toggle="collapse" data-parent="#accordion" href="#collapsefour">Links<img src="images/add.png" /></a>
                	<ul class="sub-menu panel-collapse collapse" id="collapsefour">
                    	<li><a href="#">Sidebar Menu Dark</a></li>
                        <li><a href="#">Sidebar Menu Light</a></li>
                        <li><a href="#">Top Menu Dark</a></li>
                        <li><a href="#">Top Menu Ligh</a></li>
                        <li><a href="#">Top Menu Primary</a></li>
                    </ul>
                </li>
                <li><img src="images/pages.png" /><a href="#">Pages</a></li>
                <li><img src="images/dashbrd-sign.png" /><a href="#">Comments</a></li>
                <li><img src="images/posts.png" /><a href="#">Genesis</a></li>
                <li><img src="images/listings.png" /><a href="#">Appearance</a></li>
                <li><img src="images/media.png" /><a href="#">Plugins</a></li>
                <li><img src="images/links.png" /><a href="#">Users</a></li>
                <li><img src="images/pages.png" /><a href="#">Tools</a></li>
            </ul>
        </div>
    </div>
    	<!-- dashboard ends -->
    </div>
    <!-- left-content ends -->
	<!-- right-content starts -->
    <div class="right-cnt-main">
        <!-- top-header starts -->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="navigation pull-left">
                            <ul>
                                <li id="myButton"><a href="#"><img src="images/menu.png" /></a></li>
                                <li><a href="#"><img src="images/refresh.png" /></a></li>
                                <li class="search-area"><input type="submit" value="submit" /><input type="text" value="Search Dashboard"/></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="profile-info pull-right">
                            <ul>
                                <li><a href="#"><div class="noti">3</div></a></li>
                                <li><a href="#">Abhay Verma <img src="images/drop-arrow.png" /></a></li>
                                <li class="profile-pic"><a href="#"><img src="images/profile-pic.png" /></a></li>
                                <li><a href="#"><img src="images/setting.png" /></a></li>
                                <li class="profile"><a href="#"><img src="images/profile-set.png" /><span>3</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </div>
        </div>
        <!-- top-header ends -->
        <!-- content-part starts -->
        <div class="content-part">
            <div class="container-fluid">
                <!-- row starts -->
                <div class="row">
                    <!-- content -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>Dashboard</h4>
                        <!-- first-part starts -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>How many Visits</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <img src="images/no-visitors.png" alt="visitors" />
                                <label>8,320 <span>Visits</span></label>
                            </div>
                        </div>
                        <!-- first-part ends -->
                        <!-- second-part starts -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>Quick Draft</h3>
                                    <a href="#"><img src="images/up-arw.png" /></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="update-text">
                                    <input type="text" value="Title" />
                                    <textarea>What's on your mind?</textarea>
                                    <input type="submit" value="Save Draft" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- second-part ends -->
                        <!-- third-part starts -->
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>Activity</h3>
                                    <a href="#"><img src="images/up-arw.png" /></a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="activity">
                                    <input type="text" value="Search" />
                                    <div class="activity-detail">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <img src="images/activity-pic.png" class="img-responsive" />
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's simply.</p>
                                            <span>Typesetting industry. Lorem Ipsum has been</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <ul>
                                    <li><a href="#">All</a></li>
                                    <li><a href="#">Pending <span>(1)</span></a></li>
                                    <li><a href="#">Approved</a></li>
                                    <li><a href="#">Spam <span>(0) </span></a></li>
                                    <li><a href="#">Trash <span>(0)</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- third-part ends -->
                        <!-- fourth-part starts -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>Notifications</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="notification">
                                    <div class="activity-detail">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <img src="images/noti-pic1.png" />
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                            <label>David Nester - Commented on your wall </label>
                                            <p>There are many variations of passages of Lorem Ipsum</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="notification">
                                    <div class="activity-detail">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <img src="images/activity-pic.png" />
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                            <label>David Nester - Commented on your wall </label>
                                            <p>There are many variations of passages of Lorem Ipsum</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="notification">
                                    <div class="activity-detail">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <img src="images/noti-3.png" />
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                                            <label>David Nester - Commented on your wall </label>
                                            <p>There are many variations of passages of Lorem Ipsum</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- fourth-part ends -->
                        <!-- fifth-part starts -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>To do List</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="to-do-list">
                                    <input type="text" value="Keywords" />
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="" />
                                        Send email to David, new signups
                                      </label>
                                    </div>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="" />
                                        Call Janell
                                      </label>
                                    </div>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="" />
                                        Server upgrades ASAP
                                      </label>
                                    </div>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="" />
                                        Hello, new task
                                      </label>
                                    </div>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="" />
                                        James Mockup Design
                                      </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- fifth-part ends -->
                        <!-- sixrth-part starts -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="partition-detail">
                                <div class="hdng-bck">
                                    <h3>Mini Calendar</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="calender">
                                    <div class="calendr-month">
                                        <a href="#" class="left-arw"><img src="images/left-arw.png" /></a>
                                        <span>April 2014</span>
                                        <a href="#" class="right-arw"><img src="images/right-arw.png" /></a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive">
                                      <tr>
                                        <th scope="col">Su</th>
                                        <th scope="col">Mo</th>
                                        <th scope="col">Tu</th>
                                        <th scope="col">We</th>
                                        <th scope="col">Th</th>
                                        <th scope="col">Fr</th>
                                        <th scope="col">Sa</th>
                                      </tr>
                                      <tr>
                                        <td><a href="#"><span>30</span></a></td>
                                        <td><a href="#"><span>31</span></a></td>
                                        <td><a href="#">1</a></td>
                                        <td><a href="#">2</a></td>
                                        <td><a href="#">3</a></td>
                                        <td><a href="#">4</a></td>
                                        <td><a href="#">5</a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#">6</a></td>
                                        <td><a href="#">7</a></td>
                                        <td><a href="#">8</a></td>
                                        <td><a href="#">9</a></td>
                                        <td><a href="#">10</a></td>
                                        <td><a href="#">11</a></td>
                                        <td><a href="#">12</a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#">13</a></td>
                                        <td><a href="#">14</a></td>
                                        <td><a href="#">15</a></td>
                                        <td><a href="#">16</a></td>
                                        <td><a href="#">17</a></td>
                                        <td><a href="#">18</a></td>
                                        <td><a href="#">19</a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#">20</a></td>
                                        <td><a href="#">21</a></td>
                                        <td><a href="#">22</a></td>
                                        <td><a href="#">23</a></td>
                                        <td><a href="#">24</a></td>
                                        <td><a href="#">25</a></td>
                                        <td><a href="#">26</a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#">27</a></td>
                                        <td><a href="#">28</a></td>
                                        <td><a href="#">29</a></td>
                                        <td><a href="#">30</a></td>
                                        <td><a href="#"><span>1</span></a></td>
                                        <td><a href="#"><span>2</span></a></td>
                                        <td><a href="#"><span>3</span></a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="#"><span>4</span></a></td>
                                        <td><a href="#"><span>5</span></a></td>
                                        <td><a href="#"><span>6</span></a></td>
                                        <td><a href="#"><span>7</span></a></td>
                                        <td><a href="#"><span>8</span></a></td>
                                        <td><a href="#"><span>9</span></a></td>
                                        <td><a href="#"><span>10</span></a></td>
                                      </tr>
                                    </table>
    
                                </div>
                            </div>
                        </div>
                        <!-- sixth-part ends -->
                    </div>
                    <!-- content -->
                    <!-- copyright starts -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="copy-right pull-right">
                            <ul>
                                <li>Copyright © 2014 CS Soft Solutions</li>
                                <li><a href="#">Terms of Usage</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- copyright ends -->
                </div>
                <!-- row ends -->
            </div>
        </div>
        <!-- content-part ends -->
    </div>
    <!-- right-content ends -->
    <div class="clearfix"></div>
</div>
<!-- fullbody ends -->

</body>
</html>
