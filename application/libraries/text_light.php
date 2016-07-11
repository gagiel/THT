<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Text_light{
	
	public $output_text;
	
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		log_message('debug', "Login Class Initialized");
	}
	
	public function light($text,$words)
	{
		$split_words = explode( " " , $words );
		foreach ($split_words as $word)
		{
			$text = preg_replace("|($word)|Ui" ,"<span style=\"background:#ccc; color:red;\"><b>$1</b></span>" , $text );
		}
		
		return $text;
	}
	
	private function rgbhex($red, $green, $blue)
	{
		return sprintf('#ccc', $red, $green, $blue);
	}
	
	private function generate_colors()
	{
		$red = rand( rand(60,100) , rand(200,252) );
		$green = rand( rand(60,100) , rand(200,252) );
		$blue = rand( rand(60,100) , rand(200,252) );
		$color = self::rgbhex( $red , $green , $blue );
		return $color;
	}
}
?>