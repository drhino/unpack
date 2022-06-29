<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Enum\UnpackReadError;

class UnpackReadException extends UnpackStdException
{
    public function __construct(UnpackReadError $enum, \Throwable $previous = null)
    {
        parent::__construct($enum, $previous);
    }

    /**
     * Returns an UnpackReadError based on the ZipArchive status from $zip->open().
     *
     * @param Integer $status https://www.php.net/manual/en/ziparchive.open
     *
     * @return Enum UnpackReadError
     */
    public static function zipUnpackReadError(Int $status): UnpackReadError
    {
        switch ($status) {
            case \ZipArchive::ER_INCONS:
                return UnpackReadError::ZIP_ER_INCONS;

            case \ZipArchive::ER_INVAL:
                return UnpackReadError::ZIP_ER_INVAL;

            case \ZipArchive::ER_MEMORY:
                return UnpackReadError::ZIP_ER_MEMORY;

            case \ZipArchive::ER_NOENT:
                return UnpackReadError::ZIP_ER_NOENT;

            case \ZipArchive::ER_NOZIP:
                return UnpackReadError::ZIP_ER_NOZIP;

            case \ZipArchive::ER_OPEN:
                return UnpackReadError::ZIP_ER_OPEN;

            case \ZipArchive::ER_READ:
                return UnpackReadError::ZIP_ER_READ;

            case \ZipArchive::ER_SEEK:
                return UnpackReadError::ZIP_ER_SEEK;
        }
    }
}
