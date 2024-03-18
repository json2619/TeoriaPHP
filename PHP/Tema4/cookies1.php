<html>

<?php

$value = 'Red';

if (isset($_COOKIE["Color"])) {
    $color = $_COOKIE["Color"];
} else {
    $color = "Blue";
    setcookie("Color", $value, time() + 300);
}

?>

<body bgcolor='<?php echo $color; ?>'>

</body>

</html>