<?php
require 'training16_autoloader.php';

echo \Education::EDUCATION_SCHOOL;


$education = new Education();
$education->getTitle();
$education->getShortName();