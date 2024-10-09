<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           All Question Count: {{$totalQuestionsCount}} / Correct Answering Count: {{$totalCorrectAnswerCount}}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('message'))

                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{session('message')}}
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-3 p-6 text-gray-900 dark:text-gray-100">
                @foreach($questions as $question)
                    <div
                        class="max-w-sm p-6 ml-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                        <form action="{{route('answer-for-question', [$question->id])}}" method="POST">

                            @csrf

                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{$question->question}}
                            </h5>

                            @foreach($question->answers as $index => $answer)
                                <div class="mt-4">
                                    <input type="radio" name="answer" value="{{'answer'.$index + 1}}">
                                    <label>{{$answer->answer}}</label>
                                </div>
                            @endforeach



                            <button type="submit" class="blue-btn mt-4">
                                Answer
                            </button>

                        </form>

                    </div>
                @endforeach


            </div>
        </div>
    </div>
</x-app-layout>
