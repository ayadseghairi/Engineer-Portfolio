# 💼 Engineer Portfolio

Engineer Portfolio is a dynamic and responsive personal portfolio website built with **PHP**, **HTML**, and **CSS**. It features a professional frontend and a secure backend admin panel to manage projects and contact messages easily.

---

## 📁 Project Structure

```bash
Engineer-Portfolio/
├── index.php               # Home page
├── about.php               # About section
├── projects.php            # List of all projects
├── project-details.php     # Single project details
├── contact.php             # Contact form
├── send.php                # Contact form handler
├── db.php                  # Database connection
├── style.css               # Frontend styling
├── admin/                  # Admin dashboard
│   ├── index.php           # Login page
│   ├── dashboard.php       # Admin homepage
│   ├── projects.php        # Manage projects (CRUD)
│   ├── messages.php        # View contact messages
│   ├── logout.php          # Logout handler
│   ├── style.css           # Admin panel styles
│   └── includes/
│       ├── db.php          # DB connection for admin
│       └── auth.php        # Session authentication
└── README.md
````

---

## 🛠️ Technologies Used

* **PHP** – Dynamic page generation and database interaction
* **MySQL** – Store project and contact data
* **HTML5/CSS3** – Responsive and elegant design
* **Vanilla JS** – Optional interactivity (if added)

---

## 🚀 How to Run the Project

1. Clone this repository to your web server.
2. Create a MySQL database and import the SQL tables if provided.
3. Edit `db.php` and `admin/includes/db.php` with your DB credentials.
4. Access `index.php` from your browser to view the site.
5. Go to `/admin/index.php` to access the admin dashboard.

---

## 🔐 Admin Panel

The `/admin/` directory contains a secure dashboard that allows you to:

* 🧑‍💻 Login and manage session-protected content.
* ➕ Add, edit, and delete portfolio projects.
* 📩 View and respond to contact form messages.
* ✅ Secure logout functionality.

---

## ✨ Features

* Clean and modern portfolio design.
* Mobile-friendly (responsive) layout.
* Admin dashboard to manage content easily.
* Contact form with backend handler.
* Organized and reusable PHP code structure.

---

## 🤝 Contributing

Contributions are welcome!

To contribute:

1. Fork this repository.
2. Create a new branch: `git checkout -b feature/YourFeature`
3. Make your changes and commit: `git commit -m "Add new feature"`
4. Push to the branch: `git push origin feature/YourFeature`
5. Submit a Pull Request.
