<style>
  .alb {
    width: 200px;
    height: 200px;
    padding: 5px;
  }

  .alb img {
    width: 100%;
    height: 100%;
    margin-left: 76%;
    margin-right: auto;
  }

  a {
    text-decoration: none;
    color: blue;
  }

  .update_pic {
    margin-left: 32.5%
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">

        <h3 align="center"> <?= $user['firstname'] . ' ' . $user['lastname'] ?></h3>
        <hr>

        <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <?php
        $name = $user['firstname'];
        $sql = "SELECT * FROM images WHERE owner='$name' AND id=(
              SELECT max(id) FROM images
              )";
        $sname = "localhost";
        $uname = "root";
        $password = "";
        $db_name = "login";
        $conn = mysqli_connect($sname, $uname, $password, $db_name);
        $res = mysqli_query($conn,  $sql);
        ?>

        <form class="" action="/profile" method="post">

            <?php $email = session()->get('email'); $sql = "SELECT * FROM images WHERE owner='$email' AND id=(SELECT max(id) FROM images)"; $conn = mysqli_connect('localhost', 'root', '', 'login'); $res = mysqli_query($conn,  $sql); ?>

            <div class="col-12">
              <?php
              // $name = $user['firstname']; // $sql = "SELECT * FROM images WHERE owner='$name' AND id=( //   SELECT max(id) FROM images //   )"; // $sname = "localhost"; // $uname = "root"; // $password = ""; // $db_name = "login"; // $conn = mysqli_connect($sname, $uname, $password, $db_name); // $res = mysqli_query($conn,  $sql);
              $mysqli = new mysqli('localhost', 'root', '', 'login');
              $email = session()->get('email');
              $result = $mysqli->query("SELECT * FROM images WHERE owner = '$email'");
              if ($result->num_rows == 0) {
                echo "<a href='/image_form' class='update_pic'>Update Profile Picture</a>";
              } else {
                if (mysqli_num_rows($res) > 0) {
                  while ($images = mysqli_fetch_assoc($res)) {  ?>
                    <div class="alb">
                      <?php $img_path = "C:\\xampp\\htdocs\\codeigniter4\\aktahr\\writable\\uploads\\"; ?>
                      <img src="/uploads_test/<?= $images['image_url'] ?>">
                    </div>
                    <br>
                    <a href='/image_form' class='update_pic'>Update Profile Picture</a>
              <?php }
                  $mysqli->close();
                }
              } ?>
            </div>
            <br>

          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>">
              </div>
            </div>


            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname', $user['lastname']) ?>">
              </div>
            </div>


            <div class="col-12">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
              </div>
            </div>


            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
              </div>
            </div>


            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
              </div>
            </div>


            <?php if (isset($validation)) : ?>
              <div class="col-12">
                <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>

          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>