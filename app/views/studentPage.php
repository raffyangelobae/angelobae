<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudentPage GUI</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #74b9ff, #a29bfe);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .main-container {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 1300px;
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      animation: fadeIn 0.6s ease-in-out;
    }

    /* Search bar at the top */
    .search-section {
      width: 100%;
      margin-bottom: 20px;
      display: flex;
      justify-content: center;
    }

    .search-section form {
      display: flex;
      gap: 10px;
      width: 100%;
      max-width: 2000px;
    }

    .search-section input[type="text"] {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 15px;
      width: 1900px;
      transition: 0.3s ease;
    }

    .search-section input[type="text"]:focus {
      border-color: #0984e3;
      box-shadow: 0 0 5px rgba(9,132,227,0.4);;
      outline: none;
    }

    .search-section button {
      background: #0984e3;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 10px;
      width: 20%;
      cursor: pointer;
      font-size: 15px;
      transition: background 0.3s ease;
    }

    .search-section button:hover {
      background: #0652dd;
    }

    .form-section {
      flex: 1;
      min-width: 280px;
    }

    .form-section h2 {
      margin-bottom: 20px;
      color: #2d3436;
      font-weight: 600;
      text-align: center;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 15px;
      transition: 0.3s ease;
    }

    input[type="text"]:focus {
      border-color: #0984e3;
      box-shadow: 0 0 5px rgba(9,132,227,0.4);
      outline: none;
    }

    button {
      background: #0984e3;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #0652dd;
    }

    .table-section {
      flex: 2;
      min-width: 400px;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px 12px;
      text-align: center;
      cursor: pointer;
    }

    th {
      background: #f1f2f6;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    /* Pagination Styles */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      list-style: none;
      gap: 6px;
      padding: 0;
      margin: 15px 0;
    }

    .pagination li {
      display: inline-block;
    }

    .pagination a,
    .pagination strong {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 6px;
      background: #f1f2f6;
      color: #2d3436;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.2s ease-in-out;
    }

    .pagination a:hover {
      background: #0984e3;
      color: white;
    }

    .pagination strong {
      background: #0984e3;
      color: white;
      font-weight: bold;
    }

    .pagination-container {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      align-items: center;
    }

    .pagination-info {
      font-size: 14px;
      color: #636e72;
    }

    .pagination-select {
      font-size: 14px;
      padding: 6px 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .search-bar {
      flex: 1; /* let it expand */
      max-width: 300px; /* you can adjust to match your design */
    }

    .search-bar input {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .search-bar button {
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      background: #0984e3;
      color: white;
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .search-bar button:hover {
      background: #0652dd;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="search-section">
      <form method="POST" action="search" id="studentForm">
        <input type="text" id="searchbar" name="searchbar" placeholder="Search student...">
        <button type="submit">Search</button>
        <button href="http://localhost:3010/student/index/1">Cancel</button>

      </form>
    </div>

    <!-- Student Form -->
    <div class="form-section">
      <h2>Student Form</h2>
      <form method="POST" action="inserted" id="studentForm">
        <!-- hidden id for update -->
        <input type="hidden" id="student_id" name="id">

        <input type="text" id="fname" name="First_Name" placeholder="First Name" required>
        <input type="text" id="lname" name="Last_Name" placeholder="Last Name" required>
        <input type="text" id="email" name="Email" placeholder="Email" required>
        <select id="role" name="role" required>
          <option value="" disabled selected>-- Select Role --</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>

        <!-- Insert button -->
        <button type="submit" formaction="inserted">Submit</button>
        <!-- Update button -->
        <button type="submit" formaction="update">Update</button>
        <button type="submit" formaction="softdel">Delete</button>
      </form>
    </div>

    <!-- Table -->
    <div class="table-section" id="mytable">
      <h2>Student List</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($records)): ?>
            <?php foreach ($records as $row): ?>
              <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="4">No students found</td></tr>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Pagination Controls -->
      <?php if (isset($pagination_data)): ?>
        <div class="pagination-container">
          <!-- Pagination Links -->
          <div class="mt-3 d-flex justify-content-center">
              <?= $pagination_links ?>
          </div>
          <div class="pagination-info">
            <?= $pagination_data['info']; ?>
            &nbsp; | &nbsp;
            <label for="itemsPerPage"></label>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    // Row click = fill form
    document.querySelectorAll("#mytable tbody tr").forEach(row => {
      row.addEventListener("click", function() {
        let cells = this.querySelectorAll("td");
        document.getElementById("student_id").value = cells[0]?.textContent || "";
        document.getElementById("fname").value = cells[1]?.textContent || "";
        document.getElementById("lname").value = cells[2]?.textContent || "";
        document.getElementById("email").value = cells[3]?.textContent || "";
        document.getElementById("role").value = cells[4]?.textContent || "user";
      });
    });

    
  </script>
</body>
</html>
