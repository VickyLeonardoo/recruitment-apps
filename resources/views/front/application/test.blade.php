<x-app-layout>
    <div class="py-12 min-h-screen bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Online Assessment</h1>
                <p class="text-gray-600 mt-2">Please answer all questions carefully</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Main Content Area -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <div class="space-y-8">
                            @foreach ($tests as $index => $test)
                                <div class="pb-6 border-b border-gray-200 last:border-0">
                                    <p class="text-lg font-medium text-gray-800 mb-4">
                                        {{ $index + 1 }}. {{ $test->question->description }}
                                    </p>
                                    <div class="space-y-3">
                                        @foreach ($test->question->choice as $choice)
                                            <label
                                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 cursor-pointer group">
                                                <input type="radio" name="answers[{{ $test->question->id }}]"
                                                    value="{{ $choice->id }}"
                                                    data-question-id="{{ $test->question->id }}"
                                                    data-test-id="{{ $test->test_id }}"
                                                    {{ $test->choice_id == $choice->id ? 'checked' : '' }}
                                                    class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                <span class="ml-3 text-gray-700 group-hover:text-gray-900">
                                                    {{ $choice->label }}. {{ $choice->answerText }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <form action="{{ route('applicant.application.submit', $test->test_id) }}" method="POST"
                            class="mt-8">
                            @csrf
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    Submit Answers
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-6 space-y-6">
                        <!-- Timer -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Time Remaining</h3>
                            <div id="timer"
                                class="text-3xl font-bold text-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg text-blue-600">
                            </div>
                        </div>

                        <!-- Question Navigation -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Questions</h3>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($tests as $index => $test)
                                    <div id="question_{{ $test->question->id }}"
                                        class="question-box aspect-square rounded-lg flex items-center justify-center text-sm font-medium cursor-pointer transition-colors border border-gray-200 hover:border-blue-500 bg-white hover:bg-blue-50">
                                        {{ $index + 1 }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const addAnsweredClass = (questionId) => {
                console.log('Setting answered class for question', questionId);
                $(`#question_${questionId}`).removeClass('bg-white hover:bg-blue-50 text-gray-700')
                    .addClass('bg-blue-600 text-white border-blue-600 hover:bg-blue-700');
            };
    
            // Timer Logic
            var startTime = new Date("{{ $start_time }}").getTime();
            var currentTime = new Date().getTime();
            var endTime = startTime + 30 * 60 * 1000; // 30 minutes
    
            function startTimer() {
                var now = new Date().getTime();
                var distance = endTime - now;
    
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                // Update timer display with leading zeros
                $('#timer').text(
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`
                );
    
                if (distance < 0) {
                    clearInterval(x);
                    $('#timer').text("Time's Up!")
                        .removeClass('text-blue-600')
                        .addClass('text-red-600');
                    $('input[type="radio"]').prop('disabled', true);
                    $('button[type="submit"]').prop('disabled', true)
                        .addClass('opacity-50 cursor-not-allowed');
                }
            }
    
            if (currentTime > endTime) {
                $('#timer').text("Time's Up!")
                    .removeClass('text-blue-600')
                    .addClass('text-red-600');
                $('input[type="radio"]').prop('disabled', true);
                $('button[type="submit"]').prop('disabled', true)
                    .addClass('opacity-50 cursor-not-allowed');
            } else {
                var x = setInterval(startTimer, 1000);
            }
    
            // Answer Saving Logic
            $('input[type="radio"]').on('change', function() {
                var questionId = $(this).data('question-id');
                var testId = $(this).data('test-id');
                var choiceId = $(this).val();
    
                console.log('Question ID:', questionId, 'Test ID:', testId, 'Choice ID:', choiceId);
    
                $.ajax({
                    url: '{{ route('applicant.application.test.saveAnswer') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        question_id: questionId,
                        test_id: testId,
                        choice_id: choiceId
                    },
                    success: function(response) {
                        console.log('Save successful:', response);
                        if (response.success) {
                            addAnsweredClass(questionId);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
    
            // Initialize answered questions
            $('input[type="radio"]:checked').each(function() {
                var questionId = $(this).data('question-id');
                addAnsweredClass(questionId);
            });
        });
    </script>
</x-app-layout>
