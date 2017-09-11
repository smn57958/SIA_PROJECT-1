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
// error_reporting(0);
include ("db_handler.php");
connector::connect();
$q = ($_GET['q']);
if ($q == 1) {
    getlist();
} else {
    getActor($q);
}

function getlist()
{
    $sql = "SELECT DISTINCT mg.genre FROM movies_genres mg";
    $result = mysqli_query(connector::$connection, $sql);
    echo "Select one genre from the list : <select id='genreList'>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<option value=" . $row['genre'] . ">" . $row['genre'] . "</option>";
    }
    echo "</select>";
}

function getActor($q)
{
    $sql = "SELECT a1.first_name, a1.last_name, a1.id, m.year, m.name
FROM actors a1, roles r1, movies_genres mg1, movies m
WHERE a1.id=r1.actor_id AND r1.movie_id=mg1.movie_id AND m.id=mg1.movie_id AND mg1.genre='".$q."'
GROUP BY a1.id 
HAVING COUNT(mg1.movie_id)=
				(SELECT MAX(maxval) 
				 FROM (SELECT COUNT(mg.movie_id) maxval, mg.genre, a.first_name, a.last_name, a.id
					   FROM actors a, roles r, movies_genres mg
                       WHERE a.id=r.actor_id AND r.movie_id=mg.movie_id AND mg.genre='".$q."' GROUP BY a.id
                       ) AS count_max)				
ORDER BY m.year DESC, m.name ASC;";
    $result = mysqli_query(connector::$connection, $sql);
    echo "<table>
<th>Actor ID</th><th>First Name</th><th>Last Name</th><th>Movie Name</th><th>Movie Year</th>";
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['name'] . "</td><td>" . $row['year'] . "</td>";
        echo "</tr>";
        $count ++;
    }
    echo "</table><br/>";
    echo "Total number of Actors with maximum number of movies of genre: " . $q . " is " . $count . "</br>";
}

connector::disconnect();
?>