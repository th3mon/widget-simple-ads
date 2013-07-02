<!-- This file is used to markup the administration form of the widget. -->
<p>
    <label for="<?php echo $this->get_field_name('title'); ?>">
        Title: <input class="widefat" id="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_name('image_url'); ?>">
        Image URL: <input class="widefat" id="<?php echo $this->get_field_name('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $image_url; ?>" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_name('link_url'); ?>">
        Link URL: <input class="widefat" id="<?php echo $this->get_field_name('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo $link_url; ?>" />
    </label>
</p>
