<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>File</title>
</head>
<body>
   <form method="POST" action="/send-file" enctype="multipart/form-data">
      @csrf
      <label for="caption">Caption:</label>
      <input type="text" name="caption" required>
      
      <label for="photo">Foto/File:</label>
      <input type="file" name="photo" accept="image/*,application/pdf" required>
      
      <button type="submit">Kirim File</button>
  </form>
</body>
</html>