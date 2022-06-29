<?php

namespace drhino\Unpack\Exception;

use drhino\Unpack\Enum\UnpackWriteError;
use drhino\Unpack\Enum\UnpackReadError;
use drhino\Unpack\Enum\UnpackDestinationExistsError;

use Exception;

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

    private $enum;

    /**
     * Inherits the default exception.
     *
     * @param Enum      $enum     Error message.
     * @param Throwable $previous If nested exception.
     */
    public function __construct(
        UnpackWriteError|UnpackReadError|UnpackDestinationExistsError $enum,
        \Throwable $previous = null
    ) {
        $this->enum = $enum;

        // Constructs the default Exception.
        parent::__construct($enum->label(), 0, $previous);
    }

    public function getEnum(): Enum {
        return $this->enum;
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
