<!-- Save this as your main PHP file (e.g., index.php) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <style>
       body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom, #434343 0%, black 100%);
}
.main{
	width: 350px;
	height: 500px;
	background: red;
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 50px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 10px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 12px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: linear-gradient(to bottom, #434343 0%, black 100%);
	font-size: 1em;
	font-weight: bold;
	margin-top: 30px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: linear-gradient(to bottom, #d3cce3, #e9e4f0);
    /* label: linear-gradient(to right, #434343 0%, black 100%); */
    
}
.login{
	height: 460px;
	background: linear-gradient(to bottom, #434343 0%, black 100%);
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: linear-gradient(to bottom, #d3cce3, #e9e4f0);
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

    </style>
</head>
<body>
    <div class="main">  	
        <input type="checkbox" id="chk" aria-hidden="true">
        
        <!-- PHP Code -->
        <?php
        include 'connection.php'; // Ensure your database connection file is correct

        session_start();

        // Handle Signup
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
            $user_name = $conn->real_escape_string($_POST['user_name']);
            $email = $conn->real_escape_string($_POST['email']);
            $phno = $conn->real_escape_string($_POST['phno']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $checkEmail = "SELECT * FROM registration WHERE email = '$email'";
            $result = $conn->query($checkEmail);

            if ($result->num_rows > 0) {
                echo "<script>alert('Email already exists. Please use a different email.');</script>";
            } else {
                $sql = "INSERT INTO registration (user_name, email, phno, password) VALUES ('$user_name', '$email', '$phno', '$password')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Registration successful!');</script>";
                } else {
                    echo "<script>alert('Error: {$conn->error}');</script>";
                }
            }
        }

        // Handle Login
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $email = $conn->real_escape_string($_POST['email']);
            $password = $_POST['password'];

            $sql = "SELECT * FROM registration WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['phno'] = $user['phno'];
                    header("Location: home.php"); 
                    exit;
                } else {
                    echo "<script>alert('Invalid password. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('No user found with this email. Please register.');</script>";
            }
        }
        ?>

        <!-- Signup Form -->
        <div class="signup">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="user_name" placeholder="User name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phno" placeholder="Phone Number" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Sign up</button>
            </form>
        </div>

        <!-- Login Form -->
        <div class="login">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
