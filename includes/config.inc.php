<?php
//constants for locations
define('BASE_URL', '#######');
define('BASE_URI', '##########');
define('MYSQL', BASE_URI . '########');

function create_form_input($name, $type, $label = '', $errors =array(), $options = array()) {
$value = false;
if (isset($_POST[$name])) $value =
$_POST[$name];
if ($value && get_magic_quotes_gpc()) $value =
stripslashes($value);

echo '<div class="form-group';
if (array_key_exists($name, $errors)) echo ' has-error';
echo '">';

//create label if any
if (!empty($label)) echo '<label for="' . $name .
'" class="control-label">' . $label . '</label>';

//check input type
if ( ($type === 'text') || ($type === 'password') || ($type === 'password')) {

//begin creating input
echo '<input type="' . $type . '" name="' .
$name . '" id="' . $name . '" class="form-control"';

  if ($value) echo ' value="' . htmlspecialchars($value) . '"';
  if (!empty($options) && is_array($options)) {
    foreach ($options as $k => $v) {
      echo " $k=\"$v\"";
    }
  }

  //close tag
  echo '>';

  if (array_key_exists($name, $errors)) echo '<span class="help-block">'
  . $errors[$name] . '</span>';
}elseif ($type === 'textarea') {//make a textarea field
  if (array_key_exists($name, $errors)) echo
  '<span class="help-block">' . $errors[$name] . '</span>';
  echo '<textarea name="' .$name . '" id="' . $name . '" class="form-control"';
//options?
  if (!empty($options) && is_Array($options)) {
    foreach ($options as $k => $v) {
        echo " $k=\"$v\"";
    }
  }

  echo '>';
//fill text area
  if ($value) echo $value;

  echo '</textarea>';

 }
  echo '</div>';
}

?>
