<?php

namespace Utils\File;

Class File implements FileInterface
{
    /**
     * @type resource
     */
    private $handle;

    /**
     * @type string
     */
    private $file;

    public function load(string $file_url) : File
    {
        $this->file = $file_url;
        if ($this->handle = fopen($file_url, 'c+'))
        {
            return $this;
        }
    }

    public function write(string $text) : bool
    {
        if (fwrite($this->handle, $text))
        {
            fclose($this->handle);
            return true;
        }
        else
        {
            fclose($this->handle);
            return false;
        }
    }

    public function read() : ?string
    {
        if ($read = fread($this->handle, filesize($this->file)))
        {
            fclose($this->handle);
            return $read;
        }
        else
        {
            fclose($this->handle);
            return null;
        }
    }
}
