<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmissionsBotController extends Controller
{
    // app/Http/Controllers/AdmissionsBotController.php

    public function respond(Request $request)
    {
        // Get the current step from the request
        $step = $request->input('step', 1); // Default to 1 if no step is provided

        // Define the flow of responses and options based on the step
        $responseData = $this->getBotResponse($step);

        // Return the response as JSON
        return response()->json($responseData);
    }

    private function getBotResponse($step)
    {
        // Define responses and options based on the step
        switch ($step) {
            case 1:
                return [
                    'message' => 'Welcome to the Admissions Chatbot! Please select an option.',
                    'options' => [
                        ['id' => 2, 'text' => 'Eligibility Criteria'],
                        ['id' => 3, 'text' => 'Admission Deadlines'],
                        ['id' => 4, 'text' => 'Fee Structure'],
                        ['id' => 5, 'text' => 'Contact Admission Office']
                    ],
                ];

            case 2: // Eligibility Criteria
                return [
                    'message' => 'Eligibility Criteria: You need at least 50% marks in your qualifying exams. Choose another option or go back:',
                    'options' => [
                        ['id' => 1, 'text' => 'Main Menu'],
                    ],
                ];

            case 3: // Admission Deadlines
                return [
                    'message' => 'Admission Deadlines: Applications close on March 15th. Choose another option or go back:',
                    'options' => [
                        ['id' => 2, 'text' => 'Main Menu'],
                    ],
                ];

            case 4: // Fee Structure
                return [
                    'message' => 'The fee structure varies depending on the program. Please select a course to get the fee details.',
                    'options' => [
                        ['id' => 1, 'text' => 'Main Menu'],
                    ],
                ];

            case 5: // Contact Admission Office
                return [
                    'message' => 'You can contact the Admission Office at admissions@university.com or call (123) 456-7890.',
                    'options' => [
                        ['id' => 1, 'text' => 'Main Menu'],
                    ],
                ];

            default:
                return [
                    'message' => 'I did not understand that. Please select a valid option.',
                    'options' => [
                        ['id' => 1, 'text' => 'Main Menu'],
                    ],
                ];
        }
    }
}
