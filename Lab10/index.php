<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</body>

<script>
    async function loadCustomer () {
        let url = 'http://localhost/Lab10/customer.php?list';
        let response = await fetch(url);
        let customer_list = await response.json();
        // let data =  await response.text();
        
        let customer_table = document.querySelector( '#customer_list tbody' );
        
        let tbody = '';
        for (let customer of customer_list ) {
            console.log( customer );
            // tbody +=  `<tr><td>${customer.id}</td>
            //                 <td>${customer.name}</td>
            //                 <td>${customer.city}</td></tr>`;
            tbody += "<tr><td>"+customer.id+"</td><td>"
                    +customer.name+"</td><td>"
                    +customer.city+"</td><tr>";
        }
        customer_table.innerHTML = tbody;
    }
    window.addEventListener('load', function () {
        loadCustomer();
    })
</script>

</html>