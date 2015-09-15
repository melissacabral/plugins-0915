<div class="wrap">
	<h1>Company Information Settings</h1>
	<form method="post" action="options.php">
	<?php 
	//connect this form to the settings we registered 
	settings_fields('rad_options_group'); 
	//get the existing values from the DB as an array
	$values = get_option('rad_options');
	?>

	<label>Customer Service Phone Number</label>
	<br>
	<input type="tel" name="rad_options[phone]" value="<?php echo $values['phone'] ?>" 
	class="regular-text">

	<br><br>

	<label>Email Address</label>
	<br>
	<input type="email" name="rad_options[email]" value="<?php echo $values['email'] ?>" 
	class="regular-text">

	<br><br>
	
	<label>Mailing Address</label>
	<br>
	<textarea name="rad_options[address]" class="large-text code"><?php 
		echo $values['address'] ?></textarea>

	<?php submit_button('Save Company Information'); ?>

	</form>
</div>