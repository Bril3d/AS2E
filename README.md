# AS2E Smart CMS 🚀

### Enterprise-Grade Automation Platform & Dynamic Content Management System

![AS2E CMS Hero Banner](file:///c:/wamp64/www/as2e/public/images/readme_banner.png)

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js)](https://vuejs.org)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-Modern_SPA-9553E9?style=for-the-badge)](https://inertiajs.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Gemini AI](https://img.shields.io/badge/Gemini_AI-Integrated-4285F4?style=for-the-badge&logo=google-gemini)](https://ai.google.dev/)

---

## 🌟 Overview

**AS2E Smart CMS** is a high-performance, full-stack Content Management System tailored for the smart automation and energy efficiency sector. Built on the **Laravel + Inertia + Vue 3** stack, it delivers a lightning-fast Single Page Application (SPA) experience with a robust, scalable backend.

This platform empowers administrators to manage complex landing pages, AI chatbot interactions, and business data without writing a single line of code, while providing developers with a clean, modular architecture to build upon.

---

## 🛠️ Core Technical Features

### 💻 Dynamic CMS Architecture

- **Real-time Page Builder**: Manage Hero sections, carousels, feature lists, and services through a centralized dashboard.
- **Dynamic Rebranding**: Change the entire site's identity (Name, Logo, Contact Info) from the admin panel with zero downtime.
- **Expertise & Project Hub**: Showcase technical capabilities and past work with SEO-optimized dynamic routing.

### 🤖 Intelligent AI Integration

- **Gemini-Powered Chatbot**: Integrated AI assistant that handles customer inquiries in real-time.
- **Admin Configuration**: Switch between different Gemini models (`flash`, `pro`, etc.) and manage API keys dynamically via the dashboard.

### 🔐 Security & Access Control

- **Granular RBAC**: Fine-grained Role-Based Access Control implemented via **Spatie Laravel Permission**.
- **Secure Authentication**: Robust auth system with secondary **Google OAuth (Socialite)** integration.

### 📊 Business Analytics

- **Live Dashboard**: Interactive visualizations of platform engagement and business metrics using **Chart.js**.
- **User Activity Tracking**: Monitor registrations and interactive logs.

### 📱 Modern UX/UI & PWA

- **Progressive Web App**: Offline-ready and installable on mobile devices.
- **Premium Components**: Built with **Preline UI** and custom **Tailwind CSS** tokens for a sleek, dark-mode optimized aesthetic.
- **Advanced Real-time Updates**: Powered by **Pusher** and **Laravel Echo**.

---

## 🚀 Tech Stack

### Backend

- **Framework**: [Laravel 10](https://laravel.com/)
- **API Support**: [Sanctum](https://laravel.com/docs/sanctum)
- **Database**: MySQL / PostgreSQL
- **Security**: [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- **AI**: [Google Gemini PHP](https://github.com/google-gemini-php/laravel)

### Frontend

- **Framework**: [Vue 3](https://vuejs.org/) (Composition API)
- **Architecture**: [Inertia.js](https://inertiajs.com/)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/) & [Preline UI](https://preline.co/)
- **Visuals**: [Chart.js](https://www.chartjs.org/) & [Vite](https://vitejs.dev/)
- **Media**: [FilePond](https://pqina.nl/filepond/) (Image handling & previews)

---

## ⚙️ Installation & Setup

1. **Clone the repository**

   ```bash
   git clone https://github.com/Bril3d/AS2E.git
   cd AS2E
   ```
2. **Backend Setup**

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. **Database & Storage**

   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```
4. **Frontend Setup**

   ```bash
   npm install
   npm run build # or npm run dev
   ```
5. **Start the Application**

   ```bash
   php artisan serve
   ```

---

## 🛡️ Security

If you discover any security-related issues, please email [khaledtbk@gmail.com](mailto:khaledtbk@gmail.com) instead of using the issue tracker.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<p align="center">
  Developed with ❤️ by <a href="https://github.com/Bril3d">Bril3d</a>
</p>
