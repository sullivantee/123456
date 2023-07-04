<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="admin-main">
                <label class="admin-label">Admins</label>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo "<a class='addAdmin-btn' href='manageUser.php'><span>Add Admin</span></a>";
                    }

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='admin-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered adminDatatable">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Admin Name</th>
                            <th>Admin Username</th>
                            <th>Admin Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM admin ORDER BY 'No' ASC");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['adminID'] . "</td>";
                                echo "<td>" . $row['adminName'] . "</td>";
                                echo "<td>" . $row['adminUid'] . "</td>";
                                echo "<td>" . $row['adminEmail'] . "</td>";
                                echo "<td><a href='editAdmin.php?adminID=" . $row['adminID'] . "'>Edit</a></td>";
                                echo "<td><a href='backendphp/deleteAdmin-back.php?adminID=" . $row['adminID'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.adminDatatable').DataTable({
                "bLengthChange" : false,
                "pageLength": 6,
                "scrollY": 350,
                "paging": false,
                "info": false
            });
        </script>
    </main>
<?php
    require "footer.php";
?>