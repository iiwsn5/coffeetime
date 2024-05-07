<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Cloud Bean!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm(){
            var password = document.getElementById('password').value;
            var confirm_password = document.getElementById('confirm_password').value;
            if(password !== confirm_password){
                document.getElementById("error-message").innerHTML = "Password dosen't match!";
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="content">

        <h1>Welcome to Cloud Bean!</h1>

        <form action="process_registration.php" method="post" class="register" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br/><br/>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br/><br/>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <br/>

            <p id="error-message"></p>

            <button type="submit">Register</button>
        </form>

    </div>
</body>
</html>