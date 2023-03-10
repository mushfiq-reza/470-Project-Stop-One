<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
    <!DOCTYPE html>
    <html>
    <?php
    include_once './partials/head.php';
    ?>

    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i></i>
                <a href="salesman-home.php" class="logo_name">Stop One</a>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="salesman-home.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>

                    </a>
                </li>
                <li>
                    <a href="list-customers.php" class="active">
                        <i class='bx bx-box'></i>
                        <span class="links_name">List Customers</span>
                    </a>
                </li>
                </li>
                <li>
                    <a href="create-bill.php">
                        <i class='bx bx-box'></i>
                        <span class="links_name">Bill</span>
                    </a>
                </li>
                </li>
                <li class="log_out">
                    <a href="logout.php">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Log out</span>
                    </a>
                </li>
            </ul>
        </div>


        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class='bx bx-menu sidebarBtn'></i>
                    <span class="dashboard">Dashboard</span>
                    <span class="dashboard">
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col-6">

                                </div>
                                <div class="col">
                                    <b>
                                        <h5 style="font-family: 'Kanit', sans-serif;"> { Hello, <?php echo $_SESSION['name']; ?> }</h5>

                                    </b>
                                </div>
                            </div>

                        </div>

                    </span>
                </div>

            </nav>

            <div class="home-content">
                <div class="overview-boxes">

                    <div class="cardMod">
                        <h4>List of Customers </h4>
                        <a href="add-customer.php" class="addDriver"> + Create </a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once './model/db_conn.php';
                                $sql = "SELECT * FROM customer";
                                $i = 1;
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<th scope='row'>$i</th>";
                                        echo "<td>" . $row["customer_id"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["address"] . "</td>";
                                        echo "<td>";
                                        $sql2 = "SELECT phone_numbers FROM customer,customer_phonenumbers WHERE customer.customer_id=customer_phonenumbers.customer_id AND customer_phonenumbers.customer_id='" . $row["customer_id"] . "'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo $row2["phone_numbers"] . "<br>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>
      <div class='dropdown'>
      <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>
      <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
          <a class='dropdown-item' href='./controller/delete-cus.php?id=" . $row["customer_id"] . "'>Delete</a>
      </div>
  </div>
      </td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                let sidebar = document.querySelector(".sidebar");
                let sidebarBtn = document.querySelector(".sidebarBtn");
                sidebarBtn.onclick = function() {
                    sidebar.classList.toggle("active");
                    if (sidebar.classList.contains("active")) {
                        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                    } else
                        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            </script>




    </body>

    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>