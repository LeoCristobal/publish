<!-- // <?php
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
// ?>  -->


<?php
class Database
{
    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if (null == self::$cont)
        {     
            try
            {
                $dbUrl = getenv('DATABASE_URL');
                $dbopts = parse_url($dbUrl);

                $host = $dbopts['host'];
                $port = isset($dbopts['port']) ? $dbopts['port'] : 5432;
                $user = $dbopts['user'];
                $pass = $dbopts['pass'];
                $dbname = ltrim($dbopts['path'], '/');

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                self::$cont = new PDO($dsn, $user, $pass, $options); 

            }
            catch(PDOException $e)
            {
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

