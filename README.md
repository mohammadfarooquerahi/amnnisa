# 🌸 Amnnisa — Women's Safety & Empowerment Platform

[![Website](https://img.shields.io/badge/Platform-Amnnisa-E8006F.svg)](https://amnnisa.com)
[![WordPress](https://img.shields.io/badge/WordPress-Compatible-21759B.svg)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%20|%208.0%20|%208.1%20|%208.2-777BB4.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-Proprietary-pink.svg)](#)

> **Dignity. Safety. Innovation.**  
> Securing women's dignity and empowering women through legal guidance, technical guidance, moral support, and data-driven collaboration. Incubated at the **Mehran University of Engineering and Technology (MUET) Business Incubation Center (BIC)**.

---

## 📑 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Repository Structure](#-repository-structure)
- [WordPress Theme Installation](#-wordpress-theme-installation)
- [Form Submissions & Email Notifications](#-form-submissions--email-notifications)
- [Sections & Content Customization](#-sections--content-customization)
- [Legal Team, Society Members & Collaborators](#-legal-team-society-members--collaborators)
- [Credits & Developer Information](#-credits--developer-information)

---

## 🌟 Overview

**Amnnisa** is an all-in-one platform built to combat harassment and provide private, confidential support to women. It combines:
1. **Confidential Incident Reporting**: Anonymous or identified reporting for harassment and threats with reference code tracking.
2. **Legal & Technical Guidance**: Dedicated support network led by experienced advocates and technologists.
3. **Moral & Community Support**: A secure, judgment-free space for women to seek guidance.
4. **Community Initiatives**: Volunteer engagement, idea proposal, and mission partnerships.

---

## 🚀 Key Features

* **⚡ Ultra-Fast & Responsive**: Fully responsive across mobile, tablet, laptop, and desktop displays with fluid typography (`clamp`) and auto-fitting grid layouts.
* **📬 Live Form Submissions & Email Alerts**: Every submission (Idea, Report, Volunteer Application, Contact) is automatically saved to the WordPress database and dispatched to **`amnnisafoundation@gmail.com`**.
* **🛡️ Built-in SMTP Mailer**: Integrated SMTP configuration for guaranteed Gmail / host delivery with zero third-party plugin requirements.
* **👥 Dynamic Team Management**: Custom post type in WordPress Admin to add, edit, reorder, or delete team members anytime.
* **⚖️ Dedicated Legal & Collaborators Section**: Showcases legal advocates, society team members, and partner organizations with a custom WordPress page template.
* **🎨 Full WordPress Customizer Integration**: Inline customization for hero titles, banners, 5 pillars, founder spotlight, emergency hotlines, and footer details.

---

## 📂 Repository Structure

```
├── amannisa-theme/                # Complete WordPress custom theme
│   ├── assets/
│   │   ├── css/style.css          # Main responsive stylesheet
│   │   ├── images/                # High-resolution logos & team avatars
│   │   └── js/main.js             # Client-side router & form submission handler
│   ├── inc/
│   │   ├── customizer.php         # Customizer settings & controls
│   │   ├── form-handler.php       # Form processing, DB storage & SMTP mailer
│   │   └── post-types.php         # Team Members Custom Post Type & auto-seeder
│   ├── page-templates/
│   │   ├── template-amannisa.php  # Amnnisa Full Platform Template
│   │   └── template-legal-collaborators.php # Legal & Collaborators Page Template
│   ├── footer.php
│   ├── front-page.php
│   ├── functions.php
│   ├── header.php
│   ├── index.php
│   ├── page.php
│   ├── screenshot.png
│   └── style.css
├── amannisa-theme.zip             # 1-Click ready-to-upload WordPress Theme zip
├── index.html                     # Standalone static preview version
├── amannisa-wordpress-paste.html  # Standalone HTML with base64 embedded assets
├── WORDPRESS_DEPLOYMENT_GUIDE.md  # Detailed deployment & administrative guide
├── AMNNISA_CLIENT_USER_GUIDE.pdf  # Illustrated Client Management Manual
├── assets/images/                 # Shared media assets
└── README.md
```

---

## 🛠️ WordPress Theme Installation

1. Download **`amannisa-theme.zip`** from this repository.
2. In your WordPress Admin dashboard (`yourdomain.com/wp-admin`), navigate to **Appearance** → **Themes**.
3. Click **Add New Theme** → **Upload Theme**.
4. Choose **`amannisa-theme.zip`**, click **Install Now**, and then **Activate**.
5. Set your homepage:
   * Go to **Settings** → **Reading**.
   * Under *Your homepage displays*, select **A static page**.
   * Select **Home** (or any page using the *Amnnisa Platform Full Template*).
   * Click **Save Changes**.

---

## ✉️ Form Submissions & Email Notifications

All forms on the platform are pre-wired to:
* **Log entries in WordPress Admin**: View and manage reports via **Submissions** in the WP Admin menu or the top admin bar (`🌸 Amnnisa Submissions`).
* **Send Instant Notifications**: Dispatched to `amnnisafoundation@gmail.com`.
* **SMTP Setup**: Configure via **Appearance** → **Customize** → **12. SMTP Email Delivery (Gmail / Host)** for reliable delivery without spam filtering.

---

## ⚖️ Legal Team, Society Members & Collaborators

The platform features dedicated profiles for:
* **Legal Support**: Advocates **Rabia Samo** and **Afsheen Naz Bhutto** (15+ years experience handling harassment cases).
* **Society Members**: **Paras Bhutto**, **Huzaifa Junejo**, **Umar Qureshi**, **Syed Younis Shah**, and **Aina Syed**.
* **Partners & Collaborators**: **Draftify**, **WomenWheelz**, and **YEN** (Youth Empowerment Network).

---

## 👨‍💻 Credits & Developer Information

* **Founder**: **Homair Nisar** · Incubation at **MUET Business Incubation Center (BIC)**
* **Platform Development**: Developed by [**Mohammad Farooque**](https://www.linkedin.com/in/mohammadfarooque/)
