<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form class="w-3/4" method="POST" action="{{route('add-question')}}">
                    @csrf
                    <div class="mb-5">
                        <label for="question" class="label">Question</label>
                        <input type="text" id="question" name="question" class="text-input" required />
                    </div>
                    <div class="mb-5">
                        <label for="answer1" class="label">Answer 1</label>
                        <input type="text" id="answer1" name="answer1" class="text-input" required />

                        <input id="correct" name="correct" type="radio" value="answer1" class="radio-input" />
                        <label for="correct" class="radio-input-label">Correct</label>
                    </div>
                    <div class="mb-5">
                        <label for="answer2" class="label">Answer 2</label>
                        <input type="text" id="answer2" name="answer2" class="text-input" required />

                        <input id="correct" name="correct" type="radio" value="answer2" class="radio-input" />
                        <label for="correct" class="radio-input-label">Correct</label>
                    </div>
                    <div class="mb-5">
                        <label for="answer3" class="label">Answer 3</label>
                        <input type="text" id="answer3" name="answer3" class="text-input" required />

                        <input id="correct" name="correct" type="radio" value="answer3" class="radio-input" />
                        <label for="correct" class="radio-input-label">Correct</label>
                    </div>
                    <div class="mb-5">
                        <label for="answer4" class="label">Answer 4</label>
                        <input type="text" id="answer4" name="answer4" class="text-input" required />

                        <input id="correct" name="correct" type="radio" value="answer4" class="radio-input"  />
                        <label for="correct" class="radio-input-label">Correct</label>
                    </div>

                    <button type="submit" class="blue-btn">Add Question</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

