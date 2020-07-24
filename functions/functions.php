<?php 

		function create_text($name)
			{
				echo ucfirst($name).": <input type=\"text\" name=\"$name\" value=\"";

				if(isset($_POST[$name])) echo $_POST[$name];

				echo "\"/>";
			}


		function create_radio($name, $value)
		{
			echo ucfirst($value)." <input type=\"radio\" name=\"$name\" value=\"$value\"";

			if(isset($_POST[$name])  && ($_POST[$name] == $value)) echo 'checked="checked"';

			echo "/>";
		}

		function create_textarea($name, $row=5, $col=20)
		{
	echo ucfirst($name)." <textarea name= \"$name\" rows=\"$row\" cols=\"$col\">";
		if(isset($_POST[$name])) echo $_POST[$name];

		echo "</textarea>";
		}


			function create_select($name, $id, $values=array())
				{
					echo ucfirst($name);
					echo ": <select name=\"$id\">";
					echo "<option value=\"\">Select $id</option>";

					foreach($values as $value) {
						echo "<option value=\"$value\"";
			if(isset($_POST[$id]) && ($_POST[$id] == $value)) echo 'selected="selected"';
					
					echo ">$value</option>";
					}

						echo "</select>";
				}










?>