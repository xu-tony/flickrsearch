<form id="searchbox" action="/flickr/search" method="get">
    <input type="text" placeholder="Type here" id="search" name="text" value="<?php echo isset($_GET['text']) && trim($_GET['text']) ? $_GET['text'] : '';?>">
    <input type="submit" value="Search" id="submit">
</form>
