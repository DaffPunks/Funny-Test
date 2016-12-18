let questionsArray = [];
let currentQuestion = 1;
let answers = [];
let count;

class Questioner {

    static init(selector) {
        //Hide instance questions
        document.querySelector(selector).style.display = "none";

        //Take questions with answers and save to array
        let childs = document.querySelector(selector).children;

        count = childs.length;

        for (let question of childs) {

            let text = question.innerText;
            let answer = question.getAttribute("data-answer");

            questionsArray.push({
                "text": text,
                "answer": answer
            });
        }

        var translate = 0;

        for (let i = 0; i < questionsArray.length; i++) {

            let newEl = document.createElement("div");
            newEl.innerHTML = '<input hidden data-id="' + (i + 1) + '" name="answers[]">' +
                '<div class="main-question">' +
                questionsArray[i]["text"] +
                '</div>' +
                '<div class="main-buttons">' +
                '<button type="button" class="main-button yes-btn">' +
                'Yes' +
                '</button>' +
                '<button type="button" class="main-button no-btn">' +
                'No' +
                '</button>' +
                '</div>';
            newEl.className = "row main-row";
            newEl.setAttribute("data-question", i + 1);


            newEl.style.transform = 'translateX(' + translate + '%)';

            translate += 125;

            let el = document.getElementById('form');
            el.appendChild(newEl);
        }
    }

    static changePage(number) {
        for (let i = 0; i < count; i++) {
            let points = (125 * i) - (125 * (number - 1));
            document.querySelector('[data-question="' + (i + 1) + '"]').style.transform = 'translateX(' + points + '%)';
        }
        currentQuestion = number;
        Questioner.changeQuestionPage();
    }

    static prevQuestion() {
        if (currentQuestion > 1) {
            this.changePage(--currentQuestion);

            return true;

        } else {
            return false;
        }
    }

    static nextQuestion() {
        if (currentQuestion < count) {
            this.changePage(++currentQuestion);

            return true;

        } else {
            return false;
        }
    }

    static unansweredQuestion() {
        for (let i = 0; i < count; i++) {
            if(answers[i] === undefined) {
                return i + 1;
            }
        }
        return false;
    }

    static changeQuestionPage() {
        document.querySelector(".header-count").innerText = currentQuestion;
    }
}

class Progress {

    increaseProgress() {
        if (this._progress < this._amount) {

            this._progress++;
            document.querySelector(this._barProgress).style.width = (100 / this._amount * this._progress ) + "%";

            return true;
        } else {
            return false;
        }
    }

    constructor(textProgress, barProgress, textAmount, amount) {
        this._progress = 1;
        this._amount = amount;
        this._textProgress = textProgress;
        this._barProgress = barProgress;

        document.querySelector(textAmount).innerText = amount;
        document.querySelector(textProgress).innerText = 1;
        document.querySelector(barProgress).style.width = (100 / this._amount) + "%";
    }

}

Questioner.init("#questions");
let progressBar = new Progress(".header-count", ".current-progress", ".header-amount", questionsArray.length);

function takeAnswer(decision) {
    answers[currentQuestion - 1] = true;
    document.querySelector('input[data-id="' + currentQuestion + '"]').value = decision;

    if (progressBar.increaseProgress()) {
        if(!Questioner.nextQuestion()) {
            Questioner.changePage(Questioner.unansweredQuestion());
        }
    } else if (!Questioner.unansweredQuestion()){
        $("#form").submit();
    }
}


//Yes button
$(".yes-btn").on("click", function () {
    takeAnswer("Y");
});

//No button
$(".no-btn").on("click", function () {
    takeAnswer("N");
});

//Back button
$(".footer-back").on("click", function () {
    Questioner.prevQuestion();
});

//Next button
$(".footer-next").on("click", function () {
    Questioner.nextQuestion();
});