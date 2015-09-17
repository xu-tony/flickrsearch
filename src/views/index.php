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

        <?php if (isset($search_result_view)) echo $search_result_view?>

        <?php if (isset($pagination_view)) echo $pagination_view?>

    </body>
</html>

