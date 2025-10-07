<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom palette using Tailwind’s arbitrary values */
    body {
      background: linear-gradient(135deg, #DF3E91, #0F71B4, #00C853);
      background-size: 300% 300%;
      animation: gradientShift 8s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .glow-input:focus {
      box-shadow: 0 0 10px rgba(15, 113, 180, 0.5);
      border-color: #DF3E91;
    }

    .btn-gradient {
      background: linear-gradient(to right, #DF3E91, #0F71B4);
      transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
      background: linear-gradient(to right, #00C853, #0F71B4);
      transform: scale(1.02);
    }
  </style>
</head>
<body class="flex items-center justify-center h-screen text-gray-800">

  <div class="bg-white/95 shadow-2xl rounded-2xl p-8 w-96 backdrop-blur-md border border-white/20">
    <h2 class="text-3xl font-extrabold text-center text-[#0F71B4] mb-6">Create Account</h2>

    <form action="signup" method="POST" class="space-y-5">
      <!-- First Name -->
      <div>
        <label for="firstname" class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
        <input type="text" name="First_Name" id="firstname" required
          class="glow-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DF3E91]">
      </div>

      <!-- Last Name -->
      <div>
        <label for="lastname" class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
        <input type="text" name="Last_Name" id="lastname" required
          class="glow-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DF3E91]">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input type="email" name="Email" id="email" required
          class="glow-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DF3E91]">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <input type="password" name="passw" id="password" required
          class="glow-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DF3E91]">
      </div>

      <!-- Submit Button -->
      <button type="submit"
        class="btn-gradient w-full text-white py-2 rounded-lg font-semibold shadow-md hover:shadow-lg">
        Sign Up
      </button>
    </form>

    <p class="text-sm text-gray-700 mt-5 text-center">
      Already have an account?
      <a href="login" class="text-[#DF3E91] hover:text-[#00C853] font-semibold transition">Login here</a>
    </p>
  </div>

</body>
</html>
