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
$sql = "SELECT total_movie, genre FROM (SELECT genre, COUNT(*) AS total_movie
FROM movies_genres
GROUP BY genre) AS max_genre
ORDER BY total_movie desc
limit 2; ";
$count = 0;
$result = mysqli_query(connector::$connection, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "&nbspGenre&nbsp <span style='background-color:red;border-radius:10px;color:white;'>" . $row['genre'] . "</span> has total number of <span style='background-color:white;color:black;border-radius:10px'>" . $row['total_movie'] . " </span>movies";
    if ($count == 0)
        echo " & ";
    $count ++;
}
connector::disconnect();

?>