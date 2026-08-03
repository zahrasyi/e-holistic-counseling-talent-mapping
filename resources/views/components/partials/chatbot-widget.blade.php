<div id="chatbot-toggler"
    class="fixed bottom-5 right-5 w-16 h-16 bg-primary rounded-full flex items-center justify-center cursor-pointer shadow-lg z-[9999]">
    <svg class="w-8 h-8 text-white pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
        </path>
    </svg>

    <svg class="w-8 h-8 text-white hidden pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</div>

<div id="chatbot-window" class="fixed bottom-24 right-5 w-full max-w-sm h-[600px] bg-white dark:bg-gray-800 rounded-lg shadow-xl z-50 flex flex-col
           transform translate-y-16 opacity-0 pointer-events-none transition-all duration-300 ease-in-out">

    <div class="px-4 py-3 bg-primary text-white rounded-t-lg flex justify-between items-center">
        <div>
            <p class="font-bold text-lg">TemanCurhat AI</p>
            <p class="text-xs">Asisten Virtual Konseling</p>
        </div>
    </div>

    <div id="chatbot-messages" class="flex-1 p-4 overflow-y-auto space-y-4">
    </div>


    <div id="chatbot-typing-indicator" class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400 hidden">
        <span>TemanCurhat AI sedang mengetik...</span>
    </div>

    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <form id="chatbot-form" class="flex items-center space-x-2">
            <input type="text" id="chatbot-input" placeholder="Ketik pesan Anda di sini..." autocomplete="off"
                class="flex-1 w-full px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <button type="submit"
                class="bg-primary text-white rounded-full p-3 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <svg class="w-6 h-6 transform rotate-90 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.428A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                    </path>
                </svg>
            </button>
        </form>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.getElementById("chatbot-toggler");
    const windowEl = document.getElementById("chatbot-window");
    const closeIcon = toggler.querySelector("svg:last-child");
    const messageIcon = toggler.querySelector("svg:first-child");

    const chatForm = document.getElementById("chatbot-form");
    const chatInput = document.getElementById("chatbot-input");
    const messagesContainer = document.getElementById("chatbot-messages");
    const typingIndicator = document.getElementById("chatbot-typing-indicator");

    // riwayat history
    let conversationHistory = [];

    toggler.addEventListener("click", () => {
        const isHidden = windowEl.classList.contains("opacity-0");

        if (isHidden) {
            windowEl.classList.remove(
                "opacity-0",
                "translate-y-16",
                "pointer-events-none"
            );
            windowEl.classList.add(
                "opacity-100",
                "translate-y-0",
                "pointer-events-auto"
            );
            closeIcon.classList.remove("hidden");
            messageIcon.classList.add("hidden");

            if (conversationHistory.length === 0) {
                addBotMessage(
                    "Halo! Saya TemanCurhat AI. Ada yang bisa saya bantu terkait layanan konseling di kampus kita?"
                );
            }
        } else {
            windowEl.classList.add(
                "opacity-0",
                "translate-y-16",
                "pointer-events-none"
            );
            windowEl.classList.remove(
                "opacity-100",
                "translate-y-0",
                "pointer-events-auto"
            );
            closeIcon.classList.add("hidden");
            messageIcon.classList.remove("hidden");
        }
    });

    chatForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const userInput = chatInput.value.trim();
        if (userInput === "") return;

        addUserMessage(userInput);
        chatInput.value = "";

        typingIndicator.classList.remove("hidden");

        try {
            const response = await fetch("/chatbot/send", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ history: conversationHistory }),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok.");
            }

            const data = await response.json();

            addBotMessage(data.reply);
        } catch (error) {
            console.error("Error:", error);
            addBotMessage(
                "Maaf, sepertinya ada masalah koneksi. Silakan coba lagi nanti."
            );
        } finally {
            typingIndicator.classList.add("hidden");
        }
    });

    function addUserMessage(message) {
        conversationHistory.push({ role: "user", text: message });
        const messageElement = `
            <div class="flex justify-end">
                <div class="bg-primary text-white rounded-lg rounded-br-none py-2 px-4 max-w-xs">
                    ${message}
                </div>
            </div>
        `;
        messagesContainer.innerHTML += messageElement;
        scrollToBottom();
    }

    function addBotMessage(message) {
        conversationHistory.push({ role: "model", text: message });
        const messageElement = `
            <div class="flex justify-start">
                <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg rounded-bl-none py-2 px-4 max-w-xs">
                    ${message}
                </div>
            </div>
        `;
        messagesContainer.innerHTML += messageElement;
        scrollToBottom();
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});
</script>