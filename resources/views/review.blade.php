<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FunMath - Review</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-primary text-white max-w-screen p-4 relative max-w-4xl mx-auto">
    <header>
        <div class="flex justify-between items-center">
            <div class="left flex items-center"><img src="{{ asset('images/logo.svg') }}" alt=""></div>
            <div class="right flex align-center items-end font-bold">Tetap Belajar ya, <img width="44px"
                    src="{{ asset('images/panda.gif') }}" alt="" class="ml-2"></div>
        </div>
    </header>
    <br>
    <div class="rounded bg-gradient-to-r from-[#E45895] to-[#BC6AE5] p-4 text-sm">
        <div class="font-bold flex justify-between">
            <p>Skor : <span id="skor">{{ $quizResult->score }}</span></p>
            <p>Jumlah Benar : <span id="jumlah-benar">{{ $quizResult->score / 2 }}</span> / <span
                    id="jumlah-soal">{{ count($quizData) }}</span>
            </p>
        </div>
    </div>
    <div class="flex w-full flex-col items-center">
        <p class="mt-4 text-2xl font-medium">Leaderboard</p>
        <div class="w-3/4 -mt-3">
            @include('layouts.leaderboard')
        </div>
    </div>
    <br>
    <p class="text-2xl font-medium mb-3">Review Soal</p>
    <div id="card" class="flex flex-col gap-5"></div>
    <div class="mt-10 flex justify-center bottom-1">
        <a href="/" class="mt-2 w-3/4 p-2 rounded text-center bg-[#F08778]">Kembali</a>
    </div>

    <script>
        var quizData = @json($quizData);

        var resultListContainer = document.getElementById('card');

        quizData.forEach(function(item, index) {
            var resultItem = document.createElement('div');
            resultItem.className = "rounded bg-[#383E6E] p-4 text-sm border border-solid border-2";
            if (item.is_correct) {
                resultItem.classList.add("border-[#00ECCC]");
            } else {
                resultItem.classList.add("border-[#F08778]");
            }

            var choices = JSON.parse(item.choices);

            resultItem.innerHTML = `
                <p class="font-bold">Soal no ${index + 1}</p>
                <p class="text-center text-5xl font-bold mt-5">${item.question}</p>
                <div class="mt-10 grid grid-cols-4 gap-10">
                    ${choices.map((choice, choiceIndex) => `
                                                                                                                                                        <div class="py-4 rounded text-white ${choice == item.user_answer && choice == item.correct_answer ? 'bg-[#00ECCC]' : choice == item.user_answer && choice != item.correct_answer ? 'bg-[#F08778]' : choice == item.correct_answer ? 'bg-[#00ECCC]' : 'bg-white !text-black'}">
                                                                                                                                                            <p class="text-center font-bold">${choice}</p>
                                                                                                                                                        </div>`).join('')}
                </div>
                <p class="mt-5">Kamu <span class='font-bold'>${item.is_correct ? 'Benar' : 'Salah'}</span>, jawaban kamu adalah ${item.user_answer}</p>
                <p class="font-bold">Jawaban yang benar adalah ${item.correct_answer}</p>
            `;

            resultListContainer.appendChild(resultItem);
        });
    </script>

</body>

</html>
