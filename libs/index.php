<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eri Silk - Luxurious Customizable Silk Dresses</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php include 'sections/head.php'; ?>

</head>

<body>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Elegance Woven in Silk</h1>
                <p class="hero-subtitle">Customizable traditional dresses & handbags crafted with premium Eri silk</p>
                <a href="#collections" class="btn btn-primary">Explore Collections</a>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <span class="scroll-dot"></span>
            <span class="scroll-dot"></span>
            <span class="scroll-dot"></span>
        </div>
    </section>

    <!-- Collections Section -->
    <section id="collections" class="section collections">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Collections</h2>
                <p class="section-subtitle">Handcrafted with tradition, designed for modern elegance</p>
            </div>
            <div class="collections-grid">
                <!-- Collection Item 1 -->
                <div class="collection-item" data-product-id="1">
                    <div class="collection-image">
                        <img src="photos/sample.jpg" alt="Traditional Silk Dress">
                        <div class="collection-overlay">
                            <a href="#" class="btn btn-outline">View Details</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-name">Mekhela Chador</h3>
                        <p class="collection-price">$249.00</p>
                        <div class="collection-actions">
                            <button class="btn-icon"><i class="far fa-heart"></i></button>
                            <button class="btn-icon"><i class="fas fa-shopping-bag"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Collection Item 2 -->
                <div class="collection-item" data-product-id="2">
                    <div class="collection-image">
                        <img src="photos/sampletype2green.jpg" alt="Silk Saree">
                        <div class="collection-overlay">
                            <a href="#" class="btn btn-outline">View Details</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-name">Muga Silk Saree</h3>
                        <p class="collection-price">$199.00</p>
                        <div class="collection-actions">
                            <button class="btn-icon"><i class="far fa-heart"></i></button>
                            <button class="btn-icon"><i class="fas fa-shopping-bag"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Collection Item 3 -->
                <div class="collection-item" data-product-id="3">
                    <div class="collection-image">
                        <img src="photos/sampletype3blue.jpg" alt="Silk Handbag">
                        <div class="collection-overlay">
                            <a href="#" class="btn btn-outline">View Details</a>
                        </div>
                    </div>
                    <div class="collection-info">
                        <h3 class="collection-name">Eri Silk Handbag</h3>
                        <p class="collection-price">$89.00</p>
                        <div class="collection-actions">
                            <button class="btn-icon"><i class="far fa-heart"></i></button>
                            <button class="btn-icon"><i class="fas fa-shopping-bag"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-footer">
                <a href="#" class="btn btn-outline">View All Collections</a>
            </div>
        </div>
    </section>

    <!-- Customize Section -->
    <section id="customize" class="section customize">
        <div class="container">
            <div class="customize-inner">
                <div class="customize-content">
                    <h2 class="section-title">Create Your Unique Style</h2>
                    <p class="section-subtitle">Customize any of our products to match your personal taste</p>
                    <ul class="customize-features">
                        <li class="feature-item">
                            <i class="fas fa-palette feature-icon"></i>
                            <span>Choose from 50+ colors</span>
                        </li>
                        <li class="feature-item">
                            <i class="fas fa-ruler feature-icon"></i>
                            <span>Perfect fit measurements</span>
                        </li>
                        <li class="feature-item">
                            <i class="fas fa-embroidery feature-icon"></i>
                            <span>Add embroidery & motifs</span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary">Start Customizing</a>
                </div>
                <div class="customize-image">
                    <img src="photos/custom.jpg" alt="Customizable Silk Dress">
                    <div class="customize-badge">
                        <span>Made Just For You</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container">
            <div class="about-inner">
                <div class="about-image">
                    <img src="photos/story.jpg" alt="Eri Silk Weaving">
                </div>
                <div class="about-content">
                    <h2 class="section-title">The Art of Eri Silk</h2>
                    <p class="about-text">Eri Silk, also known as Ahimsa Silk, is produced without harming the silkworm. Our artisans have perfected the craft of weaving this luxurious fabric over generations.</p>
                    <p class="about-text">Each piece in our collection is handcrafted using traditional techniques, ensuring the highest quality while supporting sustainable practices and local communities.</p>
                    <a href="#" class="btn btn-outline">Our Story</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Loved by Our Customers</h2>
                <p class="section-subtitle">What they say about Eri Silk</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>"The craftsmanship is exceptional. My customized Mekhela Chador fits perfectly and the silk quality is unmatched."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Priya M.">
                        <span>Priya M.</span>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>"I've purchased multiple items and each one exceeds expectations. The customization options make each piece unique."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Ananya S.">
                        <span>Ananya S.</span>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>"The handbag I ordered is not just beautiful but also durable. The attention to detail is remarkable."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Meera K.">
                        <span>Meera K.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="section newsletter">
        <div class="container">
            <div class="newsletter-inner">
                <div class="newsletter-content">
                    <h2 class="section-title">Join Our Silk Journey</h2>
                    <p class="section-subtitle">Subscribe for exclusive offers, styling tips, and early access to new collections</p>
                </div>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <?php include 'sections/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Navigation Toggle
            const hamburger = document.querySelector('.hamburger');
            const nav = document.querySelector('.nav');

            hamburger.addEventListener('click', function() {
                this.classList.toggle('active');
                nav.classList.toggle('active');

                // Toggle body overflow when menu is open
                if (nav.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });

            // Close mobile menu when clicking on a link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (nav.classList.contains('active')) {
                        hamburger.classList.remove('active');
                        nav.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerHeight = document.querySelector('.header').offsetHeight;
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Cart functionality
            const cartCount = document.querySelector('.cart-count');
            let cartItems = 0;

            const addToCartButtons = document.querySelectorAll('.collection-actions .btn-icon .fa-shopping-bag');
            addToCartButtons.forEach(icon => {
                icon.parentElement.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.closest('.collection-item').dataset.productId;
                    fetch('users-libraries/add-to-cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'product_id=' + encodeURIComponent(productId)
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                cartItems = data.cart_count;
                                cartCount.textContent = cartItems;
                                showAddToCartToast(this);
                            } else {
                                showAddToCartToast(this, 'Failed to add to cart');
                            }
                        })
                        .catch(() => {
                            showAddToCartToast(this, 'Error adding to cart');
                        });
                });
            });

            function updateCartCount() {
                cartCount.textContent = cartItems;
                // Optionally, remove localStorage if you want only server-side count
                // localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

            function showAddToCartToast(button, message = 'Added to cart') {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.textContent = message;
                document.body.appendChild(toast);

                // Position the toast near the clicked button
                const buttonRect = button.getBoundingClientRect();
                toast.style.position = 'fixed';
                toast.style.left = `${buttonRect.left + window.scrollX}px`;
                toast.style.top = `${buttonRect.top + window.scrollY - 40}px`;

                setTimeout(() => {
                    toast.classList.add('show');
                }, 10);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 2000);
            }

            // Wishlist functionality
            // Select all wishlist buttons
            const wishlistButtons = document.querySelectorAll('.collection-actions .btn-icon .fa-heart');
            wishlistButtons.forEach(icon => {
                icon.parentElement.addEventListener('click', function(e) {
                    e.preventDefault();
                    icon.classList.toggle('far');
                    icon.classList.toggle('fas');

                    if (icon.classList.contains('fas')) {
                        showWishlistToast('Added to wishlist');
                    } else {
                        showWishlistToast('Removed from wishlist');
                    }
                });
            });

            function showWishlistToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.textContent = message;
                document.body.appendChild(toast);

                toast.style.position = 'fixed';
                toast.style.left = '50%';
                toast.style.top = '20px';
                toast.style.transform = 'translateX(-50%)';

                setTimeout(() => {
                    toast.classList.add('show');
                }, 10);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 2000);
            }

            // Newsletter form submission
            const newsletterForm = document.querySelector('.newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = this.querySelector('input[type="email"]');

                    if (emailInput.value) {
                        // In a real implementation, you would send this to your backend
                        showNewsletterToast('Thank you for subscribing!');
                        emailInput.value = '';
                    }
                });
            }

            function showNewsletterToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.textContent = message;
                document.body.appendChild(toast);

                toast.style.position = 'fixed';
                toast.style.left = '50%';
                toast.style.bottom = '20px';
                toast.style.transform = 'translateX(-50%)';

                setTimeout(() => {
                    toast.classList.add('show');
                }, 10);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 3000);
            }

            // Scroll reveal animation
            const scrollReveal = ScrollReveal({
                origin: 'bottom',
                distance: '60px',
                duration: 1000,
                delay: 200,
                reset: true
            });

            scrollReveal.reveal('.section-header, .collection-item, .customize-content, .customize-image, .about-image, .about-content, .testimonial-item, .newsletter-inner, .footer-col', {
                interval: 200
            });

            // Add active class to header on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.header');
                if (window.scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // Initialize the header state
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            }
        });

        // Add toast styles to the head
        const style = document.createElement('style');
        style.textContent = `
    .toast {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 24px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }
    
    .toast.show {
        opacity: 1;
    }
`;
        document.head.appendChild(style);
    </script>
</body>

</html>