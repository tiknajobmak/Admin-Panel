<section>
    <div class="inner-page-cont">
        <div class="container">
            <?php
            echo (isset($pageData['title'])) ? '<h1>' . $pageData['title'] . '</h1>' : '';
            ?>
            <div class="entry-content">
                <?php echo $this->session->flashdata('msg'); ?>
                <?php
                echo (isset($pageData['content'])) ? $pageData['content'] : '';
                ?>
                <div class="course-listing">
                    <?php if (isset($categories)): ?>
                        <div class="categoryTitle"> Filter by Category : </div>
                        <select id="categoryOption">
                            <option value="-1">All</option>
                            <?php
                            foreach ($categories as $category) {
                                echo "<option value=" . $category['categoryId'] . ">" . $category['categoryName'] . "</option>";
                            }
                            ?>
                        </select>
                    <?php endif; ?>
                    <table class="table table-striped custom-tbl-class ajaxData">
                        <?php $this->load->view('front/v_' . $pageLink . 'Table'); ?>
                    </table>
                    <input type="hidden" id="pageNumber" value="<?php echo $this->session->userdata('pageNumber'); ?>">
                </div>
            </div>
        </div>
</section>
<input type="hidden" id="pageName" value="<?php echo ($this->uri->segment(2)) ? $this->uri->segment(2) : ''; ?>">
<div class="custPopup" style="display: none">
    <div class="custPopup-overlay">
        <div class="close" onclick="closePopUp(this);"><i class="fa fa-times"></i></div>        
    </div>
</div>
<div class="pvtCodePopUp" style="display: none">
    <div class="custPopup-overlay">
        <div class="close" onclick="closePopUp(this);"><i class="fa fa-times"></i></div> 
        <div class="partition-detail">
            <div class="hdng-bck hdng-segment-detail">
                <h3>Join Class</h3>
                <div class="clearfix"></div>
            </div> 
            <div class="abc-one"> 
                <div class="message"></div>
                <form id="privateCode" action="" method="post">
                    <input type="text" name="privateCode" class="privateCode" />
                    <input type="hidden" name="classId" id="classId" value=""/>
                    <input type="submit" value="Verify Code" />

                </form>
            </div>
        </div>
    </div>
</div>