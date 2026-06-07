<?php
$page_title = 'Portfolio | Monovue';
include 'config.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href="css/portfolio.css">
<section class="portfolio-page" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h1>Our Portfolio</h1>
            <p>Discover our best work across different genres</p>
        </div>
        
        <!-- Portfolio Categories with Tabs -->
        <div class="portfolio-tabs">
            <button class="portfolio-tab-btn active" data-tab="wedding">💍 Wedding</button>
            <button class="portfolio-tab-btn" data-tab="portrait">👤 Portrait</button>
            <button class="portfolio-tab-btn" data-tab="event">🎉 Event</button>
            <button class="portfolio-tab-btn" data-tab="nature">🌿 Nature</button>
        </div>
        
        <!-- Wedding Tab Content -->
        <div class="portfolio-tab-content active" id="wedding-tab">
            <div class="portfolio-grid">
                <?php
                $images = getAllImages();
                $weddingImages = array_filter($images, function($img) {
                    return $img['category'] === 'wedding';
                });
                $weddingImages = array_slice($weddingImages, 0, 6);
                foreach($weddingImages as $image):
                ?>
                <div class="portfolio-item" data-aos="zoom-in">
                    <div class="portfolio-image-wrapper">
                        <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-content">
                                <i class="fas fa-search-plus"></i>
                                <h4><?php echo $image['caption']; ?></h4>
                                <span>Wedding Photography</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if(count($weddingImages) == 0): ?>
                    <div class="no-images">No wedding images yet. Add some in admin panel!</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Portrait Tab Content -->
        <div class="portfolio-tab-content" id="portrait-tab">
            <div class="portfolio-grid">
                <?php
                $portraitImages = array_filter($images, function($img) {
                    return $img['category'] === 'portrait';
                });
                $portraitImages = array_slice($portraitImages, 0, 6);
                foreach($portraitImages as $image):
                ?>
                <div class="portfolio-item" data-aos="zoom-in">
                    <div class="portfolio-image-wrapper">
                        <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-content">
                                <i class="fas fa-search-plus"></i>
                                <h4><?php echo $image['caption']; ?></h4>
                                <span>Portrait Photography</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if(count($portraitImages) == 0): ?>
                    <div class="no-images">No portrait images yet. Add some in admin panel!</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Event Tab Content -->
        <div class="portfolio-tab-content" id="event-tab">
            <div class="portfolio-grid">
                <?php
                $eventImages = array_filter($images, function($img) {
                    return $img['category'] === 'event';
                });
                $eventImages = array_slice($eventImages, 0, 6);
                foreach($eventImages as $image):
                ?>
                <div class="portfolio-item" data-aos="zoom-in">
                    <div class="portfolio-image-wrapper">
                        <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-content">
                                <i class="fas fa-search-plus"></i>
                                <h4><?php echo $image['caption']; ?></h4>
                                <span>Event Photography</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if(count($eventImages) == 0): ?>
                    <div class="no-images">No event images yet. Add some in admin panel!</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Nature Tab Content -->
        <div class="portfolio-tab-content" id="nature-tab">
            <div class="portfolio-grid">
                <?php
                $natureImages = array_filter($images, function($img) {
                    return $img['category'] === 'nature';
                });
                $natureImages = array_slice($natureImages, 0, 6);
                foreach($natureImages as $image):
                ?>
                <div class="portfolio-item" data-aos="zoom-in">
                    <div class="portfolio-image-wrapper">
                        <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-content">
                                <i class="fas fa-search-plus"></i>
                                <h4><?php echo $image['caption']; ?></h4>
                                <span>Nature Photography</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if(count($natureImages) == 0): ?>
                    <div class="no-images">No nature images yet. Add some in admin panel!</div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Stats Section -->
        <div class="portfolio-stats" data-aos="fade-up">
            <div class="stat-box">
                <span class="stat-number">500+</span>
                <span class="stat-label">Weddings Captured</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">1000+</span>
                <span class="stat-label">Portrait Sessions</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">200+</span>
                <span class="stat-label">Events Covered</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">15+</span>
                <span class="stat-label">Years Experience</span>
            </div>
        </div>
        
    </div>
</section>

<script>
// Portfolio Tab Switching
const tabBtns = document.querySelectorAll('.portfolio-tab-btn');
const tabContents = document.querySelectorAll('.portfolio-tab-content');

tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const tabId = btn.dataset.tab;
        
        // Remove active class from all buttons and contents
        tabBtns.forEach(b => b.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        
        // Add active class to current
        btn.classList.add('active');
        document.getElementById(`${tabId}-tab`).classList.add('active');
    });
});

</script>

<?php include 'includes/footer.php'; ?>