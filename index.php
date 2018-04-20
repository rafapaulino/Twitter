<?php

require_once 'vendor/autoload.php';

use Twitter\CountFollowers;

$twitter = new CountFollowers('Fiesp');
$total = $twitter->getTotal();

var_dump($total);
