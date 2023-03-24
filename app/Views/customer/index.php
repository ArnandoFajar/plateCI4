<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />


</head>

<body>
    <h1>Data Customer</h1>

    <table id="table" class="stripe" style="width:100%">
        <thead style="background-color: #85d0e3;">
            <tr>
                <th>NO</th>
                <th>Name</th>
                <th>Phone</th>
                <th>City</th>
                <th>Country</th>
                <th>EmployeeName</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('getcustomers'); ?>'
            });
        });
    </script>
</body>

</html>