<?php
$dir = 'image/';

$files = scandir($dir);
$paths = [];

if ($files === false) {
   return;
}

for ($i = 0; $i < count($files); $i++) {
   if (($files[$i] != ".") && ($files[$i] != "..")) {
       $paths[] = $dir . $files[$i];
   }
}