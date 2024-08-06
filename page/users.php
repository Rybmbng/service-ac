<?php
session_start();

function generateRandomId($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomId = '';
    for ($i = 0; $i < $length; $i++) {
        $randomId .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomId;
}

include_once 'config.php';

if(isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $randomId = generateRandomId(12); // Generate random ID

    
    // Validasi minimal 5 karakter untuk username dan password
    if(strlen($username) < 5 || strlen($password) < 5) {
        $_SESSION["gagal"] = "Username dan Password harus memiliki minimal 5 karakter.";
    } else {
        // Handle profile picture upload
        $profile_image = $_FILES['profile_image']['name'];
        $target_dir = "uploads/"; // Folder untuk menyimpan foto profil
        $target_file = $target_dir . basename($profile_image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION["gagal"] = "File yang diunggah bukan gambar.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_image"]["size"] > 500000) {
            $_SESSION["gagal"] = "Maaf, file gambar terlalu besar.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $_SESSION["gagal"] = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $_SESSION["gagal"] = "Maaf, file tidak diunggah.";
        } else {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                // Check if username or email already exists
                $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                    $_SESSION["gagal"] = 'USERNAME TELAH DIDAFTARKAN';
                } else {
                  if($level == "admin"){
                    $randomId = "A-".$randomId;
                  }
                  if($level == "pelanggan"){
                    $randomId = "P-".$randomId;
                  }
                  if($level == "teknisi"){
                    $randomId = "T-".$randomId;
                  }
                    // Insert new user into database
                    $stmt = $conn->prepare("INSERT INTO login (id, username, nama, email, password, level, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssss", $randomId, $username, $nama, $email, $hashed_password, $level, $profile_image);
                    $stmt->execute();
                    $_SESSION["success"] = 'Akun berhasil didaftarkan';
                }
            } else {
                $_SESSION["gagal"] = "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE *FROM login WHERE idTelegram = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

}
?>

<?php if(isset($_SESSION['success'])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo $_SESSION['success']; ?>'
        }).then(function() {
            window.location = "indexadmin.php?page=users";
        });
    </script>
<?php unset($_SESSION['success']); } ?>

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Users</button>
    <section class="section dashboard">
      <div class="row">
            <div class="card-body">
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sql = mysqli_query($conn,"SELECT * FROM login WHERE email != ''");
                    while ($data = mysqli_fetch_array($sql)){
                    ?>
                      <tr>
                        <th scope="row"><img  style="height:50px;width:50px;" src="./uploads/<?php echo $data['profile_image'] ?>" alt=""></t>
                        <th scope="row"><?php echo $data['username'] ?></th>
                        <th scope="row"><?php echo $data['email'] ?></th>
                        <th scope="row"><?php echo $data['level'] ?></th>
                        <th scope="row"><a href="?page=users&id=<?php echo $data['id']?>" class="btn btn-primary"> Hapus</a></th>
                      </tr>
                      <?php }?>
                      </tbody>
                  </table>
            </div>
        </div>
    </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $("#username").keyup(function(){
        var username = $(this).val();
        $.ajax({
            url: 'page/checkusername.php', // Ganti dengan URL Anda
            type: 'post',
            data: {username: username},
            success: function(response){
                $("#usernameResult").html(response);
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    $("#email").keyup(function(){
        var email = $(this).val();
        $.ajax({
            url: 'page/checkemail.php', // Ganti dengan URL Anda
            type: 'post',
            data: {email: email},
            success: function(response){
                $("#emailResult").html(response);
            }
        });
    });
});
</script>


<!-- Modal Tambah Kartu -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
      <div class="card">
            <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="row g-4">
            <div class="col-md-6">
                  <label for="menu" class="form-label">Username</label>
                  <div class="input-group">
                  <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-describedby="inputGroupPrepend2" required>
                  </div>
              <div id="usernameResult"></div>

                </div>

                <div class="col-md-6">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                  <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-describedby="inputGroupPrepend2" required>
                  </div>
                <div id="emailResult"></div>
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="level" class="form-label">Level</label>
                  <div class="input-group">
                      <select class="form-control" name="level" id="level" required>
                          <option value="">Pilih Level</option>
                          <option value="admin">Admin</option>
                          <option value="teknisi">Teknisi</option>
                          <option value="pelanggan">Pelanggan</option>
                      </select>
                  </div>
              </div>
              
              <div class="col-md-6">
                  <label for="profile" class="form-label">Foto Profile</label>
                  <div class="input-group">
                  <input type="file" id= "profilr" name="profile_image" accept="image/*" required>
                  </div>
              </div>
                
                <div class="col-12">
                  <button type="submit" name="daftar" value="daftar" class="btn centeralign-content-center btn-primary" >Tambah</button>
                </div>

              </form>
            </div>
          </div>
          </center>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
