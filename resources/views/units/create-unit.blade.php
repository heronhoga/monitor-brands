<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create New Product</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f4f4f4;
                font-family: 'Courier New', Courier, monospace;
            }

            .form-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 300px;
                text-align: center;
            }

            h1 {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 8px;
                text-align: left;
            }

            input[type="text"],
            input[type="number"],
            input[type="text"],
            input[type="number"] {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #4caf50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <h1>Create New Unit</h1>
            <form action="{{ route('create-unit-action') }}" method="post">
                @csrf
                
                <select id="id_brand" name="id_brand" required>
                    <option value="">Select a brand</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id_brand }}">{{ $brand->name }}</option>
                    @endforeach
                </select>

                <label for="screen_res">Screen Resolution:</label>
                <input
                    type="text"
                    id="screen_res"
                    name="screen_res"
                    placeholder="1920x1080"
                    required
                />

                <label for="refresh_rate">Refresh Rate (Hz):</label>
                <input
                    type="number"
                    id="refresh_rate"
                    name="refresh_rate"
                    placeholder="60"
                    required
                />

                <label for="screen_ratio">Screen Ratio:</label>
                <input
                    type="text"
                    id="screen_ratio"
                    name="screen_ratio"
                    placeholder="16:9"
                    required
                />

                <label for="price">Price (IDR):</label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    placeholder="500"
                    required
                />

                <button type="submit">Create Product</button>
            </form>
        </div>
    </body>
</html>
