<?php namespace Lum\Generator\Utils;

use Lum\Generator\Exceptions\FileAlreadyExistsException;
use Lum\Generator\Exceptions\FileNotFoundException;

/**
 * Class FileSystemObject
 *
 * @package Lum\Generator\Utils
 */
class FileSystemObject
{
    /**
     * Make a file
     *
     * @param string $filePath
     * @param string $content
     *
     * @return int
     * @throws FileAlreadyExistsException
     */
    public function writeFileContent(string $filePath, string $content)
    {
        if ($this->isFileExists($filePath)) {
            throw new FileAlreadyExistsException(sprintf('文件%s已存在', $filePath));
        }

        return file_put_contents($filePath, $content);
    }

    /**
     * Determine if file exists
     *
     * @param string $file
     *
     * @return bool
     */
    public function isFileExists(string $file) : bool
    {
        return file_exists($file);
    }

    /**
     * Fetch the contents of a file
     *
     * @param $file
     *
     * @return false|string
     * @throws FileNotFoundException
     */
    public function getFileContent(string $file)
    {
        if (!$this->isFileExists($file)) {
            throw new FileNotFoundException($file);
        }

        return file_get_contents($file);
    }
}
