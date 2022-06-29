<?php

namespace drhino\Unpack\Enum;

enum UnpackDestinationExistsError: String
{
    case FILE_EXISTS       = 'file_exists()';
    case DIRECTORY_EXISTS  = 'is_dir()';

    public function label(): String
    {
        return match($this) {
            static::FILE_EXISTS       => 'Output file already exists',
            static::DIRECTORY_EXISTS  => 'Output directory already exists',
        };
    }
}
