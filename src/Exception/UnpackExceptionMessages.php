<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Exception\UnpackDestinationExistsException;
use drhino\Unpack\Exception\UnpackWriteException;
use drhino\Unpack\Exception\UnpackReadException;
use ZipArchive;

class UnpackExceptionMessages
{
    public static function getMessage(Int $code): String
    {
        switch ($code) {
            case UnpackDestinationExistsException::FILE_EXISTS:
                return 'Output file already exists';

            case UnpackDestinationExistsException::DIRECTORY_EXISTS:
                return 'Output directory already exists';


            case UnpackReadException::GZIP_OPEN:
                return 'Cannot open gzip archive';

            case UnpackReadException::GZIP_READ:
                return 'Error reading gzip archive';

            case UnpackReadException::GZIP_NOENT:
                return 'Gzip archive does not exist';

            case UnpackWriteException::GZIP_CREATE:
                return 'Unable to create output file';

            case UnpackWriteException::GZIP_WRITE:
                return 'Unable to write output file';


            case !class_exists('ZipArchive', false):
                return 'Unknown Error';

            case UnpackWriteException::ZIP_EXTRACT:
                    return 'Failed to extract zip archive';

            // https://www.php.net/manual/en/ziparchive.open.php

            case ZipArchive::ER_INCONS:
                return 'Zip archive inconsistent';
            
            case ZipArchive::ER_INVAL:
                return 'Zip archive invalid argument';

            case ZipArchive::ER_MEMORY:
                return 'Zip archive memory allocation failure';

            case ZipArchive::ER_NOENT:
                return 'Zip archive does not exist';

            case ZipArchive::ER_NOZIP:
                return 'Not a zip archive';

            case ZipArchive::ER_OPEN:
                return 'Cannot open zip archive';

            case ZipArchive::ER_READ:
                return 'Error reading zip archive';

            case ZipArchive::ER_SEEK:
                return 'Seek error in zip archive';

            #case ZipArchive::ER_EXISTS:
            #    return 'Zip archive already exists';

            default:
                return 'Unknown ZipArchive Error';
        }
    }
}
