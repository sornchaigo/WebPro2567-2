<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: calc(100% - 30px);
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

        #page {
            display: grid;
            width: calc(100% - 10px);
            grid-template:
                [header-left] "head head" 30px [header-right] [main-left] "nav  main" 1fr [main-right] [footer-left] "nav  foot" 30px [footer-right] / 120px 1fr;
        }

        .header {
            background-color: lime;
            grid-area: head;
        }

        .nav {
            background-color: lightblue;
            grid-area: nav;
        }

        .main {
            grid-area: main;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .footer {
            background-color: red;
            grid-area: foot;
        }

        .content {
            margin: 15px;
        }

        .hide {
            display: none;
        }

        .show {
            display: block;
            padding: 15px;
        }
    </style>
</head>

<body id="page">
    <div class="nav">
        <div>
            <a href="#customer_list">
                <button>Customer</button>
            </a>
        </div>
        <div>
            <a href="#menu_list">
                <button>menu</button>
            </a>
        </div>
    </div>

    <div class="main">
        <table class="content" id="customer_list">
            <caption>
                <h1>Customer List</h1>
            </caption>
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>city</th>
                    <th width="100">
                        <button onclick="showAddCustomer()">Add</button>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div id="customer_add" class="hide content">
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
                <button onclick="addCustomer()">Confirm</button>
            </div>
            <br>
        </div>
        <div id="customer_edit" class="hide content">
            <h3>Edit Customer</h3>
            <input type="hidden" id="edit_customer_id">
            <div>
                <label for="">Name</label>
                <input type="text" id="edit_customer_name">
            </div>
            <div>
                <label for="">City</label>
                <input type="text" id="edit_customer_city">
            </div>
            <div>
                <button onclick="sendEditCustomer()">Comfirm</button>
            </div>
        </div>
        <br>
        <hr><br>

        <table class="content" id="menu_list">
            <caption>
                <h1>Menu List</h1>
            </caption>
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>price</th>
                    <th width="100">
                        <button onclick="showAddMenu()">Add</button>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div id="menu_add" class="hide content">
            <h3>Add Menu</h3>
            <div>
                <label for="">Name</label>
                <input type="text" id="menu_name">
            </div>
            <div>
                <label for="">Price</label>
                <input type="number" id="price">
            </div>
            <div>
                <button onclick="addMenu()">Confirm</button>
            </div>
            <br>
        </div>
        <div id="menu_edit" class="hide content">
            <h3>Edit Menu</h3>
            <input type="hidden" id="edit_menu_id">
            <div>
                <label for="">Name</label>
                <input type="text" id="edit_menu_name">
            </div>
            <div>
                <label for="">Price</label>
                <input type="number" id="edit_price">
            </div>
            <div>
                <button onclick="sendEditMenu()">Confirm</button>
            </div>
            <br>
        </div>
    </div>
</body>

<script>


    async function loadCustomer() {
        let url = 'customer.php?list';
        let response = await fetch(url);        // method GET
        let customer_list = await response.json();

        let customer_table = document.querySelector('#customer_list tbody');

        let tbody = '';
        for (let customer of customer_list) {
            tbody += `<tr id="customer_${customer.id}"><td>${customer.id}</td>
                        <td >${customer.name}</td>
                        <td>${customer.city}</td>
                        <td>
                            <button onclick="editCustomer(${customer.id})">Edit</button>
                            <button onclick="deleteCustomer(${customer.id}, '${customer.name}')">Delete</button>
                        </td>
                      </tr>`;
        }
        customer_table.innerHTML = tbody;
        window.location.href = "#customer_list";
    }

    function showAddCustomer() {
        let customer_add = document.querySelector("#customer_add");
        let customer_edit = document.querySelector("#customer_edit");
        customer_add.classList.remove("hide");
        customer_edit.classList.add("hide");
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

    async function editCustomer(id) {
        let customer_add = document.querySelector("#customer_add");
        let customer_edit = document.querySelector("#customer_edit");
        customer_add.classList.add("hide");
        customer_edit.classList.remove("hide");

        console.log(`Call edit customer_${id}`);
        // let row = document.querySelector( `#customer_${id}` );
        // let cell = row.querySelectorAll( "td" );
        let cell = document.querySelectorAll(`#customer_${id} td`)
        console.log(cell);

        let edit_customer_id = document.querySelector("#edit_customer_id");
        let edit_customer_name = document.querySelector("#edit_customer_name");
        let edit_customer_city = document.querySelector("#edit_customer_city");

        edit_customer_id.value = id;
        edit_customer_name.value = cell[1].innerText;
        edit_customer_city.value = cell[2].innerText;
    }

    async function sendEditCustomer() {
        let edit_customer_id = document.querySelector("#edit_customer_id");
        let edit_customer_name = document.querySelector("#edit_customer_name");
        let edit_customer_city = document.querySelector("#edit_customer_city");
        let customer_data = {
            id: edit_customer_id.value,
            name: edit_customer_name.value,
            city: edit_customer_city.value,
        }

        let url = 'customer.php';
        let response = await fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(customer_data)
        });        // method PUT
        loadCustomer();
    }

    async function deleteCustomer(id, name) {

        result = confirm(`คุณต้องการลบข้อมูลลูกค้า ${name} หรือไม่`);
        if ( !result )
            return;
        
        let url = 'customer.php';
        let response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({id: id})
        });        // method DELETE
        loadCustomer();
    }

    async function loadMenu() {
        let url = 'menu.php?list';
        let response = await fetch(url);
        let menu_list = await response.json();

        let menu_table = document.querySelector('#menu_list tbody');

        let tbody = '';
        for (let menu of menu_list) {
            tbody += `<tr id="menu_${menu.menu_id}"><td>${menu.menu_id}</td>
                            <td>${menu.menu_name}</td>
                            <td>${menu.price}</td>
                            <td><button onclick="editMenu(${menu.menu_id})">Edit</button></td>
                            </tr>`;
        }
        menu_table.innerHTML = tbody;
        window.location.href = "#menu_list";
    }

    function showAddMenu() {
        let menu_add = document.querySelector("#menu_add");
        let menu_edit = document.querySelector("#menu_edit");
        menu_add.classList.remove("hide");
        menu_edit.classList.add("hide");
    }

    async function addMenu() {
        let menu_name = document.querySelector('#menu_name');
        let price = document.querySelector('#price');
        let menu_data = {
            menu_name: menu_name.value,
            city: price.value,
        }

        let url = 'menu.php';
        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(menu_data)
        });        // method POST
        loadMenu();
    }

    async function editMenu(id) {
        let menu_add = document.querySelector("#menu_add");
        let menu_edit = document.querySelector("#menu_edit");
        menu_add.classList.add("hide");
        menu_edit.classList.remove("hide");

        console.log(`Call edit menu_${id}`);
        // // let row = document.querySelector( `#customer_${id}` );
        // // let cell = row.querySelectorAll( "td" );
        let cell = document.querySelectorAll(`#menu_${id} td`);
        // console.log(cell);

        let edit_menu_id = document.querySelector("#edit_menu_id");
        let edit_menu_name = document.querySelector("#edit_menu_name");
        let edit_price = document.querySelector("#edit_price");

        edit_menu_id.value = id;
        edit_menu_name.value = cell[1].innerText;
        edit_price.value = cell[2].innerText;
    }
    
    async function sendEditMenu() {
        let edit_menu_id = document.querySelector("#edit_menu_id");
        let edit_menu_name = document.querySelector("#edit_menu_name");
        let edit_price = document.querySelector("#edit_price");
        let menu_data = {
            id: edit_menu_id.value,
            menu_name: edit_menu_name.value,
            price: edit_price.value,
        }

        let url = 'menu.php';
        let response = await fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(menu_data)
        });        // method POST
        loadMenu();
    }

    window.addEventListener('load', function () {
        loadMenu();
        loadCustomer();
    })
</script>

</html>