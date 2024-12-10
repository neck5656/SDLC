    <?php
    // Database credentials
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'std_mng');

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("ERROR: Could not connect. " . $conn->connect_error);
    } else {
        echo "Connected successfully.";
    }
    ?>
