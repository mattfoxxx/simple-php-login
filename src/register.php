<?php
include('./config.php');

if(isset($_POST['submit'])) 
{ 
    $name = htmlspecialchars($_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $output = '';

    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $stmt->bindParam(':username', $name);
    $stmt->bindParam(':password', $password);
    if($stmt->execute()) {
        $new_id = $pdo->lastInsertId();
        $output .= "Created user with id $new_id.";
        $output .= "<br>Username: <b> $name </b>";
        $output .= "<br>Password has been saved as hash: <b> " . $password . "</b>";
    } else {
        $output .= "SQL Error <br />";
        $output .= $stmt->queryString."<br />";
        $output .= $stmt->errorInfo()[2];
    }

    $output .= "<p>You can use the following form again to register a new user or <a href='login.php'>login</a> with the new user.</p>"; 
}
?>
<h1>Register</h1>
<? echo $output; ?>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
   Username: 
   <br><input type="text" name="name">
   <br>Password: 
   <br><input type="password" name="password">
   <br><input type="submit" name="submit" value="Create user"><br>
</form>