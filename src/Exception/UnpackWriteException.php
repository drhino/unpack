<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Exception\UnpackStdException;

class UnpackWriteException extends UnpackStdException
{
    const GZIP_CREATE = 10301001; // Failed to fopen(), create
    const GZIP_WRITE  = 10301002; // Failed to fwrite(), append

    const ZIP_EXTRACT = 10302001; // Failed to $zip->extractTo()
}
