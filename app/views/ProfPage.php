<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #DF3E91, #0F71B4, #00C853);
      background-size: 300% 300%;
      animation: gradientShift 10s ease infinite;
    }
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen">
  <div class="backdrop-blur-xl bg-white/20 shadow-2xl rounded-3xl w-full max-w-4xl p-10 relative border border-white/30">

    <!-- Logout Button -->
    <div class="absolute top-6 right-6">
      <a href="logout" 
         class="bg-[#DF3E91] hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
        Logout
      </a>
    </div>

    <h2 class="text-4xl font-bold text-white mb-8 text-center drop-shadow-lg">My Profile</h2>

    <?php
      $fname   = $_SESSION['fname'] ?? $data['fname'] ?? 'N/A';
      $lname   = $_SESSION['lname'] ?? $data['lname'] ?? 'N/A';
      $email   = $_SESSION['email'] ?? $data['email'] ?? 'N/A';
      $age     = $_SESSION['age'] ?? $data['age'] ?? 'N/A';
      $address = $_SESSION['address'] ?? $data['address'] ?? 'N/A';
      $passw   = $_SESSION['passw'] ?? $data['passw'] ?? '********';
    ?>

    <form id="profileForm" class="flex flex-col md:flex-row gap-10 items-center md:items-start">

      <!-- Profile Info -->
      <div class="flex-1 space-y-5 w-full text-white">
        <div>
          <label class="block text-sm font-medium text-white/80">Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($fname) ?> <?= htmlspecialchars($lname) ?>"
                 class="w-full px-3 py-2 bg-white/20 border border-white/40 rounded-lg text-white placeholder-white/50 focus:ring-2 focus:ring-[#0F71B4] focus:outline-none"
                 disabled>
        </div>

        <div>
          <label class="block text-sm font-medium text-white/80">Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"
                 class="w-full px-3 py-2 bg-white/20 border border-white/40 rounded-lg text-white placeholder-white/50 focus:ring-2 focus:ring-[#0F71B4]"
                 disabled>
        </div>

        <div>
          <label class="block text-sm font-medium text-white/80">Password</label>
          <input type="password" name="password" value="<?= htmlspecialchars($passw) ?>"
                 class="w-full px-3 py-2 bg-white/20 border border-white/40 rounded-lg text-white placeholder-white/50 focus:ring-2 focus:ring-[#0F71B4]"
                 disabled>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex gap-4">
          <button type="button" id="editBtn"
                  class="bg-[#0F71B4] hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition-all">
            Edit
          </button>
          <button type="submit" id="saveBtn"
                  class="bg-[#00C853] hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow-md transition-all"
                  disabled>
            Save
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    const editBtn = document.getElementById("editBtn");
    const saveBtn = document.getElementById("saveBtn");
    const formInputs = document.querySelectorAll("#profileForm input:not([type=file])");

    editBtn.addEventListener("click", () => {
      formInputs.forEach(input => input.disabled = false);
      saveBtn.disabled = false;
      editBtn.disabled = true;
    });

    document.getElementById("profileForm").addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Profile saved!");
      formInputs.forEach(input => input.disabled = true);
      saveBtn.disabled = true;
      editBtn.disabled = false;
    });
  </script>
</body>
</html>
