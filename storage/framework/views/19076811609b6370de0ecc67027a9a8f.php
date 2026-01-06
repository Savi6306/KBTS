<style>
    #chatbot-btn {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background: #0d6efd;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        cursor: pointer;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    #chatbot-box {
        position: fixed;
        bottom: 95px;
        right: 25px;
        width: 320px;
        height: 420px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 9999;
    }

    #chatbot-header {
        background: #0d6efd;
        padding: 12px;
        color: white;
        font-weight: bold;
        text-align: center;
    }

    #chatbot-messages {
        flex: 1;
        padding: 12px;
        overflow-y: auto;
        font-size: 14px;
    }

    .bot-msg {
        background: #e9f1ff;
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        max-width: 80%;
    }

    .user-msg {
        background: #d1ffe3;
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        max-width: 80%;
        margin-left: auto;
    }

    #chatbot-input-area {
        display: flex;
        border-top: 1px solid #ddd;
    }

    #chatbot-input {
        flex: 1;
        border: none;
        padding: 10px;
        outline: none;
    }

    #chatbot-send {
        background: #0d6efd;
        color: white;
        padding: 10px 15px;
        cursor: pointer;
        border: none;
    }
</style>

<!-- Floating Chat Button -->
<div id="chatbot-btn">💬</div>

<!-- Chatbot Window -->
<div id="chatbot-box">
    <div id="chatbot-header">Helpdesk Chatbot</div>

    <div id="chatbot-messages"></div>

    <div id="chatbot-input-area">
        <input type="text" id="chatbot-input" placeholder="Ask something..." />
        <button id="chatbot-send">Send</button>
    </div>
</div>

<script>
    const btn = document.getElementById('chatbot-btn');
    const box = document.getElementById('chatbot-box');
    const input = document.getElementById('chatbot-input');
    const send = document.getElementById('chatbot-send');
    const messages = document.getElementById('chatbot-messages');

    btn.onclick = () => {
        box.style.display = box.style.display === "flex" ? "none" : "flex";
    };

    function addMessage(text, type) {
        let msg = document.createElement("div");
        msg.className = type === "bot" ? "bot-msg" : "user-msg";
        msg.innerHTML = text;
        messages.appendChild(msg);
        messages.scrollTop = messages.scrollHeight;
    }

    send.onclick = () => {
        let msg = input.value.trim();
        if (!msg) return;

        addMessage(msg, 'user');
        input.value = "";

        fetch("<?php echo e(route('chatbot.ask')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({ message: msg })
        })
        .then(res => res.json())
        .then(data => {
            addMessage(data.reply.replace(/\n/g, "<br>"), "bot");
        });
    };
</script>
<?php /**PATH C:\xampp\htdocs\kbts\resources\views/chatbot/widget.blade.php ENDPATH**/ ?>