function getQuestion() {
    //add code here that will use AJAX to get a question from getQuestion.php
    fetch("getQuestion.php")
    .then(response => response.json())
    .then(data => {
        if (Array.isArray(data)) {
            console.log(data);//for debugging
        }
    }
    )
    return true;
}
function CheckAnswer() {
    //verify if the user's answer is correct. This gets called when the user submits their answer

}
function ResetScore() {

}