<?php
include_once 'class/language.class.php';
use Mmqfilho\Languages\Language as Lang;

// create object
$objLang = new Lang();
  // or create object and set language to use
  //$objLang = new Lang('pt-br');
  // or use setter
  //$objLang->__set('default_language', 'pt-br');

// (optional) setting the language folder if necessary (without slashes in the end)
//$objLang->__set('directory', 'path/to/your/language/folder');

// (optional) show or not a message if not found the text
//$objLang->__set('show_message_not_found', true);

// (optional) the message to show if not found the text
//$objLang->__set('message_not_found', 'I dont like default message');

// show the text
echo $objLang->load('index', 'welcome');
