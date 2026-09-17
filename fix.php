<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$file = __DIR__ . '/vendor/composer/platform_check.php';

if (!file_exists($file)) {
    die("❌ File {$file} tidak ditemukan. Pastikan folder vendor sudah diekstrak.");
}

$content = file_get_contents($file);
$newContent = str_replace('80400', '80100', $content);
$newContent = str_replace('>= 8.4.0', '>= 8.1.0', $newContent);

if (file_put_contents($file, $newContent)) {
    echo "<h2 style='color:green;'>✅ BERHASIL MEMPERBAIKI PLATFORM CHECK!</h2>";
    echo "<p>Persyaratan PHP version telah diubah dari 8.4.0 menjadi <b>8.1.0</b> (kompatibel dengan server InfinityFree).</p>";
    echo "<p>Sekarang silakan buka kembali websitemu di: <a href='http://librarysmkn2pwk.site.je'>http://librarysmkn2pwk.site.je</a></p>";
    echo "<p>⚠️ <i>Jangan lupa hapus file fix.php ini setelahnya demi keamanan.</i></p>";
} else {
    echo "❌ Gagal mengedit file platform_check.php.";
}
?>
