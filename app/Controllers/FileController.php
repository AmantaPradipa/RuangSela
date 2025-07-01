<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class FileController extends BaseController
{
    /**
     * Serves files from the writable/uploads directory.
     *
     * @param string ...$segments The file path segments under writable/uploads/
     */
    public function show(...$segments)
    {
        $path = WRITEPATH . 'uploads/' . implode('/', $segments);

        // Sanitize the path to prevent directory traversal
        $realPath = realpath($path);
        if (!$realPath || strpos($realPath, realpath(WRITEPATH . 'uploads')) !== 0) {
            throw PageNotFoundException::forPageNotFound('Invalid file path.');
        }

        if (!is_file($realPath)) {
            // Try to show a default placeholder if the file is not found
            // This can be adjusted based on requirements
            throw PageNotFoundException::forPageNotFound('File not found.');
        }

        // --- Access Control ---
        $isLoggedIn = session()->get('isLoggedIn');
        $folder = $segments[0] ?? null;

        // Publicly accessible folders
        $publicFolders = ['articles', 'profile_pictures', 'audio_tones'];

        // Folders accessible only to logged-in users (or specific roles)
        $loggedInFolders = ['payment_proofs', 'user_documents', 'therapist_documents'];

        if (!in_array($folder, $publicFolders)) {
            // If not a public folder, check if user is logged in
            if (!$isLoggedIn) {
                throw new PageNotFoundException('Access denied. You must be logged in to view this file.');
            }

            // More granular checks for logged-in folders
            if ($folder === 'payment_proofs') {
                // Only admins can view payment proofs
                if (session()->get('role') !== 'admin') {
                    throw new PageNotFoundException('Access denied. You do not have permission to view this file.');
                }
            } elseif ($folder === 'user_documents') {
                // Only admins can view user documents (e.g., ID cards)
                if (session()->get('role') !== 'admin') {
                    throw new PageNotFoundException('Access denied. You do not have permission to view this file.');
                }
            } elseif ($folder === 'therapist_documents') {
                // Only admins can view therapist documents (e.g., licenses)
                if (session()->get('role') !== 'admin') {
                    throw new PageNotFoundException('Access denied. You do not have permission to view this file.');
                }
            }
        }
        
        // --- Serve File ---
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $realPath);
        finfo_close($finfo);

        // Use CodeIgniter's response object to send the file
        return $this->response
            ->setContentType($mimeType)
            ->setBody(file_get_contents($realPath));
    }
}
