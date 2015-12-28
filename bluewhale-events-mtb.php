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

// $callback
function bluewhale_event_details($post) {

  $post_id = get_the_ID();
  // create nonce for security.
  wp_nonce_field(basename(__FILE__), 'bluewhale_metabox_nonce');
  #$bluewhale_stored_meta = get_post_meta($post->ID);
  $bluewhale_stored_meta = get_post_meta($post_id);
  
  ?>
  <div>
    <pre>
      <?php var_dump($bluewhale_stored_meta) ?>
    </pre>
  </div>

    <table>
      <tr>
        <td>
          
          <label for="event-date">
        <?php  _e("Enter Date:");  ?>
      </label>
        </td>
        <td>

          <input class="widefat" type="text" name="event-date" 
        <?php
          if (!empty( $bluewhale_stored_meta['event-date']) ) {
            echo 'value="' . $bluewhale_stored_meta['event-date'][0] . '"';
          } else {
            echo 'placeholder="';
            _e('Select Date');
            echo '"';
          }
        ?> 
      size="30" data-target="datepicker" />

        </td>
      </tr>

      <tr>
        <td>
          
          <label for="cover-charge">
        <?php  _e("Cover Charge:");  ?>
      </label>
        </td>
        <td>

          <input class="widefat" type="number" name="cover-charge" min="0"
        <?php
          if (!empty( $bluewhale_stored_meta['cover-charge']) ) {
            echo 'value="' . $bluewhale_stored_meta['cover-charge'][0] . '"';
          } else {
            echo 'placeholder="';
            echo '$10.00';
            echo '"';
          }
        ?> 
      size="30" data-target="cover-charge" />

        </td>
      </tr>
    </table>
      
  		
  		

      <?php
}

/*
 * saving metabox data
 */
function bluewhale_save_meta($post_id) {

  /* checking status */
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = (isset($_POST['bluewhale_metabox_nonce']) && wp_verify_nonce($_POST['bluewhale_metabox_nonce'], basename(__FILE__))) ? 'true' : 'false'; // terse if/else statment

/*
 * 1. create an array containing names off all fields for metabox. 
 * 2. iterate through each field name and run CRUD function.
*/

  $new_meta_value = $_POST[ 'event-date' ];
  $old_meta_value = get_post_meta( $post_id, 'event-date', true );


  // exits script if any status is 'true' OR if nonce is invalid
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }

  /* 
   * Date picker save
   */ 
   /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && '' == $old_meta_value ) {
    add_post_meta($post_id, 'event-date', $new_meta_value );
  } 
   /* If the new meta value does not match the old value, update it. */
   elseif ( $new_meta_value != $old_meta_value ) {
    update_post_meta($post_id, 'event-date', $new_meta_value, $old_meta_value );
  }
  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value ) {
    delete_post_meta( $post_id, 'event-date' );
  }
}
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