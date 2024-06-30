<form action="ListTests.php?do=save" method="post" enctype="multipart/form-data">
    <div class="card m-auto px-5" style="width: 70%">
        <p class="text-start fs-2 my-4">Создание теста</p>
        <div>
            <label for="title" class="form-label">Название теста</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <button type="button" class="btn btn-primary addQuestion my-3" style="width:fit-content">Добавить вопрос</button>
        <div class="accordion" id="accordionQuestions">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuestion1" aria-expanded="false" aria-controls="collapseQuestion1">
                        Вопрос #1
                    </button>
                </h2>
                <div id="collapseQuestion1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="question-items">
                            <label for="question_1" class="form-label">Текст вопроса</label>
                            <input type="text" name="question_1" id="question_1" class="form-control mb-3" required>

                            <div class="my-3">
                                <label for="picture_1" class="form-label">Загрузить изображение для вопроса</label>
                                <input type="file" class="form-control" id="picture_1" name="picture_1">
                            </div>

                            <input type="radio" class="btn-check" name="options-base_1" id="option5" value="radio" autocomplete="off" checked>
                            <label class="btn" for="option5">Один вариант</label>

                            <input type="radio" class="btn-check" name="options-base_1" id="option6" value="checkbox" autocomplete="off">
                            <label class="btn" for="option6">Несколько вариантов</label>

                            <input type="radio" class="btn-check" name="options-base_1" id="option7" value="text" autocomplete="off">
                            <label class="btn" for="option7">Свободный ответ</label>

                            <div class="answers">
                                <div class="answer-items">
                                    <div class="d-flex justify-content-between" style="gap:15px;">
                                        <div style="flex:1;">
                                            <label for="answer_text_1_1" class="form-label">Ответ #1</label>
                                            <input type="text" name="answer_text_1_1" id="answer_text_1_1" class="form-control" required>
                                        </div>
                                        <div style="flex:1;">
                                            <label for="answer_score_1_1" class="form-label">Балл за ответ #1</label>
                                            <input type="text" name="answer_score_1_1" id="answer_score_1_1" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success addAnswer mt-3" data-question="1" data-answer="1">Добавить вариант ответа</button>
                                <button type="button" class="btn btn-primary addAnswer mt-3" data-question="1" data-answer="1">Удалить вариант ответа</button>
                            </div>
                            <button type="button" class="btn btn-primary addQuestion my-3" style="width:fit-content">Удалить вопрос</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-start fs-2 mt-3">Результаты</p>
        <button type="button" class="btn btn-primary addResult my-3" style="width:fit-content">Добавить результат</button>
        <div class="accordion" id="accordionResults">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResult1" aria-expanded="false" aria-controls="collapseResult1">
                        Результат #1
                    </button>
                </h2>
                <div id="collapseResult1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="results">
                            <div class="result-items">
                                <div class="">
                                    <label for="result_1" class="form-label">Результат #1</label>
                                    <textarea name="result_1" id="result_1" class="form-control" required></textarea>
                                </div>
                                <div class="d-flex justify-content-between my-3" style="gap:15px;">
                                    <div style="flex:1;">
                                        <label for="result_score_min_1" class="form-label">Балл (от) #1</label>
                                        <input type="text" name="result_score_min_1" id="result_score_min_1" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                    </div>
                                    <div style="flex:1;">
                                        <label for="result_score_max_1" class="form-label">Балл (до) #1</label>
                                        <input type="text" name="result_score_max_1" id="result_score_max_1" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                    </div> 
       
                                </div>
                                <button type="button" class="btn btn-primary addQuestion" style="width:fit-content">Удалить результат</button>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary my-4 w-25">Сохранить</button>
        </div>
    </div>
</form>
