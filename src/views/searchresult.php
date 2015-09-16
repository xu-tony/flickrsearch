<div id="results">
    <?php if (isset($images) && count($images) > 0):
        foreach($images as $image) :
            /**
             * @param FlickrImage $image
             */
            ?>
            <a target="_blank" href="<?php echo $image->get_image_url()?>">
                <img src="<?php echo $image->get_thumbnail_url()?>" alt="<?php echo $image->get_title()?>">
            </a>
        <?php
        endforeach;
    endif;?>
</div>