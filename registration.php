<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Registration Form</h1>
    <form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" required>
		</p>
        <p>
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" required>
		</p>
        <p>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" required>
		</p>
        <p>
			<label for="birth_date">Birth Date</label>
			<input type="date" name="birth_date">
		</p>
        <p>
			<label for="gender">Gender</label>
			<input type="text" name="gender">
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
            <button type="button" id="toggle" aria-pressed="false">Show</button>   
		</p>
        <p>
            <input type="submit" name="registerBtn">
            <input type="reset" value="Reset">
        </p>
	</form>
    <p>Already have an account?<a href="login.php"> Login Account</a></p>
</body>

<script>
    const input = document.getElementById('password');
    const btn   = document.getElementById('toggle');
    btn.addEventListener('click', () => {
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.textContent = show ? 'Hide' : 'Show';
    btn.setAttribute('aria-pressed', show);
    });   
</script>
</html>