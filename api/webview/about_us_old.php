<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - MEEM Gold</title>
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
            --text: #1f1f1f;
            --muted: #6d6d6d;
            --bg: #f8f6f1;
            --white: #ffffff;
            --line: #ece7dc;
            --shadow: 0 10px 30px rgba(0,0,0,0.08);
            --radius: 18px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.65;
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            text-decoration: none;
        }

        .about-page {
            width: 100%;
            overflow: hidden;
        }

        .container {
            width: min(100% - 32px, 1100px);
            margin: 0 auto;
        }

        .section {
            padding: 28px 0;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px;
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

        h1, h2, h3, h4 {
            line-height: 1.25;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 14px;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 10px;
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

        .hero .lead {
            font-size: 16px;
            margin-top: 12px;
            margin-bottom: 10px;
        }

        .hero .sublead {
            font-size: 15px;
            max-width: 700px;
        }

        .story-grid,
        .feature-grid,
        .advisor-grid,
        .reseller-grid {
            display: grid;
            gap: 18px;
        }

        .image-placeholder {
            min-height: 220px;
            border-radius: 18px;
            background: linear-gradient(135deg, #d8b36a, #8b6a25);
            position: relative;
            overflow: hidden;
        }

        .image-placeholder::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                    radial-gradient(circle at top right, rgba(255,255,255,0.35), transparent 30%),
                    radial-gradient(circle at bottom left, rgba(255,255,255,0.18), transparent 35%);
        }

        .image-placeholder .label {
            position: absolute;
            left: 18px;
            bottom: 18px;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            z-index: 2;
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-box {
            text-align: center;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 22px 18px;
            background: #fff;
        }

        .stat-number {
            font-size: 34px;
            font-weight: 800;
            color: var(--gold-dark);
            line-height: 1;
            margin-bottom: 10px;
        }

        .stat-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }

        .cta-box {
            background: linear-gradient(135deg, #fff, #f8f1df);
            border: 1px solid #eddcb4;
        }

        .btn {
            display: inline-block;
            margin-top: 16px;
            background: var(--gold-dark);
            color: #fff;
            padding: 12px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .btn:hover {
            background: var(--gold);
        }

        .advisor-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
        }

        .advisor-badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: #f5ead1;
            color: var(--gold-dark);
            font-size: 13px;
            font-weight: 700;
            margin-top: 10px;
        }

        .logos-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .logo-box {
            height: 80px;
            border-radius: 14px;
            background: #fff;
            border: 1px dashed #d8c9aa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8f7b53;
            font-size: 13px;
            text-align: center;
            padding: 10px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-top: 8px;
        }

        .team-card {
            background: var(--white);
            border-radius: 18px;
            padding: 18px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            text-align: center;
        }

        .team-avatar {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d6b05d, #9c7728);
            margin: 0 auto 14px;
            position: relative;
            overflow: hidden;
        }

        .team-avatar::before {
            content: "";
            position: absolute;
            inset: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.22);
        }

        .team-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .team-role {
            color: var(--muted);
            font-size: 14px;
        }

        .contact-box {
            background: #fff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: var(--shadow);
        }

        .contact-list {
            margin-top: 14px;
            display: grid;
            gap: 10px;
        }

        .contact-item {
            color: var(--muted);
            font-size: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        .contact-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(24px);
        }

        @media (min-width: 768px) {
            .section {
                padding: 44px 0;
            }

            .hero-box {
                padding: 42px;
            }

            h1 {
                font-size: 44px;
            }

            h2 {
                font-size: 32px;
            }

            .story-grid,
            .advisor-grid,
            .reseller-grid {
                grid-template-columns: 1.15fr 0.85fr;
                align-items: center;
            }

            .stats {
                grid-template-columns: repeat(3, 1fr);
            }

            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .logos-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .team-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .hero .sublead {
                font-size: 16px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<main class="about-page">

    <section class="hero">
        <div class="container">
            <div class="hero-box fade-up">
                <span class="eyebrow">About Us</span>
                <h1>Welcome to <span>MEEM Gold®</span></h1>
                <p class="lead"><strong>A wide range of physical gold products</strong> made available for customers.</p>
                <p class="sublead">
                    We continuously focuses to provide the best service to customers by offering variety of jewellery items,
                    also gemstones and other jewellery services.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="story-grid">
                <div class="card fade-up">
                    <span class="eyebrow">Our Story</span>
                    <h2>Trusted, ethical and Shariah-compliant gold solutions</h2>
                    <p>
                        MEEM Gold stands out in the gold trading industry for its steadfast adherence to Islamic finance
                        principles. We have established in 2021 with shariah-compliant (Elzar Shariah Solutions & Advisory)
                        online saving platform that changes the way you buy, save, sell and redeem in physical gold.
                        We are specialise in custom gold bars & jewellery, offering great value, amazing product variety
                        and professional friendly service.
                    </p>
                    <br>
                    <p>
                        Through rigorous compliance with Shariah law, the company ensures its gold products are ethically sourced,
                        meticulously verified for purity, and free from prohibited financial practices such as interest-based
                        transactions. MEEM Gold's dedication extends beyond compliance, as its knowledgeable team provides guidance
                        to customers, emphasizing trust, integrity, and satisfaction in every transaction.
                    </p>
                    <br>
                    <p>
                        With a focus on transparency and customer satisfaction, MEEM Gold has established itself as a reputable
                        provider of gold. Offering a range of gold products, including bars, coins, and jewelry, the company
                        caters to diverse investment needs while aligning with Islamic principles. MEEM Gold's commitment to ethical
                        sourcing and stringent verification processes sets a benchmark in the industry, making it a trusted choice
                        for those seeking halal gold saving.
                    </p>
                </div>

                <div class="image-placeholder fade-up">
                    <div class="label">MEEM Gold Story</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="stats">
                <div class="stat-box fade-up">
                    <div class="stat-number" data-target="505">0</div>
                    <div class="stat-title">Products For Sale</div>
                    <p>Beautifully crafted limited edition collections</p>
                </div>

                <div class="stat-box fade-up">
                    <div class="stat-number" data-target="120">0</div>
                    <div class="stat-title">120K+ Fulfilled Orders</div>
                    <p>We have successfully fullfilled wide variation of orders to happy customers</p>
                </div>

                <div class="stat-box fade-up">
                    <div class="stat-number" data-target="57">0</div>
                    <div class="stat-title">57K+ Growing Customers</div>
                    <p>Join us now and start collecting your favourite collections</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card cta-box fade-up">
                <span class="eyebrow">Collections</span>
                <h2>Beautifully crafted limited edition collections of gold bars & jewellery</h2>
                <p>
                    Everyone deserves to shine. Meem Gold & Jewellery’s extensive collection of jewellery pieces in Malaysia,
                    meaningfully conceptualized and beautifully crafted from gold and more, at reasonable prices. Get your hands
                    on our popular and well-loved designs. From necklaces to rings, you can find the perfect piece for every occasion.
                </p>
                <a class="btn" href="https://meem.com.my/" target="_blank">Visit Our Store</a>
            </div>
        </div>
    </section>


    <section class="section">
        <div class="container">
            <div class="card fade-up">
                <span class="eyebrow">Affiliations & Collaborators</span>
                <h2>Our network and collaborations</h2>
                <p>
                    The original page displays multiple partner and collaborator logos. You can replace the placeholders below
                    with actual logos if you want to match the source site visually.
                </p>

                <div class="logos-grid">
                    <div class="logo-box">Partner Logo 1</div>
                    <div class="logo-box">Partner Logo 2</div>
                    <div class="logo-box">Partner Logo 3</div>
                    <div class="logo-box">Partner Logo 4</div>
                    <div class="logo-box">Partner Logo 5</div>
                    <div class="logo-box">Partner Logo 6</div>
                    <div class="logo-box">Partner Logo 7</div>
                    <div class="logo-box">Partner Logo 8</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card fade-up">
                <span class="eyebrow">Meet Our Team</span>
                <h2>The people behind MEEM Gold</h2>
                <p>
                    We're lead by a team who constantly questions, tinkers, and challenges to unlock great creativity around every turn.
                </p>

                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Mohd Nazri Muid</div>
                        <div class="team-role">Executive Director</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Amran Bachok</div>
                        <div class="team-role">Chief Executive Officer</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Muhamad Zhafri Hilmi</div>
                        <div class="team-role">Operation Lead</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Auni Nafisa Rashidi</div>
                        <div class="team-role">Marketing Lead</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Puteri Nur Fariesha</div>
                        <div class="team-role">Administration Lead</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Afiq Farhan Borhan</div>
                        <div class="team-role">Creative Designer</div>
                    </div>

                    <div class="team-card">
                        <div class="team-avatar"></div>
                        <div class="team-name">Italiana Talha</div>
                        <div class="team-role">Business Operation</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

</main>

<script>
    $(document).ready(function () {
        function animateCounter($el, target, suffix = "") {
            $({ countNum: 0 }).animate(
                { countNum: target },
                {
                    duration: 1600,
                    easing: "swing",
                    step: function () {
                        $el.text(Math.floor(this.countNum) + suffix);
                    },
                    complete: function () {
                        $el.text(target + suffix);
                    }
                }
            );
        }

        function revealOnScroll() {
            $(".fade-up").each(function () {
                const top = $(this).offset().top;
                const winBottom = $(window).scrollTop() + $(window).height() - 40;

                if (winBottom > top) {
                    $(this).animate(
                        { opacity: 1, top: 0 },
                        {
                            duration: 700,
                            step: function () {},
                            progress: () => {
                                $(this).css("transform", "translateY(0)");
                            }
                        }
                    );
                }
            });
        }

        let counterStarted = false;

        function startCountersIfVisible() {
            const statsTop = $(".stats").offset().top;
            const triggerPoint = $(window).scrollTop() + $(window).height();

            if (!counterStarted && triggerPoint > statsTop) {
                counterStarted = true;

                $(".stat-number").each(function () {
                    const target = parseInt($(this).data("target"), 10);

                    if (target === 120 || target === 57) {
                        animateCounter($(this), target, "K+");
                    } else {
                        animateCounter($(this), target, "");
                    }
                });
            }
        }

        $(".fade-up").css({
            opacity: 0,
            transform: "translateY(24px)",
            position: "relative"
        });

        revealOnScroll();
        startCountersIfVisible();

        $(window).on("scroll", function () {
            revealOnScroll();
            startCountersIfVisible();
        });
    });
</script>
</body>
</html>
