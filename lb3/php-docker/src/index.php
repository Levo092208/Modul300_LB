<?php

echo "Hello from the docker m300 container";

$mysqli = new mysqli("db", "root", "example", "M300");

$sql = "INSERT INTO users (name, fav_color) VALUES('Levo', 'blau')";
$result = $mysqli->query($sql);
$sql = "INSERT INTO users (name, fav_color) VALUES('Albin', 'grün')";
$result = $mysqli->query($sql);
$sql = "INSERT INTO users (name, fav_color) VALUES('Das ist ein Test funktionierts?', 'mais oui')";
$result = $mysqli->query($sql);
$sql = "INSERT INTO users (name, fav_color) VALUES('burim', 'weiss')";
$result = $mysqli->query($sql);


$sql = 'SELECT * FROM users';

if ($result = $mysqli->query($sql)) {
    while ($data = $result->fetch_object()) {
        $users[] = $data;
    }
}

foreach ($users as $user) {
    echo "<br>";
    echo $user->name . " " . $user->fav_color;
    echo "<br>";
}