<!DOCTYPE html>
<html>
<head>
    <title>dashDB Connection Test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
if( getenv( "VCAP_SERVICES" ) )
{
    # Get database details from the VCAP_SERVICES environment variable
    #
    # *This can only work if you have used the Bluemix dashboard to 
    # create a connection from your dashDB service to your PHP App.
    #
    $details  = json_decode( getenv( "VCAP_SERVICES" ), true );
    $dsn      = $details [ "dashDB" ][0][ "credentials" ][ "ssldsn" ];
    #$ssl_dsn  = "DATABASE=BLUDB;HOSTNAME=dashdb-entry-yp-dal09-07.services.dal.bluemix.net;PORT=50000;PROTOCOL=TCPIP;UID=dash12882;PWD=bW0~c4pwB#NF;";#$details [ "dashDB" ][0][ "credentials" ][ "ssldsn" ];
	
    # Build the connection string
    #
    $driver = "DRIVER={IBM DB2 ODBC DRIVER};";
    $conn_string = $driver . $dsn;
    if(function_exists('db2_connect')){
    	echo "Function exist";
    }else{
    	echo "Function not exist";
    }
    $conn = db2_connect( $conn_string, "dash12882", "bW0~c4pwB#NF" );
	echo $conn;
    if( $conn )
    {
        echo "<p>Connection succeeded.</p>";
        db2_close( $conn );
    }
    else
    {
        echo "<p>Connection failed.</p>";
    }
}
/*else
{
    echo "<p>No credentials.</p>";
}*/
?>
</body>
</html>
