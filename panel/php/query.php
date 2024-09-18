<?php
include('connection.php');
$catImageAdress = "img/categories/";
// categories

if(isset($_POST['addCategory'])){
    $catName = $_POST['categoryName'];
$catImage = $_FILES['categoryImage']['name'];
$catTmpName = $_FILES['categoryImage']['tmp_name'];
$extension = pathinfo($catImage,PATHINFO_EXTENSION);
$des = 'img/categories/'.$catImage;
if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp"){
    if(move_uploaded_file($catTmpName,$des)){
        $query = $pdo -> prepare("insert into categary (catName,catImage) values(:pn,:pi)");
        $query->bindParam("pn",$catName);
        $query->bindParam("pi",$catImage);
        $query->execute();
        echo "<script>alert('category added')</script>";

    }
}
}
// category update
if(isset($_POST['updateCategory'])){
 $cid = $_POST['catId'];      
 $catName = $_POST['categoryName'];
if(!empty($_FILES['categoryImage']['name'])){
    $catImage = $_FILES['categoryImage']['name'];
$catTmpName = $_FILES['categoryImage']['tmp_name'];
$extension = pathinfo($catImage,PATHINFO_EXTENSION);
$des = 'img/categories/'.$catImage;
if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "webp"){
    if(move_uploaded_file($catTmpName,$des)){
        $query = $pdo -> prepare("update categary set catName = :pn, catImage = :pi where catId = :pid");
        $query->bindParam("pid",$cid);
        $query->bindParam("pn",$catName);
        $query->bindParam("pi",$catImage);
        $query->execute();
        echo "<script>alert('category update');
        location.assign('viewcategory.php')
        </script>";

    }
}
}else{
    $query = $pdo -> prepare("update categary set catName = :pn where catId = :pid");
    $query->bindParam("pid",$cid);
    $query->bindParam("pn",$catName);
    $query->execute();
    echo "<script>alert('category update');
    location.assign('viewcategory.php')
    </script>";
}
}
// delete categories
if(isset($_GET['catDelete'])){
    $catId = $_GET['catDelete'];
    $query = $pdo->prepare("delete from categary where catId = :pid");
    $query->bindParam("pid",$catId);
    $query->execute();
    echo "<script>
    alert('category deleted from table');
    location.assign('viewcategory.php')
    </script>";
}

?>