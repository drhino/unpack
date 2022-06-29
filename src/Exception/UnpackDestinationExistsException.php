<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Enum\UnpackDestinationExistsError;

class UnpackDestinationExistsException extends UnpackStdException
{
    public function __construct(UnpackDestinationExistsError $enum, \Throwable $previous = null)
    {
        parent::__construct($enum, $previous);
    }
}
