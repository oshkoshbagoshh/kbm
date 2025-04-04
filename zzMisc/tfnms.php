<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Three First Names & Associates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar is-transparent">
        <div class="navbar-brand">
            <a class="navbar-item" href="#hero">Three First Names & Associates</a>
            <div class="navbar-burger" data-target="navbarMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="#hero">Home</a>
                <a class="navbar-item" href="#about">About</a>
                <a class="navbar-item" href="#services">Services</a>
                <a class="navbar-item" href="#testimonials">Testimonials</a>
                <a class="navbar-item" href="#contact">Contact</a>
                <a class="navbar-item" href="#blog">Blog</a>
            </div>
        </div>
    </nav>

    <section id="hero" class="hero has-text-centered">
        <h1 class="title">Strike Gold with CTV Advertising</h1>
        <h2 class="subtitle">Empowering brands to thrive in the streaming landscape.</h2>
    </section>

    <section id="about" class="section">
        <div class="container">
            <h2 class="title">About Us</h2>
            <?php
                $aboutContent = [
                    "At Three First Names & Associates, we bring a unique and forward-thinking approach to Connected TV, blending deep expertise in TV advertising with a creative passion for the music industry. Founded by Nathan Michael Scott, our consulting firm leverages nearly a decade of experience in media and advertising to guide brands and agencies through the transition from traditional TV to streaming.",
                    "With an extensive background encompassing every facet of video advertising (Broadcast, Cable, Syndication, Addressable, OTT/CTV, Online Video, and Social), Nathan is uniquely positioned to help companies successfully navigate the fragmented TV landscape with experience partnering across brands in every major industry vertical.",
                    "Our diverse team is a blend of industry and technical expertise, including software engineers, data compliance officers, and independent musicians, with the goal of speeding up the adoption of streaming and ultimately enhancing the CTV ad experience for viewers.",
                ];
                foreach ($aboutContent as $paragraph) {
                    echo "<p>$paragraph</p>";
                }
            ?>
        </div>
    </section>

    <section id="services" class="section">
        <div class="container">
            <h2 class="title">Our Services</h2>
            <?php
                $services = ["CTV Strategy Consulting", "Media Planning & Buying", "Creative Campaign Development", "Performance Analytics"];
                echo "<ul>";
                foreach ($services as $service) {
                    echo "<li>$service</li>";
                }
                echo "</ul>";
            ?>
        </div>
    </section>

    <section id="testimonials" class="section">
        <div class="container">
            <h2 class="title">Testimonials</h2>
            <?php
                $testimonials = [
                    ["name" => "John Doe", "text" => "Three First Names & Associates helped us double our CTV ad performance!"],
                    ["name" => "Jane Smith", "text" => "Their expertise in streaming advertising is unmatched."],
                    ["name" => "Mike Johnson", "text" => "Highly recommend their services for any brand looking to scale."],
                ];
                foreach ($testimonials as $testimonial) {
                    echo "<blockquote>{$testimonial['text']} - <cite>{$testimonial['name']}</cite></blockquote>";
                }
            ?>
        </div>
    </section>

    <section id="contact" class="section">
        <div class="container">
            <h2 class="title">Contact Us</h2>
            <form id="contactForm" method="POST" action="submit_form.php">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" type="text" name="name" placeholder="Your Name" required />
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="Your Email" required />
                    </div>
                </div>
                <div class="field">
                    <label class="label">Message</label>
                    <div class="control">
                        <textarea class="textarea" name="message" placeholder="Your Message" required></textarea>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-primary" type="submit">Send</button>
                </div>
            </form>
        </div>
    </section>

    <section id="blog" class="section">
        <div class="container">
            <h2 class="title">Latest Posts</h2>
            <?php
                $blogPosts = [
                    ["title" => "The Future of CTV Advertising", "date" => "2025-03-01", "excerpt" => "Explore the latest trends in CTV advertising and how brands can capitalize on them."],
                    ["title" => "Streaming vs Traditional TV", "date" => "2025-02-15", "excerpt" => "A deep dive into the differences between streaming and traditional TV advertising."],
                    ["title" => "Maximizing ROI with CTV", "date" => "2025-02-01", "excerpt" => "Learn how to maximize your return on investment with CTV campaigns."],
                ];
                foreach ($blogPosts as $post) {
                    echo "<article>";
                    echo "<h3>{$post['title']}</h3>";
                    echo "<p><small>{$post['date']}</small></p>";
                    echo "<p>{$post['excerpt']}</p>";
                    echo "</article>";
                }
            ?>
        </div>
    </section>

    <footer class="footer">
        <div class="container has-text-centered">
            <a href="/privacy-policy" class="text-primary">Privacy Policy</a> |
            <a href="/faq" class="text-primary">FAQ</a> |
            <a href="/partnerships" class="text-primary">Partnerships</a> |
            <a href="https://linkedin.com" class="text-primary">LinkedIn</a>
            <p class="mb-0">&copy;                                   <?php echo date('Y'); ?> Three First Names & Associates. All rights reserved.</p>
        </div>
    </footer>

    <button class="scroll-top" id="scrollTopBtn">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
    $(document).ready(function() {
        // Smooth scrolling
        $('.navbar-item').on('click', function(event) {
            event.preventDefault();
            const target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top,
            }, 800);
        });

        // Highlight active section
        $(window).on('scroll', function() {
            let scrollPos = $(document).scrollTop();
            $('.navbar-item').each(function() {
                let currLink = $(this);
                let refElement = $(currLink.attr('href'));
                if (refElement.position().top <= scrollPos && refElement.position().top +
                    refElement.height() > scrollPos) {
                    $('.navbar-item').removeClass('active');
                    currLink.addClass('active');
                } else {
                    currLink.removeClass('active');
                }
            });

            // Show scroll to top button
            if (scrollPos > 100) {
                $('#scrollTopBtn').fadeIn();
            } else {
                $('#scrollTopBtn').fadeOut();
            }
        });

        // Scroll to top
        $('#scrollTopBtn').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        });
    });
    </script>
</body>

</html>