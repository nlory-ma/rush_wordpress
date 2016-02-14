<?php
/*
	Template Name: Registration Page
*/
get_header();
?>

<?php do_action ('process_customer_registration_form'); ?>

<form action="" method="POST" id="adduser" class="user-forms">
<table>
	<caption>Bienvenue sur le portail candidat :</caption>
	<tbody>
		<tr>
			<td>identifiant :</td>
			<td><input type="text" name="user_name" value="login" id="user_name"></td>
		</tr>
		<tr>
			<td>E-mail :</td>
			<td><input type="text" name="email" value="E-mail" id="email"></td>
		</tr>
		<tr>
			<td> <input name="adduser" type="submit" id="addusersub" class="submit button" value="envoyer" />
			<?php wp_nonce_field( 'add-user', 'add-nonce' ) ?>
<input name="action" type="hidden" id="action" value="adduser" />
			</td>
		</tr>
	</tbody>
</table>
</form>	

<?php get_footer() ?>