<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Upload extends BaseController
{
  public function index()
  {
    return view('image_form');
  }
  public function store()
  {
    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
      echo "<pre>";
      print_r($_FILES['my_image']);
      echo "</pre>";

      $img_name = $_FILES['my_image']['name'];
      $img_size = $_FILES['my_image']['size'];
      $tmp_name = $_FILES['my_image']['tmp_name'];
      $error = $_FILES['my_image']['error'];

      if ($error === 0) {
        if ($img_size > 125000) {
          $em = "Sorry, your file is too large.";
          header("Location: index.php?error=$em");
        } else {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_lc = strtolower($img_ex);

          $allowed_exs = array("jpg", "jpeg", "png");

          if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $upload_path = "C:\\xampp\\htdocs\\codeigniter4\\aktahr\\public\\uploads_test\\";
            $img_upload_path = "C:\\xampp\\htdocs\\codeigniter4\\aktahr\\public\\uploads_test\\" . $new_img_name;
            session()->start();
            $_SESSION['user_img'] = $new_img_name;
            $_SESSION['user_path'] = $upload_path;
            move_uploaded_file($tmp_name, $img_upload_path);
            $owner = session()->get('email');
            // Insert into Database
            $sql = "INSERT INTO images(image_url, owner) 
                    VALUES('$new_img_name', '$owner')";
            $conn = mysqli_connect('localhost', 'root', '', 'login');
            mysqli_query($conn, $sql);
            echo session()->get('user_img');
            return redirect()->to('/profile')->with('success', 'Image has been sucessfully uploaded with name ' . $_SESSION['user_img']);
            header("Location: view.php");
          } else {
            $em = "You can't upload files of this type";
            header("Location: index.php?error=$em");
          }
        }
      } else {
        $em = "unknown error occurred!";
        header("Location: index.php?error=$em");
      }
    } else {
      header("Location: index.php");
    }
  }
  public function display_image($img_name = 'IMG-6307294c9c9890.88852682.png')
  {
    echo "<img src= 'C:\\xampp\\htdocs\\codeigniter4\\aktahr\\writable\\uploads\\$img_name' width='500' height='600'>";
  }
}
