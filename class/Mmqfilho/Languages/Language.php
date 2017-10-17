<?php
/**
 * Get information of language and search in the json or xml file
 * @author: Marcos Menezes <mmqfilho@gmail.com>
 * @since: 2016-01-12
 */

namespace Mmqfilho\Languages ;

Class Language
{
	/**
	 * The name of cookie
	 * @access public
	 * @var string
	 */
	const COOKIE_NAME = 'mm_current_language' ;
	
	/**
	 * Default language
	 * @access private
	 * @var string
	 */
	private $default_language = 'en' ;
	
	/**
	 * List of languages (by apache 2)
	 * @access private
	 * @var string
	 */
	private $languages = array ( 'en' , 'ca' , 'cs' , 'da' , 'de' , 'el' , 'eo' , 'es' , 'et' , 'fr' , 'he' , 'hr' , 'it' , 'ja' , 'ko' ,
								 'ltz' , 'nl' , 'nn' , 'no' , 'pl' , 'pt' , 'pt-br' , 'ru' , 'sv' , 'zh-cn' , 'zh-tw' ) ;
	
	/**
	 * Location of language folders (without slashes)
	 * @access private
	 * @var string
	 */
	private $directory = 'languages' ;
	
	/**
	 * Type of return data 
	 * @access private
	 * @var string
	 */
	private $typeFile = 'json' ;
	
	/**
	 * Number of recursive attempts in directories
	 * @var integer
	 */
	private $recursiveDirCount = 3;
	
	/**
	 * Show or not a message if the text not found
	 * @access private
	 * @var boolean
	 */
	private $show_message_not_found = true ;
	
	/**
	 * The message to display
	 * @access private
	 * @var string
	 */
	private $message_not_found = 'TEXT_NOT_FOUND' ;
	
	/**
	 * Constructor
	 * @access public
	 * @param string $language
	 * @return boolean
	 */
	public function __construct ( $language = null ) {
		if ( ! empty ( $language ) && in_array ( strtolower ( $language ) , $this->languages ) ) {
			$this->default_language = $language ;
		}
		return true ;	
	}
	
	/**
	 * Destructor
	 * @access public
	 * @return boolean
	 */
	public function __destruct ( ) {
		return true ;
	}
	
	/**
	 * getter
	 * @access public
	 * @param unknown $prop
	 * @return unknown 
	 */
	public function __get ( $prop ) {
		return $this->$prop;
	}
	
	/**
	 * setter
	 * @access public
	 * @param unknown $prop
	 * @param unknown $value
	 * @return boolean
	 */
	public function __set ( $prop , $value ) {
		$this->$prop = $value ;
		return true ;
	}
	
	/**
	 * Set the return file to xml mode
	 * @access public
	 * @return void
	 */
	public function setXml ( ) {
		$this->typeFile = 'xml' ;
	}
	
	/**
	 * Set the return file to json mode
	 * @access public
	 * @return void
	 */
	public function setJson ( ) {
		$this->typeFile = 'json' ;
	}
	
	/**
	 * Get the current language in the cookie
	 * @access private
	 * @return string
	 */
	private function getLanguageCookie ( ) {
		
		if ( isset ( $_COOKIE [ self::COOKIE_NAME ] ) ) {
			$language = $_COOKIE [ self::COOKIE_NAME ] ;
			
		}else{
			$language = $this->default_language ;
		}
		
		return strtolower ( $language ) ;
	}
	
	/**
	 * Get the text to show
	 * @access public
	 * @param $strSource - json/xml page to load
	 * @param $strText - json/xml index
	 * @param $arrayData - Dinamic elements to load in the text
	 * @return string || boolean
	 */
	public function load ( $strSource , $strText , $arrayData = null ) {
		
		$lang = $this->getLanguageCookie ( ) ;
		$dir = null;
		
		for ( $x = 0 ; $x <= $this->recursiveDirCount ; $x++ ) {
			$parentDirectory = '';
			
			for ($y = 1 ; $y <= $x ; $y++ ){
				$parentDirectory .= '../';
			}
			
			if ( file_exists ( $parentDirectory . $this->directory . '/' . $lang . '/' . $strSource . '.' . $this->typeFile ) ) {
				$dir =  $parentDirectory . $this->directory . '/' . $lang . '/' . $strSource . '.' . $this->typeFile  ;
				break;
			} 
		}

		if ( $dir == null ) {
			return false ;
			
		} elseif ( $this->typeFile == 'xml' ) {
			${$this->typeFile} = $this->loadXML ( $dir ) ;
			
		} else {
			${$this->typeFile} = json_decode( $this->loadJSON ( $dir ) ) ;
			
		}
		
		if ( $arrayData != null ) {
			${$this->typeFile}->$strText = vsprintf ( ${$this->typeFile}->$strText , $arrayData ) ;
		}
		
		return ${$this->typeFile}->$strText != '' ? ${$this->typeFile}->$strText : ( $this->show_message_not_found == true ? $this->message_not_found : '' ) ;
	}
	
	/**
	 * Load a xml file
	 * @param string $dir
	 * @return SimpleXMLElement
	 */
	private function loadXML ( $dir ) {
		return simplexml_load_file ( $dir ) ;
	}
	
	/**
	 * Load a json file
	 * @param string $dir
	 * @return string
	 */
	private function loadJSON ( $dir ) {
		return file_get_contents ( $dir ) ;
	}
}
