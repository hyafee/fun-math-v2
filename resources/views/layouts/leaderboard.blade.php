@php
    $leaderboardData = (new \App\Http\Controllers\QuizController())->getLeaderboard();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- your head content here -->
</head>

<body>
    <div class="mt-6">
        <table class="table-auto w-full border-collapse border border-slate-500 mt-2 bg-primary">
            <thead class="bg-[#00ECCC]">
                <tr>
                    <th class="border border-slate-600 drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.5)]">
                        Rank</th>
                    <th class="border border-slate-600 drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.5)]"">
                        User</th>
                    <th class="border border-slate-600 drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.5)]">
                        Total Score</th>
                </tr>
            </thead>
            <tbody class="text-sm text-white">
                @if (empty($leaderboardData))
                    <tr>
                        <td class="border border-slate-600 pl-1 text-center" colspan="3">Belum ada data</td>
                    </tr>
                @else
                    @foreach ($leaderboardData as $index => $item)
                        <tr class="{{ auth()->id() == $item->user->id ? 'bg-[#274B5B] font-bold' : '' }}">
                            <td class="border border-slate-600 pl-1 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-600 pl-1">
                                {{ $item->user->name }}</td>
                            <td class="border border-slate-600 pl-1">{{ $item->total_score }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
