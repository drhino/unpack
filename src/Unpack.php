<?php

namespace drhino\Unpack;

use Throwable;
use RuntimeException;
use ZipArchive;

use drhino\Unpack\Exception\UnpackDestinationExistsException;
use drhino\Unpack\Exception\UnpackReadException;
use drhino\Unpack\Exception\UnpackWriteException;

use function gzopen;
use function gzread;
use function gzclose;
use function gzeof;
use function fopen;
use function fwrite;
use function fclose;
use function is_resource;
use function file_exists;
use function is_dir;
use function class_exists;
use function phpversion;

class Unpack
{
    /**
     * Decompresses the gzip $source file to the desired $destination.
     *
     * @param String $source input location of the gzipped file.
     * @param String $destination output location of the decompressed file.
     *
     * @throws UnpackReadException
     * @throws UnpackWriteException
     *
     * @return void
     */
    public static function ungzip(String $source, String $destination): void
    {
        // Exceptions are re-thrown after the streams are closed.
        try {
            // Throws an UnpackDestinationExistsException when the path exists.
            // The source and destination path within the exception are set in catch().
            self::exists($destination);

            if ( ($gzopen = @gzopen($source, 'rb')) === false ) {

                if (@file_exists($source) === false)
                    throw new UnpackReadException(UnpackReadException::GZIP_NOENT);

                #if (@is_readable($source) === false)

                throw new UnpackReadException(UnpackReadException::GZIP_OPEN);
            }

            while (!@gzeof($gzopen)) {
                if ( ($buffer = @gzread($gzopen, 4096)) === false )
                    throw new UnpackReadException(UnpackReadException::GZIP_READ);

                // When gzread() fails and throws an Exception; We do not want any leftover files.
                // Therefor, we only create the $destination file when the first 4KB was successfully read. 
                if (!isset($fopen))
                    // Opens the $destination in binary append mode.
                    // Assigning the file pointer creates the $destination.
                    if ( ($fopen = fopen($destination, 'ab')) === false )
                        throw new UnpackWriteException(UnpackWriteException::GZIP_CREATE);

                if (fwrite($fopen, $buffer) === false)
                    throw new UnpackWriteException(UnpackWriteException::GZIP_WRITE);
            }
        } catch (Throwable $e) {
            $e->setSource($source);
            $e->setDestination($destination);
        }

        // Always closes the streams (on success or failure).
        isset($gzopen) && is_resource($gzopen) && gzclose($gzopen);
        isset($fopen) && is_resource($fopen) && fclose($fopen);
        $buffer = null;
        $gzopen = null;
        $fopen  = null;

        if (isset($e)) throw $e;
    }

    /**
     * Extracts a compressed zip-file.
     *
     * @param String $source path to the the zip file.
     * @param String $destination to the output directory.
     *
     * @throws RuntimeException when the ZipArchive extension is missing.
     * @throws UnpackReadException when $zip->open() failed.
     * @throws UnpackWriteException when $zip->extractTo() failed.
     *
     * @return void
     */
    public static function unzip(String $source, String $destination): void
    {
        if (!class_exists('ZipArchive', false))
            throw new RuntimeException('The PHP ZipArchive extension is not loaded');

        $status = null;

        // Exceptions are re-thrown after the archive is closed.
        try {
            // Throws an UnpackDestinationExistsException when the path exists.
            self::exists($destination);

            $zip = new ZipArchive;

            // https://www.php.net/manual/en/zip.constants.php#ziparchive.constants.rdonly
            #echo phpversion('zip');
            $flags = phpversion() >= '7.4.3'
                    ? ZipArchive::RDONLY|ZipArchive::CHECKCONS
                    : ZipArchive::CHECKCONS;

            // $status = TRUE when the archived has successfully been opened.
            $status = $zip->open($source, $flags);

            // When $status is not TRUE, one of the error code constants is used:
            // https://www.php.net/manual/en/ziparchive.open.php
            if ($status !== true)
                throw new UnpackReadException($status);

            if (!$zip->extractTo($destination))
                throw new UnpackWriteException(UnpackWriteException::ZIP_EXTRACT);
        }
        catch (Throwable $e) {
            $e->setSource($source);
            $e->setDestination($destination);
        }

        // Closes the zip-file when it was successfully opened.
        #if ($status === true && !$zip->close())
        #    $e = new UnpackReadException(UnpackReadException::ZIP_CLOSE, $e);
        if ($status === true) $zip->close();
        $zip = null;

        if (isset($e)) throw $e;
    }

    /**
     * Throws an Exception when the $path is a file or directory.
     *
     * @param String $path to file or directory.
     *
     * @throws UnpackDestinationExistsException
     *
     * @return void
     */
    public static function exists(String $path): void
    {
        // E_WARNING's are suppressed.

        if (@is_dir($path) === true)
            throw new UnpackDestinationExistsException(
                UnpackDestinationExistsException::DIRECTORY_EXISTS
            );

        if (@file_exists($path) === true)
            throw new UnpackDestinationExistsException(
                UnpackDestinationExistsException::FILE_EXISTS
            );
    }
}
