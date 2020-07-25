<?php

class PokemonsContext
{
    public $db;
    private $fileHandler;

    public function __construct($directory)
    {
        $this->fileHandler = new JsonFileHandler('configuration', $directory);
        $config = $this->fileHandler->ReadConfiguration();

        $this->db = new mysqli($config->server, $config->user, $config->password, $config->database);

        if ($this->db->connect_error) {
            exit('Error connecting to database');
        }
    }
}
