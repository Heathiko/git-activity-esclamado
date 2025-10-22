<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Works</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }
    h1 {
      color: #cc0000;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      margin: 8px 0;
    }
    a {
      text-decoration: none;
      color: #333;
      background: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      transition: 0.2s;
    }
    a:hover {
      background: #cc0000;
      color: white;
    }
  </style>
</head>
<body>
  <h1>STUDIO CODE</h1>
  <h2>My Works</h2>

  <ul>
    <?php
      $files = scandir(__DIR__);
      foreach ($files as $file) {
        if ($file === '.' || $file === '..' || $file === basename(__FILE__)) continue;

        if (is_dir($file)) {
          echo "<li><a href='$file/'>$file (folder)</a></li>";
        } else {
          echo "<li><a href='$file'>$file</a></li>";
        }
      }
    ?>
  </ul>
</body>
</html>
