<?php
function generate_property($value, $prefix = null, $suffix =null)
{
	if(empty($value)) return '';
	return  $prefix .  $value . $suffix;
}