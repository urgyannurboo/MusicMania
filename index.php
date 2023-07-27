<?php
require_once "database.php";

// Retrieve songs from the database
$sql = "SELECT songs.*, categories.name AS category_name FROM songs INNER JOIN categories ON songs.category_id = categories.id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MusicMania</title>
</head>
<body>
    <h1>List of Songs</h1>
    <table>
        <thead>
            <tr>
                <th>Song Name</th>
                <th>Category</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['duration']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
// Insert a new song
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $songName = $_POST['songName'];
    $categoryId = $_POST['categoryId'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO songs (name, category_id, duration) VALUES ('$songName', $categoryId, '$duration')";

    if (mysqli_query($conn, $sql)) {
        echo "New song inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MusicMania</title>
</head>
<body>
    <h1>Add a Song</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="songName
        ">Song Name:</label>
        <input type="text" name="songName" required>
        
        <label for="categoryId">Category:</label>
        <select name="categoryId" required>
            <?php
            // Retrieve categories from the database
            $categorySql = "SELECT * FROM categories";
            $categoryResult = mysqli_query($conn, $categorySql);

            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                echo '<option value="' . $categoryRow['id'] . '">' . $categoryRow['name'] . '</option>';
            }
            ?>
        </select>
        
        <label for="duration">Duration:</label>
        <input type="text" name="duration" required>
        
        <button type="submit">Add Song</button>
    </form>
</body>
</html>
