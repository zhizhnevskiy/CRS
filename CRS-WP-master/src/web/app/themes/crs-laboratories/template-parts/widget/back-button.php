<?php if (empty($page)) { ?>
    <div class="back-button">
        <a href="#">
            <i class="fas fa-arrow-left"></i>
            <span>Page with posts doesn't exists</span>
        </a>
    </div>
<?php } else { ?>
    <div class="back-button">
        <a href="<?= get_permalink($page->ID) ?>">
            <i class="fas fa-arrow-left"></i>
            <span><?= $page->post_title ?></span>
        </a>
    </div>
<?php } ?>
