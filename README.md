# Class Languages
version: `1.2.3`

date: `2017/10/17`

Author: `Marcos Menezes <mmqfilho@gmail.com>`

## Directory structure
```
| your_project_root
|-# class (class folder)
| |-# Mmqfilho
|   |-# Languages
|     |- Language.php (class file)
|
|-# languages (language folder)
| |-# en (english language folder)
| | |- your english language files
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
include_once 'class/Mmqfilho/Languages/Language.php';
or use autoload composer
include_once YOUR_VENDOR_DIR . '/autoload.php' ;

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

(optional) number of recursive attempts in directories to find the language files (3 is the default)
```
$objLang->__set('recursiveDirCount', 3);
```

(optional) set the file type to load (json or xml) (json is the default file type)
```
$objLang->setXml();
or
$objLang->setJson();
```

Show the text
* Param 1 is the name of xml file without the '.xml' 
* Param 2 is the name of xml tag
* Param 3 (optional) is a variables array
```
echo $objLang->load('index', 'welcome');
or with an array with one or many variables
echo $objLang->load('index', 'yourName', array('Marcos'));
echo $objLang->load('index', 'yourFullName', array('Marcos', 'Menezes'));
```

## The XML files
In the tag `<languages>` put your own translation tags

If you use a html tag or special caracteres put into CDATA tag.

If you use a variable to send a parameter, put the '%s' in the tag
```
<?xml version="1.0" encoding="UTF-8"?>

<!-- English -->
<languages>
	<welcome>Welcome</welcome>
	<welcomeCData><![CDATA[<strong>Warning:</strong> Welcome %s.]]></welcomeCData>
	<yourName><![CDATA[Your name is: %s.]]></yourName>
	<yourFullName><![CDATA[Your full name is: %s %s.]]></yourFullName>
</languages>
```

## The JSON files
If you use a variable to send a parameter, put the '%s' in the tag
```
{
	"welcome": "Welcome to json version",
	"welcomeTag": "<strong>Warning:</strong> Welcome json.",
	"version": "Version: %s"
}
```

