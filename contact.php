<?php
$page_title = 'Contact | Monovue';
include 'config.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href="css/contact.css">
<section class="contact-page" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h1>Let's Connect</h1>
            <p>Ready to capture your moments? Get in touch!</p>
        </div>
        
        <div class="contact-wrapper">
            <div class="contact-info" data-aos="fade-right">
                <div class="info-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Visit Us</h3>
                    <p>123 Photography Studio<br>New York, NY 10001</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-phone"></i>
                    <h3>Call Us</h3>
                    <p>+1 (555) 123-4567</p>
                    <p>Mon-Fri, 9am-6pm</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Email Us</h3>
                    <p>hello@monovue.com</p>
                    <p>sarah@monovue.com</p>
                </div>
            </div>
            
            <div class="contact-form-wrapper" data-aos="fade-left">
                <form id="contactForm" class="contact-form">
                    <div class="form-group">
                        <input type="text" id="name" required>
                        <label for="name">Your Name</label>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" required>
                        <label for="email">Email Address</label>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone">
                        <label for="phone">Phone Number (Optional)</label>
                    </div>
                    <div class="form-group">
                        <select id="service">
                            <option value="wedding">Wedding Photography</option>
                            <option value="portrait">Portrait Session</option>
                            <option value="event">Event Coverage</option>
                            <option value="other">Other</option>
                        </select>
                        <!-- <label for="service">Service Interested In</label> -->
                    </div>
                    <div class="form-group">
                        <textarea id="message" rows="5" required></textarea>
                        <label for="message">Your Message</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Map Placeholder -->
        <div class="map-placeholder" data-aos="fade-up">
            <div class="map-overlay">
                <i class="fas fa-map-marked-alt"></i>
                <p>Interactive Map Would Appear Here</p>
                <small>123 Photography Studio, NYC</small>
            </div>
        </div>
    </div>
</section>

<script>
// Fake contact form submission
const contactForm = document.getElementById('contactForm');
if(contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const name = document.getElementById('name').value;
        
        // Show success toast
        showToast(`Thanks ${name}! We'll get back to you within 24 hours.`, 'success');
        
        // Reset form
        contactForm.reset();
        
        // Remove floating labels effect
        document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(field => {
            field.classList.remove('filled');
        });
    });
}

// Floating label effect
document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(field => {
    field.addEventListener('input', function() {
        if(this.value) {
            this.classList.add('filled');
        } else {
            this.classList.remove('filled');
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>