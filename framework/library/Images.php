<?php

namespace library;

use database\Connection;

use function getimagesize;

class Images
{
    private $translations;
    private $db;
    private $dirUpload = 'public/images/upload/';
    private $allowedMimeFormats = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    private $thumbnailSize = 200;
    private $largeSize = 500;
    private $uploadFiles = [];
    private $status = false;
    private $message = '';

    /**
     * method construct
     * @param Class Translations
     * @param Class Connection
     */

    public function __construct(Translations $translations, Connection $connection)
    {
        $this->translations = $translations;
        $this->db = $connection;
    }

    /**
     * method init
     * @param array FILES 
     * @param array settings 
     */

    public function init(array $filesForm, array $settings = null): array
    {

        foreach ($filesForm['files']['name'] as $key => $name) {
            $files['soubor-' . $key]['name'] = $name;
            $files['soubor-' . $key]['tmp_name'] = $_FILES['files']['tmp_name'][$key];
            $files['soubor-' . $key]['size'] = $_FILES['files']['size'][$key];
            $files['soubor-' . $key]['type'] = $_FILES['files']['type'][$key];
            $files['soubor-' . $key]['error'] = $_FILES['files']['error'][$key];
        }

        if ($settings) {
            if (isset($settings['dir']) && $settings['dir'] !== '') {
                $this->dirUpload = $settings['dir'];
            }
            if (isset($settings['thumbnail_size']) && $settings['thumbnail_size'] !== '') {
                $this->thumbnailSize = $settings['thumbnail_size'];
            }
            if (isset($settings['large_size']) && $settings['large_size'] !== '') {
                $this->largeSize = $settings['large_size'];
            }
            if (isset($settings['alloved_format']) && is_array($settings['alloved_format'])) {
                foreach ($settings['alloved_format'] as $format) {
                    $this->allowedMimeFormats = [];
                    $this->allowedMimeFormats[] = 'image/' . strtolower($format);
                }
            }
        }

        if (is_array($files)) {
            foreach ($files as $file) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if (in_array($mime, $this->allowedMimeFormats)) {
                    $this->set($file, $mime);
                } else {
                    $this->message = $this->translations->translateText('format_not_allowed');
                }
            }
        }

        if ($this->status) {
            $this->saveImage();
            $return['files'] = $this->uploadFiles;
            $this->message = $return['message'] = $this->translations->translateText('file-upload-success');
        }

        $return['status'] = $this->status;
        $return['message'] = $this->message;

        return $return;
    }

    /**
     * method set
     * 
     * @param string file
     * @param string mime
     */

    private function set($file, $mime): void
    {
        $file['format'] = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $name = uniqid('image_') . '.' . $file['format'];
        $includeName = $this->dirUpload . $name;
        if (move_uploaded_file($file['tmp_name'], $includeName)) {
            $this->uploadFiles[] = ['name' => $name, 'large' => $includeName, 'thumbnail' => $this->createThumbnail($includeName, $this->thumbnailSize, $mime), 'dir_upload' => $this->dirUpload];
            $this->resizeImage($includeName, $this->largeSize, $mime);
            $this->status = true;
        } else {
            $this->message = $this->translations->translateText('file-upload-failed');
        }
    }

    /**
     * method createThumbnail
     * @param string file
     * @param int thumbnailWidth
     * @param string mime
     */

    private function createThumbnail($file, $thumbnailWidth, $mime)
    {
        $thumbnailName = $this->dirUpload . 'thumbnail_' . basename($file);
        list($originalWidth, $originalHeight) = getimagesize($file);
        $thumbnailHeight = ($originalHeight / $originalWidth) * $thumbnailWidth;
        $thumbnailImage = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
            $sourceImage = imagecreatefromjpeg($file);
        } elseif ($mime === 'image/png') {
            $sourceImage = imagecreatefrompng($file);
            imagesavealpha($sourceImage, true);
            imagealphablending($sourceImage, false);
        } else {
            $sourceImage = imagecreatefromgif($file);
        }

        imagesavealpha($thumbnailImage, true);
        imagealphablending($thumbnailImage, false);

        imagecopyresampled($thumbnailImage, $sourceImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);

        if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
            imagejpeg($thumbnailImage, $thumbnailName);
        } else if ($mime === 'image/png') {
            imagepng($thumbnailImage, $thumbnailName);
        } else {
            imagegif($thumbnailImage, $thumbnailName);
        }

        imagedestroy($thumbnailImage);
        imagedestroy($sourceImage);

        return $thumbnailName;
    }

    /**
     * method resizeImage
     * @param string file
     * @param int width
     * @param string mime
     */

    private function resizeImage($file, $width, $mime)
    {
        list($old_width, $old_height) = getimagesize($file);

        if ($old_width >= $width) {
            $height = ($old_height / $old_width) * $width;
            $new_image = imagecreatetruecolor($width, $height);

            if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                $source = imagecreatefromjpeg($file);
            } else if ($mime === 'image/png') {
                $source = imagecreatefrompng($file);
                imagesavealpha($source, true);
                imagealphablending($source, false);
            } else {
                $source = imagecreatefromgif($file);
            }

            imagesavealpha($new_image, true);
            imagealphablending($new_image, false);

            imagecopyresampled($new_image, $source, 0, 0, 0, 0, $width, $height, $old_width, $old_height);

            if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                imagejpeg($new_image, $file);
            } else if ($mime === 'image/png') {
                imagepng($new_image, $file);
            } else {
                imagegif($new_image, $file);
            }

            imagedestroy($new_image);
            imagedestroy($source);
        }
    }

    /**
     * method saveImage
     */

    private function saveImage(): void
    {
        foreach ($this->uploadFiles as $key => $file) {
            $this->db->insert('images', $file);
            $this->uploadFiles[$key]['id_image'] = $this->db->lastId();
        }
    }
}
