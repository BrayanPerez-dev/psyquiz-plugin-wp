
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Contenido de tu página -->
    <div class="container">
        <h3></h3>
        <br>

        <form action="" id="enquiry_form">

            <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
            wp_nonce_field('wp_rest'); ?>
            <div id="container-item">
            </div>
            <template id="template-container-item">
                <div class="p-3 text-primary-emphasis bg-light border rounded-3 mb-4 item" style="width: 100%;">
                    <h5 class="category" id="category"></h5>
                    <br>
                    <h6 class="statement" id="statement">1. Tristeza.</h6>
                    <br>

                    <div class="mb-3 form-check" id="0">
                        <input class="form-check-input" type="radio" name="radio-stacked" id="flexRadioDefault1" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            No me siento triste
                        </label>
                    </div>
                    <div class="mb-3 form-check" id="1">
                        <input class="form-check-input" type="radio" name="radio-stacked" id="flexRadioDefault2" required>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Me siento triste
                        </label>
                    </div>
                    <div class="mb-3 form-check" id="2">
                        <input class="form-check-input" type="radio" name="radio-stacked" id="flexRadioDefault3" required>
                        <label class="form-check-label" for="flexRadioDefault3">
                            Me siento triste continuamente y no puedo dejar de estarlo.
                        </label>
                    </div>
                    <div class="mb-3 form-check" id="3">
                        <input class="form-check-input" type="radio" name="radio-stacked" id="flexRadioDefault4" required>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Me siento tan triste o desgraciado que no puedo soportarlo.
                        </label>
                    </div>
                </div>
            </template>
            <button type="submit" id="btn" class="btn btn-light border">Siguiente</button>
        </form>
        <br />

        <div id='alert' class="alert alert-success" role="alert">
            Resultados guardados
        </div>
        <div class="modal fade" id="result-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title">Formulario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id='modal-body'>

                        <label class="form-label">Resultado:</label>
                        <p id="score-result"></p>
                        <form id="result_form">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Nunca compartiremos tu correo electrónico con nadie.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#alert').hide();

            const containerItem = document.getElementById('container-item')
            const fragment = document.createDocumentFragment()
            const template = document.getElementById('template-container-item').content
            const quiz = quizData;
            const titleForm = document.querySelector('h3').textContent = ''
            const button = document.getElementById('btn')
            containerItem.innerHTML = ''
            const clone = template.cloneNode(true)
            if (quiz.form_type === 'ANSIEDAD_DE_BURNS') {
                clone.querySelector('h5').textContent = `CATEGORIA: ${quiz.statements[0].category}`
                clone.querySelector('h5').id = quiz.statements[0].category
            }
            clone.querySelector('h6').textContent = `${1}. ${quiz.statements[0].statement}`
            clone.querySelector('h6').id = quiz.statements[0].statement

            clone.getElementById('0').getElementsByClassName('form-check-label')[0].textContent = quiz.statements[0].answers[0]
            clone.getElementById('1').getElementsByClassName('form-check-label')[0].textContent = quiz.statements[0].answers[1]
            clone.getElementById('2').getElementsByClassName('form-check-label')[0].textContent = quiz.statements[0].answers[2]
            clone.getElementById('3').getElementsByClassName('form-check-label')[0].textContent = quiz.statements[0].answers[3]
            fragment.appendChild(clone)
            containerItem.appendChild(fragment)

            let results = []

            $('#enquiry_form').submit(function(e) {
                e.preventDefault();
                const statement = document.getElementsByClassName('statement');
                const index = quiz.statements.findIndex((item) => item.statement === statement[0].id)
                const answers = {
                    answer1: e.target[2].checked,
                    answer2: e.target[3].checked,
                    answer3: e.target[4].checked,
                    answer4: e.target[5].checked,
                };


                const score = answers.answer1 === true ? 0 : answers.answer2 === true ? 1 : answers.answer3 === true ? 2 : answers.answer4 === true ? 3 : 0
                results = [...results, score]

                if (statement[0].id === quiz.statements[quiz.statements.length - 1].statement) {
                    const data = {
                        scores: results,
                        form: titleForm,
                        _wpnonce: '<?php echo wp_create_nonce('wp_rest'); ?>',
                        form_type: quiz.form_type
                    }

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo get_rest_url(null, 'v1/psyquiz-form/submit'); ?>',
                        data: data,
                        dataType: 'json', // Indica que esperas un JSON
                        success: function(response) {

                            $('#result-modal').modal('show');
                            document.getElementById('modal-title').textContent = quizData.form_title
                            document.getElementById('score-result').textContent = response.data.textScore

                            results = []
                            const statement = quiz.statements[0]
                            containerItem.innerHTML = ''
                            const clone = template.cloneNode(true)
                            if (quiz.form_type === 'ANSIEDAD_DE_BURNS') {
                                clone.querySelector('h5').textContent = `CATEGORIA: ${statement.category}`
                                clone.querySelector('h5').id = statement.category
                            }
                            clone.querySelector('h6').textContent = `1. ${statement.statement}`
                            clone.querySelector('h6').id = statement.statement
                            clone.getElementById('0').getElementsByClassName('form-check-label')[0].textContent = statement.answers[0]
                            clone.getElementById('1').getElementsByClassName('form-check-label')[0].textContent = statement.answers[1]
                            clone.getElementById('2').getElementsByClassName('form-check-label')[0].textContent = statement.answers[2]
                            clone.getElementById('3').getElementsByClassName('form-check-label')[0].textContent = statement.answers[3]
                            fragment.appendChild(clone)
                            containerItem.appendChild(fragment)
                            button.textContent = 'Siguiente'

                        },
                        error: function(error) {
                            
                        }
                    });
                } else {
                    const nextStatement = quiz.statements[index + 1]
                    containerItem.innerHTML = ''
                    const clone = template.cloneNode(true)
                    if (quiz.form_type === 'ANSIEDAD_DE_BURNS') {
                        clone.querySelector('h5').textContent = `CATEGORIA: ${nextStatement.category}`
                        clone.querySelector('h5').id = nextStatement.category
                    }
                    clone.querySelector('h6').textContent = `${(index + 1) + 1 }. ${nextStatement.statement}`
                    clone.querySelector('h6').id = nextStatement.statement
                    clone.getElementById('0').getElementsByClassName('form-check-label')[0].textContent = nextStatement.answers[0]
                    clone.getElementById('1').getElementsByClassName('form-check-label')[0].textContent = nextStatement.answers[1]
                    clone.getElementById('2').getElementsByClassName('form-check-label')[0].textContent = nextStatement.answers[2]
                    clone.getElementById('3').getElementsByClassName('form-check-label')[0].textContent = nextStatement.answers[3]
                    fragment.appendChild(clone)
                    containerItem.appendChild(fragment)

                    if (quiz.statements.length - 1 === index + 1) {
                        button.textContent = 'Finalizar'
                    }

                }
            });
            $('#result_form').submit(function(e) {
                e.preventDefault();
                const resultScore = document.getElementById('score-result').textContent

                const data = {
                    form: quizData.form_title,
                    name: e.target[0].value,
                    email: e.target[1].value,
                    score: resultScore,
                    _wpnonce: '<?php echo wp_create_nonce('wp_rest'); ?>',
                }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo get_rest_url(null, 'v1/psyquiz-form/save'); ?>',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#result-modal').modal('hide');
                        $('#alert').show();

                        setTimeout(() => {
                            $('#alert').hide();
                        }, 3000);
                    },
                    error: function(error) {
                        
                    }
                })
            })
        });
    </script>
