<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Unit</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
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
        select {
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
        <h1>Edit Unit</h1>
        <form action="{{ route('edit-unit-action', $unit->id_unit) }}" method="post">
            @csrf
            @method('PUT')

            <!-- Brand Selection -->
            <label for="id_brand">Brand:</label>
            <select id="id_brand" name="id_brand" required>
                <option value="">Select a brand</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id_brand }}" {{ $unit->id_brand == $brand->id_brand ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>

            <!-- Screen Resolution -->
            <label for="screen_res">Screen Resolution:</label>
            <input
                type="text"
                id="screen_res"
                name="screen_res"
                value="{{ $unit->screen_res }}"
                placeholder="1920x1080"
                required
            />

            <!-- Refresh Rate -->
            <label for="refresh_rate">Refresh Rate (Hz):</label>
            <input
                type="number"
                id="refresh_rate"
                name="refresh_rate"
                value="{{ $unit->refresh_rate }}"
                placeholder="60"
                required
            />

            <!-- Screen Ratio -->
            <label for="screen_ratio">Screen Ratio:</label>
            <input
                type="text"
                id="screen_ratio"
                name="screen_ratio"
                value="{{ $unit->screen_ratio }}"
                placeholder="16:9"
                required
            />

            <!-- Price -->
            <label for="price">Price (IDR):</label>
            <input
                type="number"
                id="price"
                name="price"
                value="{{ $unit->price }}"
                placeholder="500"
                required
            />

            <button type="submit">Update Unit</button>
        </form>
    </div>
</body>
</html>
