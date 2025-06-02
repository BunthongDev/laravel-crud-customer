
<?php
// web.php test page
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login</h2>
    <form action="/login" method="POST" class="space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" name="email" id="email" placeholder="you@example.com" required
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••" required
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">Login</button>
    </form>
  </div>

</body>
</html>
HTML;
