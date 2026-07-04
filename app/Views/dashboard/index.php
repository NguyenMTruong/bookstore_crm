<h1>Dashboard</h1>

<p>
    Welcome,
    <strong><?= e($_SESSION['user_name']) ?></strong>
</p>

<hr>

<table border="1" cellpadding="10">

    <tr>

        <th>Total Customers</th>

        <td><?= $statistics['customers'] ?></td>

    </tr>

    <tr>

        <th>Total Orders</th>

        <td><?= $statistics['orders'] ?></td>

    </tr>

    <tr>

        <th>Pending Orders</th>

        <td><?= $statistics['pending'] ?></td>

    </tr>

    <tr>

        <th>Completed Orders</th>

        <td><?= $statistics['completed'] ?></td>

    </tr>

</table>

<br>

<form method="POST" action="/logout">
    <button>
        Logout
    </button>
</form>

