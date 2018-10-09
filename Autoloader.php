<?php

namespace alban\projet_4;

class Autoloader{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class) {

        $prefix = 'alban\\projet_4\\';

        $base_dir = __DIR__. '/';

        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0)
        {
            return;
        }

        $relative_class = substr($class, $len);

        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        if (file_exists($file))
        {
            require $file;
        }
    }
}
?>
