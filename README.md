# 🔁 Laravel Hot Reload for Views & Livewire Components

A lightweight Laravel package that automatically reloads the browser when you modify your Blade views or Livewire components — no need to refresh manually.

Perfect for developers who want a simple hot reload experience during Laravel backend development without Vite or Webpack.

---

## 🚀 Features

- 🔥 Hot reload on Blade view changes
- 🔁 Auto-reload when Livewire component files change
- 🧠 No frontend build tools required (works out of the box)
- ⚡ Fast response via Server-Sent Events (SSE)
- 🎯 Injects JavaScript automatically via middleware

---

## 📦 Installation

```bash
composer require dedsec/laravel-hot-reload
php artisan vendor:publish --tag=hot-reload-assets
php artisan serve

