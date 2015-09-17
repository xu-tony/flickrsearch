<?php if (isset($images) && count($images) > 0):?>
    <div id="results">
        <?php foreach($images as $image) :
            /**
             * @param Wrapper_Flickrimage $image
             */
            ?>
            <a target="_blank" href="<?php echo $image->get_image_url()?>">
                <img src="<?php echo $image->get_thumbnail_url()?>" alt="<?php echo $image->get_title()?>">
            </a>
        <?php endforeach;?>
    </div>
<?php endif;?>