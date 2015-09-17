<?php if (isset($pagination) && $pagination->get_num_pages() > 1):?>
    <div id="pagination">
        <?php if ($pagination->get_prev_url()): ?>
            <span><a href="<?php echo $pagination->get_prev_url(); ?>">&laquo; Previous</a></span>
        <?php endif; ?>

        <?php foreach ($pagination->get_pages() as $page): ?>
            <?php if ($page->get_url()): ?>
                <span <?php echo $page->is_current() ? 'class="current"' : ''; ?>>
                                <a <?php echo $page->is_current() ? 'class="active"' : ''; ?>
                                    href="<?php echo $page->get_url(); ?>"><?php echo $page->get_num(); ?></a>
                            </span>
            <?php else: ?>
                <span class="disabled"><span><?php echo $page->get_num(); ?></span></span>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($pagination->get_next_url()): ?>
            <span><a href="<?php echo $pagination->get_next_url(); ?>">Next &raquo;</a></span>
        <?php endif; ?>
    </div>
<?php endif;?>