<?php
//DO NOT EDIT THIS FILE
require("db.php");
function output($username) {
	global $table_name;
	global $mysqli;
	$username = mysqli_real_escape_string($mysqli, $username);
	$query = "SELECT * FROM $table_name WHERE username = '$username'";
	$result = mysqli_query($mysqli, $query);
	if(mysqli_num_rows($result)==1) {
		$row = mysqli_fetch_assoc($result);
		$human_seconds = convert_seconds($row["runtime"]);
		echo $username.", ".$human_seconds.", ".$row["var1"].", " .$row["var2"].", ".$row["var3"].", ".$row["var4"];
	}
	else {
		echo "Error performing query.";
	}	
}
function input($username, $runtime, $var1, $var2, $var3, $var4) {
	global $table_name;
	global $mysqli;
	$username = mysqli_real_escape_string($mysqli, $username);
	$runtime = mysqli_real_escape_string($mysqli, $runtime);
	$var1 = mysqli_real_escape_string($mysqli, $_GET[$var1]);
	$var2 = mysqli_real_escape_string($mysqli, $_GET[$var2]);
	$var3 = mysqli_real_escape_string($mysqli, $_GET[$var3]);
	$var4 = mysqli_real_escape_string($mysqli, $_GET[$var4]);
	$query = "SELECT * FROM $table_name WHERE username = '$username'";
	$result = mysqli_query($mysqli, $query);
	if(mysqli_num_rows($result)==1) {
		if(empty($username) || empty($runtime)) {
			echo "You are missing some parameters.";
		}
		else {
			$row = mysqli_fetch_assoc($result);
			$runtime = $runtime + $row["runtime"];
			$var1 = $var1 + $row["var1"];
			$var2 = $var2 + $row["var2"];
			$var3 = $var3 + $row["var3"];
			$var4 = $var4 + $row["var4"];
			$update_query = "UPDATE $table_name SET runtime='$runtime', var1='$var1', var2='$var2', var3='$var3', var4='$var4' WHERE username='$username'";
			$update_result = mysqli_query($mysqli, $update_query);
			if(!$update_result) {
				echo "Error performing query.";
			}
		}
	}
	else if(mysqli_num_rows($result)==0) {
		if(empty($username) || empty($runtime)) {
			echo "You are missing some parameters.";
		}
		else {
			$insert_query = "INSERT INTO $table_name (username, runtime, var1, var2, var3, var4) VALUES ('$username', '$runtime', '$var1', '$var2', '$var3', '$var4')";
			$insert_result = mysqli_query($mysqli, $insert_query);
			if(!$insert_result) {
				echo "Error performing query.";
			}
		}
	}
	else {
		echo "Error performing query.";
	}
}
function convert_seconds($d)
{
    $periods = array( 'day'    => 86400,
                      'hour'   => 3600,
                      'minute' => 60,
                      'second' => 1 );
    $parts = array();
    foreach ( $periods as $name => $dur )
    {
        $div = floor( $d / $dur );
         if ( $div == 0 )
                continue;
         else if ( $div == 1 )
                $parts[] = $div . " " . $name;
         else
                $parts[] = $div . " " . $name . "s";
         $d %= $dur;
    }
    $last = array_pop( $parts );
    if ( empty( $parts ) )
        return $last;
    else
        return join( ', ', $parts ) . " and " . $last;
}
?>
