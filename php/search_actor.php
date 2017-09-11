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
$q = ($_GET['q']);
$sql = "SELECT * FROM ACTORS WHERE first_name LIKE'" . $q . "%'";
$result = mysqli_query(connector::$connection, $sql);
if($result)
{
	if($result->num_rows ===0)
	{
		echo "Actor ".$q." not found, retry";
	}
	else
	{
		echo "Select one of the actors from the list : <select id='actorsOpt'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value=" . $row['id'] . ">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
}
echo "</select>";
	}
}

connector::disconnect();
?>