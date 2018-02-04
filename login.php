<?php
  $dbh = null;

  function db_connect() {
    global $dbh;
    try {
        $dbh = new PDO('mysql:host=db;dbname=user_db', 'root', 'password');
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>\n";
        die();
    }
  }

  function password_is_correct($email,$given_password) {
    global $dbh;
    $stmt = $dbh->prepare("SELECT password FROM users WHERE email = :email");
    if ($stmt->execute(array(':email'=>$email))) {
      while ($line = $stmt->fetch()) {
        $stored_password = $line['password'];
      }
    }

    if ($given_password === $stored_password)
      return TRUE;
  }

  db_connect();
  if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    if (password_is_correct($_POST['email'],$_POST['password']))
      header('Location: logged_in.php');
    else
      header('Location: not_logged_in.php');
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form method="post">

      <label for="email">Email ID</label>
      <input type="text" name="email"><br/>

      <label for="password">Password</label>
      <input type="password" name="password"><br/>

      <input type="submit" value="Submit">

    </form>
  </body>
</html>
