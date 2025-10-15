# JBU AI
**Jagannath Barooah University AI Chatbot**  

[![PHP](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://www.php.net/) 
[![HTML5](https://img.shields.io/badge/HTML5-orange.svg)](https://developer.mozilla.org/en-US/docs/Web/HTML) 
[![CSS3](https://img.shields.io/badge/CSS3-blue.svg)](https://developer.mozilla.org/en-US/docs/Web/CSS) 
[![JavaScript](https://img.shields.io/badge/JavaScript-yellow.svg)](https://developer.mozilla.org/en-US/docs/Web/JavaScript) 
[![License](https://img.shields.io/badge/License-Open%20Source-green.svg)](#license)

**JBU AI** is a smart, web-based chatbot designed to assist students, faculty, and visitors of **Jagannath Barooah College (JBC) & Jagannath Barooah University (JBU)**. The chatbot provides instant answers to FAQs, admission details, course information, notices, and contact details, creating an interactive, user-friendly experience.  

---

## Features

- **Conversational Greetings**  
  Responds naturally to greetings such as `Hi`, `Hello`, `Namaste`, `Hola`, etc.

- **Static Knowledge Base**  
  Provides pre-defined responses for:
  - College & university info
  - UG & PG admissions
  - Course availability & seat info
  - Departments & faculty members
  - Latest notices & announcements
  - University administration (Chancellor, VC, Registrar)
  - Contact information

- **Fallback Responses**  
  For unknown queries: `"Sorry, I don’t have an answer for that question."`

- **Session-based Chat Storage**  
  Stores conversation in user session (no database required)

- **Optional AI Integration**  
  Can integrate with Gemini AI for dynamic responses

- **Messaging Platform Ready**  
  Can integrate with Telegram for real-time access  

---

## Technology Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP |
| AI Integration | Gemini AI (Optional) |
| Server | XAMPP / PHP-enabled server |

---

## Project Structure
```text
Jbu-ai/
│
├── index.html # Frontend chat interface
├── style.css # Styles for chat UI
├── chatbot.php # Main chatbot logic in PHP
├── config.php # API keys and configuration settings
└── README.md # Project documentation
```




---

## Installation & Usage

<details>
<summary>Click to expand instructions</summary>

1. Clone or download the repository.
2. Place the folder in your **XAMPP `htdocs`** directory or any PHP-enabled server.
3. Start the **Apache** server.
4. Open your browser and go to:  
   `http://localhost/jbu-ai/index.html`
5. Interact with the bot:
   - `"Hi" / "Hello" / "Namaste"` → Bot responds with greetings
   - `"Admission process"` / `"BCA seats"` → Bot provides static answers
   - Unknown queries → Bot responds with fallback message
6. *(Optional)* Add your **Gemini AI API key** in `config.php` to enable AI-powered answers.

</details>

---

## Sample Questions

| User Query | Expected Bot Response |
|------------|---------------------|
| "Hi" | "Hi! How can I help you today?" |
| "Admission process" | "UG forms via Assam Samarth Admission Portal. Fee ₹300. PG notices on official website." |
| "How many seats are available for BCA?" | "Seats for BCA: 50. Status: Open." |
| "Who is the Vice-Chancellor?" | "Prof. Jyoti Prasad Saikia - https://jbu.ac.in/index.php/administration/vice-chancellor" |
| "Show latest notices" | "📢 Latest Notices: Admissions for 2025 are open now! ..." |
| "Admission contact info" | "Mr. Subhashis Sarma: +91 9435092618 ..." |

---

## Contributing

- Add more FAQs or department-specific info  
- Enhance conversational responses & greetings  
- Integrate Telegram or WhatsApp for messaging access  
- Add AI-based enhancements with Gemini or other APIs  

<details>
<summary>Good Practices</summary>

- Keep static data updated with official JBU/JBC notices  
- Test all greeting variations for conversational flow  
- Document any new modules added for clarity  

</details>

---

## License

This project is **open-source** and free for **educational and non-commercial purposes**.  

---

## Contact

**Email:** technorlyrics@gmail.com

---
