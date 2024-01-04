@php
    $categories = (new \App\Http\Controllers\CategoryController())->getCategory();
@endphp

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
                <input type="text" name="question" id="question" required class="my-1 rounded border-slate">
                <span class="text-xs text-slate">Contoh: 19 + 19</span>
                <hr class="my-3">

                <label for="category">Category</label>
                <select name="category" id="category" required class="p-2 border-slate rounded my-1">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="text-xs text-slate">Pilih kategori penjumlahan / pengurangan</span>
                <hr class="my-3">

                <label for="answer">Correct Answer:</label>
                <input type="number" name="answer" id="answer" required class="my-1 rounded border-slate">
                <span class="text-xs text-slate">Pilih jawaban benar, contoh: 38</span>
                <hr class="my-3">

                <label for="choices">Choices (comma-separated):</label>
                <input type="text" name="choices" id="choices" required class="my-1 rounded border-slate">
                <span class="text-xs text-slate">Pilih angka untuk dipilih oleh user</span>
                <span class="text-xs text-slate">Contoh: 37, 28, 29, 38</span>

                <button type="submit" class="bg-green rounded w-fit p-2 px-6 text-sm text-white mt-4 mb-2">Tambah
                    Quiz</button></button>
            </form>
        </div>
    </div>
    <livewire:scripts />
</x-app-layout>
