# Unpacks a .zip or .gz archive with PHP.

### Install with composer:

```sh
$ composer require drhino/unpack
```

### Example usage:

```php
<?php

use drhino\Unpack\Unpack;

$source      = '/path/to/file.zip';
$destination = '/path/to/output-directory/';

Unpack::unzip($source, $destination);

$source      = '/path/to/file.xml.gz';
$destination = '/path/to/file.xml';

Unpack::ungzip($source, $destination);
```

On failure, an Exception is thrown.
<br>A full example:

```php
<?php

use drhino\Unpack\Unpack;
use drhino\Unpack\Exception\UnpackReadException;
use drhino\Unpack\Exception\UnpackWriteException;
use drhino\Unpack\Exception\UnpackDestinationExistsException;

try {
    $source      = '/path/to/file.zip';
    $destination = '/path/to/output-directory/';

    Unpack::unzip($source, $destination);

    $source      = '/path/to/file.xml.gz';
    $destination = '/path/to/file.xml';

    Unpack::ungzip($source, $destination);
}
catch (UnpackReadException $e) {
    switch ($e->getCode()) {
        case UnpackReadException::GZIP_OPEN:
        case UnpackReadException::GZIP_READ:
        case UnpackReadException::GZIP_NOENT:
        case \ZipArchive::ER_OPEN:
        case \ZipArchive::ER_READ:
        case \ZipArchive::ER_NOENT:
        case \ZipArchive::ER_NOZIP:
        case \ZipArchive::ER_INCONS:
        case \ZipArchive::ER_INVAL:
        case \ZipArchive::ER_MEMORY:
        case \ZipArchive::ER_SEEK:
        default:
            echo $e->getMessage() . ': ' . $e->getSource();
        break;
    }
}
catch (UnpackWriteException $e) {
    switch ($e->getCode()) {
        case UnpackWriteException::GZIP_CREATE:
        case UnpackWriteException::GZIP_WRITE:
        case UnpackWriteException::ZIP_EXTRACT:
        default:
            echo $e->getMessage() . ': ' . $e->getSource() . ' to: ' . $e->getDestination();
        break;
    }
}
catch (UnpackDestinationExistsException $e) {
    switch ($e->getCode()) {
        case UnpackDestinationExistsException::FILE_EXISTS:
        case UnpackDestinationExistsException::DIRECTORY_EXISTS:
        default:
            echo $e->getMessage() . ': ' . $e->getDestination();
        break;
    }
}
catch (\RuntimeException $e) {
    echo $e->getMessage();
}
```

### Changelog: 

v1.0.0
- Initial release.
