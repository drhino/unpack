<?php

namespace drhino\Unpack\Enum;

enum UnpackWriteError: String
{
    case GZIP_CREATE = 'Failed to fopen(), create file';
    case GZIP_WRITE  = 'Failed to fwrite(), append contents';
    case ZIP_EXTRACT = 'Failed to $zip->extractTo()';

    public function label(): String
    {
        return match($this) {
            static::GZIP_CREATE => 'Unable to create output file',
            static::GZIP_WRITE  => 'Unable to write output file',
            static::ZIP_EXTRACT => 'Failed to extract zip archive',
        };
    }
}
