<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand ml-3" href="index.php">DATABASE TOKO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto mr-5 px-3">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create Data</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <?php
                $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
                if (isset($_POST['update'])) {
                    $update = array(
                        "id" => $id,
                        "nama" => $_POST['nama'],
                        "stok" => $_POST['stok'],
                        "harga" => $_POST['harga']
                    );

                    $urlupdate = 'http://localhost:8080/server/webresources/controller/updateData';
                    // mengkonversi inputan menjadi json
                    $ch = curl_init($urlupdate);
                    //mengubah array menjadi json
                    $dataencode = json_encode($update);
                    // melakukan permintaan request ke method PUT
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    // menampung data dan parameter yang akan dikirimkan
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataencode);
                    // mengatur header HTTP
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    // eksekusi request
                    $result = curl_exec($ch);
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fa fa-check-circle" style="font-size:24px"></i>&nbsp;&nbsp;Data Berhasil diupdate : ' . $update['nama'] . ' - ' . $update['stok'] . ' - ' . $update['harga'] . '

                        </div>';
                }
                ?>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center">Update Data</h3>
                    </div>
                    <div class="card-body px-5 mt-3">
                        <?php
                        $url = 'http://localhost:8080/server/webresources/controller/getData/' . $id;
                        $konten = file_get_contents($url);
                        // mengubah file json menjadi array
                        $data = json_decode($konten, true);

                        // mengembalikan fungsi jumlah elemen dalam array
                        if (sizeof($data) > 0) {
                        ?>
                            <form method="POST">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">ID</label>
                                    <div class="col-md-9">
                                        <input type="number" name="id" class="form-control" value="<?php echo $data['id']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label">Stok</label>
                                    <div class="col-md-9">
                                        <input type="number" name="stok" class="form-control" value="<?php echo $data['stok']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 col-form-label">Harga</label>
                                    <div class="col-md-9">
                                        <input type="number" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                                        <a href="index.php" class="btn btn-outline-secondary">Back</a>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>