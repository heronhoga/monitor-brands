<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Brand</title>
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

            #form-container {
                margin: 50px auto;
                width: 50%;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            form {
                display: flex;
                flex-direction: column;
            }

            label {
                font-weight: bold;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="date"],
            select {
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-family: "Courier New", Courier, monospace;
                font-size: 16px;
            }

            button {
                padding: 10px 15px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
            }

            button:hover {
                background-color: #218838;
            }

            .cancel-btn {
                background-color: #dc3545;
                margin-left: 10px;
            }

            .cancel-btn:hover {
                background-color: #c82333;
            }

            .button-container {
                display: flex;
                justify-content: flex-start;
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

        <div id="form-container">
            <h2>Edit Brand</h2>
            <form action="{{ route('edit-brand-action', ['id_brand' => $brand->id_brand]) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Brand Name:</label>
                <input type="text" id="name" name="name" value="{{ $brand->name }}" required>

                <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="">Select a country</option>
                    <option value="US" {{ $brand->country == 'US' ? 'selected' : '' }}>United States</option>
                    <option value="UK" {{ $brand->country == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="Canada" {{ $brand->country == 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Australia" {{ $brand->country == 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="Germany" {{ $brand->country == 'Germany' ? 'selected' : '' }}>Germany</option>
                    <option value="France" {{ $brand->country == 'France' ? 'selected' : '' }}>France</option>
                    <option value="India" {{ $brand->country == 'India' ? 'selected' : '' }}>India</option>
                    <option value="Japan" {{ $brand->country == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="China" {{ $brand->country == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Brazil" {{ $brand->country == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                </select>

                <label for="id_legal">ID Legal:</label>
                <input type="text" id="id_legal" name="id_legal" value="{{ $brand->id_legal }}" required>

                <label for="establish_date">Establish Date:</label>
                <input type="date" id="establish_date" name="establish_date" value="{{ $brand->establish_date }}" required>

                <div class="button-container">
                    <button type="submit">Update Brand</button>
                    <a href="/dashboard" class="cancel-btn" style="text-decoration: none; padding: 10px 15px; color: white;">Cancel</a>
                </div>
            </form>
        </div>
    </body>
</html>
