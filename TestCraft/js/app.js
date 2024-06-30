let questionNum = 1;
let resultNum = 1;
const answers = [1];

$(document).on('click', '.addAnswer', function(event) {
    const question_n = parseInt(event.target.attributes["data-question"].value) - 1;
    const answer_n = ++answers[question_n];
    let question = $(this).data('question');
    let answer = $(this).data('answer');
    let answerBlock = $(this).parents('.answers').find('.answer-items');
    answer++;
    $(this).data('answer', answer);

    answerBlock.append(`
        <div class="d-flex justify-content-between mt-3" style="gap:15px;">
            <div style="flex:1;">
                <label for="answer_text_${question}_${answer_n}" class="form-label">Ответ #${answer_n}</label>
                <input type="text" name="answer_text_${question}_${answer_n}" id="answer_text_${question}_${answer_n}" class="form-control" required>
            </div>
            <div style="flex:1;">
                <label for="answer_score_${question}_${answer_n}" class="form-label">Балл за ответ #${answer_n}</label>
                <input type="text" name="answer_score_${question}_${answer_n}" id="answer_score_${question}_${answer_n}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
        </div>`);
});

$('.addQuestion').on('click', function() {
    answers.push(1);
    questionNum++;
    let questionBlock = $('#accordionQuestions');

    questionBlock.append(`
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestion${questionNum}" aria-expanded="false" aria-controls="collapseQuestion${questionNum}">
                Вопрос #${questionNum}
            </button>
        </h2>
        <div id="collapseQuestion${questionNum}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="question-items">
                    <div class="question">
                        <label for="question_${questionNum}" class="form-label">Текст вопроса</label>
                        <input type="text" name="question_${questionNum}" id="question_${questionNum}" class="form-control" required>
                    </div>
                    <div class="answers">
                        <div class="answer-items">
                            <div class="d-flex justify-content-between" style="gap:15px;">
                                <div style="flex:1;">
                                    <label for="answer_text_${questionNum}_1" class="form-label">Ответ #1</label>
                                    <input type="text" name="answer_text_${questionNum}_1" id="answer_text_${questionNum}_1" class="form-control" required>
                                </div>
                                <div style="flex:1;">
                                    <label for="answer_score_${questionNum}_1" class="form-label">Балл за ответ #1</label>
                                    <input type="text" name="answer_score_${questionNum}_1" id="answer_score_${questionNum}_1" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success addAnswer mt-3" data-question="${questionNum}" data-answer="0">Добавить вариант ответа</button>
                    </div>
                </div>
            </div>
        </div>
    </div>`);

    let optionsBlock = $('.question:last');
    optionsBlock.append(`
        <div class="my-3">
            <label class="form-label" for="inputGroupFile_${questionNum}">Загрузить изображение для вопроса</label>
            <input type="file" class="form-control" id="inputGroupFile_${questionNum}" name="picture_${questionNum}">
        </div>

        <input type="radio" class="btn-check" name="options-base_${questionNum}" id="option5_${questionNum}" value="radio" autocomplete="off" checked>
        <label class="btn" for="option5_${questionNum}">Один вариант</label>

        <input type="radio" class="btn-check" name="options-base_${questionNum}" id="option6_${questionNum}" value="checkbox" autocomplete="off">
        <label class="btn" for="option6_${questionNum}">Несколько вариантов</label>

        <input type="radio" class="btn-check" name="options-base_${questionNum}" id="option7_${questionNum}" value="text" autocomplete="off">
        <label class="btn" for="option7_${questionNum}">Свободный ответ</label>
    `);
});
$(document).on('click', '.addResult', function() {
    resultNum++;
    let resultBlock = $('#accordionResults');

    resultBlock.append(`
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResult${resultNum}" aria-expanded="false" aria-controls="collapseResult${resultNum}">
            Результат #${resultNum}
            </button>
        </h2>
        <div id="collapseResult${resultNum}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                    <div class="result">
                        <div class="result-items">
                            <div class="">
                                <label for="result_${resultNum}" class="form-label">Результат #${resultNum}</label>
                                <textarea name="result_${resultNum}" id="result_1" class="form-control" required></textarea>
                            </div>
                            <div class="d-flex justify-content-between my-3" style="gap:15px;">
                                <div style="flex:1;">
                                    <label for="result_score_min_${resultNum}" class="form-label">Балл (от) #${resultNum}</label>
                                    <input type="text" name="result_score_min_${resultNum}" id="result_score_min_${resultNum}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                </div>
                                <div style="flex:1;">
                                    <label for="result_score_max_${resultNum}" class="form-label">Балл (до) #${resultNum}</label>
                                    <input type="text" name="result_score_max_${resultNum}" id="result_score_max_${resultNum}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>`);
});