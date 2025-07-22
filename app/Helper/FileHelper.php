<?php

namespace App\Helper;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class FileHelper
{
    /**
     * Base directory for uploads (relative to public path).
     */
    private const UPLOAD_DIR = 'uploads/';

    /**
     * Upload a file and optionally delete the old one.
     *
     * @param UploadedFile|null $file
     * @param string|null $oldFileName
     * @return string|null New stored filename
     */
    public static function upload(?UploadedFile $file, ?string $oldFileName = null): ?string
    {
        if (!$file) {
            return null;
        }

        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $sanitizedFilename = preg_replace('/\s+/', '_', $filename);
        $storedFileName = "{$sanitizedFilename}_" . time() . ".{$extension}";

        $destination = public_path(self::UPLOAD_DIR);
        $file->move($destination, $storedFileName);

        // Delete old file if it exists
        if ($oldFileName && self::exists($oldFileName)) {
            self::delete($oldFileName);
        }

        return $storedFileName;
    }

    /**
     * Check if a file exists in the upload directory.
     *
     * @param string $fileName
     * @return bool
     */
    public static function exists(string $fileName): bool
    {
        return File::exists(public_path(self::UPLOAD_DIR . $fileName));
    }

    /**
     * Get the full asset URL for a file.
     *
     * @param string $fileName
     * @return string
     */
    public static function url(string $fileName): string
    {
        return asset(self::UPLOAD_DIR . $fileName);
    }

    /**
     * Delete a file from the upload directory.
     *
     * @param string $fileName
     * @return bool True if deleted, false otherwise
     */
    public static function delete(string $fileName): bool
    {
        $path = public_path(self::UPLOAD_DIR . $fileName);

        return File::exists($path) ? File::delete($path) : false;
    }
}
