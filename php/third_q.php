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
$sql = "SELECT mg.genre, COUNT(mg.movie_id) total_number_of_movies, m.year
FROM movies_genres mg, movies m 
WHERE mg.movie_id=m.id
GROUP BY mg.genre 
HAVING COUNT(mg.movie_id)=(SELECT MAX(total_movie) 
						FROM(SELECT genre, COUNT(*) total_movie
							 FROM movies_genres
							 GROUP BY genre) AS max_genre)
ORDER BY m.year DESC, m.name ASC; ";
$count = 0;
$result = mysqli_query(connector::$connection, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "&nbspGenre&nbsp <span style='background-color:red;border-radius:10px;color:white;'>" . $row['genre'] . "</span> has total number of <span style='background-color:white;color:black;border-radius:10px'>" . $row['total_number_of_movies'] . " </span>movies";
    if ($count == 0)
        echo " & ";
    $count ++;
}
connector::disconnect();

?>