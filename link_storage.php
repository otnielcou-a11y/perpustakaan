<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<style>body{font-family:sans-serif;padding:20px;line-height:1.6;} .ok{color:green;} .err{color:red;}</style>";
echo "<h2>🖼️ Fix Image Paths & Storage (Comprehensive Copy)</h2>";

$base = __DIR__;
$sourcePublicStorage = $base . '/storage/app/public';

// 1. Recursive copy from storage/app/public to storage/
function copyRecursive($src, $dst) {
    if (!file_exists($src)) return 0;
    if (!file_exists($dst)) mkdir($dst, 0755, true);
    $dir = opendir($src);
    $count = 0;
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                $count += copyRecursive($src . '/' . $file, $dst . '/' . $file);
            } else {
                if (copy($src . '/' . $file, $dst . '/' . $file)) {
                    $count++;
                }
            }
        }
    }
    closedir($dir);
    return $count;
}

$copiedStorage = copyRecursive($sourcePublicStorage, $base . '/storage');
echo "<p class='ok'>✅ Total <b>{$copiedStorage}</b> file dari <code>storage/app/public</code> disalin ke <code>htdocs/storage/</code>.</p>";

// 2. Ensure perpus.jpeg exists in all possible fallback locations
$perpusSources = [
    $base . '/storage/app/public/img/cover/perpus.jpeg',
    $base . '/storage/img/cover/perpus.jpeg',
];

$perpusFile = null;
foreach ($perpusSources as $ps) {
    if (file_exists($ps)) {
        $perpusFile = $ps;
        break;
    }
}

if ($perpusFile) {
    $targets = [
        $base . '/storage/img/cover/perpus.jpeg',
        $base . '/storage/img/cover/perpus.jpg',
        $base . '/storage/img/perpus.jpeg',
        $base . '/storage/img/perpus.jpg',
        $base . '/asset/img/cover/perpus.jpeg',
        $base . '/asset/img/cover/perpus.jpg',
        $base . '/asset/img/perpus.jpeg',
        $base . '/asset/img/perpus.jpg',
        $base . '/storage/perpus.jpeg',
        $base . '/storage/perpus.jpg',
    ];

    foreach ($targets as $tgt) {
        $dir = dirname($tgt);
        if (!file_exists($dir)) mkdir($dir, 0755, true);
        copy($perpusFile, $tgt);
    }
    echo "<p class='ok'>✅ Foto Gedung Perpustakaan (<code>perpus.jpeg</code>) berhasil disalin ke semua lokasi (asset & storage)!</p>";
} else {
    echo "<p class='err'>⚠️ File <code>perpus.jpeg</code> tidak ditemukan di <code>storage/app/public/img/cover/perpus.jpeg</code>.</p>";
}

echo "<h3>🎉 SELESAI!</h3>";
echo "<p>Silakan buka kembali halaman profil perpustakaan di: <a href='http://librarysmkn2pwk.site.je/profile-perpustakaan'>http://librarysmkn2pwk.site.je/profile-perpustakaan</a></p>";
?>
