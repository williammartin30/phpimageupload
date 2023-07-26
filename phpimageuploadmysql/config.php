<?php
//             _____  _    _  __  __
//     /\     |_   _|| |  | ||  \/  |
//    /  \      | |  | |  | || \  / |
//   / /\ \     | |  | |  | || |\/| |
//  / ____ \ _ _| |_ | |__| || |  | |
// /_/    \_(_)_____(_)____(_)_|  |_|
//////////////////////////////////////

// Setari generale
# link to Linkedin (Ex. http://www.linkedin.com/in/name)
$link_ld= "your linkedin full account url";

# link to twitter (Ex. https://twitter.com/metrohostcj)
$link_tw= "your twitter  full account url";

# link to facebook(Ex. http://www.facebook.com/metrohost)
$link_fb= "your twitter  full account url";

# link to rss (Ex. rss.php)
$link_rss= "rss url";

# individual file size limit - in bytes (102400 bytes = 100KB)
$file_size_ind = "50000000";

# the upload store directory (chmod 777)
$dir_store= "store";

# your email address (ex. admin@fileupper.eu)
$email_ad= "your email address";

# the images directory
$dir_img= "img";

# the style-sheet file to use (located in the "img" directory, excluding .css)
$style = "style-def";

# the file type extensions allowed to be uploaded
$file_ext_allow = array("gif","jpg","jpeg","png","txt","nfo","doc","rtf","htm","dmg","zip","rar","gz","exe");

# option to display the file list
# to enable/disable, enter '1' to ENABLE or '0' to DISABLE (without quotes)
$file_list_allow = 1;

# option to allow file deletion
# to enable/disable, enter '1' to ENABLE or '0' to DISABLE (without quotes)
$file_del_allow = 0;

# option to password-protect this script [-part1]
# to enable/disable, enter '1' to ENABLE or '0' to DISABLE (without quotes)
$auth_ReqPass = 0;

# option to password-protect this script [-part2]
# if "$auth_ReqPass" is enabled you must set the username and password
$auth_usern = "admin";
$auth_passw = "admin";

# LANGUAGE (ENGLISH = en | ROMANA = ro | GERMAN = de)
$LANGUAGE_LIST = Array(
"en"
);

?>