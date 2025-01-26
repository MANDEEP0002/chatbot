<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Chatbot' }}</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .chat-container {
      max-width: 500px;
      margin: 50px auto;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .chat-header {
      background-color: #007bff;
      color: white;
      padding: 15px;
      text-align: center;
    }
    .chat-footer {
      text-align: center;
      padding: 10px;
      background-color: #f1f1f1;
    }
  </style>
  {{ $head ?? '' }}
</head>
<body>
  <div class="container">
    <div class="chat-container">
      <!-- Header Section -->
      <header class="chat-header">
        <h3>{{ $header ?? 'Chatbot UI' }}</h3>
      </header>

      <!-- Content Section -->
      <main class="p-3">
        {{ $slot }}
      </main>

      <!-- Footer Section -->
      <footer class="chat-footer">
        <p>&copy; {{ date('Y') }} Chatbot. All rights reserved.</p>
      </footer>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  {{ $scripts ?? '' }}
</body>
</html>
