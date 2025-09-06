<!-- <?php
// class Database
// {
//     private static $dbName;
//     private static $dbHost;
//     private static $dbUsername;
//     private static $dbUserPassword;
//     private static $cont = null;

//     public function __construct()
//     {
//         die('Init function is not allowed');
//     }

//     private static function loadEnv()
//     {
//         if (!self::$dbName) {
//             // Read .env file
//             $env = parse_ini_file(__DIR__ . '/.env');

//             self::$dbName        = $env['DB_DATABASE'];
//             self::$dbHost        = $env['DB_HOST'];
//             self::$dbUsername    = $env['DB_USERNAME'];
//             self::$dbUserPassword= $env['DB_PASSWORD'];
//         }
//     }

//     public static function connect()
//     {
//         if (null == self::$cont) {
//             try {
//                 self::loadEnv();

//                 self::$cont = new PDO(
//                     "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
//                     self::$dbUsername,
//                     self::$dbUserPassword
//                 );
//                 self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             } catch (PDOException $e) {
//                 die($e->getMessage());
//             }
//         }
//         return self::$cont;
//     }

//     public static function disconnect()
//     {
//         self::$cont = null;
//     }
// }
?> -->

// postgre
<?php
class Database
{
    private static $dbName;
    private static $dbHost;
    private static $dbUsername;
    private static $dbUserPassword;
    private static $cont = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    private static function loadEnv()
    {
        if (!self::$dbName) {
            // Read .env file
            $env = parse_ini_file(__DIR__ . '/.env');

            self::$dbName         = $env['DB_DATABASE'];
            self::$dbHost         = $env['DB_HOST'];
            self::$dbUsername     = $env['DB_USERNAME'];
            self::$dbUserPassword = $env['DB_PASSWORD'];
        }
    }

    public static function connect()
    {
        if (null == self::$cont) {
            try {
                self::loadEnv();

                // PostgreSQL connection
                self::$cont = new PDO(
                    "pgsql:host=" . self::$dbHost . ";port=5432;dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbUserPassword
                );
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("PostgreSQL Connection failed: " . $e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
