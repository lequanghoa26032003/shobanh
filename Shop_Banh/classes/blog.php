<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
class blog
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_blog($data, $files, $status)
    {
        $category_post_id = mysqli_real_escape_string($this->db->link, $data['category_post_id']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $status);

        $image = $_FILES['image']['name'];
        $path = "../uploads";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . "." . $image_ext;

        if ($name == "" || $content == "" || $description == "") {
            $_SESSION['error'] = 'không được để trống';
            return false;
        } else {
            $query = "INSERT INTO tbl_blog(title,description,content,category_post_id,image,status) VALUES('$name','$description','$content','$category_post_id','$filename','$status') ";
            $result = $this->db->insert($query);
            if ($result) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $filename);
                $_SESSION['alert'] = 'Đã được thêm thành công';
                return true;
            } else {
                $_SESSION['error'] = 'Thêm không thành công';
                return false;
            }

        }
    }

    public function show_blog()
    {
        $query = "SELECT * FROM tbl_blog order by id desc";
        $result = $this->db->select($query);
        return $result;
        // $query =
        // 	"SELECT products.*, tb_cat.catName

        // 	 FROM products INNER JOIN tb_cat ON products.id = tb_cat.id

        // 	 order by products.id desc ";

        // // $query = "SELECT * FROM products order by id desc ";
        // $result = $this->db->select($query);
        // return $result;
    }
    public function update_status_blog($id, $status)
    {

        $status = mysqli_real_escape_string($this->db->link, $status);
        $query = "UPDATE tbl_blog SET status = '$status' where id='$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function update_blog($data, $files, $id, $status)
    {
        $category_post_id = mysqli_real_escape_string($this->db->link, $data['category_post_id']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $status);

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];
        if ($name == "" || $content == "" || $description == "") {
            $_SESSION['error'] = 'không được để trống';
            return false;
        } else {
            if ($new_image != "") {
                //$update_filename = $new_image;
                $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
                $update_filename = time() . "." . $image_ext;

            } else {
                $update_filename = $old_image;
            }
            $path = "../uploads";
            $query = "UPDATE tbl_blog SET 
						title='$name',
						description = '$description',
						content = '$content',
                        category_post_id='$category_post_id',
						image = '$update_filename',
						status = '$status'

						WHERE id = '$id' ";
            $result = $this->db->update($query);
            if ($result) {
                if ($_FILES['image']['name'] != "") {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $update_filename);
                    if (file_exists("../uploads/" . $old_image)) {
                        unlink("../uploads/" . $old_image);
                    }
                }
                $_SESSION['alert'] = 'Cập nhật thành công';
                return true;
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại';
                return false;
            }

        }


    }
    public function del_blog($id)
    {
        $products_query = "SELECT * FROM products WHERE id = $id";
        $pd_q_run = $this->db->select($products_query);
        $products_data = $pd_q_run->fetch_assoc();
        $image = $products_data['image'];
        $query = "DELETE FROM products WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            if (file_exists("../uploads/" . $image)) {
                if (unlink("../uploads/" . $image)) {
                    $_SESSION['alert'] = "Xóa thành công";
                    return true;
                } else {
                    $_SESSION['alert'] = "Không thể xóa tệp tin";
                    return false;
                }
            } else {
                $_SESSION['alert'] = "Tệp tin không tồn tại";
                return false;
            }
        } else {
            $_SESSION['alert'] = 'Xóa không thành công';
            return false;
        }
    }


    public function getblogbyId($id)
    {
        $query = "SELECT * FROM tbl_blog where id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

}