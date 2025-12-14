# 📦 CrateMate: Track Your Performance. Perfect Your Mix.

CrateMate is designed to be the central hub for professional and aspiring DJs. It allows users to import and synchronize their libraries from various DJ software, manage tracks efficiently for set creation, and gain deep, retrospective analytical insights into their performance history.

## ✨ Core Features

### 1. Unified Library Management
CrateMate solves the problem of scattered digital libraries. Import your entire collection from your preferred DJ software to a single, searchable environment.

* **Current Support:** Currently, only **Rekordbox** library database is supported.
* **Intelligent Filtering:** Advanced search capabilities based on BPM, Key, Energy, and custom tags.
* **Setlist Optimization:** Tools to help plan sets by visually grouping tracks that are harmonically and rhythmically compatible.

### 2. The Annual Drop (Performance Analytics)

Inspired by popular music wrap-up features, "The Annual Drop" generates a deep, personalized report based on all sets played throughout the year, turning your mixing history into actionable data.

This report will highlight:

* **Top Artists:** Your most played artists across all performances.
* **Top Tracks:** The tracks you played most often.
* **Most Played BPM:** The single most common tempo of your sets.
* **Most Played BPM Range:** The typical tempo range that defined your year (e.g., 120-124 BPM).
* **Most Played Key:** The most common musical key across your tracks.

## 💻 Tech Stack

CrateMate is built using a modern, efficient, full-stack approach, leveraging Docker for consistency.

* **Environment Manager:** **Laravel Sail** (Docker-based)
* **Backend Framework:** **Laravel** (PHP)
* **Frontend Framework:** **Vue.js** via **Inertia.js**
* **Package Manager:** **pnpm**
* **Database:** **MySQL**

## 🛠 Getting Started

### Prerequisites

* Docker
* Docker Compose

### Installation

```bash
# Clone the repository
git clone [repository-url]
cd cratemate

# Install Composer dependencies via Sail
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    composer install --ignore-platform-reqs

# Install NPM dependencies using pnpm via Sail
./vendor/bin/sail npm install --global pnpm
./vendor/bin/sail pnpm install
```

### Environment Setup

1. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```

2. Generate the application key:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

3. Configure your database credentials in `.env` (ensure they match the `docker-compose.yml` services).

4. Run migrations to set up the database structure:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

### Running the Application

1. Start the Docker containers (database, queue, etc.):
   ```bash
   ./vendor/bin/sail up -d
   ```

2. Compile assets (run this every time your frontend code changes):
   ```bash
   ./vendor/bin/sail pnpm run dev
   # Or, use 'pnpm run build' for production assets
   ```

3. The application will be accessible at **http://localhost**.

## 🗺 Roadmap

* **[PHASE 1]** Establish robust parsing for Rekordbox history and library files.
* **[PHASE 2]** Implement functionality to 'merge' library tracks/artists to 'canonical' tracks/artists.
* **[PHASE 3]** Develop the backend logic for calculating "The Annual Drop" statistics.
* **[PHASE 4]** Implement the core track search, filter, and setlist creation view.
* **[PHASE 5]** Introduce support for additional DJ software libraries (e.g., Serato, Traktor).

## 🤝 Contributing

We welcome contributions! Please check the CONTRIBUTING.md file for guidelines on how to submit pull requests, report bugs, and suggest features.

## 📝 License

This project is licensed under the MIT License - see the LICENSE.md file for details.
