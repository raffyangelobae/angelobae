<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white shadow-lg rounded-2xl p-8 w-96">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

    <form action="login" method="POST" class="space-y-5">
      <!-- Username -->
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
          Email
        </label>
        <input type="text" name="username" id="username" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
          Password
        </label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
        Login
      </button>
    </form>

    <p class="text-sm text-gray-600 mt-4 text-center">
      Don’t have an account?
      <a href="signup" class="text-blue-600 hover:underline">Sign up here</a>
    </p>
  </div>
</body>
</html>
