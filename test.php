<?php
// Location where the images are stored
$file_path = 'archive/uploads';
 
// Fetch the data for the pictures
$sql = "SELECT `description`, `keywords`, `location`
        FROM `archive`
        LIMIT 10";
$result = mysql_query($sql) or trigger_error(mysql_query(), E_USER_ERROR);
 
// Display each picture
while($row = mysql_fetch_assoc($row))
{
    $src = $file_path . $row['file_name.jpg'];
 
    echo '<div class="Image">';
    echo "<img src="{$src}" alt="{$row['title']}" title="{$row['title']}"><br>"
    echo "<span>{$row['caption']}</span>";
    echo '</div>';
}
?>