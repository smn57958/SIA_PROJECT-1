<?php
/*
 * --#-------------------------------------------------------------------------------
 * # Copyright (C) 2017
 * # Authors:
 * # Sohan Nipunage <smn57958@uga.edu>
 * # Dnyanada Shirsat <dds69748@uga.edu>
 * # Akshay Agashe <aa84678@uga.edu>
 * # Niyati Shah <nhs01063@uga.edu>
 * #
 * # *For using this project anywhere, contact authors for permission*
 * # This program is free software: you can redistribute it and/or modify
 * # it under the terms of the GNU General Public License as published by
 * # the Free Software Foundation, either version 3 of the License, or
 * # (at your option) any later version.
 * #
 * # This program is distributed in the hope that it will be useful,
 * # but WITHOUT ANY WARRANTY; without even the implied warranty of
 * # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * # GNU General Public License for more details.
 * #
 * # You should have received a copy of the GNU General Public License
 * # along with this program. If not, see <http://www.gnu.org/licenses/>.
 * #-------------------------------------------------------------------------------
 */
include ("db_handler.php");
connector::connect();
$sql = "SELECT DISTINCT a.first_name, a.last_name
FROM actors a, directors d
WHERE a.first_name=d.first_name AND a.last_name=d.last_name;";
$result = mysqli_query(connector::$connection, $sql);
echo "<table>
<th>First Name</th><th>Last Name</th>";
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td>";
    echo "</tr>";
    $count ++;
}
echo "</table><br/>";
echo "Total number of Actors who have also directed movies are:&nbsp" . $count . "</br>";
echo "</select>";
connector::disconect();
?>