<?php
$page_title = 'Gallery | Monovue';
include 'config.php';
include 'includes/header.php';

$images = getAllImages();
$categories = ['all', 'wedding', 'portrait', 'event', 'nature'];
$activeCategory = isset($_GET['category']) ? $_GET['category'] : 'all';
?>
<link rel="stylesheet" href="css/gallery.css">
<section class="gallery-page" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h1>Our Gallery</h1>
            <p>Explore our collection of beautiful moments</p>
        </div>
        
        <!-- Category Filter -->
        <div class="gallery-filters">
            <?php foreach($categories as $cat): ?>
                <button class="filter-btn <?php echo $activeCategory === $cat ? 'active' : ''; ?>" data-category="<?php echo $cat; ?>">
                    <?php echo ucfirst($cat); ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <!-- Image Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <?php 
            $displayImages = $activeCategory === 'all' ? $images : array_filter($images, function($img) use ($activeCategory) {
                return $img['category'] === $activeCategory;
            });
            
            foreach($displayImages as $image):
            ?>
            <div class="gallery-item" data-category="<?php echo $image['category']; ?>" data-aos="zoom-in">
                <div class="gallery-image-wrapper">
                    <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy" data-full="<?php echo $image['path']; ?>">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h3><?php echo $image['caption']; ?></h3>
                            <span class="gallery-category"><?php echo ucfirst($image['category']); ?></span>
                        </div>
                        <button class="gallery-zoom" onclick="openLightbox('<?php echo $image['path']; ?>', '<?php echo $image['caption']; ?>')">
                            <i class="fas fa-search-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Load More Button -->
        <div class="load-more-container">
            <button class="load-more-btn" id="loadMoreBtn">Load More</button>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <span class="close-lightbox">&times;</span>
    <img class="lightbox-content" id="lightboxImg">
    <div id="lightboxCaption"></div>
</div>

<!-- Infinite Scroll Script -->
<script>
let currentItemCount = 9;
const galleryItems = document.querySelectorAll('.gallery-item');
const loadMoreBtn = document.getElementById('loadMoreBtn');

function showItems() {
    galleryItems.forEach((item, index) => {
        if (index < currentItemCount) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    if (currentItemCount >= galleryItems.length) {
        loadMoreBtn.style.display = 'none';
    }
}

if(loadMoreBtn) {
    loadMoreBtn.addEventListener('click', () => {
        currentItemCount += 6;
        showItems();
    });
    showItems();
}

// Lightbox function
function openLightbox(imgSrc, caption) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    
    lightbox.style.display = 'flex';
    lightboxImg.src = imgSrc;
    lightboxCaption.innerHTML = caption;
}

document.querySelector('.close-lightbox')?.addEventListener('click', () => {
    document.getElementById('lightbox').style.display = 'none';
});
</script>

<?php include 'includes/footer.php'; ?>