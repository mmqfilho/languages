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

// (optional) number of recursive attempts in directories to find the language files (3 is the default)
//$objLang->__set('recursiveDirCount', 3);

// (optional) set the file type to load (json or xml) (json is the default file type)
//$objLang->setXml();
// or
$objLang->setJson();

// show the text
echo $objLang->load('example', 'welcome', array('ops'));

// show text with one or more parameters in array
echo $objLang->load('example', 'version', array('1.0.2', 'pal'));
