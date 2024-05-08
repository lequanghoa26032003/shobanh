<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class post
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_post($data, $status)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $status = mysqli_real_escape_string($this->db->link, $status);

        if ($name == "" || $description == "") {
            $_SESSION['error'] = 'không được để trống';
            return true;
        } else {
            $query = "INSERT INTO tbl_category_post(title,description,status) VALUES('$name','$description','$status') ";
            $result = $this->db->insert($query);
            if ($result) {
                $_SESSION['alert'] = 'Đã được thêm thành công';
                return true;
            } else {
                $_SESSION['error'] = 'Thêm không thành công';
                return false;
            }

        }
    }



    public function show_post()
    {
        $query = "SELECT * FROM tbl_category_post order by id desc";
        $result = $this->db->select($query);
        return $result;
        // $query =
        // 	"SELECT categories.*, tb_cat.catName

        // 	 FROM categories INNER JOIN tb_cat ON categories.id = tb_cat.id

        // 	 order by categories.id desc ";

        // // $query = "SELECT * FROM categories order by id desc ";
        // $result = $this->db->select($query);
        // return $result;
    }
    public function update_status_post($id, $status)
    {

        $status = mysqli_real_escape_string($this->db->link, $status);
        $query = "UPDATE tbl_category_post SET status = '$status' where id='$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function update_post($data, $id, $status)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        $status = mysqli_real_escape_string($this->db->link, $status);

        if ($name == "" || $description == "") {
            $_SESSION['alert'] = 'không được để trống';
            return false;
        } else {

            $query = "UPDATE bl_category_post SET 
						title ='$name',
						description = '$description',
						status = '$status',
						WHERE id = '$id' ";
            $result = $this->db->update($query);
            if ($result) {
                $_SESSION['alert'] = 'Cập nhật thành công';
                return true;
            } else {
                $_SESSION['alert'] = 'Cập nhật thất bại';
                return false;
            }

        }


    }
    public function del_post($id)
    {
        $query = "DELETE FROM tbl_category_post WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $_SESSION['alert'] = "Xóa thành công";
            return true;
        } else {
            $_SESSION['alert'] = 'Xóa không thành công';
            return false;
        }
    }


    public function getpostbyId($id)
    {
        $query = "SELECT * FROM tbl_category_post where id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slug_id($slug)
    {
        $query = "SELECT * FROM categories WHERE slug='$slug' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}