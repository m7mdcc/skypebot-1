<?php
	$dbus_connection = dbus_bus_get(DBUS_BUS_SESSION);
	if (!$dbus_connection) 
		echo "DBUS is exist\n";
	else
		echo "DBUS not exist\n";
?>
