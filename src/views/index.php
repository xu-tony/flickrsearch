<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Flickr Search</title>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <link rel="stylesheet" type="text/css" href="/static/main.css">
    </head>

    <body>
        <form id="searchbox" action="/flickr/search" method="get">
            <input type="text" placeholder="Type here" id="search" name="text"
                   value="<?php echo isset($_GET['text']) && trim($_GET['text']) ? $_GET['text'] : '';?>">
            <input type="submit" value="Search" id="submit">
        </form>

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

        <?php if (isset($pagination) && $pagination->getNumPages() > 1):?>
            <div id="pagination">
                    <?php if ($pagination->getPrevUrl()): ?>
                        <span><a href="<?php echo $pagination->getPrevUrl(); ?>">&laquo; Previous</a></span>
                    <?php endif; ?>

                    <?php foreach ($pagination->getPages() as $page): ?>
                        <?php if ($page['url']): ?>
                            <span <?php echo $page['isCurrent'] ? 'class="current"' : ''; ?>>
                                <a <?php echo $page['isCurrent'] ? 'class="active"' : ''; ?>
                                    href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                            </span>
                        <?php else: ?>
                            <span class="disabled"><span><?php echo $page['num']; ?></span></span>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if ($pagination->getNextUrl()): ?>
                        <span><a href="<?php echo $pagination->getNextUrl(); ?>">Next &raquo;</a></span>
                    <?php endif; ?>
            </div>
        <?php endif;?>

    </body>
</html>

