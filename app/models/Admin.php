<?php

class Admin extends Model
{
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function updatePassword($id, $hash)
    {
        $stmt = $this->db->prepare('UPDATE admins SET password = :password WHERE id = :id');
        return $stmt->execute([':password' => $hash, ':id' => $id]);
    }
}
