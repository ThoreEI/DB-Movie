<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <link rel="stylesheet" href="../site/css/bootstrap.min.css">
</head>
<body>
<?php
require '../src/Movie.php';
try {
    init();
} catch (DOMException $e) {
    echo $e->getMessage();
}
?>

</body>
</html>
