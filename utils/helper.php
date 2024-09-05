<?php

function cek($value) {
	if($value == NULL || $value == "") {
		return NULL;
	}
  
	if($value instanceof DateTime) {
		if($value->format('Y-m-d') != '1900-01-01') {
			return $value->format('Y-m-d');
		} else {
			return NULL;
		}
	}
  
	if($value == '1900-01-01') {
		return NULL;
	}
  
	if($value == '.00') {
	  return NULL;
	}
  
	return $value;
}