<?php
namespace My;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Helpers {
    const MAX_FILE_SIZE = 2097152;
    private static $_logger;

    public static function log() : Logger
    {
        if (is_null(self::$_logger)) {
            self::$_logger = new Logger("app");
            $path = __DIR__ . "/../logs/app.log";
            // self::$_logger->pushHandler(new StreamHandler($path, Logger::DEBUG));
            self::$_logger->pushHandler(new FirePHPHandler());
        }
        return self::$_logger;
    }



    /**
     * Decir hola al usuario
     * 
     * @return string
     */
    public static function sayHello($username)
    {
        return "Hello {$username}";
    }

    public static function url(string $path, bool $ssl = false): string 
    {
        $protocol = $ssl ? "https" : "http";
        return "{$protocol}://localhost/tarda/Projecte/{$path}";
    }

    public static function render(string $path, array $__params = []):string
    {
        ob_start();
        $root = __DIR__ . "/../web";
        include("{$root}/{$path}");
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static function redirect(string $url) : string 
    {
        ob_flush(); // use ob_clean() instead to discard previous output       
        header("Location: {$url}");
        exit();
    }

    public static function upload(array $file, string $folder = "") : string 
   {
       if ($file["error"]) {
           throw new \Exception("Upload error with code " . $file["error"]);
       } else if ($file["size"] > self::MAX_FILE_SIZE) {
           throw new \Exception("Upload maximum file exceeded (2MB)");
       } else {
           $dir  = __DIR__ . "/../uploads/{$folder}";
           $path = $dir . "/" . basename($file["name"]);
           $tmp  = $file["tmp_name"];
          
           if (move_uploaded_file($tmp, $path)) {
               return $path;
           } else {
               throw new \Exception("Unable to upload file at {$path}");
           }
       }
   }

   public static function flash(string $msg = ""): array
   {
        session_start();
        $list = $_SESSION["flash"] ?? [];
        if(empty($msg))
        {
            unset($_SESSION['flash']);
        }else
        {
            $list[] = $msg;
            $_SESSION["flash"] = $list;
        }
        return $list;
   }

 
}