@extends('components.layout.index')

@section('content')
    <div class="items-center px-2 pt-3 h-96 relative">
        <h3 class="text-xl text-center font-bold mb-2 uppercase">{{ $kuesioner->subjek }}</h3>
        
        <section class="flex justify-between w-full text-xs my-3">
            <div class="text-white text-center rounded bg-violet-500 p-2 font-bold">
                <h2>Created At</h2>
                <p>{{ \Carbon\Carbon::parse($kuesioner->created_at)->format('d-m-Y') }}</p>
            </div>
            <div class="text-white text-center rounded bg-violet-500 p-2 font-bold">
                <h2>Edited At</h2>
                <p>{{ \Carbon\Carbon::parse($kuesioner->edited_at)->format('d-m-Y') }}</p>
            </div>
        </section>

        <div class="mb-5 text-sm text-gray-400">
            <h2 class="font-bold">Ditanyakan Oleh:</h2>
            <p>{{ $kuesioner->creator->username }}</p>
        </div>
        <div>
            <h2 class="font-bold">Pertanyaan:</h2>
            <p class="h-24">{{ $kuesioner->pertanyaan }}</p>
        </div>

        <div class="mt-4">
            @if($kuesioner->bestAnswer)
                <h2 class="font-bold text-green-600">Best Answer:</h2>
                <div class="bg-green-100 px-2 py-5 rounded my-2">
                    <p>{{ $kuesioner->bestAnswer->jawaban}}</p>
                </div>
            @endif

            <h2 class="font-bold">Answers:</h2>
            @if($kuesioner->answers->isEmpty())
                <p>No answer provided</p>
            @else
                @foreach($kuesioner->answers as $answer)
                    <div x-data="{ isEditing: false }" class="bg-gray-100 p-2 rounded my-2 flex justify-between items-center">
                        <div class="flex-1">
                            <form action="{{ route('kuesioner.jawaban.update', $answer->id) }}" method="POST" class="w-full flex justify-between" x-show="isEditing">
                                @csrf
                                @method('PUT')
                                <textarea name="jawaban" rows="1" class="w-full p-2 border rounded" required>{{ $answer->jawaban }}</textarea>
                                <button type="submit" class="text-blue-500 hover:text-blue-700 mx-2">Save</button>
                            </form>
                            <p x-show="!isEditing" x-text="`{{ $answer->jawaban }}`"></p>
                            <p class="text-xs text-gray-500">Answered by: {{ $answer->creator->username }}</p>
                        </div>
                        @if(Auth::user()->id == $answer->created_by)
                            <div class="flex items-center">
                                <button class="text-blue-500 hover:text-blue-700 mr-2" @click="isEditing = !isEditing" x-show="!isEditing">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button class="text-blue-500 hover:text-blue-700 mr-2" @click="isEditing = false" x-show="isEditing">Cancel</button>
                                <form action="{{ route('kuesioner.jawaban.destroy', $answer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this answer?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                @if($answer->kuesioner->bestAnswer === null || $answer->kuesioner->bestAnswer->id_kuesioner_jawaban != $answer->id)
                                    <form action="{{ route('kuesioner.markAsBest', $answer->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:text-green-700 ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 2l2.09 6.26L20 10l-5 4 2 6-6-4-6 4 2-6-5-4 6-1.74L12 2z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        @if(Auth::user()->peran == 'Administrator')
            <div class="mt-4">
                <h2 class="font-bold">Submit an Answer:</h2>
                <form action="{{ route('kuesioner.jawaban.store', $kuesioner->id) }}" method="POST">
                    @csrf
                    <textarea name="jawaban" rows="3" class="w-full p-2 border rounded" required></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Submit</button>
                </form>
            </div>
        @endif
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
