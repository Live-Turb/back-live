<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class ChatGptController extends Controller
{

    public function generateCommentInput(Request $request)
    {
        $api_key = Config::get('services.openai.api_key');

        if (!$api_key) {
            throw new \Exception('OpenAI API key not found. Please set OPENAI_API_KEY in your .env file.');
        }

        $content = "";
$comments_needed = 50;
$batch_size = 50; // Number of comments per request
while (count(explode("\n", $content)) < $comments_needed) {
    $prompt = <<<EOT
This prompt is for a SaaS platform targeting direct marketing professionals and live sales individuals. Our system caters to those who sell using a VSL. However, the audience's awareness level regarding VSLs is quite high, so we've developed a platform that mirrors YouTube's visual style but generates comments using AI. Retention rates for traditional VSLs and conversion rates are declining for everyone due to the market's increased awareness. Our goal is to revolutionize the market with this new approach to VSLs, where viewers believe they're watching a real live stream and are then presented with a product offer. Initially, our system will be designed for those selling via VSLs, but it can be adapted to other services like digital launches. However, this method of creating a sales page with a VSL where viewers are unaware it's a VSL and will receive a product offer is becoming saturated, and retention and conversion rates are declining for everyone due to market awareness. I want you to generate comments that people typically leave on videos within the niche I'll specify. Be detailed, pinpoint the audience's secret pain points, avoid sounding artificial, and stay on topic. Start with comments from various US cities (e.g., "Watching from NYC," "Just got to Orlando, keeping an eye on this live stream"). Mix in third-person compliments (e.g., "My aunt said her neighbor bought this from the live stream and loves it"). Include some pessimistic comments and doubts to make it seem less manipulated. Also, incorporate real questions the audience might have about the product. Analyze all product details and generate well-crafted comments.

Avoid formal language and don't make comments sound like they were written by an AI. Use casual language and even some internet slang.
Apply techniques such as concrete emotional details, vulnerability about difficulties, showcasing failed attempts, and including specific details.
Generate comments based on the language provided in the product details.

Here are the product details to be used as a basis for generating comments:
Product Name: {$request->prompt['productName']}
Category: {$request->prompt['productCategory']}
Description: {$request->prompt['productDescription']}
Benefits: {$request->prompt['productBenefits']}
Price: {$request->prompt['productPrice']}
Target Audience Age: {$request->prompt['targetAudienceAge']}
Gender: {$request->prompt['targetAudienceGender']}
Interests: {$request->prompt['targetAudienceInterests']}
Problems Solved: {$request->prompt['commonProblems']}
Important Topics: {$request->prompt['importantTopics']}
Common Questions: {$request->prompt['commonQuestions']}
Positive Experiences: {$request->prompt['positiveExperiences']}
Constructive Criticism: {$request->prompt['criticism']}
Interaction Incentives: {$request->prompt['incentives']}
Comment Tone: {$request->prompt['toneOfComments']}
Use of Emojis: {$request->prompt['useOfEmojis']}
Comment Frequency: every 1-2 minutes.

Remember, viewers shouldn't realize it's a VSL, but comments should subtly encourage them to buy the product. Generate appropriate comments based on the provided data. My Product name is {$request->prompt['productName']}. Create Comment for my product.
EOT;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens' => 2048,
        ]));

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $response_data = json_decode($response, true);
        $content .= $response_data['choices'][0]['message']['content'];
curl_close($ch);
}
        $numbers = [];
        $comments = [];

        // Log da resposta para debug
        Log::debug('API Response Content (generateCommentInput):', ['content' => $content]);

        // Primeiro padrão - original (mantido para compatibilidade)
        preg_match_all('/\d+\.\s*[^"]+"[^"]+"/', $content, $matches);

        if (!empty($matches[0])) {
            foreach ($matches[0] as $match) {
                preg_match('/^\d+/', $match, $numMatch);
                if (isset($numMatch[0])) {
                    $numbers[] = $numMatch[0];
                }
                preg_match('/".*"/', $match, $commentMatch);
                if (isset($commentMatch[0])) {
                    $comments[] = $commentMatch[0];
                }
            }
        }

        // Se não encontrou comentários, tenta padrão alternativo 1
        if (empty($comments)) {
            preg_match_all('/\d+\.\s*(.+)(?:\n|$)/', $content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $comment) {
                    $comments[] = '"' . trim($comment) . '"';
                }
            }
        }

        // Se ainda não encontrou, tenta padrão alternativo 2
        if (empty($comments)) {
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && !preg_match('/^\d+\.?\s*$/', $line)) {
                    $comments[] = '"' . $line . '"';
                }
            }
        }

        if (empty($comments)) {
            Log::warning('No comments found in content (generateCommentInput):', ['content' => $content]);
            return response()->json([
                'message' => 'No comments were found. Try again with another prompt',
                'debug_info' => 'Content received but no valid comments could be extracted'
            ], 500);
        }

        $newComment = [];
        foreach ($comments as $comment) {
            $trim = trim($comment, '"');
            if (!empty($trim)) {
                $newComment[] = $trim;
            }
        }

        // foreach ($newComment as $comment) {
        //     dd($comment);
        // }
        return response()->json(['message' => 'Comments were found', 'comments' => $newComment], 200);
    }


    public function generateComment(Request $request)
    {

        // $mystring = ""

        // dd($request->all());
        // dd($numbers, $comments);
        //api token
        $api_key = Config::get('services.openai.api_key');

        if (!$api_key) {
            throw new \Exception('OpenAI API key not found. Please set OPENAI_API_KEY in your .env file.');
        }
$content = "";
$comments_needed = 50;
$batch_size = 50; // Number of comments per request

while (count(explode("\n", $content)) < $comments_needed) {
        $prompt = "I'm creating a product page on a YouTube-like platform,representing a live broadcast with live chat I need Al-generated comments to simulate a real chat and encourage purchases. the comments should soem authentic, including both positive and mixed reactions Here are the product details Product Name Category Description Benefits Price Target Ausence Age Gender Interest: Problems Solved Important Topic: Common Questions: Positive Experiences: Constructive Critism: Interaction Incertives Comment Tone:Use of Emojis: Comment Frequency:every 1-2 minutes Remember, Viewers shouldn't realize it's a VSL, but comments should subey encourage them to buy the product Generate appropriate comments based on the provided data." . $request->prompt ." Generate at least {$batch_size} comments that follow this structure.";

          $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 2048, // Increase this value to allow more content
    ]));

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key,
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $response_data = json_decode($response, true);

    // Append the generated comments to the $comments string
    $content .= $response_data['choices'][0]['message']['content'] . "\n";

    curl_close($ch);
}


        $numbers = [];
        $comments = [];

        // Log da resposta para debug
        Log::debug('API Response Content:', ['content' => $content]);

        // Primeiro padrão - original (mantido para compatibilidade)
        preg_match_all('/\d+\.\s*[^"]+"[^"]+"/', $content, $matches);

        if (!empty($matches[0])) {
            foreach ($matches[0] as $match) {
                preg_match('/^\d+/', $match, $numMatch);
                if (isset($numMatch[0])) {
                    $numbers[] = $numMatch[0];
                }
                preg_match('/".*"/', $match, $commentMatch);
                if (isset($commentMatch[0])) {
                    $comments[] = $commentMatch[0];
                }
            }
        }

        // Se não encontrou comentários, tenta padrão alternativo 1
        if (empty($comments)) {
            preg_match_all('/\d+\.\s*(.+)(?:\n|$)/', $content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $comment) {
                    $comments[] = '"' . trim($comment) . '"';
                }
            }
        }

        // Se ainda não encontrou, tenta padrão alternativo 2
        if (empty($comments)) {
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && !preg_match('/^\d+\.?\s*$/', $line)) {
                    $comments[] = '"' . $line . '"';
                }
            }
        }

        if (empty($comments)) {
            Log::warning('No comments found in content:', ['content' => $content]);
            return response()->json([
                'message' => 'No comments were found. Try again with another prompt',
                'debug_info' => 'Content received but no valid comments could be extracted'
            ], 500);
        }

        $newComment = [];
        foreach ($comments as $comment) {
            $trim = trim($comment, '"');
            if (!empty($trim)) {
                $newComment[] = $trim;
            }
        }

        // foreach ($newComment as $comment) {
        //     dd($comment);
        // }
        return response()->json(['message' => 'Comments were found', 'comments' => $newComment], 200);
    }



public function generateCommentAjax(Request $request)
{
    $api_key = Config::get('services.openai.api_key');

        if (!$api_key) {
            throw new \Exception('OpenAI API key not found. Please set OPENAI_API_KEY in your .env file.');
        }

    $prompt = "I'm creating a product page on a YouTube-like platform, representing a live broadcast with live chat. I need AI-generated comments to simulate a real chat and encourage purchases. The comments should seem authentic, including both positive and mixed reactions. Here are the product details:
        Comment: " . $request->commentText . "
        Please generate appropriate responses based on the provided comment without using any prefixes like 'User:', numbering, or bullet points. The responses should appear as natural, standalone comments. Provide between 3 and 5 responses.";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 150,
    ]));

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key,
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $response_data = json_decode($response, true);
    $content = $response_data['choices'][0]['message']['content'];

    if (empty($content)) {
        return response()->json(['message' => 'Failed to generate a response. Please try again.'], 500);
    }

    // Split the content into individual lines (comments)
    $comments = array_filter(array_map('trim', explode("\n", $content)));

    // Clean up each comment and store it in an array
    $newComment = [];
    foreach ($comments as $comment) {
        // Remove any leading numbers or bullet points
        $cleanedComment = preg_replace('/^\d+\.\s*/', '', $comment); // Removes leading numbers like "3."
        $cleanedComment = str_replace(['User:', '•'], '', $cleanedComment); // Remove "User:" and bullets
        $trimmedComment = trim($cleanedComment, '"');
        $newComment[] = $trimmedComment;
    }

    // Randomly select 3 to 5 comments
    $randomCommentCount = rand(3, 5);
    $randomComments = array_slice($newComment, 0, $randomCommentCount);

    return response()->json(['message' => 'Response generated', 'comments' => $randomComments], 200);
}




}
