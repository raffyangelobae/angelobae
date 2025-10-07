<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* === Animated gradient background === */
    body {
      background: linear-gradient(135deg, #DF3E91, #0F71B4, #00C853);
      background-size: 300% 300%;
      animation: gradientMove 10s ease infinite;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen">

  <div class="backdrop-blur-xl bg-white/20 border border-white/30 shadow-2xl rounded-3xl p-10 w-96 text-white">
    <h2 class="text-3xl font-bold text-center mb-6 drop-shadow-lg">Welcome Back</h2>

    <form action="login" method="POST" class="space-y-5">
      
      <!-- Email -->
      <div>
        <label for="username" class="block text-sm font-medium text-white/80 mb-1">
          Email
        </label>
        <input type="text" name="username" id="username" required
          class="w-full px-4 py-2 bg-white/20 border border-white/40 rounded-lg text-white placeholder-white/50 focus:ring-2 focus:ring-[#0F71B4] focus:outline-none">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-white/80 mb-1">
          Password
        </label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 bg-white/20 border border-white/40 rounded-lg text-white placeholder-white/50 focus:ring-2 focus:ring-[#DF3E91] focus:outline-none">
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full bg-[#00C853] hover:bg-green-600 text-white py-2 rounded-lg shadow-md transition-all duration-300">
        Login
      </button>
    </form>

    <p class="text-sm text-white/80 mt-6 text-center">
      Don’t have an account?
      <a href="signup" class="text-[#DF3E91] hover:underline font-medium">Sign up here</a>
    </p>
  </div>

</body>
</html>
