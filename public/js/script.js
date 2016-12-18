"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var questionsArray = [];
var currentQuestion = 1;
var answers = [];
var count = void 0;

var Questioner = function () {
    function Questioner() {
        _classCallCheck(this, Questioner);
    }

    _createClass(Questioner, null, [{
        key: "init",
        value: function init(selector) {
            //Hide instance questions
            document.querySelector(selector).style.display = "none";

            //Take questions with answers and save to array
            var childs = document.querySelector(selector).children;

            count = childs.length;

            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = childs[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var question = _step.value;


                    var text = question.innerText;
                    var answer = question.getAttribute("data-answer");

                    questionsArray.push({
                        "text": text,
                        "answer": answer
                    });
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }

            var translate = 0;

            for (var i = 0; i < questionsArray.length; i++) {

                var newEl = document.createElement("div");
                newEl.innerHTML = '<input hidden data-id="' + (i + 1) + '" name="answers[]">' + '<div class="main-question">' + questionsArray[i]["text"] + '</div>' + '<div class="main-buttons">' + '<button type="button" class="main-button yes-btn">' + 'Yes' + '</button>' + '<button type="button" class="main-button no-btn">' + 'No' + '</button>' + '</div>';
                newEl.className = "row main-row";
                newEl.setAttribute("data-question", i + 1);

                newEl.style.transform = 'translateX(' + translate + '%)';

                translate += 125;

                var el = document.getElementById('form');
                el.appendChild(newEl);
            }
        }
    }, {
        key: "changePage",
        value: function changePage(number) {
            for (var i = 0; i < count; i++) {
                var points = 125 * i - 125 * (number - 1);
                document.querySelector('[data-question="' + (i + 1) + '"]').style.transform = 'translateX(' + points + '%)';
            }
            currentQuestion = number;
            Questioner.changeQuestionPage();
        }
    }, {
        key: "prevQuestion",
        value: function prevQuestion() {
            if (currentQuestion > 1) {
                this.changePage(--currentQuestion);

                return true;
            } else {
                return false;
            }
        }
    }, {
        key: "nextQuestion",
        value: function nextQuestion() {
            if (currentQuestion < count) {
                this.changePage(++currentQuestion);

                return true;
            } else {
                return false;
            }
        }
    }, {
        key: "unansweredQuestion",
        value: function unansweredQuestion() {
            for (var i = 0; i < count; i++) {
                if (answers[i] === undefined) {
                    return i + 1;
                }
            }
            return false;
        }
    }, {
        key: "changeQuestionPage",
        value: function changeQuestionPage() {
            document.querySelector(".header-count").innerText = currentQuestion;
        }
    }]);

    return Questioner;
}();

var Progress = function () {
    _createClass(Progress, [{
        key: "increaseProgress",
        value: function increaseProgress() {
            if (this._progress < this._amount) {

                this._progress++;
                document.querySelector(this._barProgress).style.width = 100 / this._amount * this._progress + "%";

                return true;
            } else {
                return false;
            }
        }
    }]);

    function Progress(textProgress, barProgress, textAmount, amount) {
        _classCallCheck(this, Progress);

        this._progress = 1;
        this._amount = amount;
        this._textProgress = textProgress;
        this._barProgress = barProgress;

        document.querySelector(textAmount).innerText = amount;
        document.querySelector(textProgress).innerText = 1;
        document.querySelector(barProgress).style.width = 100 / this._amount + "%";
    }

    return Progress;
}();

Questioner.init("#questions");
var progressBar = new Progress(".header-count", ".current-progress", ".header-amount", questionsArray.length);

function takeAnswer(decision) {
    answers[currentQuestion - 1] = true;
    document.querySelector('input[data-id="' + currentQuestion + '"]').value = decision;

    if (progressBar.increaseProgress()) {
        if (!Questioner.nextQuestion()) {
            Questioner.changePage(Questioner.unansweredQuestion());
        }
    } else if (!Questioner.unansweredQuestion()) {
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