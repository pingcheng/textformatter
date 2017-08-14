<?php
/**
 * @author: pingcheng
 * Date: 14/8/17
 * Time: 9:07 PM
 */

namespace PingCheng;

class TextFomatter
{
	protected $text;
	protected $data;

	/**
	 * create a new instance and set the text
	 * @param $text
	 * @return TextFomatter
	 */
	public static function text($text) {
		return new self($text);
	}

	/**
	 * set up the data set
	 * @param $data
	 * @return $this
	 */
	public function with($data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * get the result of final string
	 * @return string
	 */
	public function process() {
		return $this->regex_find();
	}

	/**
	 * process the text with data
	 * @return string
	 */
	private function regex_find() {
		$pattern = "/(\{{.*?\}})/";

		// replace with the variables
		$result = preg_replace_callback($pattern,
			function ($matches){
				$variable = trim($matches[0], '{ }');

				return $this->getvalue($variable);
			},
			$this->text);
		return $result;
	}

	/**
	 * fetch the value from data
	 * @param $var
	 * @return null|string
	 */
	private function getvalue($var) {
		$value = $this->data[$var];

		if (is_array($value)) {
			return implode(', ', $value);
		} else if (is_object($value)) {
			return null;
		} else {
			return (string)$value;
		}
	}

	/**
	 * Make the construct private
	 * TextFomatter constructor.
	 * @param $text
	 */
	private function __construct($text)
	{
		$this->text = $text;
	}
}