# 🌫️ AirQuality

**AirQuality** is a PHP application that visualizes Air Quality Index (AQI) data — specifically **PM2.5** and **PM10** — using interactive line charts powered by [Chart.js](https://www.chartjs.org/).

## 🧩 Features

- 📊 Line charts for PM2.5 and PM10 pollutants  
- 🏙️ City-based AQI data (from JSON + BZIP2 files)  
- 📅 Monthly average calculations  
- 🧱 Clean PHP structure with reusable components  
- ⚡ Interactive frontend using Chart.js  

---


## 📁 Project Structure

```plaintext
/AirQuality
│
├── data/
│   ├── index.json         # Maps city name to data file
│   └── *.bz2              # Compressed AQI datasets
│
├── inc/
│   └── functions.php      # Utility functions
│
├── scripts/
│   └── chart.umd.min.js   # Chart.js library
│
├── views/
│   ├── header.inc.php     # HTML header
│   └── footer.inc.php     # HTML footer
│
├── index.php              # Main logic file
└── README.md              # Project documentation

## 🚀 Getting Started

### ✅ Requirements

- PHP 7.4 or newer  
- Apache, Nginx, or PHP built-in server


# 🛠 Installation

Clone the repository:

```bash
git clone https://github.com/helderbadim/AirQuality.git
cd AirQuality

## 📦 Data Format

The `data/index.json` file maps each city to a corresponding `.bz2` file.

### Example entry in a decompressed `.bz2` file:

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


## 📊 Chart Output

Each selected city renders a chart with:

- Monthly averages for **PM2.5** and **PM10**
- **Teal** line for PM2.5
- **Purple** line for PM10
- Fully interactive via Chart.js (hover, tooltips)

## 🙏 Credits

- [Chart.js](https://www.chartjs.org/)
- [OpenAQ](https://openaq.org/) – air quality data
- [Modern PHP: The Complete Guide - From Beginner to Advanced](https://www.udemy.com/course/modern-php-the-complete-guide/)
- Developed by [@helderbadim](https://github.com/helderbadim)
