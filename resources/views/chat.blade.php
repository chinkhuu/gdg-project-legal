<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Хуулийн AI Туслах</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        #chat-window {
            border: 1px solid #ccc;
            height: 400px;
            overflow-y: scroll;
            padding: 10px;
            margin-bottom: 10px;
        }

        .message {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #e1f5fe;
            text-align: right;
        }

        .ai-message {
            background-color: #f1f1f1;
        }

        #chat-form {
            display: flex;
        }

        #question {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Хуулийн AI Туслах</h1>
<p><strong>Анхааруулга:</strong> Энэхүү систем нь зөвхөн мэдээллийн зорилготой бөгөөд хууль зүйн зөвлөгөө өгөхгүй.</p>

<div id="chat-window"></div>

<form id="chat-form">
    <input type="text" id="question" placeholder="Асуултаа энд бичнэ үү..." autocomplete="off" required>
    <button type="submit">Илгээх</button>
</form>

<script>
    const chatForm = document.getElementById('chat-form');
    const questionInput = document.getElementById('question');
    const chatWindow = document.getElementById('chat-window');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    chatForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const question = questionInput.value.trim();
        if (!question) return;

        appendMessage(question, 'user');
        questionInput.value = '';

        appendMessage('Түр хүлээнэ үү...', 'ai', true);

        try {
            const response = await fetch('/api/ask', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({question: question})
            });

            if (!response.ok) {
                throw new Error('Сервертэй холбогдоход алдаа гарлаа.');
            }

            const data = await response.json();
            updateLastMessage(data.answer, 'ai');

        } catch (error) {
            updateLastMessage('Уучлаарай, алдаа гарлаа. Дахин оролдоно уу.', 'ai');
            console.error('Error:', error);
        }
    });

    function appendMessage(text, sender, isLoading = false) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', `${sender}-message`);
        if (isLoading) {
            messageElement.id = 'loading-message';
        }
        messageElement.innerText = text;
        chatWindow.appendChild(messageElement);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    function updateLastMessage(text, sender) {
        const loadingMessage = document.getElementById('loading-message');
        if (loadingMessage) {
            loadingMessage.innerText = text;
            loadingMessage.id = '';
        } else {
            appendMessage(text, sender);
        }
    }
</script>
</body>
</html>
