<?php

class CSVFileHandler implements IFileHandler
{

    public $directory;
    public $fileName;

    public function __construct($fileName, $directory)
    {
        $this->directory = $directory;
        $this->fileName = $fileName;
    }

    public function CreateDirectory()
    {
        if (!file_exists($this->directory)) {
            mkdir($this->directory, 0777, true);
        }
    }

    public function SaveFile($value)
    {

        $this->CreateDirectory();

        $path = $this->directory . '/' . $this->fileName . '.csv';

        $file = fopen($path, 'w+');

        foreach ($value as $object) {
            fputcsv($file, get_object_vars($object));
        }

        fclose($file);

    }

    public function ReadFile()
    {

        $this->CreateDirectory();

        $path = $this->directory . '/' . $this->fileName . '.csv';
        

        if (file_exists($path)) {

            $file = fopen($path, "r");

            $csv = array();

            if ($file !== false) { 


                $csv = array_map('str_getcsv', file($path));

                
            }


            return $csv;

        } else {
            return false;
        }

    }

}