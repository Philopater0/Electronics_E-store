<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        /* Your CSS styles here */
        .chat{
            background-color: #151517;
            color: white;
            padding-left: 2rem;
            padding-right: 2rem;
            margin-left: 10rem;
            padding-top: 0.2rem;
            padding-bottom: 0.2rem;
            margin-top: 0.8rem;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            border: solid;
            border-color: white;
        }
        .container1 {
            max-width: 370px;
            margin: 20px auto;
            height: 400px;
            padding: 20px;
        }
        .chat-container {
            padding: 10px;
            margin-bottom: 10px;
            flex-direction: column;
        }
        .choices-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 2.5rem;
            flex-direction: column;
        }
        .choice {
            font-size: large;
            padding: 8px 15px;
            border: 3px solid black;
            border-radius: 20px;
            background-color: #fff;
            color: black;
            cursor: pointer;
            text-decoration: none;
            margin: 1.5rem;
        }
        .choice:hover {
            background-color: black;
            color: #fff;
        }
        .chat-message {
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .question-left {
            text-align: left;
            font-size: large;
        }
        .answer-right {
            text-align: right;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <nav class="navbar navbar-static-top" style="background-color:black;">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand"><b>Ecommerce</b>Site</a>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <button class="chat" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Chat</button>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="/action_page.php" method="post" style="width: 350px; height: 450px; margin-left: 3rem;border-radius: 15px;">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" style="padding: 0.5rem;">&times;</span>
            </div>
            <div class="container1">
                <img src="images/noun_chatbot_1585775.svg" style="width:75px;margin-left:10.5rem" alt="">
                <div id="chatContainer" class="chat-container">
                    <div id="chatMessages" class="chat-messages"></div>
                    <div id="choicesContainer" class="choices-container"></div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const questions = [
            { question: "What price do you prefer?", choices: ["Less than 15000", "15000-25000", "25000-50000","More than 50000"] },
            { question: "Choose the company you prefer", choices: ["Apple", "HP", "Lenovo","Dell","Don’t prefer any company"] },
            { question: "Do you know what RAM is and how it affects the performance of the device?", choices: ["Yes","No"] },
            { question: "What is the suitable RAM capacity for you?", choices: ["4GB", "8GB", "16GB ","32GB"] },
            { question: "Do you use heavy applications, Photoshop, or programming primarily?", choices: ["Yes","No"] },
            { question: "Do you prefer a specific operating system?", choices: ["Yes","No"] },
            { question: "What is your preferred operating system?", choices: ["Windows", "Mac OS", "Chrome OS", "No preference"] },
            { question: "What screen size do you prefer?", choices: ["Small", "Medium", "Large"] },
            { question: "What will you use the laptop for?", choices: ["Browsing", "Work", "Gaming or graphic editing"] },
            { question: "Do you prefer that the laptop has a touch screen?", choices: ["Yes","No"] },
        ];
        let questionsAnswers = [];
        let currentQuestionIndex = 0;
        const chatMessages = document.getElementById("chatMessages");
        const choicesContainer = document.getElementById("choicesContainer");

        function displayQuestion() {
            const currentQuestion = questions[currentQuestionIndex];
            const questionText = `<div class="question-left">${currentQuestion.question}</div>`;
            const choicesText = currentQuestion.choices.map(choice => `<div><a href="javascript:void(0)" class="choice" onclick="selectChoice('${currentQuestionIndex}', this, '${choice}')">${choice}</a></div>`).join("");

            const chatMessage = `<div class="chat-message" id="chat${currentQuestionIndex}">${questionText}<div class="choices-container">${choicesText}</div><div class="answer-right"></div></div>`;
            chatMessages.innerHTML += chatMessage;

            choicesContainer.innerHTML = ""; // Clear choices from previous question
        }

        function saveAnswer(answers) {
            // Use AJAX to send the answer to a PHP script for processing and database storage
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_answer.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`answers=${answers}`);
        }

        function selectChoice(questionIndex, choiceElement, choice) {
            questionsAnswers.push({questionIndex: questionIndex,choice:choice});
            const currentChat = document.getElementById(`chat${currentQuestionIndex}`);
            currentChat.style.display = "none"; // Hide current chat

            // Disable all choices for the current question
            const choices = document.querySelectorAll(".choice");
            choices.forEach(element => {
                element.removeEventListener("click", selectChoice);
                element.style.pointerEvents = "none"; // Disable clicking
                if (element === choiceElement) {
                    element.classList.add("selected"); // Mark the selected choice
                    const answerContainer = element.closest(".chat-message").querySelector(".answer-right");
                    answerContainer.textContent = `You chose: ${choice}`;
                    answerContainer.style.display = "block"; // Show answer
                }
            });

            currentQuestionIndex++;

            if (currentQuestionIndex < questions.length) {
                setTimeout(displayQuestion, 250); 
            } else {
                choicesContainer.innerHTML = ""; // Clear choices
                const finalMessage = `<div>Thank you for answering! <a href="test.php">Click here</a> to go to the next page.</div>`;
                let encodedData = btoa(encodeURIComponent(JSON.stringify(questionsAnswers)));
                saveAnswer(encodedData);
                chatMessages.innerHTML += finalMessage;
            }
        }

        // Start the chat by displaying the first question
        displayQuestion();

        var modal = document.getElementById('id01');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
