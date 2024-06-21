<?php include 'config.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['delete_ids'])) {
    $delete_ids = explode(',', $_POST['delete_ids']);
    foreach ($delete_ids as $id) {
        $id = intval($id);
        $sql = "DELETE FROM users WHERE id=$id";
        $conn->query($sql);
    }
    header("Location: Admin1.php");
    exit();
}
?>

<?php
$sql = "SELECT * FROM users WHERE user_type='user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='styled-table'><thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["username"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td><button type='button' class='delete-btn' data-id='".$row["id"]."'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No users found</p>";
}
?>
<input type="hidden" id="delete-ids" name="delete_ids" value="">
