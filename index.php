<?php

include('controller/flickr.php');
include('controller/pagination.php');
if ($_GET && isset($_GET['text'])) {

    $flickr_control = new Controller_Flickr();

    $current_page = 1;
    if ($_GET && isset($_GET['page'])) {
        $current_page = $_GET['page'];
    }
    $text = filter_var($_GET['text'], FILTER_SANITIZE_STRING);

    list($images, $total_num, $total_page) = $flickr_control->get_images($text, $current_page);

    $pagination = new Pagination();
    $pagination->items($total_num);
    $pagination->limit(5);
    $pagination->target("?text=".urlencode($text));
    $pagination->currentPage($current_page);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Flickr Search</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <link rel="stylesheet" type="text/css" href="static/main.css">
</head>

<body>

<form id="searchbox" action="" method="get">
    <input type="text" placeholder="Type here" id="search" name="text" value="<?php echo isset($_GET['text']) && trim($_GET['text']) ? $_GET['text'] : '';?>">
    <input type="submit" value="Search" id="submit">
</form>

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

<?php if(isset($pagination)) $pagination->show();?>

</body>
</html>

