<x-app-layout>
    @laravelViewsStyles
    @laravelViewsScripts(laravel - views)
    <div class="p-4 pr-0 sm:ml-64">
        @livewire('quiz-table-view')
        <hr class="border-slate my-4">
        <div class="mb-4">
            <p class="text-2xl text-white font-bold">Tambah Quiz</p>
        </div>
        <div class="bg-white rounded p-4">
            <form action="{{ route('admin-quiz') }}" method="post" class="flex flex-col">
                @csrf

                <label for="question">Question</label>
                <input type="text" name="question" id="question" required class="my-1 rounded border-slate"
                    placeholder="19 + 19">
                <span class="text-xs text-slate">Contoh: 19 + 19</span>
                <hr class="my-3">

                <!-- Kategori dihapus -->

                <label for="answer">Correct Answer:</label>
                <input type="number" name="answer" id="answer" required class="my-1 rounded border-slate"
                    placeholder="38">
                <span class="text-xs text-slate">Pilih jawaban benar, contoh: 38</span>
                <hr class="my-3">

                <label for="choices1">Choices:</label>
                <div class="flex gap-2">
                    <input type="text" name="choices1" id="choices1" pattern="\d+"
                        title="Only numeric values allowed" required class="my-1 flex-1 rounded border-slate"
                        placeholder="37">
                    <input type="text" name="choices2" id="choices2" pattern="\d+"
                        title="Only numeric values allowed" required class="my-1 flex-1 rounded border-slate"
                        placeholder="28">
                    <input type="text" name="choices3" id="choices3" pattern="\d+"
                        title="Only numeric values allowed" required class="my-1 flex-1 rounded border-slate"
                        placeholder="29">
                    <input type="text" name="choices4" id="choices4" pattern="\d+"
                        title="Only numeric values allowed" required class="my-1 flex-1 rounded border-slate"
                        placeholder="38">
                </div>

                <span class="text-xs text-slate">Pilih angka untuk dipilih oleh user</span>
                <span class="text-xs text-slate">Contoh: 37, 28, 29, 38</span>

                <button type="submit" class="bg-green rounded w-fit p-2 px-6 text-sm text-white mt-4 mb-2">Tambah
                    Quiz</button></button>
            </form>
        </div>
    </div>
    <livewire:scripts />
</x-app-layout>
