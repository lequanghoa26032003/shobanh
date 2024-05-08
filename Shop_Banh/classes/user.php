<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/session.php');
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>



<?php
/**
 * 
 */
class user
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function login_user($email, $pass)
	{
		$email = $this->fm->validation($email);
		$pass = $this->fm->validation($pass);

		$email = mysqli_real_escape_string($this->db->link, $email);
		$pass = mysqli_real_escape_string($this->db->link, $pass);

		if (empty($email) || empty($pass)) {
			$_SESSION['error'] = "Tài khoản và mật khẩu không được để trống";
			return false;
		} else {
			$query = "SELECT * FROM users WHERE email = '$email' AND pass = '$pass' LIMIT 1 ";
			$result = $this->db->select($query);

			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set('auth', true);
				Session::set('id', $value['id']);
				Session::set('email', $value['email']);
				Session::set('name', $value['name']);

				$_SESSION['alert'] = "Đăng nhập thành công";
				return true;
			} else {
				$_SESSION['error'] = "Tài khoản hoặc mật khẩu không chính xác";
				return false;
			}
		}

	}

	public function register_user($data)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));
		$cpass = mysqli_real_escape_string($this->db->link, md5($data['cpass']));
		$check_mail = "SELECT email FROM users WHERE email='$email'";
		$check_query = $this->db->select($check_mail);
		if ($check_query !== false && mysqli_num_rows($check_query) > 0) {
			$_SESSION['error'] = "Email đã tồn tại";
			header('Location:register.php');
			return false;
		} else {
			if (empty($name) || empty($email) || empty($pass)) {
				$_SESSION['error'] = "Không được để trỗng";
				return false;
			} else {
				if ($pass == $cpass) {
					$insert = "INSERT INTO users(name,email,pass) VALUES ('$name','$email','$pass')";
					$query = mysqli_query($this->db->link, $insert);
					if ($query) {
						$_SESSION['alert'] = "Đăng kí thành công";
						return true;
					} else {
						$_SESSION['error'] = "Đã xảy ra sự cố";
						return false;
					}
				} else {
					$_SESSION['error'] = "Mật khẩu khác nhau hãy nhập lại";

					return false;
				}
			}
		}

	}
	public function change_pass_user($data)
	{
		$passold = mysqli_real_escape_string($this->db->link, md5($data['passold']));
		$passnew = mysqli_real_escape_string($this->db->link, md5($data['passnew']));
		if ($passold == "" || $passnew == "") {
			$_SESSION['alert'] = "không được để trống";
			return true;
		} else {
			$query = "SELECT * FROM users WHERE pass='$passold'";
			$result_check = $this->db->select($query);
			if ($result_check == false) {
				$_SESSION['alert'] = "Mât khẩu sai hoặc mục đang để trống,làm ơn nhập lại";
				return true;
			}
			$query1 = "UPDATE users SET pass='$passnew' WHERE pass ='$passold'";
			$result = $this->db->insert($query1);
			if ($result) {
				$_SESSION['alert'] = 'Đã cập nhật thành công';
				return true;
			} else {
				$_SESSION['alert'] = "Cập nhật không thành công";
				return false;
			}
		}

	}
	public function get_user($id)
	{
		$query = "SELECT * FROM users WHERE id='$id' ";
		$result = $this->db->select($query);
		return $result;


	}
	public function update_user($data, $files)
	{
		$id = mysqli_real_escape_string($this->db->link, $data['id']);
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$new_image = $_FILES['image']['name'];
		$old_image = $_POST['old_image'];
		if ($new_image != "") {
			$image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
			$update_filename = time() . "." . $image_ext;

		} else {
			$update_filename = $old_image;
		}
		$path = "uploads";
		$query = "UPDATE users SET name='$name',phone='$phone', email='$email', address='$address',image='$update_filename' WHERE id ='$id' ";
		$result = $this->db->update($query);
		if ($result) {
			if ($_FILES['image']['name'] != "") {
				move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $update_filename);
				if (file_exists("uploads/" . $old_image)) {
					unlink("uploads/" . $old_image);
				}
			}
			$_SESSION['alert'] = 'Cập nhật thành công';
			return true;
		} else {
			$_SESSION['alert'] = 'Cập nhật thất bại';
			return false;
		}


	}
	public function insert_comment($user_id, $prod_id, $cmt)
	{
		if (empty($cmt)) {
			$_SESSION['alert'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO tbl_comments(user_id,prod_id,cmt) VALUES ('$user_id','$prod_id','$cmt') ";
			$result = $this->db->insert($query);
			if ($result) {
				$_SESSION['alert'] = 'Đã gửi bình luận của bạn đến admin';
				return true;
			} else {
				$_SESSION['alert'] = 'Đã xảy ra lỗi';
				return false;
			}
		}
	}



}
?>