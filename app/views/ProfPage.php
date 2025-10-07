<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-2xl w-full max-w-4xl p-8 relative">
    
    <!-- Logout Button -->
    <div class="absolute top-6 right-6">
      <a href="logout" 
         class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition">
        Logout
      </a>
    </div>

    <h2 class="text-3xl font-bold text-gray-800 mb-8">Profile</h2>

    <?php
      // ✅ Safely pull user data from session or default
      $fname   = $_SESSION['fname'] ?? $data['fname'] ?? 'N/A';
      $lname   = $_SESSION['lname'] ?? $data['lname'] ?? 'N/A';
      $email   = $_SESSION['email'] ?? $data['email'] ?? 'N/A';
      $age     = $_SESSION['age'] ?? $data['age'] ?? 'N/A';
      $address = $_SESSION['address'] ?? $data['address'] ?? 'N/A';
      $passw   = $_SESSION['passw'] ?? $data['passw'] ?? '********';
    ?>

    <form id="profileForm" class="flex flex-col md:flex-row gap-8 items-center md:items-start">
      

      <!-- Profile Info -->
      <div class="flex-1 space-y-4 w-full">
            
        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($fname) ?> <?= htmlspecialchars($lname) ?>"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 disabled>
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 disabled>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" value="<?= htmlspecialchars($passw) ?>"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                 disabled>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex gap-4">
          <button type="button" id="editBtn"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
            Edit
          </button>
          <button type="submit" id="saveBtn"
                  class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow"
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

    // Enable fields on Edit
    editBtn.addEventListener("click", () => {
      formInputs.forEach(input => input.disabled = false);
      saveBtn.disabled = false;
      editBtn.disabled = true;
    });

    // Handle Save (demo only)
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
