<?php
$page_title = 'Pricing | Monovue';
include 'config.php';
include 'includes/header.php';
?>
<link rel="stylesheet" href="css/pricing.css">
<section class="pricing-page" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <h1>Investment</h1>
            <p>Choose the perfect package for your needs</p>
        </div>
        
        <!-- Billing Toggle -->
        <div class="billing-toggle">
            <span class="<?php echo !isset($_GET['billing']) || $_GET['billing'] === 'monthly' ? 'active' : ''; ?>" data-billing="monthly">Monthly</span>
            <label class="switch">
                <input type="checkbox" id="billingSwitch" <?php echo isset($_GET['billing']) && $_GET['billing'] === 'yearly' ? 'checked' : ''; ?>>
                <span class="slider round"></span>
            </label>
            <span class="<?php echo isset($_GET['billing']) && $_GET['billing'] === 'yearly' ? 'active' : ''; ?>" data-billing="yearly">Yearly <span class="save-badge">Save 20%</span></span>
        </div>
        
        <!-- Pricing Cards -->
        <div class="pricing-grid" id="pricingGrid">
            <div class="pricing-card" data-aos="flip-left">
                <div class="pricing-header">
                    <h3>Basic</h3>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount monthly-amount">499</span>
                        <span class="yearly-amount" style="display: none;">399</span>
                        <span class="period">/session</span>
                    </div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> 2-hour photoshoot</li>
                    <li><i class="fas fa-check"></i> 50 edited photos</li>
                    <li><i class="fas fa-check"></i> Online gallery</li>
                    <li><i class="fas fa-check"></i> Print rights</li>
                    <li><i class="fas fa-times"></i> Album included</li>
                </ul>
                <a href="contact.php" class="btn btn-outline">Book Now</a>
            </div>
            
            <div class="pricing-card popular" data-aos="flip-left" data-aos-delay="100">
                <div class="popular-badge">Most Popular</div>
                <div class="pricing-header">
                    <h3>Premium</h3>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount monthly-amount">999</span>
                        <span class="yearly-amount" style="display: none;">799</span>
                        <span class="period">/session</span>
                    </div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> 4-hour photoshoot</li>
                    <li><i class="fas fa-check"></i> 150 edited photos</li>
                    <li><i class="fas fa-check"></i> Online gallery + USB</li>
                    <li><i class="fas fa-check"></i> Print rights + canvas</li>
                    <li><i class="fas fa-check"></i> 10-page album</li>
                </ul>
                <a href="contact.php" class="btn btn-primary">Book Now</a>
            </div>
            
            <div class="pricing-card" data-aos="flip-left" data-aos-delay="200">
                <div class="pricing-header">
                    <h3>Luxury</h3>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount monthly-amount">1999</span>
                        <span class="yearly-amount" style="display: none;">1599</span>
                        <span class="period">/session</span>
                    </div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Full day coverage</li>
                    <li><i class="fas fa-check"></i> 300+ edited photos</li>
                    <li><i class="fas fa-check"></i> Premium album + USB</li>
                    <li><i class="fas fa-check"></i> Print rights + wall art</li>
                    <li><i class="fas fa-check"></i> 20-page luxury album</li>
                </ul>
                <a href="contact.php" class="btn btn-outline">Book Now</a>
            </div>
        </div>
        
        <!-- Add-on Services -->
        <div class="addons-section" data-aos="fade-up">
            <h2>Add-on Services</h2>
            <div class="addons-grid">
                <div class="addon-card">
                    <i class="fas fa-video"></i>
                    <h4>Video Coverage</h4>
                    <p>$500</p>
                </div>
                <div class="addon-card">
                    <i class="fas fa-drone"></i>
                    <h4>Drone Photography</h4>
                    <p>$300</p>
                </div>
                <div class="addon-card">
                    <i class="fas fa-clock"></i>
                    <h4>Extra Hour</h4>
                    <p>$150</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Billing toggle functionality
const billingSwitch = document.getElementById('billingSwitch');
if(billingSwitch) {
    billingSwitch.addEventListener('change', function() {
        const monthlyAmounts = document.querySelectorAll('.monthly-amount');
        const yearlyAmounts = document.querySelectorAll('.yearly-amount');
        const monthlyText = document.querySelectorAll('[data-billing="monthly"]');
        const yearlyText = document.querySelectorAll('[data-billing="yearly"]');
        
        if(this.checked) {
            monthlyAmounts.forEach(el => el.style.display = 'none');
            yearlyAmounts.forEach(el => el.style.display = 'inline');
            monthlyText.forEach(el => el.classList.remove('active'));
            yearlyText.forEach(el => el.classList.add('active'));
        } else {
            monthlyAmounts.forEach(el => el.style.display = 'inline');
            yearlyAmounts.forEach(el => el.style.display = 'none');
            monthlyText.forEach(el => el.classList.add('active'));
            yearlyText.forEach(el => el.classList.remove('active'));
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?>