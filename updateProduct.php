<?php 

include 'functions.php';

$id = $_GET['id'];
$data = fetchData("SELECT * FROM product WHERE id = $id")[0];
var_dump($data['desc']);

$categories = fetchData("SELECT * FROM categories");

if (isset($_POST['submit'])) {
    $gambarLama = $data['image'];
 
    if (updateProduct($_POST, $gambarLama) >= 1) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'CPanel.php';
            </script>";

    } else {
        echo "Ada";
    }
}

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Product</title>
</head>
<body>

    <form method="post" enctype="multipart/form-data">
        <!-- mengirim id untuk di Set Database nya (TYPE HIDDEN) -->
        <input type="text" name="id" value="<?= $id ?>" hidden="">

        <!-- Munculin Gambar sesuai Nama di database -->
        <img src="img/<?= $data['image'] ?>" width="150">

        <!-- Kalo mau ngubah gambar -->
        <input type="file" name="gambarBaru">

        <br>

        <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="name">

        <br>

        <!-- Pemilihan Categorie -->
        <select class="selectUpdate" name="categorie">
            <?php foreach($categories as $categorie): ?>
                <option><?= $categorie['categories']; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Deskripsi -->
        <input type="text" name="desc" value="<?= $data['desc']; ?>" placeholder="Description">

        <!-- Price -->
        <input type="number" name="price" value="<?= $data['price']; ?>">

        <button type="reset">Reset</button>
        <button type="submit" name="submit">Submit</button>

    </form>

<script type="text/javascript">
    const selects = document.querySelectorAll('select.selectUpdate option');
    selects.forEach( select => {
        if (select.innerHTML === "<?= $data['categories'] ?>") {
            select.setAttribute('selected', '');
        }
    })
</script>
</body>
</html>