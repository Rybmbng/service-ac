<?php
$conn = mysqli_connect("localhost", "root", "","rozi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
        if (strlen($email) < 5) {
            echo "email harus memiliki minimal 5 karakter";
        } else {
            $stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "email sudah digunakan";
            } else {
                echo "email tersedia";
            }
        }
    } else {
        echo "email tidak boleh kosong";
    }
}
$conn->close();
?>
