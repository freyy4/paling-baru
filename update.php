<?php include "head.php"; ?>
<?php session_start(); ?>
<?php include "navbar2.php"; ?>
<?php 
    $id_daftar = $_GET['id_daftar'];
    $_SESSION['id_daftar'] = $id_daftar; 
?>
<div class="container">
    <div class="col-md-12" id="stickyElement">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h2 class="card-title">Ubah Status PMI</h2>
                </div>
                <div class="preview-list">
                    <div class="card-body">
                        <form action="update2.php" method="post">
                            <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                            <label for="terima">Status Penerimaan</label>
                            <select name="terima" id="terima" class="form-control">
                                <option value="terima">Terima</option>
                                <option value="tolak">Tolak</option>
                            </select>
                            <label for="aktif">Status Aktif</label>
                            <select name="aktif" id="aktif" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select><br>
                            <input type="submit" value="Update" class="btn btn-primary" onClick="alet()">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>