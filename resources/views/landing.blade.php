<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem peminjaman barang sekolah yang cepat, transparan, modern, dan mudah digunakan.">
    <title>Peminjaman Barang | Inventaris Sekolah</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ===== FOUNDATION ===== */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, system-ui, sans-serif;
            background:
                radial-gradient(circle at 15% 10%, rgba(99, 102, 241, 0.13), transparent 28%),
                radial-gradient(circle at 85% 5%,  rgba(168, 85, 247, 0.13), transparent 28%),
                radial-gradient(circle at 50% 90%, rgba(14, 165, 233, 0.10), transparent 30%),
                linear-gradient(160deg, #f0f4ff 0%, #eef2ff 35%, #f8faff 70%, #f0f9ff 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== SCROLL REVEAL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1);
        }
        .reveal.revealed {
            opacity: 1;
            transform: none;
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1);
        }
        .reveal-left.revealed { opacity: 1; transform: none; }
        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1);
        }
        .reveal-right.revealed { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ===== GLASS VARIANTS ===== */
        .glass {
            background: rgba(15, 23, 42, 0.34);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);
            transition: box-shadow 0.3s ease;
        }
        .glass:hover {
            box-shadow: 0 32px 64px rgba(79, 70, 229, 0.22);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            border: 1px solid rgba(148, 163, 184, 0.22);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 18px 40px rgba(99, 102, 241, 0.08), inset 0 1px 0 rgba(255,255,255,0.8);
            transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), box-shadow 0.35s ease, border-color 0.35s ease;
        }
        .glass-card:hover {
            transform: translateY(-8px) scale(1.015);
            box-shadow: 0 32px 64px rgba(99, 102, 241, 0.15), inset 0 1px 0 rgba(255,255,255,0.9);
            border-color: rgba(99, 102, 241, 0.28);
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(148, 163, 184, 0.28);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255,255,255,0.9);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        .nav-glass.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.12), inset 0 1px 0 rgba(255,255,255,1);
        }

        .landing-profile {
            position: relative;
        }
        .landing-profile summary {
            align-items: center;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 9999px;
            cursor: pointer;
            display: flex;
            gap: 0.6rem;
            list-style: none;
            max-width: 15rem;
            padding: 0.35rem 0.7rem 0.35rem 0.4rem;
        }
        .landing-profile summary::-webkit-details-marker { display: none; }
        .landing-profile-avatar {
            align-items: center;
            background: #e0e7ff;
            border-radius: 50%;
            color: #3730a3;
            display: inline-flex;
            flex: 0 0 2.25rem;
            font-size: 0.9rem;
            font-weight: 800;
            height: 2.25rem;
            justify-content: center;
            object-fit: cover;
            width: 2.25rem;
        }
        .landing-profile-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            min-width: 0;
            text-align: left;
        }
        .landing-profile-name {
            color: #1e293b;
            font-size: 0.78rem;
            font-weight: 800;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .landing-profile-role {
            color: #64748b;
            font-size: 0.66rem;
            margin-top: 0.15rem;
        }
        .landing-profile-chevron {
            color: #64748b;
            font-size: 0.7rem;
        }
        .landing-profile-menu {
            background: #fff;
            border: 1px solid rgba(148, 163, 184, 0.22);
            border-radius: 1rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.14);
            min-width: 13rem;
            padding: 0.4rem;
            position: absolute;
            right: 0;
            top: calc(100% + 0.55rem);
            z-index: 60;
        }
        .landing-profile-menu a,
        .landing-profile-menu button {
            background: transparent;
            border: 0;
            border-radius: 0.65rem;
            color: #334155;
            display: block;
            font: inherit;
            font-size: 0.85rem;
            padding: 0.65rem 0.75rem;
            text-align: left;
            text-decoration: none;
            width: 100%;
        }
        .landing-profile-menu a:hover,
        .landing-profile-menu button:hover {
            background: #eef2ff;
            color: #3730a3;
        }

        .hero-bg {
            background:
                radial-gradient(ellipse 80% 60% at 15% 20%, rgba(99, 102, 241, 0.15), transparent),
                radial-gradient(ellipse 60% 50% at 80% 5%,  rgba(59, 130, 246, 0.12), transparent),
                radial-gradient(ellipse 50% 60% at 50% 100%, rgba(14, 165, 233, 0.08), transparent),
                linear-gradient(160deg, rgba(255,255,255,0.85), rgba(248,250,252,0.90));
        }

        /* ===== HERO HEADING TYPING CURSOR ===== */
        .typing-cursor {
            display: inline-block;
            width: 3px;
            height: 0.85em;
            background: #6366f1;
            margin-left: 3px;
            vertical-align: middle;
            border-radius: 2px;
            animation: blink-caret 1s step-end infinite;
        }
        @keyframes blink-caret {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }

        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 40%, #0ea5e9 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% auto;
            animation: shimmer-text 4s linear infinite;
        }
        @keyframes shimmer-text {
            0%   { background-position: 0%   center; }
            50%  { background-position: 100% center; }
            100% { background-position: 0%   center; }
        }

        .primary-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 35%, #8b5cf6 100%);
            background-size: 200% auto;
            box-shadow: 0 16px 28px rgba(99, 102, 241, 0.34);
            transition: transform 0.25s cubic-bezier(0.22,1,0.36,1), box-shadow 0.25s ease, background-position 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .primary-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .primary-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 28px 40px rgba(99, 102, 241, 0.45);
            background-position: right center;
        }
        .primary-btn:hover::after { opacity: 1; }
        .primary-btn:active {
            transform: translateY(-1px) scale(0.99);
            box-shadow: 0 12px 20px rgba(99, 102, 241, 0.30);
        }

        .item-card {
            transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), border-color 0.3s ease, box-shadow 0.35s ease;
            will-change: transform;
        }
        .item-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: rgba(99, 102, 241, 0.40);
            box-shadow: 0 24px 50px rgba(79, 70, 229, 0.18);
        }
        .item-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(99,102,241,0.04), rgba(14,165,233,0.04));
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .item-card:hover::before { opacity: 1; }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.28rem 0.55rem;
            border-radius: 9999px;
            font-size: 0.63rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .status-available {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .status-borrowed {
            background: rgba(244, 63, 94, 0.12);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: #f43f5e;
        }

        /* ===== STEP CARDS (cara pinjam) ===== */
        .step-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), box-shadow 0.35s ease, border-color 0.3s ease;
        }
        .step-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(99,102,241,0.07), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }
        .step-card:hover::before { opacity: 1; }
        .step-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 32px 60px rgba(99,102,241,0.14);
            border-color: rgba(99,102,241,0.30);
        }
        .step-number {
            position: relative;
            font-size: 1.25rem;
            font-weight: 900;
            background: linear-gradient(135deg, #4f46e5, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* ===== BENTO CARDS ===== */
        .bento-card {
            transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), box-shadow 0.35s ease;
        }
        .bento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 40px 80px rgba(15,23,42,0.28);
        }

        /* ===== STAT COUNTER ===== */
        .stat-counter { font-variant-numeric: tabular-nums; }

        /* ===== BADGE PULSE ===== */
        .live-badge {
            position: relative;
        }
        .live-badge::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: rgba(52,211,153,0.4);
            animation: ping-badge 2s cubic-bezier(0,0,0.2,1) infinite;
        }
        @keyframes ping-badge {
            75%, 100% { transform: scale(2.2); opacity: 0; }
        }

        /* ===== SHIMMER CARD BORDER ===== */
        .shimmer-border {
            position: relative;
        }
        .shimmer-border::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            background: linear-gradient(90deg, transparent 0%, rgba(99,102,241,0.5) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer-border 3s linear infinite;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            z-index: -1;
        }
        .shimmer-border:hover::after { opacity: 1; }
        @keyframes shimmer-border {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ===== FAQ ACCORDION ===== */
        .faq-item {
            border-radius: 1.25rem;
            border: 1px solid rgba(148,163,184,0.25);
            background: rgba(255,255,255,0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 4px 20px rgba(15,23,42,0.05);
            overflow: hidden;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .faq-item:hover {
            box-shadow: 0 12px 32px rgba(99,102,241,0.10);
            border-color: rgba(99,102,241,0.22);
        }
        .faq-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            padding: 1.25rem 1.5rem;
            list-style: none;
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            user-select: none;
        }
        .faq-summary::-webkit-details-marker { display: none; }
        .faq-icon {
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            border-radius: 9999px;
            background: rgba(99,102,241,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6366f1;
            transition: transform 0.3s cubic-bezier(0.22,1,0.36,1), background 0.3s ease;
        }
        details[open] .faq-icon {
            transform: rotate(45deg);
            background: rgba(99,102,241,0.18);
        }
        .faq-body {
            padding: 0 1.5rem 1.25rem;
            color: #475569;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* ===== STATS SECTION ===== */
        .stats-section {
            position: relative;
            overflow: hidden;
        }
        .stats-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 80% at 50% 50%, rgba(99,102,241,0.06), transparent);
            pointer-events: none;
        }
        .stat-box {
            text-align: center;
            padding: 2rem 1rem;
            border-radius: 1.5rem;
            background: rgba(255,255,255,0.55);
            border: 1px solid rgba(148,163,184,0.18);
            backdrop-filter: blur(12px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(99,102,241,0.12);
        }

        /* ===== FOOTER ===== */
        footer {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.65);
            border-top: 1px solid rgba(148,163,184,0.22);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        /* ===== SECTION DECORATIVE DIVIDER ===== */
        .section-divider {
            width: 80px;
            height: 4px;
            border-radius: 9999px;
            background: linear-gradient(90deg, #4f46e5, #8b5cf6, #0ea5e9);
            margin: 1rem auto 0;
        }

        /* ===== GRADIENT PILL ===== */
        .gradient-pill {
            background: linear-gradient(135deg, rgba(79,70,229,0.10), rgba(139,92,246,0.10));
            border: 1px solid rgba(99,102,241,0.18);
            color: #4f46e5;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            padding: 0.35rem 1rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-dot {
            position: absolute;
            left: -0.5rem;
            top: 0.6rem;
            width: 0.8rem;
            height: 0.8rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, #22c55e, #34d399);
            box-shadow: 0 0 0 0.35rem rgba(52, 211, 153, 0.2);
        }

        .timeline-item {
            position: relative;
            padding-left: 1.6rem;
            transition: transform 0.2s ease;
        }
        .timeline-item:hover {
            transform: translateX(4px);
        }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: 0.2rem;
            top: 0.5rem;
            bottom: -0.8rem;
            width: 2px;
            background: linear-gradient(180deg, rgba(52, 211, 153, 0.9), rgba(99, 102, 241, 0.3));
        }
        .timeline-item:last-child::before {
            display: none;
        }

        .search-result:hover {
            background: rgba(99, 102, 241, 0.10);
            border-radius: 1rem;
        }
        .search-result { transition: background 0.2s ease; border-radius: 1rem; }

        .ambient-background {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
            isolation: isolate;
        }

        .ambient-background::before,
        .ambient-background::after {
            position: absolute;
            inset: 0;
            content: "";
            pointer-events: none;
        }

        .ambient-background::before {
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.045) 1px, transparent 1px);
            background-size: 52px 52px;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.55), transparent 82%);
        }

        .ambient-background::after {
            background-image:
                radial-gradient(circle, rgba(99, 102, 241, 0.24) 1px, transparent 1.5px),
                radial-gradient(circle, rgba(14, 165, 233, 0.18) 1px, transparent 1.5px);
            background-position: 0 0, 34px 38px;
            background-size: 76px 76px, 92px 92px;
            opacity: 0.3;
            mask-image: linear-gradient(to bottom, black, transparent 88%);
        }

        .ambient-orb {
            translate: var(--pointer-x, 0px) var(--pointer-y, 0px);
            transition: translate 700ms cubic-bezier(0.2, 0.7, 0.2, 1);
            opacity: 0.82;
            animation: ambient-float 23s ease-in-out infinite alternate;
        }

        .ambient-orb--indigo {
            animation-duration: 21s;
        }

        .ambient-orb--violet {
            animation-duration: 27s;
            animation-delay: -12s;
            animation-name: ambient-float-reverse;
        }

        .ambient-orb--cyan {
            animation-duration: 24s;
            animation-delay: -8s;
            animation-name: ambient-float-gentle;
        }

        @keyframes ambient-float {
            from { transform: translate3d(-24px, -20px, 0) scale(0.96); opacity: 0.7; }
            to { transform: translate3d(34px, 38px, 0) scale(1.07); opacity: 0.95; }
        }

        @keyframes ambient-float-reverse {
            from { transform: translate3d(26px, -24px, 0) scale(1.04); opacity: 0.76; }
            to { transform: translate3d(-38px, 30px, 0) scale(0.94); opacity: 0.96; }
        }

        @keyframes ambient-float-gentle {
            from { transform: translate3d(-18px, 22px, 0) scale(0.96); opacity: 0.72; }
            to { transform: translate3d(24px, -32px, 0) scale(1.06); opacity: 0.94; }
        }

        main {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 640px) {
            .ambient-background::before { background-size: 64px 64px; }
            .ambient-background::after  { opacity: 0.16; }
            .ambient-orb--indigo,
            .ambient-orb--violet,
            .ambient-orb--cyan { scale: 0.78; }
            .landing-profile-copy { display: none; }
            .landing-profile summary { padding-right: 0.55rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .ambient-orb,
            .gradient-text,
            .shimmer-border::after,
            .reveal, .reveal-left, .reveal-right {
                animation: none !important;
                transition: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }

        .hero-visual {
            isolation: isolate;
            padding: 2.25rem 0 1rem;
        }
        .inventory-summary-card {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(148, 163, 184, 0.28);
            box-shadow: 0 24px 55px rgba(49, 46, 129, 0.12);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }
        .inventory-metric {
            border: 1px solid rgba(148, 163, 184, 0.2);
            background: rgba(248, 250, 252, 0.86);
        }
        .hero-photo-frame {
            position: absolute;
            inset: 0.5rem 0.5rem 0;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 2rem;
            box-shadow: 0 32px 70px rgba(15, 23, 42, 0.18);
        }
        .hero-photo-frame::after {
            position: absolute;
            inset: 0;
            content: "";
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.04), rgba(15, 23, 42, 0.48));
        }
        .hero-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 44%;
        }
        .inventory-panel {
            position: relative;
            z-index: 1;
            margin: 1.6rem 1.35rem 0;
            background: rgba(15, 23, 42, 0.88);
            border-color: rgba(255, 255, 255, 0.32);
            box-shadow: 0 28px 64px rgba(15, 23, 42, 0.3);
        }
        .weekly-chart {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 0.5rem;
        }
        .weekly-chart-bar {
            min-width: 0;
            border-radius: 0.55rem 0.55rem 0.2rem 0.2rem;
            background: linear-gradient(180deg, #67e8f9, #6366f1);
            box-shadow: 0 0 16px rgba(103, 232, 249, 0.16);
            transform-origin: bottom;
            animation: bar-arrive 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .weekly-chart-bar:nth-child(2) { animation-delay: 0.06s; }
        .weekly-chart-bar:nth-child(3) { animation-delay: 0.12s; }
        .weekly-chart-bar:nth-child(4) { animation-delay: 0.18s; }
        .weekly-chart-bar:nth-child(5) { animation-delay: 0.24s; }
        .weekly-chart-bar:nth-child(6) { animation-delay: 0.3s; }
        .weekly-chart-bar:nth-child(7) { animation-delay: 0.36s; }
        @keyframes bar-arrive {
            from { transform: scaleY(0.2); opacity: 0.4; }
            to { transform: scaleY(1); opacity: 1; }
        }
        .weekly-chart-labels {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 0.5rem;
            color: rgba(203, 213, 225, 0.7);
            font-size: 0.6rem;
            text-align: center;
        }
        @media (max-width: 639px) {
            .hero-bg { padding-top: 7rem !important; padding-bottom: 1rem !important; }
            .hero-bg form { margin-top: 1.5rem !important; }
            .hero-bg .mt-6.flex.flex-wrap { margin-top: 1rem !important; }
            .hero-visual { padding-top: 0.5rem; }
            .hero-photo-frame { inset: 0.25rem 0 0; }
            .inventory-panel { margin: 0.5rem 0.65rem 0; padding: 1rem; }
            .weekly-chart, .weekly-chart-labels { display: none; }
        }
        @media (prefers-reduced-motion: reduce) {
            .weekly-chart-bar { animation: none; }
        }
    </style>
</head>
<body class="relative min-h-screen antialiased text-slate-800">
    <div class="ambient-background">
        <div class="ambient-orb ambient-orb--indigo absolute -left-20 top-24 h-80 w-80 rounded-full bg-indigo-300/35 blur-3xl"></div>
        <div class="ambient-orb ambient-orb--violet absolute right-0 top-0 h-96 w-96 rounded-full bg-violet-300/30 blur-3xl"></div>
        <div class="ambient-orb ambient-orb--cyan absolute bottom-10 left-1/3 h-80 w-80 rounded-full bg-cyan-200/35 blur-3xl"></div>
    </div>

    <header class="fixed inset-x-0 top-0 z-50 pt-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="nav-glass mx-auto flex max-w-6xl items-center justify-between rounded-full px-4 py-3 sm:px-6">
                <a href="#top" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-sipinjam.jpg') }}" alt="" class="h-10 w-12 shrink-0 rounded-xl bg-white object-contain p-0.5 sm:w-24" />
                    <div class="leading-none">
                        <div class="text-sm font-black tracking-tight text-slate-900">Peminjaman Barang</div>
                        <div class="mt-1 text-[10px] font-semibold uppercase tracking-[0.22em] text-slate-600">Sekolah</div>
                    </div>
                </a>

                <div class="hidden items-center gap-8 text-sm font-medium text-slate-700 md:flex">
                    <a href="#fitur" class="transition hover:text-indigo-700">Fitur</a>
                    <a href="#katalog" class="transition hover:text-indigo-700">Katalog Cepat</a>
                    <a href="#cara-pinjam" class="transition hover:text-indigo-700">Cara Pinjam</a>
                    <a href="#faq" class="transition hover:text-indigo-700">FAQ</a>
                </div>

                @if (auth()->check())
                    <details class="landing-profile">
                        <summary aria-label="Buka menu profil">
                            @if (auth()->user()->avatar_path)
                                <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="" class="landing-profile-avatar">
                            @else
                                <span class="landing-profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            @endif
                            <span class="landing-profile-copy">
                                <span class="landing-profile-name">{{ auth()->user()->name }}</span>
                                <span class="landing-profile-role">{{ auth()->user()->role === 'admin' ? 'Admin Sarpras' : (auth()->user()->role === 'guru' ? 'Guru' : 'Siswa') }}</span>
                            </span>
                            <svg aria-hidden="true" class="landing-profile-chevron" viewBox="0 0 16 16" fill="none">
                                <path d="m4 6 4 4 4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                            </svg>
                        </summary>
                        <div class="landing-profile-menu">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('profile.edit') }}">{{ auth()->user()->role === 'admin' ? 'Profil Admin' : 'Profil Saya' }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Keluar</button>
                            </form>
                        </div>
                    </details>
                @else
                    <a href="{{ route('login') }}" class="primary-btn inline-flex items-center gap-2 rounded-full px-4 py-2.5 text-sm font-semibold text-white sm:px-5">
                        Masuk ke Sistem
                        <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                            <path d="M4.5 10h11m-4.5-4.5L15.5 10 11 14.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <main id="top" class="relative">
        <section class="hero-bg relative overflow-hidden pb-20 pt-32 sm:pt-36 lg:pb-24 lg:pt-40">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-[1.08fr_0.92fr]">
                    <div class="relative z-10">
                        <div class="mb-6 inline-flex items-center gap-3 rounded-full border border-indigo-200/60 bg-white/20 px-4 py-2 text-[10px] font-bold uppercase tracking-[0.24em] text-indigo-700 shadow-[0_10px_25px_rgba(99,102,241,0.12)] backdrop-blur-xl">
                            <span class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_16px_rgba(52,211,153,0.9)]"></span>
                            Smart school inventory
                        </div>

                        <h1 class="max-w-3xl text-4xl font-black leading-[0.92] tracking-[-0.06em] text-slate-900 sm:text-5xl lg:text-7xl">
                            Inventaris &amp; Peminjaman Barang Sekolah
                            <span class="gradient-text">Lebih Rapi, Cepat, dan Transparan.</span>
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                            Sistem manajemen inventaris pintar untuk siswa, guru, dan sarpras sekolah.
                        </p>

                        <div class="mt-7 flex flex-wrap items-center gap-3">
                            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="primary-btn inline-flex items-center gap-2 rounded-full px-6 py-3 text-sm font-bold text-white">
                                Masuk ke Sistem
                                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                    <path d="M4.5 10h11m-4.5-4.5L15.5 10 11 14.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <a href="#katalog" class="inline-flex items-center rounded-full border border-indigo-200 bg-white/70 px-5 py-3 text-sm font-semibold text-indigo-700 transition hover:border-indigo-300 hover:bg-white">
                                Jelajahi katalog
                            </a>
                        </div>

                        <form id="landing-search-form" class="mt-10">
                            <div class="rounded-[1.7rem] border border-indigo-200/60 bg-slate-950/90 p-3 shadow-[0_24px_40px_rgba(15,23,42,0.18)]">
                                <div class="flex items-center gap-3 rounded-[1.2rem] border border-indigo-200/20 bg-slate-900/80 p-3">
                                    <svg aria-hidden="true" class="h-5 w-5 shrink-0 text-indigo-300" viewBox="0 0 24 24" fill="none">
                                        <circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="1.8" />
                                        <path d="m16 16 4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                    <input
                                        id="landing-search"
                                        type="text"
                                        value="{{ $searchTerm }}"
                                        placeholder="Cari barang favoritmu... misal: Proyektor, Kamera, Bola"
                                        class="w-full border-0 bg-transparent text-sm text-white placeholder:text-slate-400 focus:outline-none focus:ring-0"
                                        autocomplete="off"
                                    />
                                    <button type="submit" class="primary-btn rounded-full px-5 py-2 text-sm font-semibold text-white">
                                        Cari
                                    </button>
                                </div>

                                <div id="search-results" class="mt-3 hidden max-h-64 overflow-hidden rounded-2xl border border-white/10 bg-slate-950/70 p-2"></div>
                            </div>
                        </form>

                        <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-slate-600">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-100/90 px-3 py-1 font-medium text-emerald-700">
                                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                    <path d="m4.5 10.2 3.4 3.3 7.6-7.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Persetujuan oleh petugas
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-indigo-200 bg-indigo-100/90 px-3 py-1 font-medium text-indigo-700">
                                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                    <path d="M3.5 6.5h13v10h-13zM6.5 6.5v-3h7v3m-7 4h7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ number_format($barangTersedia, 0, ',', '.') }} Unit Siap Dipinjam
                            </span>
                        </div>
                    </div>

                    <div class="relative z-10">
                        <div class="hero-visual relative mx-auto max-w-xl">
                            @php($weeklyScale = max(1, max($weeklyLoans)))
                            <div class="hero-photo-frame" aria-hidden="true">
                                <img src="{{ asset('images/landing-classroom.jpg') }}" alt="" fetchpriority="high">
                            </div>
                            <div class="glass inventory-panel rounded-[2rem] p-5 text-white shadow-[0_35px_75px_rgba(79,70,229,0.18)]">
                                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                                    <div>
                                        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-100">Inventaris terkini</p>
                                        <h2 class="mt-2 text-3xl font-black tracking-[-0.05em] text-white">{{ number_format($totalBarang, 0, ',', '.') }}</h2>
                                    </div>
                                    <div class="inline-flex items-center gap-1 rounded-2xl border border-emerald-400/30 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-200">
                                        <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                            <circle cx="10" cy="10" r="5" fill="currentColor" />
                                        </svg>
                                        Data aktif
                                    </div>
                                </div>

                                <div class="mt-6" role="img" aria-label="Aktivitas peminjaman tujuh hari terakhir">
                                    <div class="mb-2 flex items-center justify-between text-[10px] text-slate-300">
                                        <span>Aktivitas 7 hari terakhir</span>
                                        <strong class="font-semibold text-cyan-200">{{ number_format($weeklyTotal, 0, ',', '.') }} transaksi</strong>
                                    </div>
                                    <div class="weekly-chart h-24 items-end">
                                        @foreach ($weeklyLoans as $loan)
                                            <div class="weekly-chart-bar" style="height: {{ $loan > 0 ? max(8, ($loan / $weeklyScale) * 100) : 3 }}%"></div>
                                        @endforeach
                                    </div>
                                    <div class="weekly-chart-labels mt-2">
                                        @foreach ($weeklyLabels as $label)
                                            <span>{{ $label }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-3 gap-3 text-xs text-slate-300">
                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-slate-300">Tersedia</div>
                                        <div class="mt-2 text-xl font-bold text-emerald-300">{{ number_format($barangTersedia, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-slate-300">Dipinjam</div>
                                        <div class="mt-2 text-xl font-bold text-amber-300">{{ number_format($sedangDipinjam, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-slate-300">Kategori</div>
                                        <div class="mt-2 text-xl font-bold text-cyan-300">{{ $kategoriBarang }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute -left-6 top-14 flex items-center gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-left shadow-[0_20px_40px_rgba(16,185,129,0.18)] backdrop-blur-xl">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/20 text-emerald-100">
                                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <path d="m5 12.5 4.2 4.2L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-[10px] uppercase tracking-[0.18em] text-emerald-200">Barang populer</div>
                                    <div class="text-sm font-semibold text-white">{{ $barangPopuler->first()?->nama_barang ?? 'Belum ada data' }}</div>
                                </div>
                            </div>

                            <div class="absolute -right-5 bottom-8 flex items-center gap-3 rounded-2xl border border-indigo-300/20 bg-indigo-500/10 px-4 py-3 text-left shadow-[0_20px_40px_rgba(99,102,241,0.14)] backdrop-blur-xl">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-400/20 text-indigo-100">
                                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 7h16v13H4zM8 7V4h8v3m-8 5h8m-8 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-[10px] uppercase tracking-[0.18em] text-indigo-200">Stok</div>
                                    <div class="text-sm font-semibold text-white">{{ $barangTersedia > 0 ? number_format($barangTersedia, 0, ',', '.') . ' unit siap dipinjam' : 'Stok kosong' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="relative pb-20 lg:pb-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-indigo-600">Semua yang dibutuhkan</p>
                    <h2 class="mt-4 text-3xl font-black tracking-[-0.05em] text-slate-900 sm:text-5xl">Inventaris sekolah jadi lebih rapi, cepat, dan aman.</h2>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-12">
                    <div class="md:col-span-7">
                        <div class="bento-card h-full rounded-[2rem] border border-slate-200/80 bg-slate-950 p-6 shadow-[0_24px_55px_rgba(15,23,42,0.18)] sm:p-7">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.25em] text-slate-300">Contoh alur</p>
                                    <h3 class="mt-2 text-2xl font-bold text-white">Tahapan peminjaman</h3>
                                </div>
                                <div class="rounded-full border border-emerald-400/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">Online</div>
                            </div>

                            <div class="mt-8 space-y-6">
                                <div class="timeline-item pl-8">
                                    <span class="timeline-dot"></span>
                                    <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-emerald-200">1. Mengajukan</div>
                                        <div class="mt-1 text-sm font-semibold text-white">Contoh peminjam &middot; Laptop</div>
                                    </div>
                                </div>

                                <div class="timeline-item pl-8">
                                    <span class="timeline-dot"></span>
                                    <div class="rounded-2xl border border-indigo-300/20 bg-indigo-500/10 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-indigo-200">2. Disetujui admin</div>
                                        <div class="mt-1 text-sm font-semibold text-white">Proyektor Epson &middot; 2 unit</div>
                                    </div>
                                </div>

                                <div class="timeline-item pl-8">
                                    <span class="timeline-dot"></span>
                                    <div class="rounded-2xl border border-amber-300/20 bg-amber-500/10 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-amber-200">3. Diambil</div>
                                        <div class="mt-1 text-sm font-semibold text-white">Kamera Canon &middot; Senin, 09.00</div>
                                    </div>
                                </div>

                                <div class="timeline-item pl-8">
                                    <span class="timeline-dot"></span>
                                    <div class="rounded-2xl border border-slate-400/20 bg-white/5 p-3">
                                        <div class="text-[10px] uppercase tracking-[0.2em] text-slate-300">4. Dikembalikan</div>
                                        <div class="mt-1 text-sm font-semibold text-white">Speaker Portable &middot; 1 hari lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-5">
                        <div class="inventory-summary-card h-full rounded-[2rem] p-6 sm:p-7">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                    <svg aria-hidden="true" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                        <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                        <path d="m4.5 7.8 7.5 4.4 7.5-4.4M12 12.2V21" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">Ringkasan inventaris</p>
                                    <h3 class="mt-1 text-xl font-bold text-slate-900 sm:text-2xl">Semua barang terkelola</h3>
                                </div>
                            </div>

                            <div class="mt-7 grid grid-cols-2 gap-3">
                                <div class="inventory-metric rounded-2xl p-4">
                                    <p class="text-xs font-medium text-slate-500">Jenis barang</p>
                                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900">{{ number_format($totalBarang, 0, ',', '.') }}</p>
                                </div>
                                <div class="inventory-metric rounded-2xl p-4">
                                    <p class="text-xs font-medium text-slate-500">Unit tersedia</p>
                                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-indigo-700">{{ number_format($barangTersedia, 0, ',', '.') }}</p>
                                </div>
                                <div class="inventory-metric rounded-2xl p-4">
                                    <p class="text-xs font-medium text-slate-500">Sedang dipinjam</p>
                                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900">{{ number_format($sedangDipinjam, 0, ',', '.') }}</p>
                                </div>
                                <div class="inventory-metric rounded-2xl p-4">
                                    <p class="text-xs font-medium text-slate-500">Kategori</p>
                                    <p class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900">{{ number_format($kategoriBarang, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="katalog" class="md:col-span-12">
                        <div class="rounded-[2rem] border border-slate-200/80 bg-slate-950 p-6 shadow-[0_24px_55px_rgba(15,23,42,0.18)] sm:p-7">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.25em] text-slate-300">Katalog barang populer</p>
                                    <h3 class="mt-2 text-2xl font-bold text-white">Barang paling sering dipinjam</h3>
                                </div>
                                <a href="<?php echo e(route('barang.index')); ?>" class="inline-flex items-center gap-1 text-sm font-medium text-indigo-200 transition hover:text-white">
                                    Lihat semua barang
                                    <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.5 10h11m-4.5-4.5L15.5 10 11 14.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>

                            <div class="mt-6 grid gap-4 lg:grid-cols-3">
                                <?php if ($barangPopuler->isEmpty()): ?>
                                    <div class="rounded-[1.5rem] border border-dashed border-slate-700 bg-slate-900/60 p-6 text-slate-300">Belum ada data barang yang tersedia.</div>
                                <?php else: ?>
                                    <?php foreach ($barangPopuler as $barang): ?>
                                    <?php
                                        $isAvailable = $barang->status_barang === 'tersedia' && $barang->stok_tersedia > 0;
                                        $borrowRoute = auth()->check()
                                            ? route('peminjaman.create', ['barang_id' => $barang->id])
                                            : route('login');
                                    ?>
                                    <div class="item-card rounded-[1.5rem] border border-slate-800 bg-slate-900/70 p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500/20 to-cyan-400/20 text-indigo-200" aria-hidden="true">
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                                    <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                                    <path d="m4.5 7.8 7.5 4.4 7.5-4.4M12 12.2V21" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <span class="status-pill {{ $isAvailable ? 'status-available' : 'status-borrowed' }}">
                                                {{ $isAvailable ? 'Tersedia' : 'Tidak tersedia' }}
                                            </span>
                                        </div>

                                        <h4 class="mt-4 text-lg font-bold text-white">{{ $barang->nama_barang }}</h4>
                                        <p class="mt-1 text-sm text-slate-300">
                                            {{ $barang->stok_tersedia }} unit tersedia &middot; {{ $barang->kategori ?? 'Umum' }}
                                        </p>

                                        <?php if ($isAvailable): ?>
                                            <a href="{{ $borrowRoute }}" class="mt-4 inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 px-4 py-2 text-sm font-semibold text-white shadow-[0_12px_20px_rgba(99,102,241,0.25)] transition hover:scale-[1.01]">
                                                Pinjam
                                            </a>
                                        <?php else: ?>
                                            <span class="mt-4 inline-flex cursor-not-allowed items-center justify-center rounded-full bg-slate-700 px-4 py-2 text-sm font-semibold text-slate-300">
                                                Tidak tersedia
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="cara-pinjam" class="relative pb-20 lg:pb-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-indigo-600">Cara pinjam</p>
                    <h2 class="mt-4 text-3xl font-black tracking-[-0.05em] text-slate-900 sm:text-5xl">Alur 4 langkah yang sederhana</h2>
                </div>

                <div class="grid gap-5 lg:grid-cols-4">
                    <div class="glass-card rounded-[2rem] p-6 sm:p-7">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500/20 to-violet-500/20 text-xl font-black text-indigo-700">01</div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-900">Cari Barang</h3>
                        <p class="mt-3 text-base leading-7 text-slate-600">Temukan barang yang dibutuhkan dari katalog atau pencarian cepat di halaman utama.</p>
                    </div>

                    <div class="glass-card rounded-[2rem] p-6 sm:p-7">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500/20 to-indigo-500/20 text-xl font-black text-indigo-700">02</div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-900">Ajukan Peminjaman</h3>
                        <p class="mt-3 text-base leading-7 text-slate-600">Isi form peminjaman dengan tanggal, jumlah, dan kebutuhan penggunaan barang.</p>
                    </div>

                    <div class="glass-card rounded-[2rem] p-6 sm:p-7">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500/20 to-indigo-500/20 text-xl font-black text-indigo-700">03</div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-900">Persetujuan Admin</h3>
                        <p class="mt-3 text-base leading-7 text-slate-600">Petugas sarpras memvalidasi ketersediaan dan persetujuan pengajuan sebelum barang diserahkan.</p>
                    </div>

                    <div class="glass-card rounded-[2rem] p-6 sm:p-7">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 text-xl font-black text-indigo-700">04</div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-900">Ambil Barang</h3>
                        <p class="mt-3 text-base leading-7 text-slate-600">Barang dapat diambil dengan proses cepat dan pengembalian akan otomatis tercatat di sistem.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="relative pb-24">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.28em] text-indigo-600">FAQ</p>
                    <h2 class="mt-4 text-3xl font-black tracking-[-0.05em] text-slate-900 sm:text-5xl">Pertanyaan yang sering ditanya</h2>
                </div>

                <div class="space-y-4">
                    <details class="rounded-[1.5rem] border border-slate-200 bg-white/30 p-5 shadow-[0_14px_26px_rgba(15,23,42,0.05)]" open>
                        <summary class="cursor-pointer list-none text-lg font-semibold text-slate-900">Apakah peminjaman bisa dilakukan dari ponsel?</summary>
                        <p class="mt-3 text-slate-600">Ya. Sistem dibuat responsif agar siswa bisa mengajukan dan memantau peminjaman dari perangkat apa pun, termasuk ponsel.</p>
                    </details>

                    <details class="rounded-[1.5rem] border border-slate-200 bg-white/30 p-5 shadow-[0_14px_26px_rgba(15,23,42,0.05)]">
                        <summary class="cursor-pointer list-none text-lg font-semibold text-slate-900">Bagaimana jika barang sedang dipinjam?</summary>
                        <p class="mt-3 text-slate-600">Sistem menampilkan status stok secara real-time dan akan menolak pengajuan bila barang saat itu sudah tidak tersedia.</p>
                    </details>

                    <details class="rounded-[1.5rem] border border-slate-200 bg-white/30 p-5 shadow-[0_14px_26px_rgba(15,23,42,0.05)]">
                        <summary class="cursor-pointer list-none text-lg font-semibold text-slate-900">Apakah ada pengingat pengembalian?</summary>
                        <p class="mt-3 text-slate-600">Tersedia notifikasi pengingat otomatis untuk membantu siswa mengembalikan barang tepat waktu dan menjaga kelancaran operasional sekolah.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200/80 bg-white/55 backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-8 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-sipinjam.jpg') }}" alt="" class="h-10 w-12 shrink-0 rounded-xl bg-white object-contain p-0.5 sm:w-24" />
                <div>
                    <div class="text-sm font-black text-slate-900">Peminjaman Barang</div>
                    <div class="text-[10px] uppercase tracking-[0.24em] text-slate-500">Sekolah</div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-5 text-sm text-slate-600">
                <a href="#fitur" class="hover:text-indigo-600">Fitur</a>
                <a href="#katalog" class="hover:text-indigo-600">Katalog</a>
                <a href="#cara-pinjam" class="hover:text-indigo-600">Cara Pinjam</a>
                <a href="#faq" class="hover:text-indigo-600">FAQ</a>
            </div>

            <div class="text-sm text-slate-600">
                <p>&copy; {{ date('Y') }} Peminjaman Barang Sekolah</p>
                <p class="mt-1">Kontak Sarpras: sarpras@sekolah.sch.id</p>
            </div>
        </div>
    </footer>

    <script>
        const itemCatalog = @json($featuredItems ?? []);
        const searchInput = document.getElementById('landing-search');
        const form = document.getElementById('landing-search-form');
        const resultsBox = document.getElementById('search-results');
        const ambientOrbs = document.querySelectorAll('.ambient-orb');
        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const finePointer = window.matchMedia('(pointer: fine)');

        if (!reducedMotion.matches && finePointer.matches && ambientOrbs.length) {
            let pointerFrame = null;

            window.addEventListener('pointermove', (event) => {
                if (reducedMotion.matches) {
                    return;
                }

                if (pointerFrame !== null) {
                    return;
                }

                pointerFrame = window.requestAnimationFrame(() => {
                    const offsetX = ((event.clientX / window.innerWidth) - 0.5) * 12;
                    const offsetY = ((event.clientY / window.innerHeight) - 0.5) * 12;

                    ambientOrbs.forEach((orb, index) => {
                        const direction = index === 1 ? -1 : 1;
                        orb.style.setProperty('--pointer-x', `${offsetX * direction}px`);
                        orb.style.setProperty('--pointer-y', `${offsetY * direction}px`);
                    });

                    pointerFrame = null;
                });
            }, { passive: true });

            window.addEventListener('pointerleave', () => {
                if (pointerFrame !== null) {
                    window.cancelAnimationFrame(pointerFrame);
                    pointerFrame = null;
                }

                ambientOrbs.forEach((orb) => {
                    orb.style.removeProperty('--pointer-x');
                    orb.style.removeProperty('--pointer-y');
                });
            }, { passive: true });

            reducedMotion.addEventListener('change', (event) => {
                if (!event.matches) {
                    return;
                }

                if (pointerFrame !== null) {
                    window.cancelAnimationFrame(pointerFrame);
                    pointerFrame = null;
                }

                ambientOrbs.forEach((orb) => {
                    orb.style.removeProperty('--pointer-x');
                    orb.style.removeProperty('--pointer-y');
                });
            });
        }

        function renderItems(query = '') {
            const searchQuery = query.trim().toLowerCase();
            const filtered = itemCatalog.filter(item => item.nama.toLowerCase().includes(searchQuery));

            if (!searchQuery) {
                resultsBox.classList.add('hidden');
                return;
            }

            if (!filtered.length) {
                resultsBox.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-700 bg-slate-900/40 p-4 text-sm text-slate-300">Barang yang Anda cari belum tersedia.</div>';
                resultsBox.classList.remove('hidden');
                return;
            }

            resultsBox.innerHTML = filtered.slice(0, 4).map((item) => {
                const isAvailable = item.status === 'Tersedia';
                const wrapper = isAvailable
                    ? `<a href="${item.route}" class="search-result flex w-full items-center justify-between gap-3 rounded-2xl px-3 py-2 text-left text-white">`
                    : '<div class="search-result flex w-full items-center justify-between gap-3 rounded-2xl px-3 py-2 text-left text-white" aria-disabled="true">';
                const closingTag = isAvailable ? '</a>' : '</div>';

                return `
                ${wrapper}
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-indigo-200">
                            <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="m12 3 8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                <path d="m4.5 7.8 7.5 4.4 7.5-4.4M12 12.2V21" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div>
                            <div class="text-sm font-semibold">${item.nama}</div>
                            <div class="text-xs text-slate-300">${item.kategori} &middot; ${item.stok} unit</div>
                        </div>
                    </div>
                    <span class="status-pill ${isAvailable ? 'status-available' : 'status-borrowed'}">${item.status}</span>
                ${closingTag}
            `;
            }).join('');

            resultsBox.classList.remove('hidden');
        }

        searchInput.addEventListener('input', (event) => {
            renderItems(event.target.value);
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const value = searchInput.value.trim();

            if (!value) {
                return;
            }

            window.location.href = '{{ route('barang.index') }}?search=' + encodeURIComponent(value);
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('#landing-search') && !event.target.closest('#search-results')) {
                resultsBox.classList.add('hidden');
            }
        });
    </script>
</body>
</html>