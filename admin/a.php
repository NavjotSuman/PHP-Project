<?php

$output = [];
$name = "name";
$roll = 982;
$arr = array(
    "username" => "$name",
    "class" => "10th",
    "roll-no" => "$roll"
);

$output[] = $arr;
$output[] = $arr;
$output[] = $arr;
$output[] = $arr;
$output[] = $arr;

echo "<pre>";
echo var_dump($output);
echo "</pre>";
