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
mysqli_report(MYSQLI_REPORT_STRICT);
error_reporting(0);

class connector
{

    private static $init = 'FALSE';

    public static $server;

    public static $username;

    public static $password;

    public static $connection;

    public static $dbname;

    public function connect()
    {
        if (self::$init == 'TRUE') {
            return;
        } else {
            try {
                self::$server = "localhost";
                self::$username = $_COOKIE["username"];
                self::$password = $_COOKIE["password"];
                $dbname = $_COOKIE["dbname"];
                self::$connection = new mysqli(self::$server, self::$username, self::$password);
                mysqli_select_db(self::$connection, $dbname);
            } catch (Exception $e) {}
        }
    }

    public function discond()
    {
        if (mysqli_connect_errno()) {
            echo "<div class='connection' style='background-color:red;border-radius:10px;color:white;'>Connection Failed</div>";
        } else {
            echo "<div class='connection' style='background-color:green;border-radius:10px;color:white;'>Connected successfully!</div>";
        }
    }

    public function disconnect()
    {
        if (mysqli_connect_errno())
            return;
        else
            mysqli_close(self::$connection);
    }
}

?>