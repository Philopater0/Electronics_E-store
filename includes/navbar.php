 <style>
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
  .cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
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

.chat-message {
    margin-bottom: 2.5rem; /* Add space below each question */
    padding: 10px;
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
 
 
 
 <header class="main-header">
  <nav class="navbar navbar-static-top" style="background-color:black;">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><b>Ecommerce</b>Site</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">HOME</a></li>
          <li><a href="">ABOUT US</a></li>
          <li><a href="contact.php">CONTACT US</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                      <li><a href='category.php?category=".$row['cat_slug']."'>".$row['name']."</a></li>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
            </ul>
          </li>
        </ul>
        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required style="  border-top-left-radius: 10px;  border-bottom-left-radius: 10px; background-color:gray;">
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"  style="  border-top-right-radius: 10px;  border-bottom-right-radius: 10px;"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['user'])){
              $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['firstname'].' '.$user['lastname'].'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
                <li><a href='signup.php'>SIGNUP</a></li>
              ";
            }
          ?>
          <button class="chat" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Chat</button>
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
        </ul>
      </div>
    </div>
  </nav>
</header>
<script>
  var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
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

</script>