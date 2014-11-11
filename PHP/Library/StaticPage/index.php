<?php
    ob_start();

    echo "<html>".
        "<head>".
        "<title>PHP页面静态化</title>".
        "</head>".
        "<body>PHP页面静态化示例</body>" .
        "</html>";
    $out = ob_get_contents();
    ob_end_clean();
    $fp = fopen("static.html", "w");
    if (!$fp) {
        trigger_error("System Error", E_USER_ERROR);
    } else {
        fwrite($fp, $out);
        fclose($fp);
        echo "write success";
    }