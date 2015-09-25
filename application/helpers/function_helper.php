<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function show_form($id, $type, $name, $label, $placeholder){
		echo "<div class='form-group'>
				<label for='{$id}'>{$label}</label>
				<input  type='{$type}' 
						name='{$name}' 
						class='form-control' 
						id='{$id}' 
						placeholder='{$placeholder}' 
				>
			</div>";
	}
?>