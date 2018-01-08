<?php

class UserMapper extends Mapper
{
    public function getUsers() {
        $sql = "SELECT * FROM tbl_profile";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new UserEntity($row);
        }
        return $results;
    }

    public function getUserById($user_id) {
        $sql = "SELECT *
            from tbl_profile
            where id = :user_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["user_id" => $user_id]);
        if($result) {
            return new UserEntity($stmt->fetch());
        }
    }

    public function save(UserEntity $user) {
        $sql = "insert into tbl_profile
            (FName, LName, status) values
            (:FName, :LName, :status)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "FName" => $user->getFName(),
            "LName" => $user->getLName(),
            "status" => $user->getstatus(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}

?>
