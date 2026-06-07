    </main>

    <!-- Improved Footer -->
    <footer class="footer">
        
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <!-- Brand Column -->
                    <div class="footer-col brand-col">
                        <div class="footer-logo">
                            <span class="logo-icon">📸</span>
                            <span class="logo-text">Monovue</span>
                        </div>
                        <p class="footer-description">Capturing life's most precious moments with artistry and passion. Creating timeless memories that last forever.</p>
                        <div class="footer-social">
                            <a href="#" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="social-icon" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    
                    <!-- Quick Links Column -->
                    <div class="footer-col">
                        <h4>Explore</h4>
                        <ul class="footer-links">
                            <li><a href="index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="gallery.php"><i class="fas fa-chevron-right"></i> Gallery</a></li>
                            <li><a href="portfolio.php"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                            <li><a href="pricing.php"><i class="fas fa-chevron-right"></i> Pricing</a></li>
                            <li><a href="about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                            <li><a href="contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>
                    
                    <!-- Services Column -->
                    <div class="footer-col">
                        <h4>Services</h4>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Wedding Photography</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Portrait Sessions</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Event Coverage</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Commercial Photography</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Photo Editing</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Album Design</a></li>
                        </ul>
                    </div>
                    
                    <!-- Contact Column -->
                    <div class="footer-col">
                        <h4>Get in Touch</h4>
                        <ul class="footer-contact">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Studio Address</strong>
                                    <span>123 Photography Studio, New York, NY 10001</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <div>
                                    <strong>Phone</strong>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>Email</strong>
                                    <span>hello@monovue.com</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Business Hours</strong>
                                    <span>Mon-Fri: 9am - 6pm<br>Sat: 10am - 4pm</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Newsletter Column -->
                    <div class="footer-col newsletter-col">
                        <h4>Stay Updated</h4>
                        <p class="newsletter-text">Subscribe to get special offers, photography tips, and latest updates.</p>
                        <form id="newsletterForm" class="footer-newsletter">
                            <div class="newsletter-group">
                                <input type="email" id="newsletterEmail" placeholder="Your email address" required>
                                <button type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        <p class="newsletter-note">
                            <i class="fas fa-lock"></i> We respect your privacy. No spam ever!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; 2024 Monovue. All rights reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="#">Terms of Service</a>
                        <span class="separator">|</span>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>
    
    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/main.js"></script>
    <?php if(basename($_SERVER['PHP_SELF']) == 'gallery.php'): ?>
        <script src="js/gallery.js"></script>
    <?php endif; ?>
    <?php if(basename($_SERVER['PHP_SELF']) == 'admin.php' && isset($_SESSION['admin_logged_in'])): ?>
        <script src="js/admin.js"></script>
    <?php endif; ?>
    
    <script>
    // Back to Top Button
    const backToTopBtn = document.getElementById('backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    </script>
</body>
</html>