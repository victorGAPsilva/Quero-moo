<?php

class Auth
{
    public static function check()
    {
        return !empty($_SESSION['admin_id']);
    }

    public static function id()
    {
        return $_SESSION['admin_id'] ?? null;
    }

    public static function attempt($email, $password)
    {
        $adminModel = new Admin();
        $admin = $adminModel->findByEmail($email);
        if (!$admin) {
            return false;
        }

        $stored = $admin['password'];
        $verified = false;

        if (strpos($stored, '$2y$') === 0) {
            $verified = password_verify($password, $stored);
        } else {
            $verified = hash_equals($stored, $password);
            if ($verified) {
                $adminModel->updatePassword($admin['id'], password_hash($password, PASSWORD_DEFAULT));
            }
        }

        if ($verified) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            return true;
        }

        return false;
    }

    public static function logout()
    {
        unset($_SESSION['admin_id'], $_SESSION['admin_name']);
        session_regenerate_id(true);
    }
}
