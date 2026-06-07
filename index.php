<?php
$page_title = 'Home | Monovue';
include 'config.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">

<!-- Hero Section (untouched as requested) -->
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
    <div class="hero-decoration">
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>
        <div class="deco-circle"></div>
    </div>
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
        <div class="featured-footer" style="text-align: center; margin-top: 3rem;">
    <a href="gallery.php" class="btn btn-outline" style="min-width: 200px;">
        View Full Gallery <i class="fas fa-arrow-right"></i>
    </a>
</div>
    </div>
</section>

<!-- Services Section -->
<section id="featured" class="services" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h2>Our Services</h2>
            <p>What we offer</p>
        </div>
        <div class="services-grid">
            <div class="service-card" data-aos="flip-left">
                <div class="service-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <h3>Wedding Photography</h3>
                <p>Capturing your special day with timeless elegance</p>
                <div class="service-glow"></div>
            </div>
            <div class="service-card" data-aos="flip-left" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3>Portrait Sessions</h3>
                <p>Professional portraits for any occasion</p>
                <div class="service-glow"></div>
            </div>
            <div class="service-card" data-aos="flip-left" data-aos-delay="200">
                <div class="service-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Event Coverage</h3>
                <p>Corporate events, parties, and gatherings</p>
                <div class="service-glow"></div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section - New Premium Addition -->
<!-- Stats Section - With Counter Animation -->
<section class="stats" data-aos="fade-up">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="zoom-in">
                <div class="stat-number" data-count="500">0</div>
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-number" data-count="1200">0</div>
                <div class="stat-label">Sessions Completed</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-number" data-count="50">0</div>
                <div class="stat-label">Awards Won</div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-number" data-count="8">0</div>
                <div class="stat-label">Years Experience</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta" data-aos="zoom-in">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Capture Your Memories?</h2>
            <p>Let's create something beautiful together</p>
            <a href="contact.php" class="btn btn-primary">Get in Touch</a>
        </div>
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
// Counter Animation for Stats Section
function startCounters() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const animateNumber = (element) => {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const step = Math.ceil(target / (duration / 16)); // 60fps
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current >= target) {
                element.textContent = target + (target === 8 ? '+' : '+');
                return;
            }
            element.textContent = current + '+';
            requestAnimationFrame(updateCounter);
        };
        
        updateCounter();
    };
    
    // Use Intersection Observer to trigger when stats come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumber = entry.target;
                // Only animate if not already animated
                if (!statNumber.hasAttribute('data-animated')) {
                    statNumber.setAttribute('data-animated', 'true');
                    animateNumber(statNumber);
                }
                observer.unobserve(statNumber);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(stat => observer.observe(stat));
}

// Alternative simpler version if you want numbers to end with + sign
// Or use this more precise version with easing
function startCountersEased() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const easeOutQuad = (t) => t * (2 - t);
    
    const animateNumberEased = (element) => {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000;
        const startTime = performance.now();
        const startValue = 0;
        
        const updateCounterEased = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuad(progress);
            const current = Math.floor(easedProgress * target);
            
            if (progress < 1) {
                element.textContent = current + '+';
                requestAnimationFrame(updateCounterEased);
            } else {
                element.textContent = target + '+';
            }
        };
        
        requestAnimationFrame(updateCounterEased);
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumber = entry.target;
                if (!statNumber.hasAttribute('data-animated')) {
                    statNumber.setAttribute('data-animated', 'true');
                    animateNumberEased(statNumber);
                }
                observer.unobserve(statNumber);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(stat => observer.observe(stat));
}

// Initialize counters when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    startCountersEased(); // or startCounters() for simpler version
});
</script>

<?php include 'includes/footer.php'; ?>