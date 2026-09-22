<?php
// Database connection setup
$servername = "127.0.0.1";
$username   = "root";
$password   = "";
$dbname     = "test_db";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch projects from database
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prajin Chandru | Developer Portfolio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; line-height: 1.6; padding: 2rem; }
        header { text-align: center; margin-bottom: 3rem; }
        header h1 { font-size: 2.5rem; color: #38bdf8; }
        header p { color: #94a3b8; font-size: 1.1rem; }
        .container { max-width: 900px; margin: 0 auto; }
        .section-title { font-size: 1.8rem; margin-bottom: 1.5rem; border-bottom: 2px solid #334155; padding-bottom: 0.5rem; color: #f1f5f9; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; }
        .card { background-color: #1e293b; border-radius: 8px; padding: 1.5rem; border: 1px solid #334155; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); border-color: #38bdf8; }
        .card h3 { color: #38bdf8; margin-bottom: 0.5rem; }
        .card p { color: #cbd5e1; font-size: 0.95rem; margin-bottom: 1rem; }
        .tech-tag { display: inline-block; background-color: #0284c7; color: #fff; font-size: 0.8rem; padding: 0.2rem 0.6rem; border-radius: 4px; margin-top: 0.5rem; }
        .btn { display: inline-block; margin-top: 1rem; color: #38bdf8; text-decoration: none; font-weight: bold; }
        .btn:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Prajin Chandru</h1>
        <p>Web Developer | PHP & MySQL Specialist</p>
    </header>

    <h2 class="section-title">Featured Projects</h2>

    <div class="grid">
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
                echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                echo '<span class="tech-tag">' . htmlspecialchars($row["tech_stack"]) . '</span><br>';
                if (!empty($row["link"])) {
                    echo '<a href="' . htmlspecialchars($row["link"]) . '" class="btn" target="_blank">View Project &rarr;</a>';
                }
                echo '</div>';
            }
        } else {
            echo '<p>No projects found in database.</p>';
        }
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>