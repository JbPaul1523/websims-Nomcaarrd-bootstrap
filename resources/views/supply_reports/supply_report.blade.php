<!DOCTYPE html>
<html>
<head>
    <title>Weekly Supply Report</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header img {
            width: 8rem;
            height: 8rem;
        }
        .header div {
            margin-left: 20px;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }
        .footer div {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('icons/header_logo.png') }}" alt="Logo">
        <div>
            <p>REPUBLIC OF THE PHILIPPINES</p>
            <p>Northern Mindanao Consortium for Agriculture, Aquatic and Natural Resources Research And Development (NOMCAARRD)</p>
            <p>Central Mindanao University, University Town, Musuan, Bukidnon</p>
            <p>Email address: nomcarrdcmu@gmail.com</p>
            <p>Phone: 0917-102-7065</p>
        </div>
    </div>
    <hr style="width: 80%;">
    <div style="text-align: center;">
        <p>WEEKLY REPORT AS OF {{ $report_date }}</p>
    </div>
    <div style="margin: auto; width: 80%">
        <p><i>*Note: Supplies listed below are based on this week's entry. If the supply you wish to see is not here, see other reports.</i></p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Stock</th>
                    <th>Date Acquired</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supplies as $supply)
                    <tr>
                        <td>{{ $supply->id }}</td>
                        <td>{{ $supply->name }}</td>
                        <td>{{ $supply->description }}</td>
                        <td>{{ $supply->amount }}</td>
                        <td>{{ $supply->stock }}</td>
                        <td>{{ $supply->date_acquired }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <div>
            <p>Prepared By:</p>
            <p><strong>Name of Preparer</strong></p>
        </div>
        <div>
            <p>Approved By:</p>
            <p><strong>MARIA ESTELA B. DETALLA</strong><br>Consortium Director</p>
        </div>
    </div>
</body>
</html>
