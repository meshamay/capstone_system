<div class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-4 font-sans text-gray-800">


    <div id="chat-box"
        class="hidden w-80 md:w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col h-[500px]">


        <div class="bg-[#134573] p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-full">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.159 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm">Barangay Help Desk</h4>
                    <p class="text-white/70 text-xs flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> Online
                    </p>
                </div>
            </div>


            <button onclick="window.toggleChat()" class="text-white/80 hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


        <div id="chat-messages" class="flex-1 bg-gray-50 p-4 overflow-y-auto space-y-3">
            <div class="flex justify-start">
                <div
                    class="bg-gray-200 text-gray-800 p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl text-sm max-w-[85%]">
                    Welcome to Barangay Daang Bakal! 👋<br> You can click a question below or type your message.
                </div>
            </div>
        </div>


        <div class="p-3 bg-white border-t border-gray-100 relative">
            <input type="text" id="user-input" placeholder="Type your message..."
                class="w-full bg-gray-100 border-none rounded-full pl-4 pr-10 py-2 text-sm focus:ring-2 focus:ring-[#134573] outline-none text-gray-800">
            <button onclick="window.sendMessage()"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#134573] hover:text-blue-700 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path
                        d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                </svg>
            </button>
        </div>


        <div id="question-list" class="p-2 bg-gray-100 h-40 overflow-y-auto border-t border-gray-200 space-y-2"></div>
    </div>


    <button onclick="window.toggleChat()"
        class="bg-[#134573] text-white p-4 rounded-full shadow-2xl hover:bg-[#0f365d] transition-all duration-300 hover:scale-105 group relative cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.159 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
        </svg>


        <span
            class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-white text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-md pointer-events-none">
            Need Help?
        </span>
    </button>


</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {


        // 1. DATA
        const faqData = [
            { q: "How do I register?", a: "Residents can register online by filling out the registration form. If you experience any difficulty using the system, you may visit the barangay office, where the staff will assist you with the registration process and just bring valid id for verification." },
            { q: "What documents can I request?", a: "Barangay Clearance, Certificate, Indigency, and Residency." },
            { q: "How to request documents?", a: "Once registered, log in to your account and go to the Homepage. Click the Request Document button, choose the type of document you need, fill out the required details, and submit your request for processing." },
            { q: "Processing time?", a: "After submitting your request, the processing time is typically within 24 hours. You will receive a notification or email once your document is ready for pickup at the barangay office." },
            { q: "Office Hours?", a: "The barangay office is open from Monday to Friday, 8:00 AM to 5:00 PM, excluding holidays. For online transactions, the system is accessible 24/7 for residents’ convenience." },
            { q: "Curfew Hours?", a: "The official curfew hours are from 10:00 PM to 4:00 AM, unless otherwise adjusted by barangay announcements or local ordinances. Residents are encouraged to stay indoors during these hours for safety and community order." },
            { q: "File a complaint?", a: "Yes. Log in to your account, navigate to the Homepage, and click the Submit Complaint button. You can then write and submit your complaint directly through the system." }, // Fixed Comma here
            { q: "What should I bring when claiming my document?", a: "Please bring a valid ID or provide your reference code number as proof of tracking number when claiming your document." }
        ];


        const questionList = document.getElementById('question-list');
        faqData.forEach(function (item) {
            let btn = document.createElement('button');
            btn.className = "w-full text-left text-xs bg-white border border-gray-300 p-2 rounded-lg hover:bg-blue-50 transition-colors text-gray-700 font-medium mb-1 cursor-pointer";
            btn.innerText = item.q;


            // When button clicked
            btn.addEventListener('click', function () {
                window.appendMessage(item.q, 'user');
                setTimeout(function () { window.appendMessage(item.a, 'bot'); }, 500);
            });


            questionList.appendChild(btn);
        });


            //LISTEN FOR ENTER KEY
        const inputField = document.getElementById('user-input');
        inputField.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                window.sendMessage();
            }
        });


            //ANIMATION STYLE
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
            .animate-fade-in-up { animation: fadeInUp 0.3s ease-out forwards; }
        `;
        document.head.appendChild(style);
    });
    // Toggle Chat Box
    window.toggleChat = function () {
        const box = document.getElementById('chat-box');
        if (box.classList.contains('hidden')) {
            box.classList.remove('hidden');
        } else {
            box.classList.add('hidden');
        }
    }
    // Send Message Logic
    window.sendMessage = function () {
        const input = document.getElementById('user-input');
        const text = input.value.trim();
        if (text === "") return;


        window.appendMessage(text, 'user');
        input.value = '';


        setTimeout(function () {
            const response = window.getBotResponse(text);
            window.appendMessage(response, 'bot');
        }, 600);
    }
    // Append Message to UI
    window.appendMessage = function (text, sender) {
        const chatArea = document.getElementById('chat-messages');
        const div = document.createElement('div');
        div.className = sender === 'user' ? "flex justify-end animate-fade-in-up" : "flex justify-start animate-fade-in-up";


        const bubble = document.createElement('div');
        bubble.className = sender === 'user'
            ? "bg-[#134573] text-white p-3 rounded-tl-xl rounded-bl-xl rounded-br-xl text-sm max-w-[85%]"
            : "bg-gray-200 text-gray-800 p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl text-sm max-w-[85%]";


        bubble.innerHTML = text;
        div.appendChild(bubble);
        chatArea.appendChild(div);
        chatArea.scrollTop = chatArea.scrollHeight;
    }
    // Bot Logic
    window.getBotResponse = function (input) {
        input = input.toLowerCase();
        if (input.includes('hello') || input.includes('hi') || input.includes('hey')) return "Hello! How can I help you?";
        if (input.includes('time') || input.includes('open') || input.includes('hour')) return "We are open Mon-Fri, 8AM to 5PM.";
        if (input.includes('complaint')) return "You can file a complaint on your homepage.";
        if (input.includes('thanks') || input.includes('okay') || input.includes('bye')) return "You are welcome!";
        if (input.includes('register') || input.includes('account') || input.includes('sign up')) return "Visit the barangay hall or sign up online.";
        if (input.includes('document') || input.includes('clearance')) return "Request documents via your user dashboard.";


        return "I am an automated system. Please select a question from the list.";
    }
</script>



