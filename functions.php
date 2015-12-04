<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = array(
  'lib/assets.php',  // Scripts and stylesheets
  'lib/extras.php',  // Custom functions
  'lib/setup.php',   // Theme setup
  'lib/titles.php',  // Page titles
  'lib/wrapper.php'  // Theme wrapper class
);
foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);

register_post_type( 'tasks',
		array(
			'labels' => array(
				'name' => __( 'Tasks' ),
				'singular_name' => __( 'Task' )
			),
			'label' => 'Tasks',
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'task'),
			'hierarchical' => true,
			'supports' => array('title','editor','excerpt','page-attributes'),
			'show_in_nav_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'show_in_rest'=> true,

		)
	);
function taskvideo_add_meta_box() {

	$screens = array( 'tasks' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'taskvideo_sectionid',
			__( 'Task Video' ),
			'taskvideo_meta_box_callback',
			$screen
		);
	}
}

add_action( 'add_meta_boxes', 'taskvideo_add_meta_box' );

function taskvideo_meta_box_callback($post){
	wp_nonce_field( basename( __FILE__ ), 'vid_nonce' );
	$vid_stored_meta = get_post_meta( $post->ID );
	?>
	<p>
		<?php
		chdir('../vids');
		$dir=getcwd();
		$dir1=explode('/',$dir);
		rsort($dir1);
		$files=scandir($dir);
		if ( isset ( $vid_stored_meta['vid'] ) )
			echo do_shortcode('[videojs mp4="'.$vid_stored_meta['vid'][0].'"]');

		?>
		<div style="clear: both;"></div>
		<label for="video-url" ><?php _e( 'Task Video')?></label>
		<select name="video-url" id="video-url">
			<?php

			foreach(glob("*.mp4") as $file){
				?>
				<option <?php if ( isset ( $vid_stored_meta['video-url'] ) ) {if($file == $vid_stored_meta['video-url'][0] ) echo "selected";} ?> value="<?php echo $file; ?>">
					<?php echo $file; ?>
				</option>
			<?php } ?>
		</select>
		   <input type="hidden" name="dir" value="<?php echo $dir1[0]; ?>" />
        <input type="hidden" name="vid" id="vid" value="<?php if ( isset ( $vid_stored_meta['vid'] ) ) echo $vid_stored_meta['vid'][0]; ?>" />

	</p>

<?php
}
function taskvideo_save( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'vid_nonce' ] ) && wp_verify_nonce( $_POST[ 'vid_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'video-url' ] ) ) {
		$vid= $_POST[ 'video-url' ];
		$dir=get_site_url().'/'.$_POST['dir'];
		$vid1= $dir.'/'.$vid;
		update_post_meta( $post_id, 'video-url', sanitize_text_field( $vid ) );
		update_post_meta( $post_id, 'vid', sanitize_text_field( $vid1 ) );
	}

}
add_action( 'save_post', 'taskvideo_save' );


function slug_get_post_meta_cb( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name );
}

function slug_update_post_meta_cb( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}

	add_action( 'rest_api_init', function() {
 register_api_field( 'tasks',
    'vid',
    array(
       'get_callback'    => 'slug_get_post_meta_cb',
       'update_callback' => 'slug_update_post_meta_cb',
       'schema'          => null,
    )
 );

});