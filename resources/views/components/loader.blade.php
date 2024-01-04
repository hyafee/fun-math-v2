    <div class="flex flex-col items-center">
        <div id="loader"></div>
        <p class="mt-3">Menghitung Hasil Quiz...</p>
    </div>

    <style>
        #loader {
            width: 40px;
            aspect-ratio: 1;
            --c: linear-gradient(#26C8BC 0 0);
            --m: radial-gradient(farthest-side, #26C8BC 90%, #26C8BC);
            background: var(--c), var(--m), var(--c);
            background-size: 16px 8px, 10px 10px;
            background-repeat: no-repeat;
            animation:
                l19-1 .5s infinite alternate,
                l19-2 4s infinite linear .5s;
        }

        @keyframes l19-1 {

            0%,
            10% {
                background-position: calc(50% - 8px) 50%, 50% 10%, calc(50% + 8px) 50%
            }

            80%,
            100% {
                background-position: -20px 50%, 50% 50%, calc(100% + 20px) 50%
            }
        }

        @keyframes l19-2 {

            0%,
            24.99% {
                transform: rotate(0)
            }

            25%,
            49.99% {
                transform: rotate(90deg)
            }

            50%,
            74.99% {
                transform: rotate(180deg)
            }

            75%,
            100% {
                transform: rotate(270deg)
            }
        }
    </style>
