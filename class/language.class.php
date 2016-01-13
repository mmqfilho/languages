<?php
/**
 * Get information of language and search in the xml file
 * @author: Marcos Menezes <mmqfilho@gmail.com>
 * @since: 2016-01-12
 */

namespace Mmqfilho\Languages;

Class Language
{
	/**
	 * The name of cookie
	 * @var string
	 */
	const COOKIE_NAME = 'mm_current_language';
	
	/**
	 * Default language
	 * @access private
	 * @var string
	 */
	private $default_language = 'en';
	
	/**
	 * List of languages (by apache 2)
	 * @access private
	 * @var string
	 */
	private $languages = array('en', 'ca', 'cs', 'da', 'de', 'el', 'eo', 'es', 'et', 'fr', 'he', 'hr', 'it', 'ja', 'ko', 'ltz', 'nl', 'nn', 'no', 'pl', 'pt', 'pt-br', 'ru', 'sv', 'zh-cn', 'zh-tw');
	
	/**
	 * Location of language folders (without slashes)
	 * @var string
	 */
	private $directory = 'languages';
	
	/**
	 * Show or not a message if the text not found
	 * @access private
	 * @var boolean
	 */
	private $show_message_not_found = true;
	
	/**
	 * The message to display
	 * @access private
	 * @var unknown
	 */
	private $message_not_found = 'TEXT_NOT_FOUND';
	
	/**
	 * Constructor
	 * @access public
	 * @param string $language
	 * @return boolean
	 */
	public function __construct($language = null){
		if (!empty($language) && in_array(strtolower($language), $this->languages)){
			$this->default_language = $language;
		}
		return true;	
	}
	
	/**
	 * Destructor
	 * @access public
	 * @return boolean
	 */
	public function __destruct(){
		return true;
	}
	
	/**
	 * getter
	 * @access public
	 * @param unknown $prop
	 * @return unknown 
	 */
	public function __get($prop) {
		return $this->$prop;
	}
	
	/**
	 * setter
	 * @access public
	 * @param unknown $prop
	 * @param unknown $value
	 * @return boolean
	 */
	public function __set($prop, $value) {
		$this->$prop = $value;
		return true;
	}
	
	/**
	 * Get the current language in the cookie
	 * @access private
	 * @return string
	 */
	private function getLanguageCookie(){
		
		if (isset($_COOKIE[self::COOKIE_NAME])){
			$language = $_COOKIE[self::COOKIE_NAME];
		}else{
			$language = $this->default_language;
		}
		
		return strtolower($language);
	}
	
	/**
	 * Get the text to show
	 * @access public
	 * @param $strSource - xml page to load
	 * @param $strText - xml index
	 * @return string || boolean
	 */
	public function load($strSource, $strText){
		
		$lang = $this->getLanguageCookie();
		
		if (file_exists($this->directory.'/'.$lang.'/'.$strSource.'.xml')) {
			$xml = simplexml_load_file($this->directory.'/'.$lang.'/'.$strSource.'.xml');
		}elseif (file_exists('../'.$this->directory.'/'.$lang.'/'.$strSource.'.xml')){
			$xml = simplexml_load_file('../'.$this->directory.'/'.$lang.'/'.$strSource.'.xml');
		}elseif (file_exists('../../'.$this->directory.'/'.$lang.'/'.$strSource.'.xml')){
			$xml = simplexml_load_file('../../'.$this->directory.'/'.$lang.'/'.$strSource.'.xml');
		}else{
			return false;
		}
		
		return ($xml->$strText != '' ? $xml->$strText : ($this->show_message_not_found == true ? $this->message_not_found : ''));
	}
}
