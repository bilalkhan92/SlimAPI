<?php

class UserMapper extends Mapper
{
    public function getUsers() {
        $sql = "SELECT * FROM tbl_profile";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getUserById($user_id) {
        $sql = "SELECT *
            from tbl_profile
            where id = :user_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["user_id" => $user_id]);
        $result = array($stmt->fetch());

        if(count($result[0]) > 1) {
            return $result;
        }
    }

    public function save(UserEntity $user) {
        $sql = "insert into tbl_profile
            (email, password, status) values
            (:email, :password, :status)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "email" => $user->getemail(),
            "password" => $user->getpassword(),
            "status" => $user->getstatus(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}

?>
