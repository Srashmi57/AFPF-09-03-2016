<?php
$file = Router::url('/', true)."files/1/Artform-Platform.doc";


?><?php
header('Content-disposition: inline;filename=Artform-Platform.doc');

header('Content-type: application/msword'); // not sure if this is the correct MIME type
readfile($file);
exit;
?>