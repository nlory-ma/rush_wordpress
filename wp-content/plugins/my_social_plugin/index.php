<?php
/*
Plugin Name: social_plug 
Description: 42 cents
License: GPL
Author: hmichals
Version: 0.1
*/

function fb_add_custom_user_profile_fields( $user ) {
?>

<h3><?php _e('Reseaux Sociaux', 'your_textdomain'); ?></h3> <table class="form-table">
<tr>
<th>
<label for="Facebook"><?php _e('Facebook', 'your_textdomain'); ?></label>
</th>
<td>
<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta(
'facebook', $user->ID ) ); ?>" class="regular-text" /><br /> <span class="description">
<?php _e('URL de votre compte facebook', 'your_textdomain'); ?> </span>
</td>
</tr>
</table>

<h3><?php _e('Ajouter une video', 'your_textdomain'); ?></h3> <table class="form-table">
<tr>
<th>
<label for="URL"><?php _e('Dailymotion', 'your_textdomain'); ?></label>
</th>
<td>
<input type="text" name="dailymotion" id="dailymotion" value="<?php echo esc_attr( get_the_author_meta(
'dailymotion', $user->ID ) ); ?>" class="regular-text" /><br /> <span class="description">
<?php _e('URL dailymotion', 'your_textdomain'); ?> </span>
</td>
</tr>
</table>



<h3><?php _e('How you feel today?', 'your_textdomain'); ?></h3> <table class="form-table">
<tr>
<th>
<label for="Ton humeur"><?php _e('Facebook', 'your_textdomain'); ?></label>
</th>
<td>
<select name="mood" size="1">
<form>
<option>Cool<option>Chilly<option>Relax<option>En bad<option>Nervous breakdown</select><form>
<?php _e('Dites nous tout !', 'your_textdomain'); ?> </span>
</td>
</tr>
</table>

<?php }

function fb_save_custom_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) return FALSE;
update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
update_usermeta( $user_id, 'dailymotion', $_POST['dailymotion'] );
update_usermeta( $user_id, 'mood', $_POST['mood'] );

}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );

?>