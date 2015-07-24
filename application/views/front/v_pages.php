<section>
    <div class="inner-page-cont">
        <div class="container">
            <?php
            echo (isset($pageData['title'])) ? '<h1>' . $pageData['title'] . '</h1>' : '';
            ?>
            <div class="entry-content">
                <?php
            echo (isset($pageData['content'])) ?  $pageData['content'] : '';
                ?>
                 
            </div>
        </div>
    </div>
</section>
