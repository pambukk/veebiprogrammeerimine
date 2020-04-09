
<?php
require("../../config_eesrakendused.php");
require("function_lisa.php");
$limit = 10;
$toScript = "\t" .'<link rel="stylesheet" type="text/css" href="todo.css">' ."\n";
$toScript .= "\t" .'<script type="text/javascript" src="todo.js" defer></script>' ."\n";
$latestTodosHTML= latestTodos();
?>
<body>
<?php




echo "<table>
<tr>
<th>Tiitel</th>
<th>Sisu</th>
<th>Loodud</th>
<th>Kategooria</th>
<th>Kehtib</th>
</tr>";

echo $latestTodosHTML;
/*
while($row = mysqli_fetch_array($latestTodosHTML)) {
    echo "<tr>";
    echo "<td>" . $row['tiitel'] . "</td>";
    echo "<td>" . $row['sisu'] . "</td>";
    echo "<td>" . $row['loodud'] . "</td>";
    echo "</tr>";
}
echo "</table>";
#mysqli_close($con);
*/
?>
</body>
</html>