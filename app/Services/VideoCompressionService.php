<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;


class VideoCompressionService
{
    /**
     * Compress the uploaded video using FFmpeg with aggressive settings.
     *
     * @param  \Illuminate\Http\UploadedFile  $video
     * @param  string  $outputPath
     * @return string
     */
    public function compress($videoFile)
    {
        // Set the path where compressed video will be saved
        $destinationPath = storage_path('app/public/videos/compressed_' . $videoFile->getClientOriginalName());

        // Use FFmpeg for compression (you might need to install FFmpeg)
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($videoFile->getRealPath());

        // Compress and save
        $video->save(new X264(), $destinationPath);

        // Return the file path
        return $destinationPath;
    }


      /**
     * Format file size to a human-readable format (KB, MB, GB).
     *
     * @param  int  $size
     * @return string
     */
    private function formatFileSize($size)
    {
        if ($size >= 1073741824) {
            return number_format($size / 1073741824, 2) . ' GB';
        } elseif ($size >= 1048576) {
            return number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            return number_format($size / 1024, 2) . ' KB';
        } else {
            return $size . ' B';
        }
    }
}
