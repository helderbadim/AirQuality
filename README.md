# 🌫️ AirQuality

**AirQuality** is a PHP web application that visualizes Air Quality Index (AQI) data — specifically **PM2.5** and **PM10** — through interactive line charts powered by [Chart.js](https://www.chartjs.org/).

> 🛠️ This project was developed as part of the [Modern PHP: The Complete Guide – From Beginner to Advanced](https://www.udemy.com/course/modern-php-the-complete-guide/) course on **Udemy**.

---

## 🧩 Features

- 📊 Dynamic line charts for PM2.5 and PM10 pollutants  
- 🏙️ City-based AQI data parsed from JSON and BZIP2 sources  
- 📅 Monthly average air quality statistics  
- 🧱 Clean and modular PHP project structure  
- ⚡ Interactive frontend powered by Chart.js  

---

## 📁 Project Structure

```plaintext
/AirQuality
│
├── data/
│   ├── index.json         # Maps each city to a compressed AQI dataset
│   └── *.bz2              # BZIP2-compressed AQI data files
│
├── inc/
│   └── functions.php      # Utility functions (e.g. HTML escaping)
│
├── scripts/
│   └── chart.umd.min.js   # Chart.js library
│
├── views/
│   ├── header.inc.php     # Page header
│   └── footer.inc.php     # Page footer
│
├── index.php              # Main application logic
└── README.md              # Project documentation
```

---

## 🚀 Getting Started

### ✅ Requirements

- PHP 7.4 or newer  
- Apache, Nginx, or PHP built-in development server

---

## 🛠 Installation

Clone the repository:

```bash
git clone https://github.com/helderbadim/AirQuality.git
cd AirQuality
```

Start the PHP development server:

```bash
php -S localhost:8000
```

Open your browser and visit:

```
http://localhost:8000/?city=YourCityName
```

> Replace `YourCityName` with one of the cities listed in `data/index.json`.

---

## 📦 Data Format

The `data/index.json` file maps each city to its corresponding `.bz2` data file.

### Example of decompressed `.bz2` content:

```json
{
  "results": [
    {
      "parameter": "pm25",
      "value": 42.1,
      "unit": "µg/m³",
      "date": {
        "local": "2023-01-15T10:00:00+00:00"
      }
    }
  ]
}
```

---

## 📊 Chart Output

Each selected city displays a line chart with:

- Monthly average values for **PM2.5** and **PM10**
- **Teal** line representing PM2.5
- **Purple** line representing PM10
- Fully interactive behavior (hover, tooltips) using Chart.js

---

## 🙏 Credits

- [Chart.js](https://www.chartjs.org/) – JavaScript charting library  
- [OpenAQ](https://openaq.org/) – Public air quality data  
- [Modern PHP: The Complete Guide – From Beginner to Advanced](https://www.udemy.com/course/modern-php)  
- Developed by [@helderbadim](https://github.com/helderbadim)


