<?php
session_start();
include('usernav.php');
include('connect.php');

if (isset( $_SESSION['dash_name'])) {
    $sql = "SELECT * FROM hire_tbl WHERE name = '" . $_SESSION['dash_name'] . "'";
     $res = mysqli_query($con, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        ?>
        <div class="table-responsive">
            <table id="postTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Status</th>
                        <th scope="col">Applied</th>
                        <th scope="col">Company</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['skills']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['applied_for']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo "<p>No records found for the given ID.</p>";
    }
} else {
    echo "<p>ID not provided!</p>";
}
?>
