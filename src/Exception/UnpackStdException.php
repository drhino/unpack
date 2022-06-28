<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Exception\UnpackExceptionMessages;
use Exception;
use Throwable;

/**
 * Extends the default exception and adds some logic.
 * This is the standard exception, which is used to extend from.
 */
class UnpackStdException extends Exception
{
    # Holds the path to the input file.
    private $source;
    # Holds the path to the output file or directory.
    private $destination;

    /**
     * Inherits the default exception.
     *
     * @param Integer   $code     Child class exception code.
     * @param Throwable $previous If nested exception.
     */
    public function __construct(Int $code, Throwable $previous = null)
    {
        // Full list of error codes:
        //   drhino\Unpack\Exception\UnpackExceptionMessages
        $message = UnpackExceptionMessages::getMessage($code);

        // Inherits the source and destination path by default.
        if (isset($previous)) {
            if (method_exists($previous, 'getSource'))
                $this->setSource($previous->getSource());

            if (method_exists($previous, 'getDestination'))
                $this->setSource($previous->getDestination());
        }

        // Constructs the default Exception.
        parent::__construct($message, $code, $previous);
    }

    /**
     * Sets the source path.
     *
     * @param String $path
     *
     * @return void
     */
    public function setSource(String $path): void
    {
        $this->source = $path;
    }

    /**
     * Sets the destination path.
     *
     * @param String $path
     *
     * @return void
     */
    public function setDestination(String $path): void
    {
        $this->destination = $path;
    }

    /**
     * Returns the source path.
     *
     * @return String
     */
    public function getSource(): String
    {
        return $this->source;
    }

    /**
     * Returns the destination path.
     *
     * @return String
     */
    public function getDestination(): String
    {
        return $this->destination;
    }
}
