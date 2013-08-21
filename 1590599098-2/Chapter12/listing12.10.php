<?php

class VH {
    static function getRequest() {
        return woo_base_RequestRegistry::getRequest();
    }
}

// cheat and cache this stuff
require_once("woo/controller/Request.php");
require_once("woo/base/Registry.php");
require_once("woo/domain/Venue.php");
woo_base_RequestRegistry::setRequest( new woo_controller_Request() );
$request = VH::getRequest();
$request->setObject( 'venue', new woo_domain_Venue( 5, "my venue" ) );
//

//require_once( "woo/view/ViewHelper.php" );
$request = VH::getRequest();
$venue = $request->getObject('venue');
?>

<html>
<head>
<title>Add a Space for venue <?php echo $venue->getName() ?></title>
</head>
<body>
<h1>Add a Space for Venue '<?php print $venue->getName() ?>'</h1>

<table>
<tr>
<td>
<?php print $request->getFeedbackString("</td></tr><tr><td>"); ?>
</td>
</tr>
</table>

<form method="post">
    <input type="text"
     value="<?php echo $request->getProperty( 'space_name' ) ?>" name="space_name"/>
    <input type="hidden" name="venue_id" value="<?php echo $venue->getId() ?>" />
    <input type="submit" value="submit" />
</form>

</body>
</html>
