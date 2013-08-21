<?php
require_once( "woo/command/Command.php" );

class woo_command_DefaultCommand2 extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $request->addFeedback( "Welcome to WOO" );
    }
}

?>
