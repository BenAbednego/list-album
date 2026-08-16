# Private Shared Photo Album & Memory Vault

**A private digital photo gallery built to be shared — made for couples, families, or a small close circle who want to store and manage memories together without the hassle.**


## Why This Project Exists

Saving photo memories with the people closest to you still comes with a few annoying problems:
- Cloud storage like Google Photos or iCloud gets frustrating once you run out of space, and you end up having to pay for a subscription.
- Posting to social media isn't always comfortable either, especially when the photos are personal and not meant for everyone to see.
- What people actually need is simple: one shared space where both sides can create albums and upload their own photos, without complicated invite systems or access settings.

That's where this project comes in. The idea is straightforward: one account, shared by everyone who needs it. Anyone holding the email and password can log in from their own phone or laptop, access the same gallery, create new albums, and save memories without relying on a third-party app.


## Key Features

- **Shared Account Login** — no complicated invite system, just share one email and password with someone you trust.
- **Flexible Album Management** — create, rename, or delete albums as needed (e.g. "Bali Trip", "Graduation 2026", "Group Project").
- **Photos With Context** — each photo can include a title, date, and a short story behind why it matters.
- **Instant Search** — find photos instantly without reloading the page.
- **Warm, Minimal Aesthetic** — a calm cream and amber color palette designed to keep the photos themselves as the main focus.
- **Zero-Setup Database** — runs on SQLite, so there's no need to install or configure a separate database server.


## Tech Stack

Built on a lightweight but solid stack:

- **Framework**: Laravel 13 (PHP MVC)
- **Frontend**: HTML5, Vanilla CSS (custom design system using CSS variables), Vite
- **Database**: SQLite — file-based, fully local
- **Security**: Laravel Auth, Session Management, CSRF Protection, Mass Assignment Protection (`$fillable`)


## Running It Locally

### 1. Prerequisites
- PHP v8.3+ and Composer
- Node.js and npm

### 2. Initial Setup
```bash
# Clone the repo
git clone https://github.com/BenAbednego/list-album.git
cd list-album

# Copy environment file
cp .env.example .env

# Install dependencies
composer install
npm install

# Generate app key
php artisan key:generate

# Set up SQLite database and run migrations
touch database/database.sqlite
php artisan migrate
```

### 3. Running the Server
Run this single command:

```bash
composer run dev
```

Or open two terminal tabs and run:

**Terminal 1 (Backend):**
```bash
php artisan serve
```

**Terminal 2 (Compile Assets):**
```bash
npm run dev
```

Then open your browser and go to: `http://127.0.0.1:8000`


## How to Share Access With Someone

1. Go to `http://127.0.0.1:8000/register` to create the account for the first time.
2. Share the email and password with your partner, family member, or friend.
3. They can log in from their own device using the same account.
4. From there, you can both create albums, upload your own photos, and browse the shared gallery together — without worrying about anyone else seeing it.
