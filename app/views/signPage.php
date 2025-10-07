<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white shadow-lg rounded-2xl p-8 w-96">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create Account</h2>

    <form action="signup" method="POST" class="space-y-5">
      <!-- Firstname -->
      <div>
        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">
          First Name
        </label>
        <input type="text" name="First_Name" id="firstname" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
      </div>

      <!-- Lastname -->
      <div>
        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">
          Last Name
        </label>
        <input type="text" name="Last_Name" id="lastname" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
          Email
        </label>
        <input type="email" name="Email" id="email" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium tessssxt-gray-700 mb-1">
          Password
        </label>
        <input type="password" name="passw" id="password" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
        Sign Up
      </button>
    </form>

    <p class="text-sm text-gray-600 mt-4 text-center">
      Already have an account?
      <a href="login" class="text-blue-600 hover:underline">Login here</a>
    </p>
  </div>
</body>
</html>
