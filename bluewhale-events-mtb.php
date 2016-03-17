<?php
/*
 * add meta box
 * inserts date to sort by.
 * enqueue jqueryui for datepicker.
 * enqueue JS for form validation.
 * enqueue CSS for Event Details box
 * Display the meta box on the edit screen.
 * this code will show up on the edit screen for `events` CPT.
 * does nothing as of 15-12-12
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
  // create nonce for security.
  wp_nonce_field(basename(__FILE__), 'bluewhale_metabox_nonce');
  $bluewhale_stored_meta = get_post_meta( get_the_ID() );
  ?>
    <table>
      <tr>
        <td>
          <label for="event_date"><?php  _e("Enter Date:");  ?></label>
        </td>
        <td>
          <input class="widefat" type="text" name="event_date"
        <?php
          if (!empty( $bluewhale_stored_meta["event_date"]) ) {
            echo sprintf('value="%s"', $bluewhale_stored_meta["event_date"][0] );
          } else {
            echo sprintf('placeholder="%s"', __('Select Date'));
          }
        ?> data-target="datepicker" >

        </td>
        <td>
          <label for="headliner"><?php _e("Headliner:"); ?></label>
        </td>
        <td>
          <input class="widefat" type="text" name="headliner"
        <?php
          if (!empty( $bluewhale_stored_meta["headliner"]) ) {
            echo sprintf('value="%s"', $bluewhale_stored_meta["headliner"][0] );
          } else {
            echo sprintf('placeholder="%s"', __('Headliner'));
          }
        ?>>
        </td>
      </tr>

      <tr>
        <td>

          <label for="cover-charge">
        <?php  _e("Cover Charge:");  ?>
      </label>
        </td>
        <td>

          <input class="widefat" type="number" name="cover_charge" min="0"
        <?php
          if (!empty( $bluewhale_stored_meta["cover_charge"]) ) {
            echo sprintf('value="%s"', $bluewhale_stored_meta["cover_charge"][0]);
          } else {
            echo 'placeholder="i.e. $10.00"';
          }
        ?> data-target="cover_charge" />

        </td>
        <td>
          <label for="video_bg"><?php _e("Url for Video Background"); ?></label>
        </td>
        <td>
          <input class="widefat" type="url" name="video_bg"
        <?php
          if (!empty( $bluewhale_stored_meta["video_bg"]) ) {
            echo sprintf('value="%s"', $bluewhale_stored_meta["video_bg"][0] );
          } else {
            echo sprintf('placeholder="%s"', __('url'));
          }
        ?>>
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
  $is_valid_nonce = (isset($_POST['bluewhale_metabox_nonce']) && wp_verify_nonce($_POST['bluewhale_metabox_nonce'], basename(__FILE__))) ? true : false;
  // exits script if any status is 'true' OR if nonce is invalid
  if ($is_autosave || $is_revision || !$is_valid_nonce) {
    return;
  }
  /*
   * cover_charge save
   */
  $new_cover_value = $_POST[ "cover_charge" ];
  $old_cover_value = get_post_meta( $post_id, "cover_charge", true );
   /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_cover_value && '' == $old_cover_value ) {
    add_post_meta($post_id, "cover_charge", $new_cover_value );
  }
   /* If the new meta value does not match the old value, update it. */
  if ( $new_cover_value != $old_cover_value ) {
    update_post_meta($post_id, "cover_charge", $new_cover_value, $old_cover_value );
  }
  /* If there is no new meta value but an old value exists, delete it. */
  if ( '' == $new_cover_value ) {
    delete_post_meta( $post_id, "cover_charge" );
  }

  /* date picker save */
  $new_date_value = $_POST[ "event_date" ];
  $old_date_value = get_post_meta( $post_id, "event_date", true );
  if ( $new_date_value && '' == $old_date_value ) {
    add_post_meta($post_id, "event_date", $new_date_value );
  }
  if ( $new_date_value != $old_date_value ) {
    update_post_meta($post_id, "event_date", $new_date_value, $old_date_value );
  }
  if ( '' == $new_date_value ) {
    delete_post_meta( $post_id, "event_date" );
  }

  /* headliner save */
  $new_headliner_value = $_POST[ "headliner" ];
  $old_headliner_value = get_post_meta( $post_id, "headliner", true );
  if ( $new_headliner_value && '' == $old_headliner_value ) {
    add_post_meta($post_id, "headliner", $new_headliner_value );
  }
  if ( $new_headliner_value != $old_headliner_value ) {
    update_post_meta($post_id, "headliner", $new_headliner_value, $old_headliner_value );
  }
  if ( '' == $new_headliner_value ) {
    delete_post_meta( $post_id, "headliner" );
  }

  /* video_bg save */
  $new_video_value = $_POST[ "video_bg" ];
  $old_video_value = get_post_meta( $post_id, "video_bg", true );
  if ( $new_video_value && '' == $old_video_value ) {
    add_post_meta($post_id, "video_bg", $new_video_value );
  }
  if ( $new_date_value != $old_date_value ) {
    update_post_meta($post_id, "video_bg", $new_video_value, $old_video_value );
  }
  if ( '' == $new_video_value ) {
    delete_post_meta( $post_id, "video_bg" );
  }
}
