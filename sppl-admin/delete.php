<?php
 unlink("pgimages/".$_GET['file']); 
 header('Location: insert_image.php');
 exit;
 ?>