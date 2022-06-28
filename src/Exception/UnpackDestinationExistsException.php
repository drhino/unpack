<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Exception\UnpackStdException;

class UnpackDestinationExistsException extends UnpackStdException
{
    const FILE_EXISTS      = 10100001; // file_exists()
    const DIRECTORY_EXISTS = 10100002; // is_dir()
}
