<?php

function sfi_cas_split_attributes(&$attributes, $attribute_delims)
{
   //splits each attribute by the corresponding delimiter, because the CAS attributes come in a weird form.
    foreach($attributes as $i => $attr)
    {
	  foreach($attribute_delims as $delim) 
	  {
		  if(substr($attr,0,strlen($delim)) ==  $delim)
		  {
			//matched to start of attribute - make as key
			$attributes[$delim] = substr($attr, strlen($delim));
            unset($attributes[$i]);
		  } 
	  }
    }
    return $attributes;
}

?>