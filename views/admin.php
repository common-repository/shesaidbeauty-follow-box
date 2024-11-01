<div class="wrapper">  
  <fieldset>  
    <legend>  
      <?php _e('SheSaidBeauty Follow Box', PLUGIN_LOCALE); ?>
    </legend>  
      
    <div class="option">  
      <label for="shesaidbeauty_vanityname">  
        <?php _e('SheSaidBeauty Vanity Name', PLUGIN_LOCALE); ?>  
      </label>  
      <input type="text" id="<?php echo $this->get_field_id('shesaidbeauty_vanityname'); ?>" name="<?php echo $this->get_field_name('shesaidbeauty_vanityname'); ?>" value="<?php echo $instance['shesaidbeauty_vanityname']; ?>" class="">  
    </div>  
      
    <div class="option">  
		<label for="shesaidbeauty_followbox_width">  
		<?php _e('SheSaidBeauty Follow Box Width', PLUGIN_LOCALE); ?>  
		</label>  
		<input type="text" id="<?php echo $this->get_field_id('shesaidbeauty_followbox_width'); ?>" name="<?php echo $this->get_field_name('shesaidbeauty_followbox_width'); ?>" value="<?php echo $instance['shesaidbeauty_followbox_width']; ?>" class="">  
    	<span class="shesaidbeauty_notice_small">(Numbers only - e.g. 300)</span>
    </div>
      
  </fieldset>  
</div>  