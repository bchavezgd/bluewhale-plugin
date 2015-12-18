<?php
/*
 *
 * add meta box
 *
 * inserts date to sort by.
 *
 * enqueue jqueryui for datepicker. 
 *
 * enqueue JS for form validation. 
 *
 * enqueue CSS for Event Details box 
 *
 * Display the meta box on the edit screen.
 *
 * this code will show up on the edit screen for `events` CPT.
 *
 * does nothing as of 15-12-12
 *
 */


// $callback
function bluewhale_event_details() {

  // create nonce for security.
  wp_nonce_field(basename(__FILE__), 'bluewhale_metabox_nonce');
  ?>
      <p>
      <label for="smashing-post-class">
        <?php
        _e("Add a custom CSS class, which will be applied to WordPress' post class.");
  ?>
      </label>
      <br />
      <input class="widefat" type="text" name="smashing-post-class" id="smashing-post-class" value="<?php echo esc_attr(get_post_meta($object->ID, 'smashing_post_class', true)); ?>" size="30" />
        </p>

  <div>
       <p>
             <label for="date" >Date: </label><input type="date" id="datepicker" value="yy-mm-dd">
         </p>
         <p>
               <label for="cover-charge">Cover Charge: </label><input type="number" placeholder="$" >
           </p>
         <p>
        <label for="headliner">Headliner:</label><input type="text" row="20">
          </p>
        <p>
          <label for="video-bg">Video URL:</label><input type="url">
        </p>
    </div>


<?php
}

function bluewhale_meta_box() {
  add_meta_box(
    'bluewhale-date', // $id
    __('Event Details'), // $title,
    'bluewhale_event_details', // $callback
    'events', // $screen  -> events CPTs
    'normal', // $context
    'high' // $priority
    // [$callback_args]
  );
}

/*
 * saving metabox data
 */

/* setting up meta box for date */

function bluewhale_meta_box_setup() {
  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action('add_meta_boxes', 'bluewhale_meta_box');

  /* Adds Save meta box function to 'save post meta' hook */
  add_action('save_post', 'bluewhale_save_meta', 10, 2);
}

/* defines screens on which meta boxes appear */
add_action('load-post.php', 'bluewhale_meta_box_setup');
add_action('load-post-new.php', 'bluewhale_meta_box_setup');

// add_action('post.php', 'bluewhale_meta_box_setup');
// add_action('post-new.php', 'bluewhale_meta_box_setup');
