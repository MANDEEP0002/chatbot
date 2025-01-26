<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admissions Chatbot</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        body {
            background-color: #f4f8fb;
        }
        #chat-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        #chat-window {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .chat-message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .user-msg {
            background-color: #d1ecf1;
            text-align: right;
        }
        .bot-msg {
            background-color: #f8d7da;
            text-align: left;
        }
        .option-btn {
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="chat-window">
            <!-- Messages will appear here -->
        </div>
        <div id="options-container">
            <!-- Options buttons will appear here -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to send user message and get bot response
        function sendMessage(optionId, step) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/admissions/bot/response', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ step: step })
            })
            .then(response => response.json())
            .then(data => {
                // Display bot response in chat window
                displayMessage(data.message, 'bot');
                
                // Display new options
                const optionsContainer = document.getElementById('options-container');
                optionsContainer.innerHTML = ''; // Clear previous options

                data.options.forEach(option => {
                    const optionBtn = document.createElement('button');
                    optionBtn.classList.add('btn', 'btn-light', 'option-btn');
                    optionBtn.textContent = option.text;
                    optionBtn.onclick = () => sendMessage(option.id, option.step);
                    optionsContainer.appendChild(optionBtn);
                });
            })
            .catch(error => console.error('Error:', error));
        }

        // Function to display messages in the chat window
        function displayMessage(message, sender) {
            const chatWindow = document.getElementById('chat-window');
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('chat-message', sender === 'user' ? 'user-msg' : 'bot-msg');
            msgDiv.textContent = message;
            chatWindow.appendChild(msgDiv);
            chatWindow.scrollTop = chatWindow.scrollHeight; // Auto scroll to bottom
        }

        // Initialize chatbot
        document.addEventListener('DOMContentLoaded', () => {
            displayMessage('Welcome to the Admissions Chatbot! Please select an option.', 'bot');
            const optionsContainer = document.getElementById('options-container');
            const initialOptions = [
                { id: 2, text: 'Eligibility Criteria' },
                { id: 3, text: 'Admission Deadlines' },
                { id: 4, text: 'Fee Structure' },
                { id: 5, text: 'Contact Admission Office' }
            ];

            initialOptions.forEach(option => {
                const optionBtn = document.createElement('button');
                optionBtn.classList.add('btn', 'btn-light', 'option-btn');
                optionBtn.textContent = option.text;
                optionBtn.onclick = () => sendMessage(option.id, 1);
                optionsContainer.appendChild(optionBtn);
            });
        });
    </script>
</body>
</html>
