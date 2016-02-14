<?php

//custom meta 

add_action( 'admin_menu', 'my_create_post_meta_box' );
add_action( 'save_post', 'my_save_post_meta_box', 10, 2 );


function my_create_post_meta_box() {
add_meta_box( 'my-meta-box', 'Second Excerpt', 'my_post_meta_box', 'post', 'normal', 'high' );
add_meta_box( 'my-meta-box', 'Second Excerpt', 'my_post_meta_box', 'page', 'normal', 'high' );
}
function my_post_meta_box( $object, $box ) { ?>
<p>
<label for="second-excerpt">Second Excerpt</label>
<br />
<textarea name="second-excerpt" id="second-excerpt" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo
wp_specialchars( get_post_meta( $object->ID, 'Second Excerpt', true ), 1 ); ?></textarea>
<input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>"
/>
<?php }
function my_save_post_meta_box( $post_id, $post ) {
if (!wp_verify_nonce( $_POST['my_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
return $post_id;
if (!current_user_can( 'edit_post', $post_id ) )
return $post_id;
$meta_value = get_post_meta( $post_id, 'Second Excerpt', true );
$new_meta_value = stripslashes( $_POST['second-excerpt'] );
if ( $new_meta_value && '' == $meta_value )
add_post_meta( $post_id, 'Second Excerpt', $new_meta_value, true );
elseif ( $new_meta_value != $meta_value )
update_post_meta( $post_id, 'Second Excerpt', $new_meta_value );
elseif ( '' == $new_meta_value && $meta_value )
delete_post_meta( $post_id, 'Second Excerpt', $meta_value );
} ?>

<?php
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'menuH' )
		));
}

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 150, true ); // Normal post thumbnails

add_custom_background();


// custom fields

add_action('wp_insert_post', 'wpc_champs_personnalises_defaut');
function wpc_champs_personnalises_defaut($post_id)
{
if ( $_GET['post_type'] != 'page' ) {
add_post_meta($post_id, 'id_dailymotion', '', true);
}
return true; }


// Custom registration form

function registration_process_hook() {
	 if (isset($_POST['adduser']) && isset($_POST['add-nonce']) && wp_verify_nonce($_POST['add-nonce'], 'add-user')) {
        if ( !wp_verify_nonce($_POST['add-nonce'],'add-user') ) {
            wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
        } else {
            // auto generate a password
            $user_pass = wp_generate_password();
            // setup new user
            $userdata = array(
                'user_pass' => $user_pass,
                'user_login' => esc_attr( $_POST['user_name'] ),
                'user_email' => esc_attr( $_POST['email'] ),
                'role' => get_option( 'default_role' ),
            );
            // setup some error checks
            if ( !$userdata['user_login'] )
                $error = 'A username is required for registration.';
            elseif ( username_exists($userdata['user_login']) )
                $error = 'Sorry, that username already exists!';
            elseif ( !is_email($userdata['user_email'], true) )
                $error = 'You must enter a valid email address.';
            elseif ( email_exists($userdata['user_email']) )
                $error = 'Sorry, that email address is already used!';
            // setup new users and send notification
            else{
                $new_user = wp_insert_user( $userdata );
                wp_new_user_notification($new_user, $user_pass);
            }
        }
    }
    if ( $new_user ) : ?>
 
    <p class="alert"><!-- create and alert message to show successful registration -->
    <?php
        $user = get_user_by('id',$new_user);
        echo 'Vous etes maintenant enregistre ' . $user->user_login;
        echo '<br/>Veuillez verifier votre boite E-mail.';
    ?>
    </p>
    <?php else : ?>
        <?php if ( $error ) : ?>
            <p class="error"><!-- echo errors if users fails -->
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
    <?php endif;
}
add_action('process_customer_registration_form', 'registration_process_hook');


// Custom login page

add_action('init', function(){

  // not the login request?
  if(!isset($_POST['action']) || $_POST['action'] !== 'my_login_action')
    return;

  // see the codex for wp_signon()
  $result = wp_signon();

  if(is_wp_error($result))
    wp_die('Login failed. Wrong password or user name?');

  // redirect back to the requested page if login was successful    
  header('Location: ' . $_SERVER['REQUEST_URI']);
  exit;
});

// Custom comment listing
function wpbx_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
    $avatarURL = get_bloginfo('template_directory');
	$avatar = str_replace( "class='avatar", "class='avatar", get_avatar( $avatar_email, 40, $default = $avatarURL . '/images/gravatar-blank.jpg' ) );
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo $avatar . ' <span class="fn n">' . $commenter . '</span>'; ?>
			</div>
			<div class="comment-meta">
				<?php printf(__('%1$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'wpbx'),
					get_comment_date('j M Y', '', '', false),
					get_comment_time(),
					'#comment-' . get_comment_ID() );
					edit_comment_link(__('Edit', 'wpbx'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>');
				?>
				<span class="reply-link">
					<span class="meta-sep">|</span> <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</span>
			</div>

			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'wpbx') ?>

			<div class="comment-content"><?php comment_text() ?></div>
		</div>
<?php
}
// wpbx_comment()

// For category lists on category archives: Returns other categories except the current one (redundant)
function wpbx_cat_also_in($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function wpbx_tag_also_in($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

// Generate custom excerpt length
function wpbx_excerpt_length($length) {
	return 75;
}
add_filter('excerpt_length', 'wpbx_excerpt_length');


// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function wpbx_widgets_init() {
	if ( !function_exists('register_sidebars') ) {
		return;
	}
	// Formats the theme widgets, adding readability-improving whitespace
	$p = array(
		'before_widget'  =>   '<li id="%1$s" class="widget %2$s">',
		'after_widget'   =>   "</li>\n",
		'before_title'   =>   '<h3 class="widget-title">',
		'after_title'    =>   "</h3>\n"
	);
	register_sidebars( 1, $p );
	register_sidebar( array( 'name' => 'Team42',
	'before_widget' => '<div>', 'after_widget' => "</div>\n",
	'before_title' => '<h3>', 'after_title' => "</h3>\n"
));
	} // ici on ferme la fonction function wpbx_widgets_init()


// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'wpbx_widgets_init' );

// Adds filters for the description/meta content
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Translate, if applicable
load_theme_textdomain('wpbx');


// Construct the WordPress header
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'next_post_rel_link');
remove_action('wp_head', 'previous_post_rel_link');