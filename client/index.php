<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Toko</title>

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
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create Data</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">Data Barang</h2>
                <?php
                $delete = isset($_GET['delete']) ? (int) $_GET['delete'] : 0;
                if (!empty($delete)) {
                    $urldel = 'http://localhost:8080/server/webresources/controller/deleteData/' . $delete;
                    // mengkonversi inputan menjadi json
                    $ch = curl_init($urldel);
                    // melakukan permintaan request ke method DELETE
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                    // mengatur header HTTP
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    // eksekusi request
                    $result = curl_exec($ch);
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fa fa-check-circle" style="font-size:24px"></i>&nbsp;&nbsp;Berhasil menghapus data dengan id : ' . $delete . '
                        </div>';
                }
                ?>
                <table class="table table-striped table-hover">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th class="col-lg-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $url = 'http://localhost:8080/server/webresources/controller/getData';
                        $konten = file_get_contents($url);
                        // mengubah file json menjadi array
                        $data = json_decode($konten, true);

                        foreach ($data as $key => $value) {
                            echo '
                                <tr>
                                    <td>' . $value['id'] . '</td>
                                    <td>' . $value['nama'] . '</td>
                                    <td>' . $value['stok'] . '</td>
                                    <td>' . $value['harga'] . '</td>
                                    <td>
                                        <a class="btn btn-warning text-white btn-sm" href="update.php?id=' . $value['id'] . '"><i class="fa fa-edit"></i> Update</a>
                                        &nbsp;
                                        <a class="btn btn-danger btn-sm" href="index.php?delete=' . $value['id'] . '"><i class="fa fa-trash-o"></i> Delete</a>
                                    </td>
                                </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>