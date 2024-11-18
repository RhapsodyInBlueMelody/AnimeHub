<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { display: none; }
    </style>  
    <script>
        window.addEventListener('load', function() {
            document.querySelector('.container').style.display = 'block';
        });
    </script>
</head>
<body>
    <?php
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "my_database";

    try {
        $conn = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS Admins (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL
        )";
        $conn->exec($sql);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["add"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $sql =
                    "INSERT INTO Admins (name, email) VALUES (:name, :email)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(["name" => $name, "email" => $email]);
            }

            if (isset($_POST["delete"])) {
                $id = $_POST["id"];
                $sql = "DELETE FROM Admins WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(["id" => $id]);
            }
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

    <div class="container mt-5">
        <h2 class="mb-4">Database Records</h2>

        <form method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="col-md-4">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="add" class="btn btn-success">Add Record</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM Admins");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>
                            <form method='POST' style='display: inline;'>
                                <input type='hidden' name='id' value='" .
                        $row["id"] .
                        "'>
                                <button type='submit' name='delete' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                            <a href='edit.php?id=" .
                        $row["id"] .
                        "' class='btn btn-primary btn-sm'>Edit</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
