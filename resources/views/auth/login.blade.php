<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aposaga Airport - Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f3f4f6; margin: 0; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 320px; }
        h2 { margin-top: 0; text-align: center; color: #1f2937; }
        .group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.25rem; color: #4b5563; font-size: 0.9rem; }
        input { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 0.6rem; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        button:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Aposaga Airport</h2>
        <form method="POST" action="/login">
            <div class="group">
                <label>Email Address</label>
                <input type="email" name="email" required autofocus>
            </div>
            <div class="group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>
