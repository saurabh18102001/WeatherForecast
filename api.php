
<?php
header('Content-Type: application/json');

$apiKey = "your_api_key"; // Replace with your OpenWeatherMap API key
$input = isset($_GET['city']) ? trim($_GET['city']) : '';

if (!$input) {
    echo json_encode(['error' => 'City or country is required']);
    exit;
}

// List of countries and their capitals (ISO 3166-1)
$countries = [
    "Afghanistan" => "Kabul", "Albania" => "Tirana", "Algeria" => "Algiers", "Andorra" => "Andorra la Vella", "Angola" => "Luanda",
    "Argentina" => "Buenos Aires", "Armenia" => "Yerevan", "Australia" => "Canberra", "Austria" => "Vienna", "Azerbaijan" => "Baku",
    "Bahrain" => "Manama", "Bangladesh" => "Dhaka", "Belarus" => "Minsk", "Belgium" => "Brussels", "Bhutan" => "Thimphu",
    "Bolivia" => "Sucre", "Bosnia and Herzegovina" => "Sarajevo", "Botswana" => "Gaborone", "Brazil" => "Brasilia",
    "Bulgaria" => "Sofia", "Cambodia" => "Phnom Penh", "Canada" => "Ottawa", "Chile" => "Santiago", "China" => "Beijing",
    "Colombia" => "Bogotá", "Costa Rica" => "San José", "Croatia" => "Zagreb", "Cuba" => "Havana", "Cyprus" => "Nicosia",
    "Czech Republic" => "Prague", "Denmark" => "Copenhagen", "Egypt" => "Cairo", "Estonia" => "Tallinn", "Finland" => "Helsinki",
    "France" => "Paris", "Germany" => "Berlin", "Greece" => "Athens", "Hungary" => "Budapest", "India" => "Delhi",
    "Indonesia" => "Jakarta", "Iran" => "Tehran", "Iraq" => "Baghdad", "Ireland" => "Dublin", "Israel" => "Jerusalem",
    "Italy" => "Rome", "Japan" => "Tokyo", "Jordan" => "Amman", "Kazakhstan" => "Nur-Sultan", "Kenya" => "Nairobi",
    "South Korea" => "Seoul", "Kuwait" => "Kuwait City", "Latvia" => "Riga", "Lebanon" => "Beirut", "Libya" => "Tripoli",
    "Lithuania" => "Vilnius", "Malaysia" => "Kuala Lumpur", "Mexico" => "Mexico City", "Nepal" => "Kathmandu",
    "Netherlands" => "Amsterdam", "New Zealand" => "Wellington", "Nigeria" => "Abuja", "Norway" => "Oslo", "Pakistan" => "Islamabad",
    "Palestine" => "Ramallah", "Peru" => "Lima", "Philippines" => "Manila", "Poland" => "Warsaw", "Portugal" => "Lisbon",
    "Qatar" => "Doha", "Romania" => "Bucharest", "Russia" => "Moscow", "Saudi Arabia" => "Riyadh", "Serbia" => "Belgrade",
    "Singapore" => "Singapore", "Slovakia" => "Bratislava", "Slovenia" => "Ljubljana", "South Africa" => "Pretoria",
    "Spain" => "Madrid", "Sri Lanka" => "Colombo", "Sweden" => "Stockholm", "Switzerland" => "Bern", "Syria" => "Damascus",
    "Thailand" => "Bangkok", "Tunisia" => "Tunis", "Turkey" => "Ankara", "Ukraine" => "Kyiv", "United Arab Emirates" => "Abu Dhabi",
    "United Kingdom" => "London", "United States" => "Washington, D.C.", "Uzbekistan" => "Tashkent", "Venezuela" => "Caracas",
    "Vietnam" => "Hanoi", "Yemen" => "Sanaa", "Zambia" => "Lusaka", "Zimbabwe" => "Harare"
];

// Check if input is a country
$city = array_key_exists(ucwords(strtolower($input)), $countries) ? $countries[ucwords(strtolower($input))] : $input;

$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if ($data['cod'] == 200) {
    $weather = [
        'city' => $data['name'],
        'country' => array_search($data['name'], $countries) ?: $data['sys']['country'],
        'temperature' => $data['main']['temp'] . "°C",
        'weather' => ucfirst($data['weather'][0]['description']),
        'humidity' => $data['main']['humidity'] . "%",
        'wind_speed' => $data['wind']['speed'] . " m/s",
        'icon' => $data['weather'][0]['icon']
    ];
    echo json_encode($weather);
} else {
    echo json_encode(['error' => 'City or country not found']);
}
?>



<?php

/*
🔥 Suggested Additional Features
1️⃣ 📍 Auto-Detect User’s Location

Fetch weather data based on the user's current location using the Geolocation API.
Example: When the user opens the app, it automatically shows their weather.
2️⃣ 📅 5-Day Weather Forecast

Instead of just current weather, fetch a 5-day forecast using OpenWeatherMap's /forecast API.
Show daily temperature trends in a graph (Chart.js).
3️⃣ 🌙 Dark & ☀️ Light Mode Toggle

Add a button to switch between dark and light themes for better accessibility.
4️⃣ 📌 Save Favorite Cities

Allow users to bookmark cities and quickly check their weather later.
Store favorite locations using LocalStorage.
5️⃣ 🌡️ Feels Like Temperature & UV Index

Display “Feels Like” temperature instead of just actual temperature.
Include the UV index to give more weather insights.

7️⃣ 🎤 Voice Search

Integrate Web Speech API to allow users to search for weather by voice.
*/

?>
