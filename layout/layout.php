<?php

class Layout
{

    //Atributos
    public $directory;
    public $onDirectory;

    //Constructor
    public function __construct($onDirectory = false)
    {

        $this->onDirectory = $onDirectory;
        $this->directory = ($this->onDirectory) ? "" : "../";

    }

    //Funciones

    //Imprime el header
    public function printHeader()
    {

        $header = <<<EOF

<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pokedex</title>

  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bulma CSS -->
  <link href="{$this->directory}vendor/bulma/css/bulma.css" rel="stylesheet">


  <style>
  body{
      font-family: 'Roboto';
      font-size:1.2em;
  }

  .table th, .table td{
    vertical-align: middle;
  }

</style>

</head>



<body>

  <!-- Navigation -->
  <nav class="navbar is-danger" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a href="{$this->directory}index.php" class="navbar-item py-0" >
        <img src="{$this->directory}assets/img/pokeball.png" width="40px" height="40px" style="object-fit: cover" alt="pokeball"></img>
      </a>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
  </div>

</nav>
EOF;

        echo $header;
    }

    //Imprime el footer
    public function printFooter()
    {

        $footer = <<<EOF
</body>

</html>

EOF;

        echo $footer;
    }

}
