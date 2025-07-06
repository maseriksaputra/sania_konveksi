<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sania Konveksi - Solusi Konveksi Terpercaya</title>
    <meta name="description" content="Sania Konveksi menyediakan layanan konveksi berkualitas tinggi dengan harga terjangkau. Spesialis dalam pembuatan seragam, kaos, dan berbagai produk tekstil custom.">
    <meta name="keywords" content="konveksi, seragam, kaos custom, bordir, sablon, tekstil">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #15B392;
            --primary-dark: #12A57E;
            --secondary-color: #1E40AF;
            --accent-color: #F59E0B;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --background-light: #F9FAFB;
            --white: #FFFFFF;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .header.transparent {
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .logo i {
            margin-right: 10px;
            font-size: 2rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            align-items: center;
            gap: 30px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .header.transparent .nav-link {
            color: var(--white);
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            display: inline-flex; /* Added for icon alignment */
            align-items: center; /* Added for icon alignment */
            gap: 8px; /* Spacing between icon and text */
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        .header.transparent .mobile-menu-toggle {
            color: var(--white);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: linear-gradient(135deg, rgba(21, 179, 146, 0.9), rgba(18, 165, 126, 0.9)),
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(21, 179, 146, 0.8), rgba(18, 165, 126, 0.6));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero h2 {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: var(--white);
            color: var(--primary-color);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border-color: var(--white);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Stats Section */
        .stats {
            background: var(--white);
            padding: 80px 0;
            position: relative;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .stat-item {
            text-align: center;
            padding: 40px 20px;
            background: var(--background-light);
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-10px);
        }

        .stat-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Section Styles */
        .section {
            padding: 100px 0;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .bg-primary .section-title,
        .bg-primary .section-subtitle {
            color: var(--white);
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .service-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Portfolio Section */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .portfolio-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: var(--background-light);
            transition: transform 0.3s ease;
        }

        .portfolio-item:hover {
            transform: scale(1.05);
        }

        .portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(21, 179, 146, 0.9), rgba(18, 165, 126, 0.9));
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }

        .portfolio-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .portfolio-description {
            font-size: 1rem;
            opacity: 0.9;
            padding: 0 15px; /* Added padding for better readability */
        }

        /* Testimonials Section */
        .testimonials-slider {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            padding-bottom: 50px; /* Space for dots */
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
            text-align: center;
            display: none; /* Hidden by default for slider functionality */
        }

        .testimonial-card.active {
            display: block;
            animation: fadeIn 0.6s ease-out;
        }

        .testimonial-text {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .testimonial-company {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--text-light);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--primary-color);
            transform: scale(1.2);
        }

        /* About Section */
        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .about-image {
            flex: 1;
            min-width: 300px;
        }

        .about-image img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
        }

        .about-text {
            flex: 2;
            min-width: 300px;
        }

        .about-text h3 {
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .about-text p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .about-text ul {
            list-style: none;
            margin-top: 20px;
        }

        .about-text ul li {
            margin-bottom: 10px;
            color: var(--text-dark);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .about-text ul li i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }


        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            text-align: center;
            padding: 100px 0;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-button-large {
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .cta-btn-primary {
            background: var(--white);
            color: var(--primary-color);
            box-shadow: var(--shadow-lg);
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .cta-btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .cta-btn-secondary:hover {
            background: var(--white);
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Contact Section */
        .contact-content {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .contact-info {
            flex: 1;
            min-width: 300px;
        }

        .contact-info h3 {
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .contact-info p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .contact-details {
            list-style: none;
        }

        .contact-details li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .contact-details li i {
            color: var(--primary-color);
            margin-right: 15px;
            font-size: 1.3rem;
            width: 25px; /* Fixed width for icon alignment */
            text-align: center;
        }

        .contact-form {
            flex: 1.5;
            min-width: 300px;
            background: var(--background-light);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #D1D5DB;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--text-dark);
            transition: border-color 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .contact-form textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-form button {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            width: 100%;
        }

        .contact-form button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }


        /* Footer */
        .footer {
            background: var(--text-dark);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            line-height: 1.6;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            color: var(--white);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }


        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        /* Scroll to Top */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: var(--white);
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 50px;
                transition: left 0.3s ease;
                box-shadow: var(--shadow-lg);
            }

            .nav-menu.active {
                left: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero h2 {
                font-size: 1.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .about-content,
            .contact-content {
                flex-direction: column;
            }

            .about-image,
            .about-text,
            .contact-info,
            .contact-form {
                width: 100%;
                min-width: unset;
            }
        }
    </style>
</head>
<body>
    <header class="header transparent" id="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-scissors"></i>
                Sania Konveksi
            </a>

            <nav class="nav-menu" id="nav-menu">
                <a href="#layanan" class="nav-link">Layanan</a>
                <a href="#portofolio" class="nav-link">Portofolio</a>
                <a href="#testimoni" class="nav-link">Testimoni</a>
                <a href="#tentang" class="nav-link">Tentang</a>
                <a href="#kontak" class="nav-link">Kontak</a>
                <a href="#order" class="cta-button">
                    <i class="fas fa-shopping-cart"></i>
                    Order Sekarang
                </a>
            </nav>

            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <section class="hero" id="hero">
        <div class="hero-content">
            <h1>Sania Konveksi</h1>
            <h2>Solusi Konveksi Terpercaya</h2>
            <p>Wujudkan kebutuhan seragam dan produk tekstil berkualitas tinggi dengan harga terjangkau. Kami melayani dengan standar profesional dan hasil yang memuaskan.</p>
            <div class="hero-buttons">
                <a href="#layanan" class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                    Lihat Layanan
                </a>
                <a href="https://wa.me/082250791395?text=Halo%20Sania%20Konveksi%2C%20saya%20ingin%20konsultasi%20tentang%20produk%20Anda." class="btn btn-secondary" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">500+</div>
                <div class="stat-label">Pelanggan Puas</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">5+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-number">1000+</div>
                <div class="stat-label">Produk Berkualitas</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="stat-number">99%</div>
                <div class="stat-label">Tepat Waktu</div>
            </div>
        </div>
    </section>

    <section class="section" id="layanan">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Kami menyediakan berbagai layanan konveksi profesional dengan kualitas terbaik dan harga yang kompetitif</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3 class="service-title">Kaos Custom</h3>
                    <p class="service-description">Produksi kaos dengan desain custom sesuai kebutuhan Anda. Tersedia berbagai pilihan bahan dan teknik printing.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="service-title">Seragam Kantor</h3>
                    <p class="service-description">Seragam kantor berkualitas dengan desain profesional. Cocok untuk korporat dan instansi pemerintahan.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="service-title">Seragam Sekolah</h3>
                    <p class="service-description">Seragam sekolah dengan standar kualitas tinggi. Nyaman digunakan untuk aktivitas belajar mengajar.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="service-title">Sablon & Bordir</h3>
                    <p class="service-description">Layanan sablon dan bordir dengan teknologi modern. Hasil yang tajam dan tahan lama.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <h3 class="service-title">Seragam Kerja</h3>
                    <p class="service-description">Seragam kerja untuk berbagai profesi. Desain fungsional dengan material berkualitas tinggi.</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3 class="service-title">Kaos Olahraga</h3>
                    <p class="service-description">Kaos olahraga dengan bahan yang menyerap keringat. Ideal untuk tim olahraga dan event.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-primary" id="portofolio">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Portofolio Kami</h2>
                <p class="section-subtitle">Lihat hasil karya terbaik kami yang telah dipercaya oleh berbagai klien</p>
            </div>

            <div class="portfolio-grid">
                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Seragam Kantor">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Seragam Kantor</h3>
                        <p class="portfolio-description">Seragam kantor PT. ABC dengan desain modern dan elegan</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Kaos Custom">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Kaos Custom</h3>
                        <p class="portfolio-description">Kaos custom untuk event gathering perusahaan</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1434510423563-285f0c3fb75d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Seragam Sekolah">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Seragam Sekolah</h3>
                        <p class="portfolio-description">Seragam sekolah SMA Negeri 1 dengan kualitas premium</p>
                    </div>
                </div>

                <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Kaos Olahraga">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Kaos Olahraga</h3>
                        <p class="portfolio-description">Kaos olahraga dengan bahan cepat kering untuk tim</p>
                    </div>
                </div>
                 <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1582260655113-176840742588?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Jaket Komunitas">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Jaket Komunitas</h3>
                        <p class="portfolio-description">Jaket stylish untuk komunitas dengan bordir logo</p>
                    </div>
                </div>
                 <div class="portfolio-item">
                    <img src="https://images.unsplash.com/photo-1563294371-33ed609f303f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Topi Custom">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title">Topi Custom</h3>
                        <p class="portfolio-description">Topi baseball custom dengan bordir logo perusahaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="testimoni">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Apa Kata Klien Kami?</h2>
                <p class="section-subtitle">Dengar langsung dari pelanggan yang telah merasakan kualitas dan layanan Sania Konveksi</p>
            </div>

            <div class="testimonials-slider">
                <div class="testimonial-card active">
                    <p class="testimonial-text">"Sania Konveksi benar-benar luar biasa! Kualitas seragam kantor yang kami pesan melebihi ekspektasi. Pelayanan sangat responsif dan proses pengerjaan cepat. Sangat direkomendasikan!"</p>
                    <p class="testimonial-author">- Ibu Rina, Manajer HRD PT. Jaya Abadi</p>
                    <p class="testimonial-company">Jakarta</p>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Kami memesan kaos custom untuk acara reuni sekolah, dan hasilnya sangat memuaskan. Sablonnya rapi, warnanya cerah, dan bahan kaosnya nyaman dipakai. Pasti akan order lagi di sini!"</p>
                    <p class="testimonial-author">- Budi Santoso, Ketua Panitia Reuni Angkatan '98</p>
                    <p class="testimonial-company">Surabaya</p>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Sania Konveksi adalah pilihan tepat untuk kebutuhan seragam sekolah kami. Mereka sangat memperhatikan detail dan memberikan harga yang bersaing. Anak-anak sangat senang dengan seragam barunya."</p>
                    <p class="testimonial-author">- Pak Doni, Kepala Sekolah SD Harapan Bangsa</p>
                    <p class="testimonial-company">Bandung</p>
                </div>
            </div>
            <div class="slider-dots">
                <span class="dot active" data-index="0"></span>
                <span class="dot" data-index="1"></span>
                <span class="dot" data-index="2"></span>
            </div>
        </div>
    </section>

    <section class="section" id="tentang">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Tentang Sania Konveksi</h2>
                <p class="section-subtitle">Kisah kami dalam menyediakan produk tekstil berkualitas tinggi untuk Anda</p>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1552504930-b302c332c9c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Tentang Sania Konveksi">
                </div>
                <div class="about-text">
                    <h3>Dedikasi untuk Kualitas dan Kepuasan Pelanggan</h3>
                    <p>Sania Konveksi didirikan lebih dari 5 tahun yang lalu dengan visi untuk menjadi mitra terpercaya dalam memenuhi kebutuhan konveksi di Indonesia. Berawal dari workshop kecil, kini kami telah berkembang menjadi konveksi modern dengan kapasitas produksi besar, didukung oleh tim profesional dan mesin-mesin terkini.</p>
                    <p>Kami percaya bahwa setiap produk adalah representasi dari identitas Anda. Oleh karena itu, kami selalu berkomitmen untuk menghasilkan produk dengan kualitas terbaik, mulai dari pemilihan bahan, proses produksi, hingga finishing. Kepuasan pelanggan adalah prioritas utama kami.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Bahan Berkualitas Tinggi</li>
                        <li><i class="fas fa-check-circle"></i> Tim Profesional Berpengalaman</li>
                        <li><i class="fas fa-check-circle"></i> Produksi Tepat Waktu</li>
                        <li><i class="fas fa-check-circle"></i> Harga Kompetitif</li>
                        <li><i class="fas fa-check-circle"></i> Desain Custom Fleksibel</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section" id="order">
        <div class="section-container">
            <h2 class="cta-title">Siap Wujudkan Kebutuhan Konveksi Anda?</h2>
            <p class="cta-subtitle">Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda dari konsultasi hingga proses produksi.</p>
            <div class="cta-buttons">
                <a href="#kontak" class="cta-button-large cta-btn-primary">
                    <i class="fas fa-phone-alt"></i>
                    Hubungi Kami
                </a>
                <a href="https://wa.me/082250791395?text=Halo%20Sania%20Konveksi%2C%20saya%20ingin%20memesan%20produk%20Anda." class="cta-button-large cta-btn-secondary" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Order Via WhatsApp
                </a>
            </div>
        </div>
    </section>

    <section class="section" id="kontak">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Kontak Kami</h2>
                <p class="section-subtitle">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami untuk pertanyaan atau pemesanan.</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Informasi Kontak</h3>
                    <p>Sania Konveksi berkomitmen untuk memberikan pelayanan terbaik. Hubungi kami melalui detail di bawah ini:</p>
                    <ul class="contact-details">
                        <li><i class="fas fa-map-marker-alt"></i> Jl. Contoh Raya No. 123, Purwodadi, Jawa Tengah</li>
                        <li><i class="fas fa-phone"></i> (0271) 123456</li>
                        <li><i class="fab fa-whatsapp"></i> +62 822-5079-1395</li>
                        <li><i class="fas fa-envelope"></i> info@saniakonveksi.com</li>
                        <li><i class="fas fa-clock"></i> Senin - Sabtu: 08.00 - 17.00 WIB</li>
                    </ul>
                    <div class="social-icons">
                        <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Kirim Pesan Kepada Kami</h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan alamat email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" name="subject" placeholder="Subjek pesan Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini" required></textarea>
                        </div>
                        <button type="submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about-us">
                <h3>Sania Konveksi</h3>
                <p>Penyedia solusi konveksi terpercaya untuk seragam, kaos custom, dan berbagai produk tekstil berkualitas tinggi dengan harga terjangkau.</p>
            </div>
            <div class="footer-section quick-links">
                <h3>Tautan Cepat</h3>
                <ul>
                    <li><a href="#layanan">Layanan</a></li>
                    <li><a href="#portofolio">Portofolio</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section contact-info">
                <h3>Hubungi Kami</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Contoh Raya No. 123, Purwodadi, Jawa Tengah</p>
                <p><i class="fas fa-phone"></i> (0271) 123456</p>
                <p><i class="fab fa-whatsapp"></i> +62 822-5079-1395</p>
                <p><i class="fas fa-envelope"></i> info@saniakonveksi.com</p>
            </div>
            <div class="footer-section social-media">
                <h3>Ikuti Kami</h3>
                <div class="social-icons">
                    <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Sania Konveksi. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <div class="scroll-to-top" id="scrollToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Header Transparency on Scroll
        const header = document.getElementById('header');
        const heroSection = document.getElementById('hero');
        const headerHeight = header.offsetHeight;

        function checkHeaderTransparency() {
            if (window.scrollY > heroSection.offsetHeight - headerHeight) {
                header.classList.remove('transparent');
            } else {
                header.classList.add('transparent');
            }
        }

        window.addEventListener('scroll', checkHeaderTransparency);
        window.addEventListener('DOMContentLoaded', checkHeaderTransparency); // Check on initial load

        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const navMenu = document.getElementById('nav-menu');

        mobileMenuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            // Toggle icon
            const icon = mobileMenuToggle.querySelector('i');
            if (navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when a link is clicked
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                mobileMenuToggle.querySelector('i').classList.add('fa-bars');
            });
        });


        // Scroll to Top Button Visibility
        const scrollToTopButton = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) { // Show button after scrolling 300px
                scrollToTopButton.classList.add('visible');
            } else {
                scrollToTopButton.classList.remove('visible');
            }
        });

        scrollToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Testimonials Slider
        let currentSlide = 0;
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = testimonialCards.length;

        function showSlide(index) {
            testimonialCards.forEach((card, i) => {
                card.classList.remove('active');
                dots[i].classList.remove('active');
                if (i === index) {
                    card.classList.add('active');
                    dots[i].classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Auto-play slider (optional)
        let slideInterval = setInterval(nextSlide, 7000); // Change slide every 7 seconds

        // Pause auto-play on hover
        const testimonialsSlider = document.querySelector('.testimonials-slider');
        testimonialsSlider.addEventListener('mouseenter', () => clearInterval(slideInterval));
        testimonialsSlider.addEventListener('mouseleave', () => slideInterval = setInterval(nextSlide, 7000));

        // Initial display
        showSlide(currentSlide);
    </script>
</body>
</html>
