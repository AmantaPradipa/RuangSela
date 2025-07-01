<?php

// app/Helpers/file_helper.php

if (!function_exists('asset_url')) {
    /**
     * Generates a URL to an asset in the writable/uploads directory.
     *
     * @param string|null $path The path to the file relative to writable/uploads.
     * @param string $defaultAsset The path to a default asset if the primary one is not found.
     * @return string The full URL to the asset.
     */
    function asset_url(?string $path, string $defaultAsset = ''): string
    {
        // Jika path kosong, return default asset
        if (empty($path)) {
            return base_url($defaultAsset);
        }

        // Cek apakah file exists di writable/uploads
        $fullPath = WRITEPATH . 'uploads/' . $path;
        
        if (file_exists($fullPath)) {
            return base_url('uploads/' . $path);
        }

        // Jika file tidak ditemukan, return default asset
        return base_url($defaultAsset);
    }
}

if (!function_exists('create_upload_directory')) {
    /**
     * Create upload directory if it doesn't exist
     *
     * @param string $directory Directory path relative to writable/uploads
     * @return bool
     */
    function create_upload_directory(string $directory): bool
    {
        $fullPath = WRITEPATH . 'uploads/' . $directory;
        
        if (!is_dir($fullPath)) {
            return mkdir($fullPath, 0755, true);
        }
        
        return true;
    }
}

if (!function_exists('delete_old_file')) {
    /**
     * Delete old file if exists
     *
     * @param string|null $filePath File path relative to writable/uploads
     * @return bool
     */
    function delete_old_file(?string $filePath): bool
    {
        if (empty($filePath)) {
            return true;
        }

        $fullPath = WRITEPATH . 'uploads/' . $filePath;
        
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }
        
        return true;
    }
}