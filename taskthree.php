<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Three</title>
</head>
<body>
  <h1>Task Three Solution</h1>
  <div>
    <p>Please <a href="./taskthree.sql">Click here</a> to download task three sql file</p>
    <div>
      <h3>See Example Query Below</h3>
      <p style="width: 500px">
        SELECT * FROM employees WHERE id = 1;

        SELECT t.info_type as type, l.language as language, i.text 
        FROM employee_info i 
        LEFT JOIN employee_languages l ON l.id = i.language_id 
        LEFT JOIN info_type t ON t.id = i.info_type_id
        WHERE i.employee_id = 1;
      </p>
    </div>
  </div>
</body>
</html>