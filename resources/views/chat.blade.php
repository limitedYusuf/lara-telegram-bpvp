<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Chat</title>
</head>
<body>
   <form method="POST" action="/send-chat">
      @csrf
      <label for="message">Pesan:</label>
      <input type="text" name="message" required>
      <button type="submit">Kirim Pesan</button>
  </form>
</body>
</html>