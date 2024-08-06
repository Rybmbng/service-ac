<?php
$conn = mysqli_connect("localhost", "root", "","rozi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = $_POST['username'];
        if (strlen($username) < 5) {
            echo "Username harus memiliki minimal 5 karakter";
        } else {
            $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Username sudah digunakan";
            } else {
                echo "Username tersedia";
            }
        }
    } else {
        echo "Username tidak boleh kosong";
    }
}
$conn->close();
?>
