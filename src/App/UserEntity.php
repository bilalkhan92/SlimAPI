<?php

class UserEntity
{
    protected $id;
    protected $email;
    protected $password;
    protected $status;
    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->status = $data['status'];
    }
    public function getId() {
        return $this->id;;
    }
    public function getemail() {
        return $this->email;
    }
    public function getpassword() {
        return $this->password;
    }
    public function getstatus() {
        return $this->status;
    }
}
 ?>
