// <?php
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
// ?> 


<?php
class Database
{
    private static $dbName = null;
    private static $dbHost = null;
    private static $dbUsername = null;
    private static $dbUserPassword = null;
    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // Load from Render environment variables
        self::$dbName         = getenv("DB_DATABASE") ?: 'research_574b';
        self::$dbHost         = getenv("DB_HOST") ?: 'dpg-d2tuekre5dus73e71p0g-a.oregon-postgres.render.com';
        self::$dbUsername     = getenv("DB_USERNAME") ?: 'research_574b_user';
        self::$dbUserPassword = getenv("DB_PASSWORD") ?: 'mP9MhGx9FLmOWU3Xkf7w8JtXDIsqv5Rw';

        if (null == self::$cont)
        {     
            try
            {
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 5,          // 5-second timeout
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                self::$cont = new PDO(
                    "pgsql:host=".self::$dbHost.
                    ";port=5432;dbname=".self::$dbName.
                    ";sslmode=require",
                    self::$dbUsername,
                    self::$dbUserPassword,
                    $options
                ); 

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
