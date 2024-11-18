<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tag List</title>
  <style>
    /* Basic styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f4f6;
      padding: 20px;
    }

    .container {
      width: 90%;
      max-width: 600px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      color: #4a90e2;
      margin-bottom: 20px;
    }

    .add-button {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .add-button a {
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: #4a90e2;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .add-button a:hover {
      background-color: #357abd;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #4a90e2;
      color: #fff;
    }

    .actions button {
      padding: 6px 12px;
      font-size: 14px;
      color: #fff;
      background-color: #4a90e2;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 5px;
      transition: background-color 0.3s ease;
    }

    .actions button:hover {
      background-color: #357abd;
    }

    .actions .delete {
      background-color: #e74c3c;
    }

    .actions .delete:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Tag List</h2>
    <div class="add-button">
      <a href="tag_form.html">Add Tag</a>
    </div>
    <table>
      <thead>
        <tr>
          <th>Tag Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tag_list as $tag)
        <tr>
          <td>{{ $tag->name }}</td>
          <td class="actions">
            <button onclick="location.href='tag_form.html'">Edit</button>
            <button class="delete">Delete</button>
          </td>
        </tr>
        @endforeach
        <!-- Additional tags will be listed here -->
      </tbody>
    </table>
  </div>
</body>
</html>
