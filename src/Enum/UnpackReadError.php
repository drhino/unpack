<?php

namespace drhino\Unpack\Enum;

use ZipArchive;

enum UnpackReadError: String
{
    case GZIP_OPEN    = 'Failed to gzopen()';
    case GZIP_READ    = 'Failed to gzread()';
    case GZIP_NOENT   = 'File does not exist';
    case GZIP_UNAVAIL = 'Function gzopen() not found';

    case ZIP_ER_INCONS = 'Failed to $zip->open() ZipArchive::ER_INCONS';
    case ZIP_ER_INVAL  = 'Failed to $zip->open() ZipArchive::ER_INVAL';
    case ZIP_ER_MEMORY = 'Failed to $zip->open() ZipArchive::ER_MEMORY';
    case ZIP_ER_NOENT  = 'Failed to $zip->open() ZipArchive::ER_NOENT';
    case ZIP_ER_NOZIP  = 'Failed to $zip->open() ZipArchive::ER_NOZIP';
    case ZIP_ER_OPEN   = 'Failed to $zip->open() ZipArchive::ER_OPEN';
    case ZIP_ER_READ   = 'Failed to $zip->open() ZipArchive::ER_READ';
    case ZIP_ER_SEEK   = 'Failed to $zip->open() ZipArchive::ER_SEEK';

    public function label(): String
    {
        return match($this) {
            static::GZIP_OPEN    => 'Cannot open gzip archive',
            static::GZIP_READ    => 'Error reading gzip archive',
            static::GZIP_NOENT   => 'Gzip archive does not exist',
            static::GZIP_UNAVAIL => 'PHP zlib extension not loaded',
            static::ZIP_ER_INCONS => 'Zip archive inconsistent',
            static::ZIP_ER_INVAL  => 'Zip archive invalid argument',
            static::ZIP_ER_MEMORY => 'Zip archive memory allocation failure',
            static::ZIP_ER_NOENT  => 'Zip archive does not exist',
            static::ZIP_ER_NOZIP  => 'Not a zip archive',
            static::ZIP_ER_OPEN   => 'Cannot open zip archive',
            static::ZIP_ER_READ   => 'Error reading zip archive',
            static::ZIP_ER_SEEK   => 'Seek error in zip archive',
        };
    }

    # Zip archive already exists: ZipArchive::ER_EXISTS
}
