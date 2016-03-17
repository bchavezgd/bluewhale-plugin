# bluewhale plugin

Plugin will work with the bluewhale theme to display custom events as the main page on the site.

### Planned:

- Modifying main WP Query for front page.  
- [data validation and sanitization.](https://codex.wordpress.org/Data_Validation)
- require ( $dir . 'bluewhale-artist-cpt.php');
- require ( $dir . 'bluewhale-artist-tax.php');
- require ( $dir . 'bluewhale-artist-mtb.php');

## Active development.

- Custom Meta data for event details mentioned above.

## 2016-03-09

Finished Date and cover charge meta data save.

## 2015-12-26:

Metabox working, able to save and manage dates to the db.

## 2015-12-18:

- Custom Post Type created,
    - all event details will be included in "Event" post including:
        - date
        - cover charge
        - headliner (for main page)
        - video URL input for video background

- custom Genre Taxonomy created.
    - these act as tags
    - end user can search or browse by Genre
