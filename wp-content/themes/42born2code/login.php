<?php
/*
Template Name: Login Page
*/
?>

<?php

	if ( is_user_logged_in() )
	{
		header('location: /');
	}
?>

<?php get_header()?>

<form action="" method="post">
<table>
<caption>Bienvenue sur le portail candidat :</caption>
<tbody>
<tr>
<td>identifiant :</td>
<td><input type="text" name="log" value="login""></td>
</tr>
<tr>
<td>mot de passe :</td>
<td><input type="password" name="pwd" value="password"></td>
<td></td>
</tr>
<tr>
<td><input type="submit" value="envoyer">
<input type="hidden" name="action" value="my_login_action" /></td>
</tr>
</tbody>
</table>
</form>

<?php get_footer() ?>
