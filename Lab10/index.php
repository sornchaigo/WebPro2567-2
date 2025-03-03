<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px
        }

        table th:first-child {
            width: 100px;
        }
    </style>
</head>

<body>
    <table id="customer_list">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>city</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div>
        <h3>Add Customer</h3>
        <div>
            <label for="">Name</label>
            <input type="text" id="customer_name">
        </div>
        <div>
            <label for="">City</label>
            <input type="text" id="customer_city">
        </div>
        <div>
            <button onclick="addCustomer()">Add</button>
        </div>
    </div>
    <br>
    <hr><br>

    <table id="menu_list">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</body>

<script>

    async function loadCustomer() {
        let url = 'customer.php?list';
        let response = await fetch(url);        // method GET
        let customer_list = await response.json();

        let customer_table = document.querySelector('#customer_list tbody');

        let tbody = '';
        for (let customer of customer_list) {
            console.log(customer);
            // tbody +=  `<tr><td>${customer.id}</td>
            //                 <td>${customer.name}</td>
            //                 <td>${customer.city}</td></tr>`;
            tbody += "<tr><td>" + customer.id + "</td><td>"
                + customer.name + "</td><td>"
                + customer.city + "</td><tr>";
        }
        customer_table.innerHTML = tbody;
    }


    async function loadMenu() {
        let url = 'menu.php?list';
        let response = await fetch(url);
        let menu_list = await response.json();

        let menu_table = document.querySelector('#menu_list tbody');

        let tbody = '';
        for (let menu of menu_list) {
            console.log(menu);
            tbody += `<tr><td>${menu.menu_id}</td>
                            <td>${menu.menu_name}</td>
                            <td>${menu.price}</td></tr>`;
        }
        menu_table.innerHTML = tbody;
    }

    async function addCustomer() {
        let customer_name = document.querySelector('#customer_name');
        let customer_city = document.querySelector('#customer_city');
        let customer_data = {
            name: customer_name.value,
            city: customer_city.value,
        }

        let url = 'customer.php';
        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(customer_data)
        });        // method POST
        loadCustomer();

    }

    window.addEventListener('load', function () {
        loadCustomer();
        loadMenu();
    })
</script>

</html>