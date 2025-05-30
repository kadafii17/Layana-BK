<?php
// filepath: [logout.php](http://_vscodecontentref_/2)
session_start();
session_unset();      // Hapus semua variabel session
session_destroy();    // Hancurkan session
header('Location: index.php');
exit();
