<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Exception\UnpackStdException;

class UnpackReadException extends UnpackStdException
{
    const GZIP_OPEN  = 10201001; // Failed to gzopen()
    const GZIP_READ  = 10201002; // Failed to gzread()
    const GZIP_NOENT = 10201003; // File does not exist
    
    #const ZIP_CLOSE = 10202001; // Failed to $zip->close()
    // OR one of: ZipArchive::   // Failed to $zip->open()
}
