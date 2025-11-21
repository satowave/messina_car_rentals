<?php
require "includes/common.php";
session_start();
if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
    header('location:index.php');
    exit();
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $price=(int)$_POST['price'];
    $category_id=(int)$_POST['category_id'];
    $redirect=$_POST['redirect'];

    $image_name='';
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error']===UPLOAD_ERR_OK){
        $image_tmp = $_FILES['image_file']['tmp_name'];
        $image_name = basename($_FILES['image_file']['name']);

        $images_dir = __DIR__ . '/images';
        if(!is_dir($images_dir)){
            mkdir($images_dir, 0777, true);
        }

        $destination = $images_dir . '/' . $image_name;
        move_uploaded_file($image_tmp, $destination);
    }

    $query="INSERT INTO products(name,price,category_id,image) VALUES('$name',$price,$category_id,'$image_name')";
    mysqli_query($con,$query) or die(mysqli_error($con));
    if($category_id!=1){
        $query_all="INSERT INTO products(name,price,category_id,image) VALUES('$name',$price,1,'$image_name')";
        mysqli_query($con,$query_all) or die(mysqli_error($con));
    }
    header('location:'. $redirect);
    exit();
}
$category_id=isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;
$redirect=$_SERVER['HTTP_REFERER'] ?? 'products.php';
$categories=mysqli_query($con,"SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="p-4">
<h3>Add New Product</h3>
<form method="post" action="add_product.php" enctype="multipart/form-data">
    <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">
    <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <?php while($cat=mysqli_fetch_assoc($categories)){ ?>
            <option value="<?php echo $cat['category_id']; ?>" <?php echo $cat['category_id']==$category_id?'selected':''; ?>><?php echo htmlspecialchars($cat['category_name']); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="image_file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo htmlspecialchars($redirect); ?>" class="btn btn-secondary">Cancel</a>
</form>
</body>
</html>
