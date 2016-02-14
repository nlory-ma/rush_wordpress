<?php
/*
Template Name: Registration
*/

global $current_user;
get_currentuserinfo();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$company = $_POST['company'];

if (($firstname != '') && ($lastname != '') && ($company != '')) {
    // TODO: Do more rigorous validation on the submitted data

    // TODO: Generate a better login (or ask the user for it)
    $login = $firstname . $lastname;

    // TODO: Generate a better password (or ask the user for it)
    $password = '123';

    // TODO: Ask the user for an e-mail address
    $email = 'test@example.com';

    // Create the WordPress User object with the basic required information
    $user_id = wp_create_user($login, $password, $email);

    if (!$user_id || is_wp_error($user_id)) {
       // TODO: Display an error message and don't proceed.
    }

    $userinfo = array(
       'ID' => $user_id,
       'first_name' => $firstname,
       'last_name' => $lastname,
    );

    // Update the WordPress User object with first and last name.
    wp_update_user($userinfo);

    // Add the company as user metadata
    update_usermeta($user_id, 'company', $company);
}

if (is_user_logged_in()) : ?>

  <p>D&eacute enregistr&eacute !</p>

<?php else : while (have_posts()) : the_post(); ?>

<div id="page-<?php the_ID(); ?>">
    <h2><?php the_title(); ?></h2>

    <div class="content">
        <?php the_content() ?>
    </div>

    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="firstname">
            <label for="firstname">First name:</label>
            <input name="firstname"
                   id="firstname"
                   value="<?php echo esc_attr($firstname) ?>">
        </div>
        <div class="lastname">
            <label for="lastname">Last name:</label>
            <input name="lastname"
                   id="lastname"
                   value="<?php echo esc_attr($lastname) ?>">
         </div>
    </form>
</div>

<?php endwhile; endif; ?>