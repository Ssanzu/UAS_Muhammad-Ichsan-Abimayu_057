<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/main.php';
$userObj   = new User();
$query = mysqli_query($userObj->getConnect(), "SELECT * FROM tb_user");


$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            User
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddUser">Add User</button>
                </div>
            </div>

            <!-- Modal Add user-->
            <div class="modal fade" id="ModalAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
<div class="modal-body">
                            <form action="process/input_user.php" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="name" required>
                                            <label for="floatingInput">Nama</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="Your Username" name="username" required>
                                            <label for="floatingInput">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingInput" placeholder="Your Password" disabled value="a" name="password">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_user_validate" value="1234">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal View -->
            <?php
            foreach ($result as $row) {
            ?>
                <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
<form action="process/input_user.php" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="name"
                                                    value="<?php echo $row['nama']; ?>" disabled>
                                                <label for="floatingInput">Nama</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="Your Username" name="username"
                                                    value="<?php echo $row['username']; ?>" disabled>
                                                <label for="floatingInput">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
<form action="process/edit_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="name"
                                                    value="<?php echo $row['nama']; ?>" required
                                                    <?php echo ($row['username'] == $_SESSION['username_sanzubooking']) ? 'disabled' : ''; ?>>
                                                <label for="floatingInput">Nama</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="Your Username" name="username"
                                                    value="<?php echo $row['username']; ?>" required
                                                    <?php echo ($row['username'] == $_SESSION['username_sanzubooking']) ? 'disabled' : ''; ?>>
                                                <label for="floatingInput">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit_user_validate" value="1234">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="process/delete_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="col-lg-12">
                                        <?php if ($row['username'] == $_SESSION['username_sanzubooking']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun yang sedang digunakan!</div>";
                                        } else {
                                            echo "Apakah anda yakin ingin menghapus <b>$row[nama] </b>?";
                                        }  ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_user_validate" value="1234"
                                            <?php echo ($row['username'] == $_SESSION['username_sanzubooking']) ? 'disabled' : ''; ?>>Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
 
            <?php
            }
            if (empty($result)) {
                echo "<div class='alert alert-danger'>Data User Tidak Ditemukan</div>";
            } else {
                $no = 1;
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#ModalView<?php echo $row['id'] ?>">
                                            <i class="bi bi-eye"></i></button>
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>