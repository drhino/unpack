<?php

namespace drhino\Unpack\Exception;

use Exception;
use Throwable;

class UnpackDestinationExistsException extends Exception
{
    // Code prefix: 1001
    const FILE_EXISTS = 1001001;
    const DIRECTORY_EXISTS = 1001002;

    public function __construct(
        String $path,
        Int $code,
        Throwable $previous = null
    ) {
        parent::__construct($path, $code, $previous);
    }

    public function __toString() {
        $message = $this->humanReadableStatusCode($this->code);
        $path = $this->message;
        return __CLASS__ . ": [{$this->code}]: {$message}: {$path}\n";
    }

    public function humanReadableStatusCode(Int $code): String {
        $error = 'The destination path already exists';

        switch ($code) {
            case self::FILE_EXISTS:
                return $error . ' and is a file';

            case self::DIRECTORY_EXISTS:
                return $error . ' and is a directory';

            default:
                return 'Unknown Error';
        }
    }
}
