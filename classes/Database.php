<?php
class Database {
    // Properties 
    private static ?Database $instance = null;
    private mysqli $connect;
    private string $host;
    private string $user;
    private string $pass;
    private string $dbname;

    // Constructor 
    private function __construct(
        string $host   = "localhost",
        string $user   = "root",
        string $pass   = "",
        string $dbname = "db_sanzubookings"
    ) {
        $this->host   = $host;
        $this->user   = $user;
        $this->pass   = $pass;
        $this->dbname = $dbname;
        $this->connect = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (!$this->connect) {
            die("Koneksi Gagal: " . mysqli_connect_error());
        }
    }
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnect(): mysqli {
        return $this->connect;
    }

    public function getHost(): string {
        return $this->host;
    }
    public function getDbname(): string {
        return $this->dbname;
    }
}
?>
