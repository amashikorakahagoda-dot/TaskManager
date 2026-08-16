<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TaskMaster - Project & Task Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* ===== HERO SECTION - DARK BLUE ===== */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0a1628 0%, #14204a 40%, #0a1628 100%);
            padding: 120px 0 80px;
        }
        
        .hero-section .bg-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .hero-section .orb-1 {
            position: absolute;
            top: 80px;
            right: 80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.08);
            filter: blur(80px);
            animation: floatOrb 6s ease-in-out infinite;
        }
        
        .hero-section .orb-2 {
            position: absolute;
            bottom: 80px;
            left: 80px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.06);
            filter: blur(80px);
            animation: floatOrb 8s ease-in-out infinite reverse;
        }
        
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.1); }
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            width: 100%;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 8px 20px;
            border-radius: 50px;
            margin-bottom: 24px;
        }
        
        .hero-badge .dot {
            position: relative;
            display: inline-block;
            width: 12px;
            height: 12px;
        }
        
        .hero-badge .dot .ping {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(96, 165, 250, 0.5);
            animation: ping 1.5s ease-in-out infinite;
        }
        
        .hero-badge .dot .core {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #3b82f6;
        }
        
        @keyframes ping {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(2); opacity: 0; }
        }
        
        .hero-badge span {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            font-weight: 500;
        }
        
        .hero-title {
            font-size: 58px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
            margin-bottom: 24px;
        }
        
        .hero-title .highlight {
            background: linear-gradient(135deg, #60a5fa, #818cf8, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-subtitle {
            font-size: 18px;
            line-height: 1.8;
            color: rgba(191, 219, 254, 0.7);
            max-width: 550px;
            margin-bottom: 32px;
        }
        
        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 32px;
        }
        
        .btn-primary-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .btn-primary-hero:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
            color: #fff;
        }
        
        .btn-outline-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: transparent;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-outline-hero:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            color: #fff;
        }
        
        .btn-white-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: #ffffff;
            color: #1e3a8a;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .btn-white-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: #1e3a8a;
        }
        
        .trust-indicators {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }
        
        .trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(191, 219, 254, 0.6);
            font-size: 14px;
        }
        
        .trust-item i {
            color: #60a5fa;
        }
        
        /* ===== IMAGE SECTION ===== */
        .hero-image-wrapper {
            position: relative;
        }
        
        .hero-image-wrapper .deco-1 {
            position: absolute;
            top: -40px;
            left: -40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.05);
            filter: blur(60px);
        }
        
        .hero-image-wrapper .deco-2 {
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.05);
            filter: blur(60px);
        }
        
        .image-card {
            position: relative;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
        }
        
        .image-card .image-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .image-card .image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        
        .image-card .image-overlay {
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: linear-gradient(to top, rgba(30, 58, 138, 0.3), transparent);
        }
        
        .stats-card {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .stats-card .stats-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stats-card .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .stats-card .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        
        .stats-card .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
        }
        
        .stats-card .stat-icon.green {
            background: linear-gradient(135deg, #34d399, #10b981);
        }
        
        .stats-card .stat-icon.orange {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
        }
        
        .stats-card .stat-label {
            font-size: 11px;
            font-weight: 500;
            color: #6b7280;
            margin: 0;
        }
        
        .stats-card .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }
        
        .floating-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 12px 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .floating-badge .badge-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
        }
        
        .floating-badge .badge-icon.green {
            background: #22c55e;
        }
        
        .floating-badge .badge-icon.purple {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
        }
        
        .floating-badge .badge-label {
            font-size: 11px;
            font-weight: 500;
            color: #6b7280;
            margin: 0;
        }
        
        .floating-badge .badge-value {
            font-size: 13px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }
        
        .floating-badge.badge-1 {
            top: -16px;
            right: -16px;
            animation: floatBadge 3s ease-in-out infinite;
        }
        
        .floating-badge.badge-2 {
            bottom: -16px;
            left: -16px;
            animation: floatBadge 3.5s ease-in-out infinite reverse;
        }
        
        @keyframes floatBadge {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* ===== FEATURES SECTION - WHITE BACKGROUND ===== */
        .features-section {
            padding: 80px 0;
            background: #ffffff;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 0.8s ease forwards;
        }

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

        .features-section .section-title {
            opacity: 0;
            transform: translateY(20px);
            animation: titleFadeIn 0.6s ease forwards;
            animation-delay: 0.1s;
        }

        @keyframes titleFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            background: #f8fafc;
            cursor: default;
            position: relative;
            overflow: hidden;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.5s ease;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            min-height: 320px;
            opacity: 0;
            transform: translateY(30px);
            animation: cardFadeIn 0.6s ease forwards;
            border: 1px solid #e2e8f0;
        }

        .feature-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .feature-card:hover {
            cursor: pointer !important;
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        .feature-card:hover * {
            cursor: pointer !important;
        }

        .feature-card:hover .card-overlay {
            opacity: 0.3 !important;
            background: rgba(59, 130, 246, 0.3) !important;
        }

        .feature-card:hover .card-bg {
            opacity: 0.6 !important;
        }

        .feature-card.active {
            transform: scale(1.05);
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.2);
            background: transparent;
            border-color: transparent;
        }

        .feature-card.active:hover {
            cursor: pointer !important;
            transform: scale(1.05);
            box-shadow: 0 20px 60px rgba(59, 130, 246, 0.2);
        }

        .feature-card.active:hover * {
            cursor: pointer !important;
        }

        .feature-card.active .card-overlay {
            opacity: 1 !important;
            background: rgba(30, 58, 138, 0.85) !important;
        }

        .feature-card.active .card-bg {
            opacity: 1 !important;
        }

        .feature-card .card-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: all 0.5s ease;
            z-index: 0;
        }

        .feature-card .card-overlay {
            position: absolute;
            inset: 0;
            background: rgba(30, 58, 138, 0);
            opacity: 0;
            transition: all 0.5s ease;
            z-index: 1;
        }

        .feature-card .card-content {
            position: relative;
            z-index: 2;
            transition: all 0.5s ease;
        }

        .feature-card .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: white;
            transition: all 0.5s ease;
        }

        .feature-card .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #0a1628;
            transition: all 0.5s ease;
        }

        .feature-card .feature-desc {
            color: #64748b;
            line-height: 1.6;
            opacity: 0.8;
            transition: all 0.5s ease;
        }

        .feature-card:hover .feature-title {
            color: #3b82f6;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.05);
        }

        .feature-card.active .feature-icon {
            background: white;
            color: #1e3a8a;
            transform: scale(1.2);
        }

        .feature-card.active .feature-title {
            color: white;
        }

        .feature-card.active .feature-desc {
            color: white;
            opacity: 1;
        }

        .feature-card.active .card-content {
            transform: scale(1.05);
        }
        
        /* ===== HOW IT WORKS SECTION - DARK BLUE BACKGROUND ===== */
.how-it-works {
    padding: 80px 0;
    background: #0d1a2e;
    position: relative;
}

.how-it-works::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, #3b82f6, #6366f1, transparent);
}

.how-it-works .section-title {
    opacity: 0;
    transform: translateY(20px);
    animation: titleFadeIn 0.6s ease forwards;
    animation-delay: 0.1s;
}

.how-badge {
    display: inline-block;
    background: rgba(59, 130, 246, 0.15);
    color: #60a5fa;
    padding: 6px 24px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3px;
    margin-bottom: 15px;
    text-transform: uppercase;
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.how-badge i {
    margin-right: 8px;
}

.title-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
}

.title-divider span {
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #6366f1);
    border-radius: 2px;
}

.title-divider i {
    color: #3b82f6;
    font-size: 10px;
}

/* ===== STEP ROW ===== */
.step-row {
    display: flex;
    align-items: center;
    gap: 50px;
    max-width: 1100px;
    margin: 0 auto 30px;
    opacity: 0;
    transform: translateY(30px);
    animation: cardFadeIn 0.6s ease forwards;
}

.step-row:nth-child(2) {
    animation-delay: 0.3s;
}

.step-row-reverse {
    flex-direction: row !important;
}

/* ===== IMAGE SIDE ===== */
.step-image-side {
    flex: 1;
    position: relative;
}

.step-image-right {
    flex: 1;
    position: relative;
}

.step-image-wrapper-side {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    background: #1a2744;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.step-image-wrapper-side img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    transition: all 0.5s ease;
}

.step-image-wrapper-side:hover img {
    transform: scale(1.05);
}

.step-overlay-side {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(10, 22, 40, 0.2), rgba(10, 22, 40, 0.6));
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-number-side {
    font-size: 4rem;
    font-weight: 800;
    color: rgba(255, 255, 255, 0.6);
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    font-family: 'Georgia', serif;
    letter-spacing: 4px;
    text-align: center;
    line-height: 1.2;
}

.step-badge-side {
    position: absolute;
    bottom: -12px;
    right: 20px;
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: #ffffff;
    padding: 4px 20px;
    font-size: 11px;
    letter-spacing: 2px;
    font-weight: 600;
    border-radius: 4px;
}

.step-image-right .step-badge-side {
    right: 20px;
}

/* ===== CONTENT SIDE ===== */
.step-content-side {
    flex: 1;
    padding: 20px 0;
    text-align: left;
}

.step-content-left {
    text-align: left !important;
}

.step-icon-wrapper-side {
    display: flex;
    margin-bottom: 15px;
}

.step-content-side .step-icon-wrapper-side {
    justify-content: flex-start;
}

.step-content-left .step-icon-wrapper-side {
    justify-content: flex-start;
}

.step-icon-circle-side {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #ffffff;
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    border: 3px solid #0d1a2e;
    transition: all 0.3s ease;
}

.step-row:hover .step-icon-circle-side,
.step-row-reverse:hover .step-icon-circle-side {
    transform: scale(1.1);
    box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
}

.step-title-side {
    font-size: 1.8rem;
    font-weight: 700;
    color: #e2e8f0;
    margin-bottom: 12px;
    font-family: 'Georgia', serif;
    letter-spacing: 0.5px;
}

.step-desc-side {
    color: #94a3b8;
    line-height: 1.8;
    font-size: 1rem;
    margin-bottom: 15px;
    max-width: 450px;
}

.step-content-side .step-desc-side {
    margin-right: auto;
    margin-left: 0;
}

.step-content-left .step-desc-side {
    margin-right: auto;
    margin-left: 0;
}

.step-features-side {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.step-features-side li {
    color: #94a3b8;
    font-size: 0.9rem;
    padding: 4px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.step-content-side .step-features-side li {
    justify-content: flex-start;
}

.step-content-left .step-features-side li {
    justify-content: flex-start;
}

.step-features-side li i {
    color: #3b82f6;
    font-size: 12px;
}

.step-read-more-side {
    margin-top: 5px;
}

.step-content-side .step-read-more-side {
    text-align: left;
}

.step-content-left .step-read-more-side {
    text-align: left;
}

.step-link-side {
    color: #60a5fa;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    letter-spacing: 0.5px;
}

.step-link-side i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.step-link-side:hover {
    color: #93bbfc;
}

.step-link-side:hover i {
    transform: translateX(5px);
}

/* ===== CONNECTOR CENTER ===== */
.step-connector-center {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 20px 0;
    max-width: 1100px;
    margin: 0 auto;
}

.connector-line {
    flex: 1;
    max-width: 300px;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #6366f1);
    opacity: 0.2;
}

.connector-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #3b82f6;
    border: 2px solid #0d1a2e;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

/* ===== BOTTOM TEXT ===== */
.how-bottom-text {
    color: #64748b;
    font-size: 0.95rem;
    font-style: italic;
    letter-spacing: 0.5px;
    font-family: 'Georgia', serif;
}

.how-bottom-text i {
    margin: 0 10px;
    color: #3b82f6;
    font-size: 12px;
}
/* ===== CONNECTOR CENTER ===== */
        .step-connector-center {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            padding: 20px 0;
            max-width: 1100px;
            margin: 0 auto;
        }
        
        .connector-line {
            flex: 1;
            max-width: 300px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            opacity: 0.2;
        }
        
        .connector-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3b82f6;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }
        
        /* ===== BOTTOM TEXT ===== */
        .how-bottom-text {
            color: #94a3b8;
            font-size: 0.95rem;
            font-style: italic;
            letter-spacing: 0.5px;
            font-family: 'Georgia', serif;
        }
        
        .how-bottom-text i {
            margin: 0 10px;
            color: #3b82f6;
            font-size: 12px;
        }
        
        /* ===== STATS SECTION - WHITE BACKGROUND ===== */
        .stats-section {
            padding: 60px 0;
            background: #ffffff;
            position: relative;
        }
        
        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #6366f1, #3b82f6);
        }
        
        .stats-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .stats-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: 10px 20px;
            position: relative;
            flex: 1;
            min-width: 160px;
            max-width: 220px;
        }
        
        .stat-icon-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 2px solid #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #3b82f6;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.08);
        }
        
        .stat-item:hover .stat-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.25);
        }
        
        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0a1628;
            margin-bottom: 4px;
            font-family: 'Georgia', serif;
            letter-spacing: 1px;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .stat-line {
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            margin: 8px auto 0;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        
        .stat-item:hover .stat-line {
            width: 50px;
        }
        
        .stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 50px;
            background: linear-gradient(to bottom, transparent, #3b82f6, transparent);
            opacity: 0.15;
        }
        
        /* ===== CTA SECTION - DARK BLUE ===== */
        .cta-section {
            padding: 70px 0;
            background: linear-gradient(135deg, #0a1628 0%, #14204a 50%, #0a1628 100%);
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.05), transparent 70%);
            border-radius: 50%;
        }
        
        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.04), transparent 70%);
            border-radius: 50%;
        }
        
        .cta-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .cta-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.15);
            padding: 6px 18px;
            border-radius: 50px;
            color: #60a5fa;
            font-size: 13px;
            margin-bottom: 15px;
        }
        
        .cta-badge i {
            color: #3b82f6;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 15px;
        }
        
        .cta-title .highlight {
            background: linear-gradient(135deg, #60a5fa, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .cta-description {
            color: #94a3b8;
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 550px;
        }
        
        .cta-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }
        
        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
            width: 100%;
            justify-content: center;
        }
        
        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
            color: #fff;
        }
        
        .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            background: transparent;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
            justify-content: center;
        }
        
        .btn-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: translateY(-3px);
        }
        
        /* ===== FOOTER SECTION - DARK BLUE ===== */
        .footer {
            background: linear-gradient(135deg, #0a1628 0%, #0d1a2e 50%, #0a1628 100%);
            color: #ffffff;
            padding: 40px 0 15px;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 200px;
            height: 200px;
            background: rgba(59, 130, 246, 0.02);
            border-radius: 50%;
        }
        
        .footer::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 250px;
            height: 250px;
            background: rgba(99, 102, 241, 0.02);
            border-radius: 50%;
        }
        
        .footer-brand-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .footer-brand {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
        }
        
        .footer-brand i {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 6px;
        }
        
        .footer-description {
            color: #94a3b8;
            line-height: 1.6;
            font-size: 13px;
            margin-bottom: 0;
            max-width: 380px;
        }
        
        .footer-social {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.04);
            font-size: 14px;
        }
        
        .social-link:hover {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);
        }
        
        .footer-contact-simple {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .footer-contact-simple span {
            color: #94a3b8;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .footer-contact-simple span i {
            color: #3b82f6;
            font-size: 13px;
        }
        
        .footer-newsletter {
            position: relative;
            z-index: 1;
        }
        
        .newsletter-text {
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 8px;
        }
        
        .newsletter-form {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50px;
            padding: 3px;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }
        
        .newsletter-form input {
            background: transparent;
            border: none;
            padding: 8px 15px;
            color: #ffffff;
            font-size: 13px;
            outline: none;
            width: 180px;
        }
        
        .newsletter-form input::placeholder {
            color: #64748b;
        }
        
        .newsletter-form button {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }
        
        .newsletter-form button:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.04);
            padding-top: 15px;
            margin-top: 25px;
            position: relative;
            z-index: 1;
        }
        
        .footer-bottom p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }
        
        .footer-bottom p strong {
            color: #94a3b8;
        }
        
        .footer-bottom-links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        
        .footer-bottom-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 12px;
            transition: color 0.3s ease;
        }
        
        .footer-bottom-links a:hover {
            color: #60a5fa;
        }
        
        .footer-bottom-links .separator {
            color: #334155;
            font-size: 12px;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 44px;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .trust-indicators {
                justify-content: center;
            }
            
            .hero-subtitle {
                margin: 0 auto 32px;
                text-align: center;
            }
            
            .hero-badge {
                margin: 0 auto 24px;
            }
            
            .hero-title {
                text-align: center;
            }
            
            .floating-badge.badge-1 {
                top: -10px;
                right: -10px;
            }
            
            .floating-badge.badge-2 {
                bottom: -10px;
                left: -10px;
            }
            
            .cta-title {
                font-size: 2rem;
                text-align: center;
            }
            
            .cta-description {
                text-align: center;
                margin: 0 auto 25px;
            }
            
            .cta-badge {
                margin: 0 auto 15px;
            }
            
            .cta-buttons {
                flex-direction: row;
                justify-content: center;
            }
            
            .btn-cta-primary,
            .btn-cta-secondary {
                width: auto;
                padding: 12px 28px;
                font-size: 14px;
            }
            
            .footer-brand-wrapper {
                text-align: center;
            }
            
            .footer-description {
                margin: 0 auto;
            }
            
            .footer-social {
                justify-content: center;
            }
            
            .footer-contact-simple {
                justify-content: center;
            }
            
            .footer-newsletter {
                text-align: center;
                margin-top: 10px;
            }
            
            .newsletter-form {
                margin: 0 auto;
            }
            
            .step-row {
                flex-direction: column !important;
                gap: 30px;
                max-width: 600px;
            }
            
            .step-row-reverse {
                flex-direction: column !important;
            }
            
            .step-image-wrapper-side img {
                height: 280px;
            }
            
            .step-content-side {
                text-align: center !important;
                padding: 0 20px;
            }
            
            .step-content-left {
                text-align: center !important;
            }
            
            .step-icon-wrapper-side {
                justify-content: center !important;
            }
            
            .step-content-left .step-icon-wrapper-side {
                justify-content: center !important;
            }
            
            .step-desc-side {
                max-width: 100% !important;
                margin: 0 auto !important;
            }
            
            .step-content-side .step-desc-side {
                margin: 0 auto !important;
            }
            
            .step-content-left .step-desc-side {
                margin: 0 auto !important;
            }
            
            .step-features-side li {
                justify-content: center !important;
            }
            
            .step-content-side .step-features-side li {
                justify-content: center !important;
            }
            
            .step-content-left .step-features-side li {
                justify-content: center !important;
            }
            
            .step-read-more-side {
                text-align: center !important;
            }
            
            .step-content-side .step-read-more-side {
                text-align: center !important;
            }
            
            .step-content-left .step-read-more-side {
                text-align: center !important;
            }
            
            .step-badge-side {
                bottom: -10px;
                right: 50%;
                transform: translateX(50%);
            }
            
            .step-image-right .step-badge-side {
                right: 50%;
                transform: translateX(50%);
            }
            
            .step-connector-center {
                padding: 10px 0;
            }
            
            .connector-line {
                max-width: 150px;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0 60px;
                min-height: auto;
            }
            
            .hero-title {
                font-size: 32px;
            }
            
            .hero-subtitle {
                font-size: 16px;
            }
            
            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-primary-hero,
            .btn-outline-hero,
            .btn-white-hero {
                width: 100%;
                justify-content: center;
                padding: 12px 24px;
                font-size: 14px;
            }
            
            .stats-card .stats-row {
                flex-direction: column;
                gap: 12px;
            }
            
            .stats-card .stat-item {
                width: 100%;
                justify-content: center;
            }
            
            .floating-badge {
                display: none;
            }
            
            .hero-badge {
                font-size: 12px;
                padding: 6px 16px;
            }
            
            .trust-indicators {
                gap: 12px;
                font-size: 12px;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .feature-card.active {
                transform: scale(1.02);
            }
            
            .feature-card {
                min-height: 280px;
                padding: 30px 20px;
            }
            
            .stats-section {
                padding: 40px 0;
            }
            
            .stats-row {
                gap: 25px;
            }
            
            .stat-item {
                min-width: 130px;
                max-width: 180px;
                padding: 10px 15px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .stat-label {
                font-size: 0.75rem;
            }
            
            .stat-item:not(:last-child)::after {
                display: none;
            }
            
            .stat-line {
                width: 25px;
            }
            
            .how-it-works {
                padding: 50px 0;
            }
            
            .step-image-wrapper-side img {
                height: 220px;
            }
            
            .step-number-side {
                font-size: 3.5rem;
            }
            
            .step-title-side {
                font-size: 1.4rem;
            }
            
            .step-desc-side {
                font-size: 0.9rem;
            }
            
            .step-icon-circle-side {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
            
            .title-divider span {
                width: 30px;
            }
            
            .how-badge {
                font-size: 10px;
                padding: 5px 18px;
                letter-spacing: 2px;
            }
            
            .step-connector-center {
                padding: 5px 0;
            }
            
            .connector-line {
                max-width: 80px;
            }
            
            .connector-dot {
                width: 10px;
                height: 10px;
            }
            
            .footer {
                padding: 25px 0 15px;
            }
            
            .footer-brand {
                font-size: 20px;
            }
            
            .footer-description {
                font-size: 12px;
                max-width: 100%;
            }
            
            .footer-social {
                gap: 8px;
            }
            
            .social-link {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }
            
            .footer-contact-simple {
                gap: 12px;
                flex-direction: column;
                align-items: center;
            }
            
            .footer-contact-simple span {
                font-size: 11px;
            }
            
            .newsletter-form input {
                width: 140px;
                font-size: 12px;
                padding: 6px 12px;
            }
            
            .newsletter-form button {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
            
            .footer-bottom {
                padding-top: 12px;
                margin-top: 20px;
            }
            
            .footer-bottom p {
                font-size: 12px;
            }
            
            .footer-bottom-links {
                justify-content: center;
                margin-top: 8px;
            }
            
            .footer-bottom-links a {
                font-size: 11px;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 28px;
            }
            
            .feature-card .feature-title {
                font-size: 1.2rem;
            }
            
            .feature-card .feature-desc {
                font-size: 14px;
            }
            
            .stats-section {
                padding: 30px 0;
            }
            
            .stats-row {
                gap: 15px;
            }
            
            .stat-item {
                min-width: 120px;
                max-width: 160px;
                padding: 8px 10px;
            }
            
            .stat-icon {
                width: 42px;
                height: 42px;
                font-size: 17px;
            }
            
            .stat-number {
                font-size: 1.3rem;
            }
            
            .stat-label {
                font-size: 0.7rem;
            }
            
            .stat-line {
                width: 20px;
                height: 1.5px;
            }
            
            .cta-section {
                padding: 50px 0;
            }
            
            .cta-title {
                font-size: 1.6rem;
            }
            
            .cta-description {
                font-size: 0.95rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-cta-primary,
            .btn-cta-secondary {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
                font-size: 14px;
            }
            
            .footer {
                padding: 20px 0 12px;
            }
            
            .footer-brand {
                font-size: 18px;
            }
            
            .footer-description {
                font-size: 11px;
            }
            
            .social-link {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }
            
            .newsletter-form input {
                width: 120px;
                font-size: 11px;
            }
            
            .footer-bottom-links {
                gap: 5px;
            }
            
            .footer-bottom-links .separator {
                display: none;
            }
            
            .how-it-works {
                padding: 40px 0;
            }
            
            .step-image-wrapper-side img {
                height: 180px;
            }
            
            .step-number-side {
                font-size: 2.8rem;
            }
            
            .step-title-side {
                font-size: 1.2rem;
            }
            
            .step-desc-side {
                font-size: 0.85rem;
            }
            
            .step-icon-circle-side {
                width: 44px;
                height: 44px;
                font-size: 16px;
                border-width: 2px;
            }
            
            .step-features-side li {
                font-size: 0.8rem;
            }
            
            .title-divider span {
                width: 20px;
            }
            
            .title-divider i {
                font-size: 10px;
            }
            
            .how-bottom-text {
                font-size: 0.85rem;
            }
            
            .how-bottom-text i {
                font-size: 10px;
                margin: 0 6px;
            }
            
            .step-badge-side {
                font-size: 9px;
                padding: 3px 14px;
                bottom: -8px;
            }
        }
    </style>
</head>
<body>
    
    <!-- ===== HERO SECTION ===== -->
    <section class="hero-section">
        
        <div class="bg-pattern"></div>
        <div class="orb-1"></div>
        <div class="orb-2"></div>
        
        <div class="container hero-content">
            <div class="row align-items-center">
                
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge">
                        <span class="dot">
                            <span class="ping"></span>
                            <span class="core"></span>
                        </span>
                        <span>Project & Task Management</span>
                    </div>
                    
                    <h1 class="hero-title">
                        Manage Your
                        <br>
                        <span class="highlight">Projects & Tasks</span>
                        <br>
                        Efficiently
                    </h1>
                    
                    <p class="hero-subtitle">
                        TaskMaster helps you organize projects, track tasks, and collaborate with your team. 
                        Simple, intuitive, and powerful project management made easy.
                    </p>
                    
                    <div class="hero-buttons">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-white-hero">
                                <i class="fas fa-tachometer-alt"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary-hero">
                                <i class="fas fa-rocket"></i>
                                Get Started Free
                            </a>
                            <a href="{{ route('login') }}" class="btn-outline-hero">
                                <i class="fas fa-sign-in-alt"></i>
                                Sign In
                            </a>
                        @endauth
                    </div>
                    
                    <div class="trust-indicators">
                        <span class="trust-item">
                            <i class="fas fa-check-circle"></i>
                            Free to use
                        </span>
                        <span class="trust-item">
                            <i class="fas fa-check-circle"></i>
                            Secure & Private
                        </span>
                        <span class="trust-item">
                            <i class="fas fa-check-circle"></i>
                            Team Collaboration
                        </span>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="hero-image-wrapper">
                        <div class="deco-1"></div>
                        <div class="deco-2"></div>
                        
                        <div class="image-card">
                            <div class="image-wrapper">
                                <img 
                                    src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop&crop=center" 
                                    alt="TaskMaster Dashboard Preview"
                                >
                                <div class="image-overlay"></div>
                                
                                <div class="stats-card">
                                    <div class="stats-row">
                                        <div class="stat-item">
                                            <div class="stat-icon blue">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div>
                                                <p class="stat-label">Total Projects</p>
                                                <p class="stat-value">1,284</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon green">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>
                                                <p class="stat-label">Completed</p>
                                                <p class="stat-value">847</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon orange">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div>
                                                <p class="stat-label">In Progress</p>
                                                <p class="stat-value">342</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="floating-badge badge-1">
                            <div class="badge-icon green">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="badge-label">Task Status</p>
                                <p class="badge-value">85% Complete</p>
                            </div>
                        </div>
                        
                        <div class="floating-badge badge-2">
                            <div class="badge-icon purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <p class="badge-label">Team Members</p>
                                <p class="badge-value">12 Active</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </section>
    
    <!-- ===== FEATURES SECTION ===== -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5 section-title">
                <h2 class="display-4 fw-bold" style="color: #0a1628;">
                    Why Choose TaskMaster?
                </h2>
                <p class="fs-5" style="color: #64748b;">
                    Everything you need to manage projects and tasks effectively
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card" onclick="toggleCard(this)">
                        <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&h=400&fit=crop');"></div>
                        <div class="card-overlay"></div>
                        <div class="card-content">
                            <div class="feature-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <h4 class="feature-title">Project Management</h4>
                            <p class="feature-desc">
                                Create and manage multiple projects with detailed information including 
                                start/end dates, status, and descriptions.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card" onclick="toggleCard(this)">
                        <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&h=400&fit=crop');"></div>
                        <div class="card-overlay"></div>
                        <div class="card-content">
                            <div class="feature-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h4 class="feature-title">Task Tracking</h4>
                            <p class="feature-desc">
                                Add tasks to projects with priority levels, due dates, and status tracking 
                                from pending to completed.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card" onclick="toggleCard(this)">
                        <div class="card-bg" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop');"></div>
                        <div class="card-overlay"></div>
                        <div class="card-content">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h4 class="feature-title">Dashboard Analytics</h4>
                            <p class="feature-desc">
                                Get a quick overview with statistics showing total projects, tasks, 
                                and their completion status at a glance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ===== HOW IT WORKS SECTION ===== -->
    <section class="how-it-works">
        <div class="container">
            <div class="text-center mb-5 section-title">
                <span class="how-badge">
                    <i class="fas fa-heart"></i> HOW IT WORKS
                </span>
                <h2 class="display-4 fw-bold" style="color: #f2f2f3; font-family: 'Georgia', serif;">
                    Simple <span style="color: #3b82f6; font-style: italic;">Process</span>
                </h2>
                <p class="fs-5" style="color: #64748b; font-style: italic; font-family: 'Georgia', serif;">
                    Two steps to get started with TaskMaster
                </p>
                <div class="title-divider">
                    <span></span>
                    <i class="fas fa-asterisk"></i>
                    <span></span>
                </div>
            </div>
            
            <!-- Step 1 - Image Left | Details Right -->
            <div class="step-row">
                <div class="step-image-side">
                    <div class="step-image-wrapper-side">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop&crop=center" alt="Step 1">
                        <div class="step-overlay-side">
                            <div class="step-number-side">STEP<br>01</div>
                        </div>
                    </div>
                    <div class="step-badge-side">STEP 01</div>
                </div>
                <div class="step-content-side">
                    <div class="step-icon-wrapper-side">
                        <div class="step-icon-circle-side">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <h3 class="step-title-side">Register & Login</h3>
                    <p class="step-desc-side">
                        Create your account and log in to access the TaskMaster dashboard. 
                        Get started in just a few clicks with secure authentication.
                    </p>
                    <ul class="step-features-side">
                        <li><i class="fas fa-check"></i> User Registration</li>
                        <li><i class="fas fa-check"></i> User Login</li>
                        <li><i class="fas fa-check"></i> Secure Authentication</li>
                    </ul>
                    <div class="step-read-more-side">
                        <span class="step-link-side">Learn More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
            </div>
            
            <!-- Connector Line -->
            <div class="step-connector-center">
                <div class="connector-dot"></div>
                <div class="connector-line"></div>
                <div class="connector-dot"></div>
            </div>
            
            <!-- Step 2 - Details Left | Image Right -->
            <div class="step-row step-row-reverse">
                <div class="step-content-side step-content-left">
                    <div class="step-icon-wrapper-side">
                        <div class="step-icon-circle-side">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
                    <h3 class="step-title-side">Manage Projects & Tasks</h3>
                    <p class="step-desc-side">
                        Create projects, add tasks, track progress, and manage everything 
                        efficiently from your dashboard.
                    </p>
                    <ul class="step-features-side">
                        <li><i class="fas fa-check"></i> Create Projects</li>
                        <li><i class="fas fa-check"></i> Add Tasks</li>
                        <li><i class="fas fa-check"></i> Track Progress</li>
                    </ul>
                    <div class="step-read-more-side">
                        <span class="step-link-side">Learn More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
                
                <div class="step-image-side step-image-right">
                    <div class="step-image-wrapper-side">
                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&h=400&fit=crop&crop=center" alt="Step 2">
                        <div class="step-overlay-side">
                            <div class="step-number-side">STEP<br>02</div>
                        </div>
                    </div>
                    <div class="step-badge-side">STEP 02</div>
                </div>
            </div>
            
            <!-- Bottom Decorative Text -->
            <div class="text-center mt-5">
                <p class="how-bottom-text">
                    <i class="fas fa-heart"></i>
                    Start your journey with TaskMaster today
                    <i class="fas fa-heart"></i>
                </p>
            </div>
        </div>
    </section>
    
    <!-- ===== STATS SECTION ===== -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-wrapper">
                <div class="stats-row">
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Active Users</div>
                        <div class="stat-line"></div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                        </div>
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Projects Managed</div>
                        <div class="stat-line"></div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                        <div class="stat-line"></div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="stat-number">4.9★</div>
                        <div class="stat-label">User Rating</div>
                        <div class="stat-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ===== CTA SECTION ===== -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <span class="cta-badge"><i class="fas fa-rocket"></i> Get Started Today</span>
                            <h2 class="cta-title">
                                Ready to <span class="highlight">Streamline</span> Your Workflow?
                            </h2>
                            <p class="cta-description">
                                Join thousands of teams already using TaskMaster to manage their projects 
                                and tasks efficiently. Start your free journey today!
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="cta-buttons">
                            <a href="{{ route('register') }}" class="btn-cta-primary">
                                <i class="fas fa-rocket"></i> Start Free Trial
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4 align-items-center">
                
                <div class="col-lg-4 col-md-6 text-center text-md-start">
                    <div class="footer-brand-wrapper">
                        <h3 class="footer-brand">
                            <i class="fas fa-tasks"></i> TaskMaster
                        </h3>
                        <p class="footer-description">
                            The ultimate project and task management solution for teams 
                            and individuals to organize, track, and collaborate efficiently.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="footer-contact-simple">
                        <span><i class="fas fa-envelope"></i> support@taskmaster.com</span>
                        <span><i class="fas fa-phone"></i> +1 (555) 123-4567</span>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-12 text-center text-lg-end">
                    <div class="footer-newsletter">
                        <p class="newsletter-text">Subscribe for updates</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Your email">
                            <button><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} <strong>TaskMaster System</strong>. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-bottom-links">
                            <a href="#">Privacy</a>
                            <span class="separator">|</span>
                            <a href="#">Terms</a>
                            <span class="separator">|</span>
                            <a href="#">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </footer>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // ===== FEATURE CARD TOGGLE =====
        function toggleCard(card) {
            var bg = card.querySelector('.card-bg');
            var overlay = card.querySelector('.card-overlay');
            var icon = card.querySelector('.feature-icon');
            var title = card.querySelector('.feature-title');
            var desc = card.querySelector('.feature-desc');
            var content = card.querySelector('.card-content');
            
            var isActive = card.classList.contains('active');
            
            document.querySelectorAll('.feature-card').forEach(function(c) {
                c.classList.remove('active');
                var cBg = c.querySelector('.card-bg');
                var cOverlay = c.querySelector('.card-overlay');
                var cIcon = c.querySelector('.feature-icon');
                var cTitle = c.querySelector('.feature-title');
                var cDesc = c.querySelector('.feature-desc');
                var cContent = c.querySelector('.card-content');
                
                if (cBg) {
                    cBg.style.opacity = '0';
                }
                if (cOverlay) {
                    cOverlay.style.opacity = '0';
                    cOverlay.style.background = 'rgba(30, 58, 138, 0)';
                }
                if (cIcon) {
                    cIcon.style.background = 'linear-gradient(135deg, #3b82f6, #6366f1)';
                    cIcon.style.color = 'white';
                    cIcon.style.transform = 'scale(1)';
                }
                if (cTitle) {
                    cTitle.style.color = '#0a1628';
                }
                if (cDesc) {
                    cDesc.style.color = '#64748b';
                    cDesc.style.opacity = '0.8';
                }
                if (cContent) {
                    cContent.style.transform = 'scale(1)';
                }
                c.style.transform = 'scale(1)';
                c.style.background = '#f8fafc';
                c.style.boxShadow = '0 5px 20px rgba(0,0,0,0.05)';
                c.style.borderColor = '#e2e8f0';
                c.style.cursor = 'default';
            });
            
            if (!isActive) {
                card.classList.add('active');
                
                bg.style.opacity = '1';
                overlay.style.opacity = '1';
                overlay.style.background = 'rgba(30, 58, 138, 0.85)';
                
                icon.style.background = 'white';
                icon.style.color = '#1e3a8a';
                icon.style.transform = 'scale(1.2)';
                
                title.style.color = 'white';
                
                desc.style.color = 'white';
                desc.style.opacity = '1';
                
                card.style.transform = 'scale(1.05)';
                card.style.background = 'transparent';
                card.style.boxShadow = '0 20px 60px rgba(59,130,246,0.2)';
                card.style.borderColor = 'transparent';
                card.style.cursor = 'pointer';
                
                content.style.transform = 'scale(1.05)';
            }
        }
        
        // ===== SCROLL ANIMATION OBSERVER =====
        document.addEventListener('DOMContentLoaded', function() {
            // How It Works Section
            const howSection = document.querySelector('.how-it-works');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            if (howSection) {
                howSection.style.opacity = '0';
                howSection.style.transform = 'translateY(50px)';
                observer.observe(howSection);
            }
        });
    </script>
    
</body>
</html>