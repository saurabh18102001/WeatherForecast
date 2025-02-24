<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather App</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <style>
      * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  padding: 20px;
  text-align: center;
}

/* Light & Dark Mode */
.dark-mode {
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  color: white;
}
.light-mode {
  background: linear-gradient(135deg, #ffffff, #f0f0f0, #dcdcdc);
  color: black;
}

/* Responsive Container */
.container {
  background: rgba(0, 0, 0, 0.5);
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  width: 90%;
  max-width: 800px;
}

.light-mode .container {
  background: rgba(255, 255, 255, 0.8);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Title */
h2 {
  color: #1e90ff;
  margin-bottom: 15px;
  font-weight: 600;
}

/* Theme Toggle Button */
.toggle-btn {
  position: fixed;
  top: 10px;
  left: 40%;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  z-index: 1000;
}

.toggle-btn:hover {
  background: none !important;
}


.dark-mode .toggle-btn {
  color: yellow;
}
.light-mode .toggle-btn {
  color: black;
}

/* Input Field */
.input-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

input {
  padding: 12px;
  width: 100%;
  max-width: 400px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  outline: none;
  background: rgba(255, 255, 255, 0.2);
  color: white;
  text-align: center;
}

.light-mode input {
  background: rgba(0, 0, 0, 0.1);
  color: black;
}
.light-mode input::placeholder {
  color: rgba(0, 0, 0, 0.5);
}

.dark-mode input {
  color: white;
}
input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

/* Buttons */
.btn-group {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 100%;
  max-width: 400px;
}

button {
  padding: 12px;
  background: #1e90ff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: 0.3s ease;
  width: 100%;
}

button:hover {
  background: #1565c0;
}

/* Weather Result Card */
.weather-card {
  background: rgba(255, 255, 255, 0.1);
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1);
  display: none;
  margin-top: 15px;
}

.weather-card h3 {
  font-size: 20px;
  margin-bottom: 10px;
  color: #1e90ff;
}

.weather-card p {
  font-size: 14px;
  margin: 5px 0;
}

/* Forecast Scrolling */
#forecast-container {
  margin-top: 20px;
  text-align: center;
  color: white;
  overflow-x: auto;
  white-space: nowrap;
  display: flex;
  gap: 10px;
}

#forecast-container div {
  background: rgba(255, 255, 255, 0.2);
  padding: 10px;
  border-radius: 10px;
  min-width: 120px;
  text-align: center;
}

/* Loading Spinner */
.loading {
  display: none;
  margin-top: 10px;
}

.loading i {
  font-size: 24px;
  color: white;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* Responsive Adjustments */
@media screen and (max-width: 768px) {
  .container {
    padding: 15px;
  }
  
  h2 {
    font-size: 20px;
  }

  .toggle-btn {
    font-size: 20px;
  }

  input {
    font-size: 14px;
  }

  button {
    font-size: 14px;
    padding: 10px;
  }

  .weather-card {
    font-size: 14px;
  }

  #forecast-container div {
    min-width: 100px;
  }
}

@media screen and (max-width: 480px) {
  .container {
    padding: 10px;
  }

  h2 {
    font-size: 18px;
  }

  .toggle-btn {
    font-size: 18px;
  }

  input {
    font-size: 13px;
  }

  button {
    font-size: 13px;
    padding: 8px;
  }

  .weather-card {
    font-size: 13px;
  }

  #forecast-container div {
    min-width: 90px;
  }
}

    </style>
  </head>
  <body class="dark-mode">
    <button class="toggle-btn" onclick="toggleTheme()">☀️</button>
    <div class="container">
      <h2>Weather App</h2>
      <div class="input-group">
        <input type="text" id="city" placeholder="Enter city or country" />
       
        <div class="btn-group">
          <button onclick="getWeather()">🔍 Search</button>
          <button onclick="detectLocation()">📍 Use My Location</button>
          <button id="voice-search" >
            🎤 Speak for Search
          </button>
        </div>
      </div>
      <div class="loading" id="loading">
        <i class="fas fa-spinner"></i> Loading...
      </div>
      <div class="weather-card" id="result"></div>
    </div>

    <div id="forecast-container" style="margin-top: 20px; text-align: center; color: white;"></div>


    <script>

function getWeather(city = null) {
  if (!city) city = document.getElementById("city").value.trim();
  if (city === "") {
    alert("Please enter a city or country!");
    return;
  }

  document.getElementById("loading").style.display = "block";
  document.getElementById("result").style.display = "none";

  // Fetch current weather
  fetch(`api.php?city=${city}`)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("loading").style.display = "none";
      if (data.error) {
        document.getElementById("result").innerHTML = `<p style="color: red;">${data.error}</p>`;
      } else {
        let currentWeather = `
          <h3>${data.city}, ${data.country}</h3>
          <p><strong>🌡️ Temperature:</strong> ${data.temperature}</p>
          <p><strong>🌥️ Weather:</strong> ${data.weather}</p>
          <p><strong>💧 Humidity:</strong> ${data.humidity}</p>
          <p><strong>🌬️ Wind Speed:</strong> ${data.wind_speed}</p>
        `;

        // Fetch 5-day weather forecast
        fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${city}&units=metric&appid=your_api_key`)
          .then((response) => response.json())
          .then((forecastData) => {
            let forecastHTML = "<h3>5-Day Forecast</h3><div style='display:flex; gap:10px; overflow-x:auto;'>";

            let forecastDays = {};

            forecastData.list.forEach((entry) => {
              let date = entry.dt_txt.split(" ")[0];

              // Get only one entry per day (12:00 PM entry)
              if (!forecastDays[date] && entry.dt_txt.includes("12:00:00")) {
                forecastDays[date] = `
                  <div style='background:rgba(255,255,255,0.2); padding:10px; border-radius:10px; min-width:120px; text-align:center;'>
                    <p><strong>${date}</strong></p>
                    <p>🌡️ ${entry.main.temp}°C</p>
                    <p>${entry.weather[0].description}</p>
                  </div>
                `;
              }
            });

            forecastHTML += Object.values(forecastDays).join("") + "</div>";
            document.getElementById("result").innerHTML = currentWeather + forecastHTML;
            document.getElementById("result").style.display = "block";
          })
          .catch(() => {
            document.getElementById("result").innerHTML = currentWeather + "<p style='color: red;'>Failed to load forecast data.</p>";
          });
      }
    })
    .catch(() => {
      document.getElementById("loading").style.display = "none";
      document.getElementById("result").innerHTML = `<p style="color: red;">Error fetching data. Please try again later.</p>`;
    });
}



      function detectLocation() {
        if ("geolocation" in navigator) {
          document.getElementById("loading").style.display = "block";
          navigator.geolocation.getCurrentPosition(
            (position) => {
              let lat = position.coords.latitude;
              let lon = position.coords.longitude;
              fetch(
                `https://api.openweathermap.org/geo/1.0/reverse?lat=${lat}&lon=${lon}&limit=1&appid=your_api_key`
              )
                .then((response) => response.json())
                .then((data) => {
                  if (data.length > 0) {
                    getWeather(data[0].name);
                  } else {
                    alert("Location detection failed!");
                  }
                })
                .catch(() => alert("Error detecting location!"));
            },
            () => {
              alert("Location permission denied!");
            }
          );
        } else {
          alert("Geolocation is not supported by your browser.");
        }
      }

      function toggleTheme() {
        let body = document.body;
        let button = document.querySelector(".toggle-btn");
        if (body.classList.contains("dark-mode")) {
          body.classList.remove("dark-mode");
          body.classList.add("light-mode");
          button.textContent = "🌙";
          localStorage.setItem("theme", "light-mode");
        } else {
          body.classList.remove("light-mode");
          body.classList.add("dark-mode");
          button.textContent = "☀️";
          localStorage.setItem("theme", "dark-mode");
        }
      }

      document.addEventListener("DOMContentLoaded", () => {
        let savedTheme = localStorage.getItem("theme");
        if (savedTheme) {
          document.body.classList.add(savedTheme);
          document.querySelector(".toggle-btn").textContent =
            savedTheme === "dark-mode" ? "☀️" : "🌙";
        }
      });

      document.getElementById("voice-search").addEventListener("click", function () {
  let recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
  recognition.lang = "en-US"; // Set language
  recognition.start(); // Start listening

  recognition.onresult = function (event) {
    let spokenText = event.results[0][0].transcript;
    document.getElementById("city").value = spokenText; // Set input value
    getWeather(spokenText); // Fetch weather
  };

  recognition.onerror = function () {
    alert("Voice recognition failed. Please try again.");
  };
});

    </script>
  </body>
</html>
