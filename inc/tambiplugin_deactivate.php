
<?php
/** 
* @Ppackage TambiPlugin
*/

class tambiplugin_deactivate{
    
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
