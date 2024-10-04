<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard</title>
        <style>
            body {
                font-family: "Courier New", Courier, monospace;
            }

            #navbar {
                background-color: #333;
                overflow: hidden;
            }

            #navbar ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                float: right;
            }

            #navbar ul li {
                float: left;
            }

            #navbar ul li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 20px;
                text-decoration: none;
            }

            #navbar ul li a:hover {
                background-color: #111;
            }

            #navbar .navbar-name {
                float: left;
                color: white;
                padding: 14px 20px;
                font-size: 18px;
            }

            #table {
                margin: 20px auto;
                width: 80%;
                text-align: center;
            }

            #create-brand-btn {
                display: inline-block;
                margin-bottom: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }

            #create-brand-btn:hover {
                background-color: #0056b3;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }

            table th,
            table td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: center;
            }

            table th {
                background-color: #f2f2f2;
            }

            table tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            table tr:hover {
                background-color: #f1f1f1;
            }

            .edit-btn {
                padding: 8px 12px;
                background-color: #28a745;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }

            .edit-btn:hover {
                background-color: #218838;
            }

            .delete-btn {
                padding: 8px 12px;
                background-color: #dc3545;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }

            .delete-btn:hover {
                background-color: #c82333;
            }
        </style>
    </head>
    <body>
        <div id="navbar">
            <div class="navbar-name">
                {{ session("name", "Your Name") }}
            </div>
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/units">Units</a></li>
                <li>
                    <a href="/logout" style="background-color: red">Logout</a>
                </li>
            </ul>
        </div>

        <div id="table">
            <a href="/create-brand" id="create-brand-btn">Create New Brand</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Country</th>
                        <th>ID Legal</th>
                        <th>Establish Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id_brand }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->country }}</td>
                        <td>{{ $brand->id_legal }}</td>
                        <td>{{ $brand->establish_date }}</td>
                        <td>
                            <a
                                href="/edit-brand/{{ $brand->id_brand }}"
                                class="edit-btn"
                                >Edit</a
                            >
                            <form
                                action="{{ route('delete-brand-action', ['id_brand' => $brand->id_brand]) }}"
                                method="POST"
                                style="display: inline-block"
                            >
                                @csrf @method('DELETE')
                                <button
                                    type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this brand?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($brands->isEmpty())
            <p>No brands found.</p>
            @endif
        </div>
    </body>
</html>
