
<?php
/** 
* @Ppackage TambiPlugin
*/

class tambiplugin_activate{
    
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
