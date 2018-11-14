<?php
    $command = 'rm -R files/upload/*';
    shell_exec($command);
    header('Location: '.'./?msg=Files removed!');
?>
