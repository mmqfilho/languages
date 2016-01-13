# Class Languages
version: `1.0`

date: `2016/01/12`

Author: `Marcos Menezes <mmqfilho@gmail.com>`

## Directory structure
```
| your_project_root
|-# class (your class folder)
| |- language.class.php
|
|-# languages (language folder)
| |-# en (english language folder)
| |  |- your english language files
| |
| |-# pt-br (brazilian portuguese language folder)
| | |- your brazilian portuguese language files
| |
| |-# xxxx (other languages folder)
|   |- others language files
```

## How to use

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
* Param 1 is the name of xml file without the '.xml' 
* Param 2 is the name of xml tag
```
echo $objLang->load('index', 'welcome');
```

## The XML files
In the tag `<languages>` put your own translation tags

If you use a html tag or special caracteres put into CDATA tag.
```
<?xml version="1.0" encoding="UTF-8"?>

<!-- English -->
<languages>
	<welcome>Welcome</welcome>
	<welcomeCData><![CDATA[<strong>Warning:</strong> Welcome.]]></welcomeCData>	
</languages>
```

