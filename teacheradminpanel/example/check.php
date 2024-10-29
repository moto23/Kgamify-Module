<?php
// Define the folder path
$folderPath = 'https://kgamify.in/teacheradminpanel/profile_images';

// Check if the folder is writable
if (is_writable($folderPath)) {
    echo "The folder is writable.";
} else {
    echo "The folder is not writable.";
}
?>
