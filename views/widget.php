<!-- This file is used to markup the public-facing widget. -->
<?php
    if (!empty($title)) {
        echo $before_title . $title . $after_title;
    }

    if (!empty($link_url) && !empty($image_url)) {
?>
        <a href="<?php echo $link_url; ?>"><img src="<?php echo $image_url; ?>" /></a>
<?php
    }
?>