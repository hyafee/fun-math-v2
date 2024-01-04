<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FunMath - Quiz</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-K5+9u5z2WqS6EU5yfEUbR/iQrRus5TDO3YD4ea2iG8SNwBE2dEz/48KaIbSzeHpig/LdA7EK9SyiG6bqD4U8Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        [type='radio']:checked,
        [type='radio']:checked:hover,
        [type='radio']:checked:focus {
            background-color: #00ECCC !important;
            background-image: none;
            outline: none;
            appearance: none;
            box-shadow: none
        }

        input[type="radio"]:checked+label {
            color: white;
        }
    </style>

    <script defer>
        var quiz = @json($quizzes);

        var currentQuestion = 0;
        var userAnswers = [];
        var optionValue = 0;
        var timeLimit = 60; // 2 minutes in seconds
        var timer;
        var timerStarted = false;

        function startTimer() {
            timer = setInterval(function() {
                timeLimit--;
                updateTimer();

                if (timeLimit <= 0) {
                    clearInterval(timer);
                    saveResult();
                }
            }, 1000);
        }

        function updateTimer() {
            var minutes = Math.floor(timeLimit / 60);
            var seconds = timeLimit % 60;
            document.getElementById('timer').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        function displayQuestion() {
            if (!timerStarted) {
                startTimer();
                timerStarted = true;
            }
            if (currentQuestion < quiz.length) {
                var currentQuiz = quiz[currentQuestion];
                document.getElementById('pertanyaan').textContent = currentQuiz.question;

                var parsedChoices = JSON.parse(currentQuiz.choices);

                for (var i = 0; i < 4; i++) {
                    var option = document.getElementById('option-answer' + (i + 1));
                    option.textContent = parsedChoices[i];
                }

                currentQuestion++;
                var radioButtons = document.querySelectorAll(".option");
                radioButtons.forEach(function(radio) {
                    radio.checked = false;
                });
                document.getElementById('nomorPertanyaan').textContent = currentQuestion;
                document.querySelector('#randomImage').setAttribute('src', 'images/random-' + (Math.floor(Math.random() *
                    2) + 1) + '.svg');
                document.querySelector('#randomImageSoal').setAttribute('src', 'images/random-soal-' + (Math.floor(Math
                    .random() * 19) + 1) + '.svg');

                document.getElementById('nextButton').classList.add('hidden');
            } else {
                saveResult();
            }
        }

        function selectOption(selectedOption) {
            optionValue = document.getElementById(selectedOption).textContent;
            document.getElementById('nextButton').classList.remove('hidden');
        }

        function saveResult() {
            var resultListData = [];

            for (var i = 0; i < currentQuestion; i++) {
                var userAnswer = userAnswers[i] !== undefined && userAnswers[i] !== null ? userAnswers[i] : 0;

                if (userAnswer !== 0 || currentQuestion > 1) {
                    resultListData.push({
                        quiz_id: quiz[i].id,
                        user_answer: userAnswer,
                    });
                }
            }

            if (resultListData.length > 0) {
                resultListData.pop();

                axios.post('{{ route('save.result') }}', {
                        result_list: resultListData,
                    })
                    .then(function(response) {
                        window.location.href = '/result/' + response.data.id;
                    })
                    .catch(function(error) {
                        console.error('Error saving result:', error);
                    }).finally(function() {
                        document.getElementById('loading').classList.add('hidden');
                    });
            } else {
                console.warn('User answer is empty for the first question.');
                document.getElementById('loading').classList.add('hidden');
            }
        }

        function nextBtn() {
            userAnswers.push(optionValue);
            displayQuestion();
        }
    </script>
</head>

<body class="antialiased bg-primary text-white max-w-screen p-4 max-w-4xl mx-auto">

    <div id="loading" class="hidden fixed inset-0 bg-primary z-50 flex justify-center items-center">
        @include('components.loader')
    </div>



    <header>
        <div class="flex justify-between items-center">
            <div class="left flex items-center"><img src="{{ asset('images/logo.svg') }}" alt=""></div>
            <div class="right flex align-center items-end font-bold">Semangat, <img width="35px"
                    src="{{ asset('images/semangat.gif') }}" alt="" class="ml-2"></div>
        </div>
    </header>

    <div class="mt-10 relative">
        <p>Soal <span id="nomorPertanyaan"></span></p>
        <p class="font-bold mt-4">Waktu Tersisa</p>
        <span id="timer" class="text-2xl">1:00</span>
        <img id="randomImage" src="{{ asset('images/random-' . rand(1, 2) . '.svg') }}" width="95px" height="95px"
            class="animate-[bounce_10s_infinite] absolute right-0 -top-0" alt="">
    </div>

    <div class="mt-10 text-sm">
        <p>Silahkan baca dan hitung soal di bawah ini.</p>
        <div class="bg-white sm:w-6/12 mx-auto rounded mt-5 relative">
            <img id="randomImageSoal" src="{{ asset('images/random-soal-' . rand(1, 19) . '.svg') }}" alt=""
                class="absolute left-5 bottom-2" width="70px">
            <p class="text-5xl text-black font-black text-center py-10" id="pertanyaan">1 + 12</p>
        </div>
        <div class="mt-5">
            <p>Masukkan jawaban di bawah sini.</p>
            <p class="mt-2">Klik pada salah satu kotak untuk menjawab pertanyaan dengan benar.</p>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="mt-10 grid grid-cols-2 w-fit gap-4" id="choices">
            @for ($i = 1; $i <= 4; $i++)
                <div class="relative w-fit m-auto">
                    <input type="radio" name="options"
                        class="option appearance-none checked:bg-[#00ECCC] font-black text-4xl w-28 h-28 bg-white rounded flex justify-center items-center"
                        id="option{{ $i }}">
                    <label for="option{{ $i }}" onclick="selectOption('option-answer{{ $i }}')"
                        class="absolute inset-0 text-4xl text-black font-bold flex justify-center items-center">
                        <span id="option-answer{{ $i }}">1</span>
                    </label>
                </div>
            @endfor
        </div>
    </div>

    <div class="mt-5 flex justify-center min-h-14">
        <button id="nextButton" onclick="nextBtn()"
            class="hidden bg-gradient-to-l from-[#E45895] to-[#BC6AE5] py-3 rounded w-full sm:w-6/12">Selanjutnya</button>
    </div>
    <script defer>
        displayQuestion();
    </script>
</body>

</html>
