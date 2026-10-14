# 🌸 Amnnisa Platform — WordPress Deployment & Content Editing Guide

This package contains everything needed to deploy the **Amnnisa Women's Safety & Empowerment Platform** onto WordPress (`amnnisa.com`) with **full responsiveness**, **real email notifications to admin (`amnnisafoundation@gmail.com`)**, **WordPress Admin Submissions logging**, and **complete inline editability** for all pages, sections, text, images, and team members directly from the WordPress Admin Dashboard.

---

## 📦 What Is Included

| File / Package | Purpose | Best Used For |
|---|---|---|
| **[`amannisa-theme.zip`](file:///c:/Users/DC/BIC%20data/AmanNisa/amannisa-theme.zip)** | Complete WordPress Theme zip package | **Recommended**: 1-click theme upload in WordPress Admin (`Appearance > Themes`). |
| **[`amannisa-theme/`](file:///c:/Users/DC/BIC%20data/AmanNisa/amannisa-theme)** | Source theme files (`inc/customizer.php`, `inc/form-handler.php`, `inc/post-types.php`, `functions.php`, etc.) | Direct FTP / cPanel upload to `wp-content/themes/amannisa-theme/`. |
| **[`amannisa-wordpress-paste.html`](file:///c:/Users/DC/BIC%20data/AmanNisa/amannisa-wordpress-paste.html)** | Standalone responsive HTML with embedded assets | For pasting directly into a WordPress **Custom HTML** block, Elementor, or Divi. |
| **[`index.html`](file:///c:/Users/DC/BIC%20data/AmanNisa/index.html)** | Standalone responsive preview website | For immediate local browser preview or static hosting. |
| **[`assets/images/`](file:///c:/Users/DC/BIC%20data/AmanNisa/assets/images)** | Clean, optimized image assets | High-resolution photos and logos for the platform. |

---

## 🚀 Theme Installation & Update (3 Simple Steps)

1. Log into your **WordPress Admin Dashboard** (`amnnisa.com/wp-admin`).
2. Go to **Appearance** → **Themes** → click **Add New Theme** → **Upload Theme**.
3. Choose **`amannisa-theme.zip`**, click **Install Now**, and then click **Activate** (or **Replace active with uploaded**).

---

## 🛡️ Form Submissions & Admin Email Notifications

All forms on the website are fully functional:
- **Report a Case** (Harassment / Threats — anonymous or identified)
- **Contact Us** (Direct messages & inquiries)
- **Join the Mission** (Volunteer, legal, tech, partnership applications)
- **Share an Idea** (Initiatives, features, solutions)
- **Track Status** (Reference number lookups)
- **Support / Donate** (Notification alerts)

### Where Form Submissions Appear in WordPress Admin:
1. **Left Menu**: Click **Submissions** (shows badge with total count) in the WP Admin menu.
2. **Top Admin Bar**: Click **🌸 Amnnisa Submissions (X)** at the top of your screen from any page.
3. **Dashboard Widget**: The main `/wp-admin` dashboard displays the 5 most recent submissions with reference ID, urgency, and submitter name.

### Where Form Submissions are Emailed:
- Every submission is instantly dispatched to **`amnnisafoundation@gmail.com`**.
- It also sends a copy to your WordPress admin email.

### Setting Up Reliable Gmail Delivery (SMTP):
Web hosts often restrict or block unauthenticated PHP `mail()`. To ensure emails never bounce or land in spam:
1. Go to **Appearance** → **Customize** → **12. SMTP Email Delivery (Gmail / Host)**.
2. Check **Enable Custom SMTP Delivery**.
3. Enter your Gmail details:
   - **SMTP Host**: `smtp.gmail.com`
   - **SMTP Port**: `587`
   - **Encryption**: `tls`
   - **SMTP Username**: `amnnisafoundation@gmail.com`
   - **SMTP App Password**: Your 16-character Google App Password ([generate here](https://myaccount.google.com/apppasswords))
4. Click **Publish**.
5. Test it: Open **Submissions** in WP Admin and click **Send Test Email to amnnisafoundation@gmail.com**. A green check confirms live email dispatch!

---

## 👥 How to Add, Edit, or Delete Team Members

In your WordPress Admin left sidebar:
👉 **Team Members**

1. **Pre-Seeded Members**:
   - The 6 founding team members (*Aliza Shah, Shanze Fatima, Emaan Muneer, Khadija Soomro, Humna Irfan, Amna Korai*) are automatically loaded into the database.
2. **Edit a Member**:
   - Click **Edit** on any member to change their name, Title/Role, Department, or Photo.
   - You can upload a photo via the **Featured Image** box on the right, OR paste an image URL directly into the **Photo Image URL** field.
3. **Delete a Member**:
   - Hover over any member and click **Trash** to delete them. They will immediately disappear from the frontend Team page.
4. **Add a New Member**:
   - Click **Add New Member**, type their name, fill their Role and Department, upload their photo, and click **Publish**.
5. **Restore Defaults**:
   - If you ever want to reset back to the initial 6 members, click the **↺ Restore Default 6 Members** button in the notice banner at the top of the Team Members screen.

---

## ✏️ How to Edit All Pages & Sections via Customizer

Go to **Appearance** → **Customize** → **Amnnisa Site Content & Sections**:

- **0. Header Brand, Logo & Tagline**:
  - Platform Brand Name (defaults to `Amnnisa`)
  - Tagline (defaults to `SAFETY PLATFORM`)
  - Upload Custom Logo image
- **1. Home — Hero Section**:
  - Headings, hero description paragraph, CTA buttons, and hero photo upload.
- **2. Home — Our Pillars (5)**:
  - Edit all 5 pillars: Secure, Dignity, Empower, Guide, Collaborate.
- **3. Home — Take Action Cards & Track**:
  - Edit the 4 action cards and the **Track Report Bar** (title, description, button, and optional custom icon image).
- **4. Home — Founder Quote**:
  - Homair Nisar quote and CTA button.
- **5. Home — How It Works (3 Steps)**:
  - 3 steps: Tell us, Get guided, Stay protected.
- **6. Home — Emergency Hotlines**:
  - Emergency phone numbers: Police (15), Human Rights (1099), Rescue (1122), Sindh Women Helpline (9911).
- **7. Home — Stats & Incubation**:
  - Incubator logo (MUET Jamshoro) and stat callouts.
- **8. About Us Page & FAQs**:
  - Mission description, 3 guidance cards (Legal, Technical, Moral), and 4 Common Questions / FAQs.
- **9. Our Team — Founder Spotlight**:
  - Homair Nisar photo, title, badge, and founder bio.
- **10. Contact & Social Channels**:
  - Recipient email address (`amnnisafoundation@gmail.com`), Instagram link, WhatsApp channel link, and MUET campus address.
- **11. Footer Content & Copyright**:
  - Footer mission blurb, credit line, and copyright note.
- **12. SMTP Email Delivery (Gmail / Host)**:
  - Built-in SMTP settings for guaranteed email delivery to Gmail.

---

## ⚖️ Legal Team, Society Members & Collaborators Page

The dedicated **Legal Team, Society Members & Collaborators** section is fully integrated into the navigation and platform routing:

1. **Navigation & URL Access**:
   - Accessible via the top navigation link: **Legal & Collaborators** (`#collaborators`).
   - Also directly accessible via anchor links: `#legal-team`, `#team-members`, `#collaborators-section`.
   - Linked directly from the bottom of the **Our Team** page with a prominent callout button.
2. **Page Content**:
   - **Legal Team**: Advocates **Rabia Samo** and **Afsheen Naz Bhutto** (15+ years experience) with confidential guidance advisory.
   - **Team Members**: Amnnisa Society members **Paras Bhutto**, **Huzaifa Junejo**, **Umar Qureshi**, **Syed Younis Shah**, and **Aina Syed**.
   - **Partners & Collaborators**: Partner logos for **Draftify**, **WomenWheelz**, and **YEN** (Youth Empowerment Network).
3. **Dedicated WordPress Page Template**:
   - A custom template **Legal Team & Collaborators** (`page-templates/template-legal-collaborators.php`) is available. If you create a standalone WordPress page (e.g. `/legal-collaborators/`), simply select this template in the Page Attributes dropdown.

---

## 📱 Responsiveness Verification

- Fully responsive across Desktop, Laptop, Tablet, and Mobile.
- Fixed `.track` box with dedicated `.track-content` wrapper and locked `56px` pink icon box to prevent stretching.
- Responsive grid layouts with fluid typography, auto-fit cards, and aspect-ratio preservation for all member avatars and partner logos.
- Mobile drawer menu with touch-friendly navigation and smooth closing on route transitions.
