<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Enum\UnpackWriteError;

class UnpackWriteException extends UnpackStdException
{
    public function __construct(UnpackWriteError $enum, \Throwable $previous = null)
    {
        parent::__construct($enum, $previous);
    }
}
