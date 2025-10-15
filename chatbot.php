<?php
include 'config.php';
session_start();

// ------------------ STATIC DATA ------------------

// General FAQs
$faqs = [
    "college name" => "Jagannath Barooah College (JBC), Jorhat, Assam",
    "website" => "The official website is https://jbu.ac.in",
    "campus facilities" => "Facilities include library, hostels, canteen, sports, labs, audio-visual centers, and seminar halls.",
    "admission process" => "Undergraduate forms are issued by the college and can be submitted online via Assam Samarth Admission Portal: https://assamadmission.samarth.ac.in/",
    "undergraduate admission" => "UG admission forms and details are on the Assam Samarth portal with ₹300 application fee.",
    "postgraduate admission" => "PG admission notices are published on the official website: https://jbu.ac.in/index.php/admission-notice-2025-26/2194-pg-admission-notice-for-academic-session-2025-26",
    "fees" => "Fee structure is available on the official website. Scholarships are provided for eligible students.",
    "notices" => "Latest notices are available here: https://jbu.ac.in/index.php/notice-polsc?start=1",
    "exam results" => "Check the examination section for results: https://jbu.ac.in/index.php/examination-results-notice",
];

// Courses & Admission Info
$admissions = [
    "bca" => ["seats" => 50, "status" => "Open"],
    "bsc" => ["seats" => 30, "status" => "Closed"],
    "bcom" => ["seats" => 40, "status" => "Open"],
    "arts" => ["seats" => 100, "status" => "Open"],
    "commerce" => ["seats" => 40, "status" => "Open"],
];

// Departments & faculty
$departments = [
    "english" => ["Dr. Nandini Choudhury Bora (HoD)", "Dr. Surajit Sharma", "Dr. Deepanjali Baruah", "Mrs. Pranami Bania"],
    "assamese" => ["Dr. Surajit Sharma", "Dr. Nandini Choudhury Bora", "Dr. Deepanjali Baruah", "Mrs. Pranami Bania"],
    "commerce" => ["Mr. Porag Sarmah", "Dr. Apurba Kumar Sharma", "Dr. Rajlaxmi Bordoloi"],
    "computer science" => ["Gautam Kumar Adhyapok", "Nribid Bikash Dutta", "Chandan Chakraborty"],
    "chemistry" => ["Dr. Bhupen Baruah", "Mrs. Akhtara H. Kalita", "Dr. Jayashree Nath"],
    "physics" => ["Monoranjan Kakoti", "Akash Dipta Thakur", "Jibon Saikia"],
];

// University Administration
$administration = [
    "chancellor" => "Shri Lakshman Prasad Acharya (Governor of Assam) - https://jbu.ac.in/index.php/administration/chancellor",
    "vice chancellor" => "Prof. Jyoti Prasad Saikia - https://jbu.ac.in/index.php/administration/vice-chancellor",
    "registrar" => "Dr. Utpal Jyoti Mahanta - https://jbu.ac.in/index.php/administration/registrar",
];

// Notices & Contacts
$notices = [
    "Admissions for 2025 are open now!",
    "Mid-semester exams start from November 10.",
    "College will remain closed on October 18 due to festival."
];

$contacts = [
    "general" => "Email: jbcollege@rediffmail.com",
    "admission" => [
        "Mr. Subhashis Sarma: +91 9435092618",
        "Dr. Kalyan Das: +91 8638046878",
        "Mr. Ritopan Borah: +91 8638528495",
        "Dr. Harbamon Rongpi: +91 8638706724",
        "Mr. Biswa Jyoti Sharma (Sys Admin): +91 9706567068"
    ]
];

// ------------------ FUNCTIONS ------------------

function checkGreetings($msg) {
    $greetings = ['hi', 'hello', 'hey', 'namaste', 'hola', 'hii', 'hey there'];
    foreach ($greetings as $greet) {
        if (stripos($msg, $greet) !== false) {
            // You can customize replies
            $responses = [
                "Hi! How can I help you today?",
                "Hello! How can I assist you?",
                "Hey there! Need any help?",
                "Namaste! How can I help you?",
                "Hola! What can I do for you?"
            ];
            return $responses[array_rand($responses)]; // Random friendly reply
        }
    }
    return null;
}

function checkFAQ($msg, $faqs) {
    foreach ($faqs as $key => $ans) {
        if (stripos($msg, $key) !== false) return $ans;
    }
    return null;
}

function checkAdmissions($msg, $admissions) {
    foreach ($admissions as $course => $info) {
        if (stripos($msg, $course) !== false) {
            return "Course: " . strtoupper($course) . "\nSeats: " . $info["seats"] . "\nStatus: " . $info["status"];
        }
    }
    if (stripos($msg, 'admission') !== false || stripos($msg, 'seat') !== false)
        return "Available courses: BCA, BSc, BCom, Arts, Commerce.";
    return null;
}

function checkDepartments($msg, $departments) {
    foreach ($departments as $dept => $faculty) {
        if (stripos($msg, $dept) !== false) {
            return "Faculty for " . ucfirst($dept) . " department:\n- " . implode("\n- ", $faculty);
        }
    }
    return null;
}

function checkAdministration($msg, $administration) {
    foreach ($administration as $role => $person) {
        if (stripos($msg, $role) !== false) return ucfirst($role) . ": " . $person;
    }
    return null;
}

function checkNotices($msg, $notices) {
    if (stripos($msg, 'notice') !== false || stripos($msg, 'announcement') !== false) {
        return "📢 Latest Notices:\n- " . implode("\n- ", $notices);
    }
    return null;
}

function checkContacts($msg, $contacts) {
    if (stripos($msg, 'contact') !== false) {
        $response = $contacts['general'] . "\nAdmission contacts:\n- " . implode("\n- ", $contacts['admission']);
        return $response;
    }
    return null;
}

// ------------------ GEMINI FUNCTIONS ------------------

// Call Gemini ListModels to pick a valid model
function getAvailableGeminiModel($api_key) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $api_key",
        "Accept: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if(curl_errno($ch)) return null;

    $data = json_decode($response, true);
    if(empty($data['models'])) return null;

    // Find first model that supports generateText
    foreach($data['models'] as $model) {
        if(!empty($model['supportedMethods']) && in_array("generateText", $model['supportedMethods'])) {
            return $model['name'];
        }
    }
    return null;
}

// Call Gemini AI
function askGemini($prompt, $api_key) {
    $model = getAvailableGeminiModel($api_key);
    if(!$model) return "Cannot find a valid Gemini model for your API key.";

    $url = "https://generativelanguage.googleapis.com/v1beta/$model:generateText";

    $data = [
        "prompt" => $prompt,
        "temperature" => 0.7,
        "maxOutputTokens" => 500
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $api_key"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    if(curl_errno($ch)) return "Error contacting Gemini: " . curl_error($ch);

    $resp = json_decode($response, true);
    return $resp['candidates'][0]['content'] ?? "Sorry, no response from Gemini.";
}

// ------------------ MAIN HANDLER ------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_msg = trim($_POST['message'] ?? '');

    $reply = checkGreetings($user_msg)
        ??checkFAQ($user_msg, $faqs)
        ?? checkAdmissions($user_msg, $admissions)
        ?? checkDepartments($user_msg, $departments)
        ?? checkAdministration($user_msg, $administration)
        ?? checkNotices($user_msg, $notices)
        ?? checkContacts($user_msg, $contacts)
        ?? "Sorry, I don’t have an answer for that question.";

    $_SESSION['chat'][] = ["user" => $user_msg, "bot" => $reply];

    echo $reply;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($_SESSION['chat'] ?? []);
    exit;
}
?>
