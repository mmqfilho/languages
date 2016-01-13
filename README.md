# Class Languages
version: `1.0`

date: `2016/01/12`

Author: `Marcos Menezes <mmqfilho@gmail.com>`

# Directory structure
```
| your_project_root
|-# class (your class folder)
| |- language.class.php
|
|-# languages (language folder)
| |-# en (english language folder)
| |  |- your english language files
| |
| |-# pt-br (brazillian portuguese language folder)
| | |- your brazillian portuguese language files
| |
| |-# xxxx (other languages folder)
|   |- others language files
```

# How to use

include the file and set the namespace
```
include_once 'class/language.class.php';
use mmqfilho\Languages\Language as Lang;
```

Create object 
```
$objLang = new Lang(); 
```

Or create object and set language to use
```
$objLang = new Lang('en'); 
```

Or use setter
```
$objLang->__set('default_language', 'en');
```

(optional) Setting the language folder if necessary (without slashes in the end)
```
$objLang->__set('directory', 'path/to/your/language/folder');
```

(optional) Show or not a message if not found the text
```
$objLang->__set('show_message_not_found', true);
```

(optional) The message to show if not found the text
```
$objLang->__set('message_not_found', 'I dont like default message');
```

Show the text
```
echo $objLang->load('index', 'welcome');
```
