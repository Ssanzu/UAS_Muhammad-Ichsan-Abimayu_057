<?php
require_once __DIR__ . '/Database.php';

// Class User
class User {
    // ─── Properties
    private int    $id;
    private string $nama;
    private string $username;
    private string $password;
    private mysqli $connect;

    // Constructor 
    public function __construct(int $id = 0, string $nama = '', string $username = '', string $password = '') {
        $this->id       = $id;
        $this->nama     = $nama;
        $this->username = $username;
        $this->password = $password;
        $this->connect  = Database::getInstance()->getConnect();
    }

    // Getter 
    public function getId(): int        { return $this->id; }
    public function getNama(): string   { return $this->nama; }
    public function getUsername(): string { return $this->username; }
    public function getConnect(): mysqli { return $this->connect; }


    // Setter 
    public function setNama(string $nama): void         { $this->nama = $nama; }
    public function setUsername(string $username): void { $this->username = $username; }
    public function setPassword(string $raw): void      { $this->password = md5($raw); }

    // Methods 
    public function login(string $username, string $password): ?array {
        $username  = htmlentities($username);
        $password  = md5(htmlentities($password));
        $query     = mysqli_query($this->connect,
            "SELECT * FROM tb_user WHERE username='$username' AND password='$password'"
        );
        $hasil = mysqli_fetch_array($query);
        return $hasil ?: null;
    }

    public function getAllUsers(): array {
        $query = mysqli_query($this->connect, "SELECT * FROM tb_user");
        $result = [];
        while ($row = mysqli_fetch_array($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function addUser(string $nama, string $username): bool {
        $nama     = mysqli_real_escape_string($this->connect, $nama);
        $username = mysqli_real_escape_string($this->connect, $username);
        $password = md5('password');

        $cek = mysqli_query($this->connect, "SELECT * FROM tb_user WHERE username='$username'");
        if (mysqli_num_rows($cek) > 0) return false;

        return (bool) mysqli_query($this->connect,
            "INSERT INTO tb_user (nama, username, password) VALUES ('$nama', '$username', '$password')"
        );
    }

    public function editUser(int $id, string $nama, string $username): bool {
        $id       = mysqli_real_escape_string($this->connect, $id);
        $nama     = mysqli_real_escape_string($this->connect, $nama);
        $username = mysqli_real_escape_string($this->connect, $username);
        $password = md5('password');

        $cek = mysqli_query($this->connect, "SELECT * FROM tb_user WHERE username='$username' AND id != '$id'");
        if (mysqli_num_rows($cek) > 0) return false;

        return (bool) mysqli_query($this->connect,
            "UPDATE tb_user SET nama='$nama', username='$username', password='$password' WHERE id='$id'"
        );
    }

    public function deleteUser(int $id): bool {
        $id = mysqli_real_escape_string($this->connect, $id);
        return (bool) mysqli_query($this->connect, "DELETE FROM tb_user WHERE id='$id'");
    }
}
?>
