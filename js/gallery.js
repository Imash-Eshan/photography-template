// Gallery Filtering
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    if (filterButtons.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active button
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                const category = btn.dataset.category;
                
                // Filter items
                galleryItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                        item.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }
});

// Lightbox with keyboard support
document.addEventListener('keydown', (e) => {
    const lightbox = document.getElementById('lightbox');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'Escape') {
            lightbox.style.display = 'none';
        }
    }
});

// Image loading animation
const images = document.querySelectorAll('.gallery-image-wrapper img');
images.forEach(img => {
    img.addEventListener('load', () => {
        img.classList.add('image-loaded');
    });
});