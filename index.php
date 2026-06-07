<?php
$page_title = 'Home | Monovue';
include 'config.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
<!-- Hero Section -->
<section class="hero" data-aos="fade-in">
    <div class="hero-content">
        <h1 class="hero-title">
            <span class="typed-text"></span>
            <span class="cursor">&nbsp;</span>
        </h1>
        <p class="hero-subtitle">Capturing life's most precious moments with artistry and passion</p>
        <div class="hero-buttons">
            <a href="gallery.php" class="btn btn-primary">View Gallery</a>
            <a href="contact.php" class="btn btn-secondary">Book a Session</a>
        </div>
    </div>
    
    <!-- Dynamic light/shadow sweep effect -->
    <div class="hero-sweep"></div>
    
    <!-- Decorative floating elements -->
    <div class="hero-decoration">
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>
    </div>

    <!-- Scroll indicator -->
    <div class="hero-scroll-indicator" onclick="document.getElementById('featured').scrollIntoView({behavior: 'smooth'})">
        <span>SCROLL</span>
        <div class="scroll-mouse"></div>
    </div>
</section>

<!-- Featured Work -->
<section class="featured" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h2>Featured Work</h2>
            <p>Some of our favorite captures</p>
        </div>
        <div class="featured-grid">
            <?php
            $images = getAllImages();
            $featured = array_slice($images, 0, 3);
            foreach($featured as $image):
            ?>
            <div class="featured-card" data-aos="zoom-in">
                <div class="featured-image">
                    <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                    <div class="featured-overlay">
                        <span class="featured-category"><?php echo ucfirst($image['category']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="featured" class="featured" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h2>Our Services</h2>
            <p>What we offer</p>
        </div>
        <div class="services-grid">
            <div class="service-card" data-aos="flip-left">
                <i class="fas fa-camera"></i>
                <h3>Wedding Photography</h3>
                <p>Capturing your special day with timeless elegance</p>
            </div>
            <div class="service-card" data-aos="flip-left" data-aos-delay="100">
                <i class="fas fa-user-friends"></i>
                <h3>Portrait Sessions</h3>
                <p>Professional portraits for any occasion</p>
            </div>
            <div class="service-card" data-aos="flip-left" data-aos-delay="200">
                <i class="fas fa-calendar-alt"></i>
                <h3>Event Coverage</h3>
                <p>Corporate events, parties, and gatherings</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta" data-aos="zoom-in">
    <div class="container">
        <h2>Ready to Capture Your Memories?</h2>
        <p>Let's create something beautiful together</p>
        <a href="contact.php" class="btn btn-primary">Get in Touch</a>
    </div>
</section>

<script>
// Typing animation for hero text
const typedTextSpan = document.querySelector(".typed-text");
const textArray = ["Capturing Moments", "Creating Memories", "Telling Stories"];
const typingDelay = 100;
const erasingDelay = 50;
const newTextDelay = 2000;
let textArrayIndex = 0;
let charIndex = 0;

function type() {
    if (charIndex < textArray[textArrayIndex].length) {
        typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    } else {
        setTimeout(erase, newTextDelay);
    }
}

function erase() {
    if (charIndex > 0) {
        typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(erase, erasingDelay);
    } else {
        textArrayIndex++;
        if (textArrayIndex >= textArray.length) textArrayIndex = 0;
        setTimeout(type, typingDelay + 1100);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    if(textArray.length) setTimeout(type, newTextDelay + 250);
});
</script>

<?php include 'includes/footer.php'; ?>