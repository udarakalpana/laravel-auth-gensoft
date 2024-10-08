<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Question Count / Correct answering count
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-2 p-6 text-gray-900 dark:text-gray-100">


                @foreach($questions as $question)
                    <div
                        class="max-w-sm p-6 ml-4 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                        <form action="">

                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{$question->question}}
                            </h5>

                            @foreach($question->answers as $index => $answer)
                                <div class="mt-4">
                                    <input type="radio" name="answer" value="{{'answer'.$index + 1}}">
                                    <label>{{$answer->answer}}</label>
                                </div>
                            @endforeach



                            <button type="submit" class="blue-btn">
                                Answer
                            </button>

                        </form>

                    </div>
                @endforeach


            </div>
        </div>
    </div>
</x-app-layout>
