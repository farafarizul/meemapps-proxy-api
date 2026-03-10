<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - MEEM Gold</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #c59a3d;
            --gold-dark: #9b7524;
            --gold-soft: #f5ead1;
            --text: #1f1f1f;
            --muted: #6d6d6d;
            --bg: #f8f6f1;
            --white: #ffffff;
            --line: #ece7dc;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --radius: 20px;
            --success: #25D366;
            --success-dark: #1ea952;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.65;
        }

        img {
            width: 100%;
            display: block;
        }

        a {
            text-decoration: none;
        }

        .page {
            width: 100%;
            overflow: hidden;
        }

        .container {
            width: min(100% - 32px, 1120px);
            margin: 0 auto;
        }

        .section {
            padding: 24px 0;
        }

        .eyebrow {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 12px;
        }

        h1, h2, h3 {
            line-height: 1.25;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 12px;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        p {
            color: var(--muted);
            font-size: 15px;
        }

        .hero {
            padding: 28px 0 18px;
        }

        .hero-box {
            background: linear-gradient(135deg, #fff7e8, #ffffff);
            border-radius: 24px;
            padding: 28px 22px;
            box-shadow: var(--shadow);
            border: 1px solid #f2e5c8;
        }

        .hero h1 span {
            color: var(--gold-dark);
        }

        .lead {
            font-size: 16px;
            margin-top: 10px;
        }

        .toolbar {
            display: grid;
            gap: 14px;
            margin-top: 18px;
        }

        .search-box,
        .filter-box {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 12px 14px;
            box-shadow: var(--shadow);
        }

        .search-box input,
        .filter-box select {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            font-size: 15px;
            color: var(--text);
        }

        .featured-card,
        .branch-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .featured-grid {
            display: grid;
            gap: 18px;
        }

        .featured-image,
        .branch-image {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #d8b36a, #8b6a25);
        }

        .featured-image {
            min-height: 260px;
        }

        .branch-image {
            min-height: 200px;
        }

        .featured-image::before,
        .branch-image::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                    radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                    radial-gradient(circle at bottom left, rgba(255,255,255,0.10), transparent 35%);
            pointer-events: none;
            z-index: 1;
        }

        .featured-image img,
        .branch-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 22px;
        }

        .top-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: var(--gold-soft);
            color: var(--gold-dark);
            font-size: 12px;
            font-weight: 700;
        }

        .state-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #faf7ef;
            color: #6f5a28;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #ead9ae;
        }

        .contact-list {
            display: grid;
            gap: 12px;
            margin-top: 14px;
        }

        .contact-item {
            padding-bottom: 12px;
            border-bottom: 1px solid var(--line);
        }

        .contact-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .contact-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .contact-value {
            color: var(--muted);
            font-size: 15px;
            word-break: break-word;
        }

        .contact-value a {
            color: var(--gold-dark);
            font-weight: 600;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
            border: 0;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--gold-dark);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--gold);
        }

        .btn-secondary {
            background: var(--gold-soft);
            color: var(--gold-dark);
        }

        .btn-secondary:hover {
            background: #eddcb4;
        }

        .btn-whatsapp {
            background: var(--success);
            color: #fff;
        }

        .btn-whatsapp:hover {
            background: var(--success-dark);
        }

        .section-head {
            margin-bottom: 18px;
        }

        .branch-listing {
            display: grid;
            gap: 18px;
        }

        .branch-card {
            display: grid;
            gap: 0;
        }

        .branch-name-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 6px;
        }

        .branch-sub {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .empty-state {
            display: none;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
            text-align: center;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            position: relative;
        }

        .hidden-card {
            display: none !important;
        }

        @media (min-width: 768px) {
            .section {
                padding: 40px 0;
            }

            .hero-box {
                padding: 42px;
            }

            h1 {
                font-size: 42px;
            }

            h2 {
                font-size: 30px;
            }

            .toolbar {
                grid-template-columns: 1.2fr 0.8fr;
            }

            .featured-grid {
                grid-template-columns: 1.08fr 0.92fr;
                align-items: stretch;
            }

            .branch-card {
                grid-template-columns: 320px 1fr;
            }

            .branch-image {
                min-height: 100%;
            }
        }

        @media (min-width: 1024px) {
            .branch-listing {
                gap: 22px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<main class="page">

    <section class="hero">
        <div class="container">
            <div class="hero-box fade-up">
                <span class="eyebrow">Contact Us</span>
                <h1>Visit <span>MEEM Gold</span> Near You</h1>
                <p class="lead">
                    Find our headquarters and branches across Malaysia. Search by name, city, or address, and filter branches by state.
                </p>

                <div class="toolbar">
                    <div class="search-box">
                        <input type="text" id="branchSearch" placeholder="Search branch, city or address..." />
                    </div>
                    <div class="filter-box">
                        <select id="stateFilter">
                            <option value="all">All States</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Johor">Johor</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="featured-card fade-up branch-item" data-state="Selangor" data-search="meem gold hq shah alam selangor pusat perdagangan worldwide seksyen 13 hq headquarters">
                <div class="featured-grid">
                    <div class="featured-image">
                        <img src="./assets/featured_meem_gold_hq-800x500.png" alt="MEEM Gold HQ">
                    </div>

                    <div class="card-content">
                        <div class="top-meta">
                            <span class="badge">Headquarters</span>
                            <span class="state-badge">Selangor</span>
                        </div>

                        <h2>MEEM Gold HQ</h2>
                        <p>
                            Our main headquarters is the primary contact point for MEEM Gold. You can reach the HQ directly for enquiries, support, and store visits.
                        </p>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value">
                                    <a href="tel:0355231231">03-5523 1231</a>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">
                                    2-11-2 Presint Alami, Pusat Perdagangan Worldwide 2, Seksyen 13, 40100 Shah Alam, Selangor.
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value">
                                    <a href="https://maps.app.goo.gl/M9ewA4ksZ6RvVJ2T9" target="_blank">Open location in Google Maps</a>
                                </div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:0355231231">Call HQ</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/60355231231" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/M9ewA4ksZ6RvVJ2T9" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head fade-up">
                <span class="eyebrow">Branch Listing</span>
                <h2>Our Branches</h2>
                <p>Explore our branches and get in touch with the MEEM Gold location nearest to you.</p>
            </div>

            <div class="branch-listing" id="branchListing">

                <div class="branch-card fade-up branch-item" data-state="Kedah" data-search="meem gold jitra kedah jalan pj 2/2 pekan jitra 2 06000 jitra">
                    <div class="branch-image">
                        <img src="./assets/featured_meem_gold_jitra-800x500.png" alt="MEEM Gold Jitra">
                    </div>
                    <div class="card-content">
                        <div class="branch-name-row">
                            <div>
                                <div class="top-meta">
                                    <span class="badge">Branch</span>
                                    <span class="state-badge">Kedah</span>
                                </div>
                                <h3>MEEM Gold Jitra</h3>
                                <div class="branch-sub">Jitra, Kedah</div>
                            </div>
                        </div>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value"><a href="tel:049172347">04-917 2347</a></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">260, Jalan PJ 2/2, Pekan Jitra 2, 06000 Jitra, Kedah</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value"><a href="https://maps.app.goo.gl/nYAxuPs8uFAjGMrD7" target="_blank">Open location in Google Maps</a></div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:049172347">Call Branch</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/6049172347" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/nYAxuPs8uFAjGMrD7" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>

                <div class="branch-card fade-up branch-item" data-state="Kedah" data-search="meem gold alor setar kedah jalan shahab 4 shahab perdana 05150 alor setar">
                    <div class="branch-image">
                        <img src="./assets/featured_meem_gold_alor_setar-800x500.png" alt="MEEM Gold Alor Setar">
                    </div>
                    <div class="card-content">
                        <div class="branch-name-row">
                            <div>
                                <div class="top-meta">
                                    <span class="badge">Branch</span>
                                    <span class="state-badge">Kedah</span>
                                </div>
                                <h3>MEEM Gold Alor Setar</h3>
                                <div class="branch-sub">Alor Setar, Kedah</div>
                            </div>
                        </div>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value"><a href="tel:047364291">04-736 4291</a></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">216, Jalan Shahab 4, Shahab Perdana, 05150 Alor Setar, Kedah</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value"><a href="https://maps.app.goo.gl/7JhwJtLtUAJcKGiE9" target="_blank">Open location in Google Maps</a></div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:047364291">Call Branch</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/6047364291" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/7JhwJtLtUAJcKGiE9" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>

                <div class="branch-card fade-up branch-item" data-state="Pulau Pinang" data-search="meem gold bertam pulau pinang kepala batas jalan dagangan 13 pusat bandar bertam perdana 13200">
                    <div class="branch-image">
                        <img src="./assets/featured_meem_gold_bertam-800x500.png" alt="MEEM Gold Bertam">
                    </div>
                    <div class="card-content">
                        <div class="branch-name-row">
                            <div>
                                <div class="top-meta">
                                    <span class="badge">Branch</span>
                                    <span class="state-badge">Pulau Pinang</span>
                                </div>
                                <h3>MEEM Gold Bertam</h3>
                                <div class="branch-sub">Kepala Batas, Pulau Pinang</div>
                            </div>
                        </div>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value"><a href="tel:045212311">04-521 2311</a></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">15, Jalan Dagangan 13, Pusat Bandar Bertam Perdana, 13200 Kepala Batas, Pulau Pinang</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value"><a href="https://maps.app.goo.gl/HuN5JpJ7CEeyW1xD8" target="_blank">Open location in Google Maps</a></div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:045212311">Call Branch</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/6045212311" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/HuN5JpJ7CEeyW1xD8" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>

                <div class="branch-card fade-up branch-item" data-state="Selangor" data-search="meem gold bangi selangor bandar baru bangi jalan 9/2 seksyen 9 43650">
                    <div class="branch-image">
                        <img src="./assets/featured_meem_gold_bangi-800x500.png" alt="MEEM Gold Bangi">
                    </div>
                    <div class="card-content">
                        <div class="branch-name-row">
                            <div>
                                <div class="top-meta">
                                    <span class="badge">Branch</span>
                                    <span class="state-badge">Selangor</span>
                                </div>
                                <h3>MEEM Gold Bangi</h3>
                                <div class="branch-sub">Bandar Baru Bangi, Selangor</div>
                            </div>
                        </div>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value"><a href="tel:0389289596">03-8928 9596</a></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">5A (1st Floor), Jalan 9/2, Seksyen 9, 43650 Bandar Baru Bangi, Selangor</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value"><a href="https://maps.app.goo.gl/oSixWiFQEP3YsHHeA" target="_blank">Open location in Google Maps</a></div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:0389289596">Call Branch</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/60389289596" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/oSixWiFQEP3YsHHeA" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>

                <div class="branch-card fade-up branch-item" data-state="Johor" data-search="meem gold johor johor bahru bandar dato onn jln perjiranan 4/5 81100 johor darul tazim">
                    <div class="branch-image">
                        <img src="./assets/featured_meem_gold_johor-800x500.png" alt="MEEM Gold Johor">
                    </div>
                    <div class="card-content">
                        <div class="branch-name-row">
                            <div>
                                <div class="top-meta">
                                    <span class="badge">Branch</span>
                                    <span class="state-badge">Johor</span>
                                </div>
                                <h3>MEEM Gold Johor</h3>
                                <div class="branch-sub">Johor Bahru, Johor</div>
                            </div>
                        </div>

                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value"><a href="tel:073646534">07-364 6534</a></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Address</div>
                                <div class="contact-value">35, Jln Perjiranan 4/5, Bandar Dato Onn, 81100 Johor Bahru, Johor Darul Ta'zim</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Google Maps</div>
                                <div class="contact-value"><a href="https://maps.app.goo.gl/KRCgQpKVrU1naCpJ9" target="_blank">Open location in Google Maps</a></div>
                            </div>
                        </div>

                        <div class="button-group">
                            <a class="btn btn-primary" href="tel:073646534">Call Branch</a>
                            <a class="btn btn-whatsapp" href="https://wa.me/6073646534" target="_blank">WhatsApp</a>
                            <a class="btn btn-secondary" href="https://maps.app.goo.gl/KRCgQpKVrU1naCpJ9" target="_blank">Open Map</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="empty-state" id="emptyState">
                <h3>No branch found</h3>
                <p>Try a different branch name, city, or state filter.</p>
            </div>
        </div>
    </section>

</main>

<script>
    $(document).ready(function () {
        function revealOnScroll() {
            $(".fade-up").each(function () {
                const top = $(this).offset().top;
                const winBottom = $(window).scrollTop() + $(window).height() - 40;

                if (winBottom > top) {
                    $(this).stop().animate(
                        { opacity: 1 },
                        {
                            duration: 600,
                            progress: () => {
                                $(this).css("transform", "translateY(0)");
                            }
                        }
                    );
                }
            });
        }

        function filterBranches() {
            const keyword = $("#branchSearch").val().toLowerCase().trim();
            const state = $("#stateFilter").val();
            let visibleCount = 0;

            $(".branch-item").each(function () {
                const searchText = ($(this).data("search") || "").toString().toLowerCase();
                const itemState = ($(this).data("state") || "").toString();
                const matchesKeyword = keyword === "" || searchText.indexOf(keyword) !== -1;
                const matchesState = state === "all" || itemState === state;

                if (matchesKeyword && matchesState) {
                    $(this).removeClass("hidden-card");
                    visibleCount++;
                } else {
                    $(this).addClass("hidden-card");
                }
            });

            if (visibleCount === 0) {
                $("#emptyState").stop(true, true).fadeIn(200);
            } else {
                $("#emptyState").hide();
            }
        }

        $(".fade-up").css({
            opacity: 0,
            transform: "translateY(24px)",
            position: "relative"
        });

        revealOnScroll();

        $(window).on("scroll", function () {
            revealOnScroll();
        });

        $("#branchSearch").on("keyup", function () {
            filterBranches();
        });

        $("#stateFilter").on("change", function () {
            filterBranches();
        });
    });
</script>
</body>
</html>