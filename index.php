<?php

include('./controller/flickr.php');

if ($_GET && trim($_GET['text'])) {

    $flickr_control = new Controller_Flickr();

    list($images, $total_num, $total_page) = $flickr_control->get_images($_GET['text']);

    $pagination = $flickr_control->get_pagination($total_num, $total_page);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Flickr Search</title>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
</head>
<body>
<!-- HTML for SEARCH BAR -->
<div id="tfheader">
    <form id="flickrimagesearch" method="get" action="">
        <input type="text" class="tftextinput" name="text" size="21" maxlength="120" value="<?php echo isset($_GET['text'])?$_GET['text']:'';?>">
        <input type="submit" value="search" class="tfbutton">
    </form>
    <div class="tfclear">
    <?php if (isset($images) && count($images) > 0):
        foreach($images as $image) :
            /**
             * @param FlickrImage $image
             */
        ?>
            <img src="<?php echo $image->get_thumbnail_url()?>" alt="<?php echo $image->getTitle()?>">
    <?php
        endforeach;
    endif;?>
        <ul>
            <li class=""><a href="&page=1">&raquo;</a>one</li> <br>
            <li class=""><a href="&page=2">&raquo;</a>two</li><br>
            <li class=""><a href="&page=3">&raquo;</a>three</li>
        </ul>
    </div>
</div>
</body>
</html>

