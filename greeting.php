<?php
/**
* 
*/
class greeting
{
	
	function __construct($greeting)
	{
		$this->_id=greeting::get_max_id()+1;
		$this->_greeting=$greeting;
		$greetings = greeting::get_all_greetings();
		array_push($greetings, $this);
		greeting::save_greetings($greetings);
	}

	var $_id;
	var $_greeting;


	static function get_by_id($id)
	{
		$greetings=greeting::get_all_greetings();
		return $greetings[$id];
	}

	static function get_max_id()
	{
		$max_id =0;
		$greetings=greeting::get_all_greetings();
		foreach($greetings as &$greeting)
		{
			if($greeting->_id>$max_id)
			{
				$max_id=$greeting->_id;
			}
		}
		return $max_id;
	}

	static function get_all_greetings()
	{
		$greetings=json_decode(file_get_contents('greeting.json'));
		if($greetings===null)
		{
			$greetings=array();
		}
		return $greetings;
	}
	static function save_greetings($greetings)
	{
		file_put_contents('greeting.json', json_encode($greetings));
	}
}

/**
* 
*/
class user_greeting
{
	
	function __construct($id_user,$id_greeting)
	{
		$this->_id_user=$id_user;
		$this->_id_greeting=$id_greeting;
		$items = greeting::get_all();
		array_push($items, $this);
		greeting::save_greetings($items);
	}

	var $_id_user;
	var $_id_greeting;

	static function get_all()
	{
		$items=json_decode(file_get_contents('user_greeting.json'));
		if($items===null)
		{
			$items=array();
		}
		return $items;
	}

	static function save_greetings($items)
	{
		file_put_contents('user_greeting.json', json_encode($items));
	}
}
?>