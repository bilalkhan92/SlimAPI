<?php
class UserEntity
{
    protected $id;
    protected $FName;
    protected $LName;
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
        $this->FName = $data['FName'];
        $this->LName = $data['LName'];
        $this->status = $data['status'];
    }
    public function getId() {
        return $this->id;;
    }
    public function getFName() {
        return $this->FName;
    }
    public function getLName() {
        return $this->LName;
    }
    public function getstatus() {
        return $this->status;
    }
}
 ?>
