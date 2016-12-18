let questionsArray = [];
let currentQuestion = 1;
let answers = [];

class Questioner {

    static init(selector) {
        //Hide questions
        document.querySelector(selector).style.display = "none";

        //Take questions with answers and save to array
        let childs = document.querySelector(selector).children;

        for (let question of childs) {

            let text = question.innerText;
            let answer = question.getAttribute("data-answer");

            questionsArray.push({
                "text": text,
                "answer": answer
            });
        }

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

            if (i != 0) {
                newEl.style.transform = 'translateX(125%)';
            }

            let el = document.getElementById('form');
            el.appendChild(newEl);
        }


    }

    static prevQuestion(number) {
        if (number > 1) {
            $('[data-question="' + number + '"]').css("transform", "translateX(125%)");
            $('[data-question="' + (number - 1) + '"]').css("transform", "translateX(0)");

            return true;

        } else {
            return false;
        }
    }

    static nextQuestion(number) {
        if (number < questionsArray.length) {
            $('[data-question="' + number + '"]').css("transform", "translateX(-125%)");
            $('[data-question="' + (number + 1) + '"]').css("transform", "translateX(0)");

            return true;

        } else {
            return false;
        }
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

    isCompleted() {
        return this._amount == this._progress;
    }
}

Questioner.init("#questions");
let progressBar = new Progress(".header-count", ".current-progress", ".header-amount", questionsArray.length);

function takeAnswer(decision) {
    answers[currentQuestion - 1] = decision;
    document.querySelector('input[data-id="' + currentQuestion + '"]').value = decision;

    if (progressBar.increaseProgress()) {
        Questioner.nextQuestion(currentQuestion);
        currentQuestion++;
    } else {
        $("#form").submit();
    }
    Questioner.changeQuestionPage();
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
    if (Questioner.prevQuestion(currentQuestion)) {
        currentQuestion--;
    }
    Questioner.changeQuestionPage();
});

//Next button
$(".footer-next").on("click", function () {
    if (Questioner.nextQuestion(currentQuestion)) {
        currentQuestion++;
    }
    Questioner.changeQuestionPage();
});