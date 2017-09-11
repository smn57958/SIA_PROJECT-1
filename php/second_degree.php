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
error_reporting(0);
include ("db_handler.php");
connector::connect();
$sql = "SELECT a1.first_name, a1.last_name, m.name, m.year
FROM actors a1, roles r2, movies m
WHERE a1.id=r2.actor_id AND m.id=r2.movie_id AND r2.actor_id <> 22591 AND r2.movie_id IN (SELECT r3.movie_id 
																	 FROM roles r3) AND r2.movie_id NOT IN 
																								  (SELECT r.movie_id
																								   FROM roles r
																								   WHERE r.movie_id IN (SELECT r1.movie_id 
																													    FROM roles r1
																													    WHERE r1.actor_id=22591))
ORDER BY m.year DESC, m.name ASC;";
$result = mysqli_query(connector::$connection, $sql);
echo "<table>
<th>First Name</th><th>Last Name</th><th>Movie Name</th><th>Movie Year</th>";
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td>";
    echo "</tr>";
    $count ++;
}
echo "</table><br/>";
echo "Total number of Movies connected with Actor <b>Kevin Bacon</b> are :" . $count . "</br>";
connector::disconnect();
?>