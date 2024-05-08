<?php
include 'includes/header.php';
include '../classes/category.php';
?>
<?php
$category = new category();
if (!isset($_GET['id']) || $_GET['id'] == null) {
    echo "<script>window.location='categorys.php';</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $upcategory = $category->update_category($_POST, $_FILES, $id, $status, $popular);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4">Sửa loại sản phẩm</span>
                </div>

                <div class="card-body">
                    <?php $getpd = $category->getcategorybyId($id);
                    if ($getpd) {
                        while ($result = $getpd->fetch_assoc()) {
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input placeholder="Nhập tên sản phẩm" value="<?= $result['name'] ?>" id="name" $
                                            name="name" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug">Slug</label>
                                        <input placeholder="Nhập Slug" id="slug" value="<?= $result['slug'] ?>" name="slug"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="des">Description</label>
                                        <input placeholder="Nhập tên sản phẩm" id="des" value="<?= $result['description'] ?>"
                                            name="description" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="image">Upload Image</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Image</label>
                                        <input type="hidden" name="old_image" value="<?= $result['image'] ?>">
                                        <img style="height:70px; width:70px;" src="../uploads/<?= $result['image'] ?>" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="mttitle">Meta Title</label>
                                        <input placeholder="Nhập tên sản phẩm" id="mttitle" value="<?= $result['meta_title'] ?>"
                                            name="meta_title" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="mtdes">Meta Description</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="mtdes" name="meta_description" type="text"
                                            class="form-control"><?= $result['meta_description'] ?></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="mtkey">Meta Keywords</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="mtkey" name="meta_keywords" type="text"
                                            class="form-control"><?= $result['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <input id="status" <?= $result['status'] == '1' ? 'checked' : '' ?> name="status"
                                            type="checkbox">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="popular">Popular</label>
                                        <input id="popular" <?= $result['popular'] == '1' ? 'checked' : '' ?> name="popular"
                                            type="checkbox">
                                    </div>
                                    <div class="ct-example"
                                        style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                        <a href="category.php" class="btn btn-primary">Trở về</a>
                                        <button name="submit" class="btn btn-icon btn-3 btn-secondary" type="submit">
                                            Cập nhật
                                        </button>

                                    </div>
                                </div>

                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>