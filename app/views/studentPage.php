<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudentPage GUI</title>
  <style>
    :root {
      --pink: #DF3E91;
      --blue: #0F71B4;
      --green: #00C853;
      --light: #f8f9fa;
      --dark: #2d3436;
    }

    body {
      font-family: 'Poppins', 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, var(--blue), var(--pink), var(--green));
      background-size: 300% 300%;
      animation: gradientFlow 8s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    @keyframes gradientFlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .main-container {
      background: white;
      padding: 35px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      width: 90%;
      max-width: 1300px;
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      animation: fadeIn 0.6s ease-in-out;
    }

    /* Search Section */
    .search-section {
      width: 100%;
      margin-bottom: 15px;
      display: flex;
      justify-content: center;
    }

    .search-section form {
      display: flex;
      gap: 10px;
      width: 100%;
      max-width: 1000px;
    }

    .search-section input[type="text"] {
      flex: 1;
      padding: 12px;
      border: 2px solid var(--blue);
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .search-section input[type="text"]:focus {
      border-color: var(--green);
      box-shadow: 0 0 8px rgba(0,200,83,0.4);
      outline: none;
    }

    .search-section button {
      background: var(--pink);
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s ease;
    }

    .search-section button:hover {
      background: var(--blue);
    }

    /* Form Section */
    .form-section {
      flex: 1;
      min-width: 280px;
      background: var(--light);
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .form-section h2 {
      text-align: center;
      color: var(--blue);
      font-weight: 700;
      margin-bottom: 20px;
    }

    input[type="text"], select {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s;
    }

    input[type="text"]:focus, select:focus {
      border-color: var(--pink);
      box-shadow: 0 0 5px rgba(223,62,145,0.4);
      outline: none;
    }

    button {
      background: var(--blue);
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      transition: 0.3s ease;
    }

    button:hover {
      background: var(--green);
    }

    /* Table Section */
    .table-section {
      flex: 2;
      min-width: 400px;
      overflow-x: auto;
    }

    .table-section h2 {
      color: var(--pink);
      font-weight: 700;
      margin-bottom: 15px;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #eee;
      padding: 12px;
      text-align: center;
    }

    th {
      background: var(--blue);
      color: white;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    tr:hover {
      background: rgba(223,62,145,0.1);
      transition: background 0.3s ease;
    }

    /* Pagination */
    .pagination-container {
      margin-top: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .pagination a, .pagination strong {
      display: inline-block;
      padding: 8px 14px;
      border-radius: 8px;
      background: var(--pink);
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .pagination a:hover {
      background: var(--green);
    }

    .pagination strong {
      background: var(--blue);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="search-section">
      <form method="POST" action="search" id="studentForm">
        <input type="text" id="searchbar" name="searchbar" placeholder="Search student...">
        <button type="submit">Search</button>
        <button type="button" onclick="window.location.href='http://localhost:3010/student/index/1'">Cancel</button>
      </form>
    </div>

    <div class="form-section">
      <h2>Student Form</h2>
      <form method="POST" action="inserted" id="studentForm">
        <input type="hidden" id="student_id" name="id">
        <input type="text" id="fname" name="First_Name" placeholder="First Name" required>
        <input type="text" id="lname" name="Last_Name" placeholder="Last Name" required>
        <input type="text" id="email" name="Email" placeholder="Email" required>
        <select id="role" name="role" required>
          <option value="" disabled selected>-- Select Role --</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>

        <button type="submit" formaction="inserted">Submit</button>
        <button type="submit" formaction="update">Update</button>
        <button type="submit" formaction="softdel">Delete</button>
      </form>
    </div>

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

      <?php if (isset($pagination_data)): ?>
        <div class="pagination-container">
          <div class="pagination">
            <?= $pagination_links ?>
          </div>
          <div class="pagination-info">
            <?= $pagination_data['info']; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    document.querySelectorAll("#mytable tbody tr").forEach(row => {
      row.addEventListener("click", function() {
        let cells = this.querySelectorAll("td");
        document.getElementById("student_id").value = cells[0]?.textContent || "";
        document.getElementById("fname").value = cells[1]?.textContent || "";
        document.getElementById("lname").value = cells[2]?.textContent || "";
        document.getElementById("email").value = cells[3]?.textContent || "";
      });
    });
  </script>
</body>
</html>
