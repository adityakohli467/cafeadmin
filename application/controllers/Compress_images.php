<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * One-time CLI script to compress existing invoice images.
 * 
 * Usage: php index.php cron compress_existing_images
 * 
 * This will scan all invoice folders and compress images that are over 500KB.
 * PDFs are skipped. Original files are overwritten with compressed versions.
 * Run this ONCE on production to reclaim disk space.
 */
class Compress_images extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!is_cli()) {
            show_error('CLI access only', 403);
            exit;
        }
    }

    public function index() {
        $folders = array(
            FCPATH . 'assets/docs/invoices/',
            FCPATH . 'assets/docs/invoices_1/',
            FCPATH . 'assets/docs/invoices_2/',
            FCPATH . 'assets/docs/invoices_3/',
            FCPATH . 'assets/docs/damaged_file/',
        );

        $total_before = 0;
        $total_after = 0;
        $compressed = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($folders as $folder) {
            if (!is_dir($folder)) {
                echo "Skipping (not found): $folder\n";
                continue;
            }

            echo "\nProcessing: $folder\n";
            $files = glob($folder . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);

            foreach ($files as $file) {
                $size_before = filesize($file);
                $total_before += $size_before;

                // Only compress files over 500KB
                if ($size_before < 512000) {
                    $total_after += $size_before;
                    $skipped++;
                    continue;
                }

                $info = @getimagesize($file);
                if ($info === false) {
                    $total_after += $size_before;
                    $errors++;
                    echo "  ERROR (not valid image): " . basename($file) . "\n";
                    continue;
                }

                $mime = $info['mime'];
                $orig_w = $info[0];
                $orig_h = $info[1];

                switch ($mime) {
                    case 'image/jpeg': $img = @imagecreatefromjpeg($file); break;
                    case 'image/png':  $img = @imagecreatefrompng($file); break;
                    default:
                        $total_after += $size_before;
                        $skipped++;
                        continue 2;
                }

                if (!$img) {
                    $total_after += $size_before;
                    $errors++;
                    echo "  ERROR (could not load): " . basename($file) . "\n";
                    continue;
                }

                // Resize if larger than 1920px
                $max_dim = 1920;
                $new_w = $orig_w;
                $new_h = $orig_h;
                if ($orig_w > $max_dim || $orig_h > $max_dim) {
                    if ($orig_w >= $orig_h) {
                        $new_w = $max_dim;
                        $new_h = (int)round($orig_h * ($max_dim / $orig_w));
                    } else {
                        $new_h = $max_dim;
                        $new_w = (int)round($orig_w * ($max_dim / $orig_h));
                    }
                    $resized = imagecreatetruecolor($new_w, $new_h);
                    imagecopyresampled($resized, $img, 0, 0, 0, 0, $new_w, $new_h, $orig_w, $orig_h);
                    imagedestroy($img);
                    $img = $resized;
                }

                // Save as JPEG quality 75
                imagejpeg($img, $file, 75);
                imagedestroy($img);

                $size_after = filesize($file);
                $total_after += $size_after;
                $saved = $size_before - $size_after;
                $pct = round(($saved / $size_before) * 100);
                $compressed++;

                echo "  " . basename($file) . ": " . $this->_format_bytes($size_before) . " -> " . $this->_format_bytes($size_after) . " (saved {$pct}%)\n";
            }
        }

        echo "\n=== Summary ===\n";
        echo "Compressed: $compressed files\n";
        echo "Skipped (under 500KB): $skipped files\n";
        echo "Errors: $errors files\n";
        echo "Total before: " . $this->_format_bytes($total_before) . "\n";
        echo "Total after:  " . $this->_format_bytes($total_after) . "\n";
        echo "Space saved:  " . $this->_format_bytes($total_before - $total_after) . "\n";
    }

    private function _format_bytes($bytes) {
        if ($bytes >= 1073741824) return round($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}
