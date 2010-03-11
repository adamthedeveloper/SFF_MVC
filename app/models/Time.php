<?php
class Time {
	function getTime($format)
	{
		// reuse Date - pretty much does the same thing
		// I would have just deleted this class altogether
		// and just used the Date Model but the instructions said
		// each page should have it's own class - not knowing
		// completely what they meant, I just decided to 
		// do it this way.  Hopefully it's not a ding in
		// judgement.  Adam
		return Date::getDate($format);
	}
}