<style>
  .alb {
    width: 200px;
    height: 200px;
    padding: 5px;
  }

  .alb img {
    width: 100%;
    height: 100%;
  }

  a {
    text-decoration: none;
    color: black;
  }
</style>

<?php $email = session()->get('email'); $sql = "SELECT * FROM images WHERE owner='$email' AND id=( SELECT max(id) FROM images )"; $conn = mysqli_connect('localhost', 'root', '', 'login'); $res = mysqli_query($conn,  $sql); ?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Hello, <?= session()->get('firstname') ?> . Your id is <?= session()->get('id') ?> </h1>
      <?php
      // $name = $user['firstname']; // $sql = "SELECT * FROM images WHERE owner='$name' AND id=( //   SELECT max(id) FROM images //   )"; // $sname = "localhost"; // $uname = "root"; // $password = ""; // $db_name = "login"; // $conn = mysqli_connect($sname, $uname, $password, $db_name); // $res = mysqli_query($conn,  $sql);
      $mysqli = new mysqli('localhost', 'root', '', 'login');
      $email = session()->get('email');
      $result = $mysqli->query("SELECT * FROM images WHERE owner = '$email'");
      if ($result->num_rows == 0) {
        echo "<h4>Please set a profile picture. </h4>";
      } else {
        if (mysqli_num_rows($res) > 0) {
          while ($images = mysqli_fetch_assoc($res)) {  ?>
            <div class="alb">
              <?php $img_path = "C:\\xampp\\htdocs\\codeigniter4\\aktahr\\writable\\uploads\\"; ?>
              <img src="/uploads_test/<?= $images['image_url'] ?>">
            </div>
      <?php }
          $mysqli->close();
        }
      } ?>
    </div>
  </div>
</div>