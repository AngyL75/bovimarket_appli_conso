<?php
/**
 * Cache Killer : Use this only on server where you cannot remove cahce file easily.
 */

header( 'Content-type: text/html; charset=utf-8' );
echo 'Hello, I\'m cache killer !<br /><br />';

$di = new RecursiveDirectoryIterator(__DIR__ . '/cache', FilesystemIterator::SKIP_DOTS);
$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
foreach ( $ri as $file ) {
    echo 'Remove ' . ($file->isDir() ?  'DIR ' : 'FILE ') . $file->getPathname() . '<br />';
    flush();
    ob_flush();
    $file->isDir() ?  rmdir($file) : unlink($file);
}

echo '<br />Done. Bye !';