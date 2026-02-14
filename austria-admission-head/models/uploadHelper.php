<?php
/**
 * uploadHelper.php
 * Simple file upload helper used across austria-admission-head module.
 * - Validates extension and MIME
 * - Limits file size
 * - Generates randomized safe filename
 * - Moves file to destination
 */

function upload_single_file($file, $destDir, $allowedExts = ['jpg','jpeg','png','gif','pdf','doc','docx'], $maxSize = 5242880) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'No file uploaded or upload error'];
    }

    if (!is_dir($destDir)) {
        if (!mkdir($destDir, 0755, true)) {
            return ['success' => false, 'error' => 'Unable to create destination directory'];
        }
    }

    $originalName = $file['name'];
    $size = $file['size'];
    $tmpPath = $file['tmp_name'];

    if ($size > $maxSize) {
        return ['success' => false, 'error' => 'File exceeds maximum allowed size'];
    }

    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExts)) {
        return ['success' => false, 'error' => 'File extension not allowed'];
    }

    // Basic MIME check
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $tmpPath);
    finfo_close($finfo);

    // Map a few safe MIME types to extensions (simple check)
    $mimeOK = false;
    $mimeMap = [
        'image/jpeg' => ['jpg','jpeg'],
        'image/png'  => ['png'],
        'image/gif'  => ['gif'],
        'application/pdf' => ['pdf'],
        'application/msword' => ['doc'],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['docx']
    ];
    if (isset($mimeMap[$mime]) && in_array($ext, $mimeMap[$mime])) {
        $mimeOK = true;
    }
    // allow if unknown mime but extension is in white list (best-effort)
    if (!$mimeOK && !in_array($ext, ['jpg','jpeg','png','gif','pdf','doc','docx'])) {
        return ['success' => false, 'error' => 'MIME type not allowed'];
    }

    // sanitize base name and create randomized filename
    $safeBase = preg_replace('/[^A-Za-z0-9-_\.]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
    $rand = bin2hex(random_bytes(6));
    $finalName = date('Ymd_His') . '_' . $rand . '_' . $safeBase . '.' . $ext;

    $destPath = rtrim($destDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $finalName;
    if (!move_uploaded_file($tmpPath, $destPath)) {
        return ['success' => false, 'error' => 'Failed to move uploaded file'];
    }

    return ['success' => true, 'file' => $finalName, 'path' => $destPath];
}
