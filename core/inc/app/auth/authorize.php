<?php
if (!checkAppPol($appID, $type)) {
    $page_title = "Disallowed";
    require_once('core/template/head/header.php');
    echo '<br /><center><span style="font-size:20px; color:#999; font-weight:bolder">' . $theme['name'] . ' has disabled your use of this application.</span></center>';
    require_once('core/template/foot/footer.php');
    exit();
}

?>