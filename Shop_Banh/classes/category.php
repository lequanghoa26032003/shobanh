<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class category
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_category($data, $files, $status, $popular)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$slug = mysqli_real_escape_string($this->db->link, $data['slug']);
		$description = mysqli_real_escape_string($this->db->link, $data['description']);
		$meta_title = mysqli_real_escape_string($this->db->link, $data['meta_title']);
		$meta_description = mysqli_real_escape_string($this->db->link, $data['meta_description']);
		$meta_keywords = mysqli_real_escape_string($this->db->link, $data['meta_keywords']);
		$status = mysqli_real_escape_string($this->db->link, $status);
		$popular = mysqli_real_escape_string($this->db->link, $popular);
		$image = $_FILES['image']['name'];
		$path = "../uploads";
		$image_ext = pathinfo($image, PATHINFO_EXTENSION);
		$filename = time() . "." . $image_ext;

		if ($slug == '' || $name == "" || $description == "" || $meta_title == "" || $meta_description == "" || $meta_keywords == "") {
			$_SESSION['error'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO categories(name,slug,meta_title,image,description,meta_keywords,meta_description,status,popular) VALUES('$name','$slug','$meta_title','$filename','$description','$meta_keywords','$meta_description','$status','$popular') ";
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


	public function insert_slider($data, $files)
	{
		$sliderName = mysqli_real_escape_string($this->db->link, $data['title']);
		$status = mysqli_real_escape_string($this->db->link, $data['type']);
		$image = $_FILES['image']['name'];
		$path = "../uploads";
		$image_ext = pathinfo($image, PATHINFO_EXTENSION);
		$filename = time() . "." . $image_ext;

		if (empty($sliderName)) {
			$_SESSION['error'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO tbl_slider(sliderName,sliderImage,type) VALUES('$sliderName','$filename','$status') ";
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
	public function show_slider()
	{
		$query = "SELECT * FROM tbl_slider where type='1' order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_slider($id)
	{
		$query = "DELETE FROM tbl_slider where id='$id'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function show_slider_list()
	{
		$query = "SELECT * FROM tbl_slider order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_status_slider($id, $status)
	{

		$status = mysqli_real_escape_string($this->db->link, $status);
		$query = "UPDATE tbl_slider SET type = '$status' where id='$id'";
		$result = $this->db->update($query);
		return $result;
	}
	public function update_slide($data, $files, $id)
	{
		$sliderName = mysqli_real_escape_string($this->db->link, $data['title']);
		$status = mysqli_real_escape_string($this->db->link, $data['type']);

		$new_image = $_FILES['image']['name'];
		$old_image = $_POST['old_image'];
		if (empty($sliderName)) {
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
			$query = "UPDATE tbl_slider SET 
						sliderName ='$sliderName',
						sliderImage = '$update_filename',
						type = '$status'
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
	public function getsliderbyId($id)
	{
		$query = "SELECT * FROM tbl_slider where id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_categories_warehouse()
	{
		$query =
			"SELECT categories.*, tbl_warehouse.*

			 FROM categories INNER JOIN tbl_warehouse ON categories.id = tbl_warehouse.id_sanpham

			 order by tbl_warehouse.sl_ngaynhap desc ";


		$result = $this->db->select($query);
		return $result;
	}
	public function show_category()
	{
		$query = "SELECT * FROM categories order by id desc";
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


	public function update_category($data, $files, $id, $status, $popular)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$slug = mysqli_real_escape_string($this->db->link, $data['slug']);
		$description = mysqli_real_escape_string($this->db->link, $data['description']);

		$meta_title = mysqli_real_escape_string($this->db->link, $data['meta_title']);
		$meta_description = mysqli_real_escape_string($this->db->link, $data['meta_description']);
		$meta_keywords = mysqli_real_escape_string($this->db->link, $data['meta_keywords']);
		$status = mysqli_real_escape_string($this->db->link, $status);
		$popular = mysqli_real_escape_string($this->db->link, $popular);

		$new_image = $_FILES['image']['name'];
		$old_image = $_POST['old_image'];
		if ($slug == '' || $name == "" || $description == "" || $meta_title == "" || $meta_description == "" || $meta_keywords == "") {
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
			$query = "UPDATE categories SET 
						name ='$name',
						slug = '$slug',
						description = '$description',
						meta_title = '$meta_title',
						meta_description = '$meta_description',
						meta_keywords = '$meta_keywords',
						image = '$update_filename',
						status = '$status',
						popular = '$popular'
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
	public function del_category($id)
	{
		$categories_query = "SELECT * FROM categories WHERE id = $id";
		$pd_q_run = $this->db->select($categories_query);
		$categories_data = $pd_q_run->fetch_assoc();
		$image = $categories_data['image'];
		$query = "DELETE FROM categories WHERE id = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			if (file_exists("../uploads/" . $image)) {
				if (unlink("../uploads/" . $image)) {
					$_SESSION['alert'] = "Xóa thành công";
					return true;
				} else {
					$_SESSION['error'] = "Không thể xóa tệp tin";
					return false;
				}
			} else {
				$_SESSION['error'] = "Tệp tin không tồn tại";
				return false;
			}
		} else {
			$_SESSION['error'] = 'Xóa không thành công';
			return false;
		}
	}


	public function getcategorybyId($id)
	{
		$query = "SELECT * FROM categories where id = '$id' ";
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