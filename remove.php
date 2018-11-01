<?php
    $command = 'rm -R files/upload/*';
    shell_exec($command);
    echo 'Files removed!';
?>
