

<?php

function error($type, $title, $msg)
{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: '$type',
			  title: '$title',
			  text: '$msg'
			  
			});
			</script>";
}


?>
