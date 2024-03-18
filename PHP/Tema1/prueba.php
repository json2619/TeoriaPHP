<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mi Página</title>
</head>
<body>

<?php

    echo "<table border='2' width='300' height='300'>";

    for($i= 0;$i<10;$i++)
    {
        echo "<tr>";

        for($j= 0;$j<10;$j++)
        {
            echo "<td>$i</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
?>

</body>
</html>