<?php
include_once(__DIR__ . '/Database.php');
include_once(__DIR__ . '/Cart.php');

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username, $password) {

        // session_destroy();
        session_start();
        $cart = new Cart();
        $result = $this->db->checkUser($username, $password);
        if ($result) {
            $result2 = $this->db->slectUser($username);
            $_SESSION['username'] = $result2[0]['username'];
            $_SESSION['role'] = $result2[0]['role'];
            $_SESSION['id'] = $result2[0]['IDuser'];
            $_SESSION['cart'] = $cart->getNumberOfCartByUserId($_SESSION['id']);
            // echo $_SESSION['username'];

            echo "<script>alert('Login success'); window.location.href = 'index.php';</script>";
            // header('Location: index.php');
        } else {
            // echo 'Wrong username or password';
            echo "<script>alert('Wrong username or password'); window.location.href = 'login.php';</script>";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }

    public function logoutToAdmin() {
        session_start();
        session_destroy();
        header('Location: ../index.php');
    }


    public function register($username, $password, $email, $phone, $adress) {
        $result = $this->db->insertUser($username, $password, $email, $phone, $adress);
        if ($result) {
            echo "<script>alert('Register success'); window.location.href = 'login.php';</script>";
            // header('Location: Login.php');
        } else {
            echo '<script>alert("Register failed"); window.location.href = "register.php";</script>';
            // echo 'Username already exists';
        }
    }

    public function insertUser($username, $password, $email, $phone, $adress) {
        $result = $this->db->insertUser($username, $password, $email, $phone, $adress);
        if ($result) {
            echo "<script>alert('Insert user success'); window.location.href = 'User-table.php';</script>";
            // header('Location: User-table.php');
        } else {
            echo '<script>alert("Insert user failed"); window.location.href = "User-table.php";</script>';
            // echo 'Username already exists';
        }
    }

    public function loadDataonTable() {
        $result = $this->db->slectFromUSers();
        // print_r($result);
        foreach ($result as $row) {
            echo "<tr>";
            // echo "<td>" . $row['IDuser'] . "</td>";
            echo "<td><a href='User-detail.php?id=" . $row['IDuser'] . "'>" . $row['username'] . "</a></td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['adress'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td><a class='btn btn-warning' href='update_user.php?id=" . $row['IDuser'] . "'>Edit <i class='fas fa-edit'></i></a></td>";
            echo "<td><a class='btn btn-danger' href='delete_user.php?id=" . $row['IDuser'] . "'>Delete <i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    public function updateUser($id, $username, $password, $email, $phone, $adress) {
        $result = $this->db->updateUser($id, $username, $password, $email, $phone, $adress);
        if ($result) {
            echo "<script>alert('Update success');</script>";
            echo ("<script>location.href = 'User-table.php';</script>");

        } else {
            echo '<script>alert("Update failed");</script>';
            echo ('<script>
                location.reload();
            </script>');

        }
    }

    public function updateUser2($id, $username, $password, $email, $phone, $adress) {
        $result = $this->db->updateUser($id, $username, $password, $email, $phone, $adress);
        if ($result) {
            echo "<script>alert('Update success');</script>";
            echo ("<script>location.href = 'information.php';</script>");

        } else {
            echo '<script>alert("Update failed");</script>';
            echo ('<script>
                location.reload();
            </script>');
        }
    }

    public function deleteUser($id) {
        $result = $this->db->deleteUserByID($id);
        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "script>alert('Delete failed!')</script>";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    public function selectUserByID($id) {
        $result = $this->db->slectUserById($id);
        return $result;
    }
}

// $auth = new User();
// $auth->login('hello1', '1234');