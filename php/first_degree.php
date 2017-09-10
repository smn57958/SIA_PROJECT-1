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
$id = ($_GET['id']);
$sql = "SELECT DISTINCT m.name
FROM actors a, roles r, movies m
WHERE a.id=r.actor_id AND m.id=r.movie_id AND a.id=" . $id . " AND r.movie_id IN (SELECT r1.movie_id 
																									FROM roles r1
                                                                                                    WHERE r1.actor_id=22591);";
$result = mysqli_query(connector::$connection, $sql);
echo "<table>
<th>Movie Name</th>";
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
    $count ++;
}
echo "</table><br/>";
echo "Total number of Movies connected with Actor <b>Kevin Bacon</b> are :" . $count . "</br>";
connector::disconnect();
echo "</select>";

?>