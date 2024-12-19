<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

  if(isset($_SESSION["username"])) {
  header("location: ".APPURL."");
  }
  if(isset($_POST["submit"])){
    if(empty($_POST['email']) or empty($_POST['password'])){
      echo "<script>alert('one or more inputs are empty');</script>";
    }
    else{
      $email = $_POST["email"];
      $password = $_POST["password"];

      $login = $conn->query("SELECT * FROM users WHERE email='$email'");
      $login->execute();

      $fetch = $login->fetch(PDO::FETCH_ASSOC);

      if($login->rowCount() > 0){
        if(password_verify($password, $fetch['mypassword'])) {

          $_SESSION['username'] = $fetch['username'];
          $_SESSION['user_id'] = $fetch['id'];

          header("location: ".APPURL."");


        } else {
          echo "<script>alert('email or password are wrong');</script>";

        }
      }
      else{
        echo "<script>alert('email or password are wrong');</script>";
      }
    }
  }
  
?>

  <div class="reservation-form">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-12">
          <form id="reservation-form" method="post" role="search" action="#">
            <div class="row">
              <div class="col-lg-12">
                <h4>Login</h4>
              </div>
              <div class="col-md-12">
                  <fieldset>
                      <label for="Name" class="form-label">Your Email</label>
                      <input type="email" name="email" class="Name" placeholder="email" autocomplete="on" required>
                  </fieldset>
              </div>          
              <div class="col-md-12">
                <fieldset>
                    <label for="Name" class="form-label">Your Password</label>
                    <input type="password" name="password" class="Name" placeholder="password" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">                        
                  <fieldset>
                      <button type="submit" name="submit" class="main-button">login</button>
                  </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require "../includes/footer.php"; ?>