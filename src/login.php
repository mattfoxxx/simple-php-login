<?php 
session_start();

include('./config.php');

if(isset($_POST['submit'])) 
{ 
    $name = htmlspecialchars($_POST['name']);
    $password = $_POST['password'];
    $output = '';

    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $name);
    if ($stmt->execute()) {
      $result = $stmt->fetch();
      if ($result !== false && password_verify($password, $result['password'])) {
         $_SESSION['username'] = $result['username'];
         header("Location: home.php");
      } else {
         $output .= "Username or password incorrect!<br />";
      }
    } else {
        $output .= "SQL Error <br />";
        $output .= $stmt->queryString."<br />";
        $output .= $stmt->errorInfo()[2];
    }
}

?>
<h1>Login</h1>
<? echo $output; ?>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
   Username: 
   <br><input type="text" name="name">
   <br>Password: 
   <br><input type="password" name="password">
   <br><input type="submit" name="submit" value="Login"><br>
</form>