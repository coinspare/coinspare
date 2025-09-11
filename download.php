<?php
// index.php - Main landing page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finvare - Video Downloader</title>
    <meta name="description" content="Free online video downloader for YouTube, Instagram, Facebook, Twitter, and TikTok. Download videos in high quality without installation.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563EB;
            --secondary-color: #1E40AF;
            --accent-color: #3B82F6;
            --light-bg: #F8FAFC;
            --dark-text: #1E293B;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-text);
            background-color: var(--light-bg);
        }
        
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 0;
            color: white;
            position: relative;
        }
        
        .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
        }
        
        .progress-bar {
            background-color: var(--primary-color);
        }
        
        .footer {
            background-color: #1E293B;
            color: white;
        }
        
        .footer a {
            color: #CBD5E1;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
        
        .update-card {
            border-left: 4px solid var(--primary-color);
        }
        
        .faq-item {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
        }
        
        .faq-question {
            cursor: pointer;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .faq-answer {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .faq-answer.open {
            max-height: 200px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-cloud-download-alt mr-2"></i>
                <span class="fw-bold">Finvare</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home mr-1"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="platformDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fab fa-youtube mr-1"></i> Platforms
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">YouTube</a></li>
                            <li><a class="dropdown-item" href="#">Instagram</a></li>
                            <li><a class="dropdown-item" href="#">Facebook</a></li>
                            <li><a class="dropdown-item" href="#">Twitter</a></li>
                            <li><a class="dropdown-item" href="#">TikTok</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-question-circle mr-1"></i> Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-envelope mr-1"></i> Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Free Video Downloader</h1>
                    <p class="lead mb-4">Download videos from popular social media platforms quickly and easily. No software required, completely free to use.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4 py-2">
                            <i class="fab fa-youtube mr-2"></i>Start Downloading
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4 py-2">
                            <i class="fas fa-play-circle mr-2"></i>Tutorial
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white rounded p-4 shadow-sm">
                        <h3 class="mb-3">Enter Video URL</h3>
                        <form id="downloadForm" action="process_download.php" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" id="videoUrl" name="videoUrl" class="form-control" placeholder="Paste video URL here..." required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-download mr-2"></i>Start Downloading
                                </button>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar w-0" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="text-muted small">Supported platforms: YouTube, Instagram, Facebook, Twitter, TikTok</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose Finvare?</h2>
                <p class="text-muted">Fast, reliable, and completely free video downloading service</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4 text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="mb-3">Lightning Fast</h4>
                        <p class="text-muted">Our advanced technology ensures quick downloads with minimal waiting time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4 text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="mb-3">Secure & Safe</h4>
                        <p class="text-muted">No malware, adware, or viruses. Your privacy and security are our priority.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom h-100 p-4 text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="mb-3">Mobile Friendly</h4>
                        <p class="text-muted">Works seamlessly on desktop, tablet, and mobile devices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">How It Works</h2>
                <p class="text-muted">Simple steps to download your favorite videos</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <div class="p-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-3">
                                    <i class="fas fa-copy fa-2x text-primary"></i>
                                </div>
                                <h5>Copy URL</h5>
                                <p class="text-muted small">Find the video you want to download and copy its URL.</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="p-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-3">
                                    <i class="fas fa-paste fa-2x text-primary"></i>
                                </div>
                                <h5>Paste URL</h5>
                                <p class="text-muted small">Paste the copied URL into our downloader field above.</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="p-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-block p-3 mb-3">
                                    <i class="fas fa-download fa-2x text-primary"></i>
                                </div>
                                <h5>Download</h5>
                                <p class="text-muted small">Click download and choose your preferred format and quality.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Updates Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Recent Updates</h2>
                <p class="text-muted">Stay informed about our latest features and improvements</p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card update-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>New Platform Added: TikTok</h5>
                            <p class="card-text">We've added TikTok support to our platform. Now you can download TikTok videos with just one click. Try it out today!</p>
                            <small class="text-muted">Posted: October 15, 2023</small>
                        </div>
                    </div>
                    <div class="card update-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Improved Download Speed</h5>
                            <p class="card-text">We've optimized our backend systems to provide faster download speeds across all platforms. Enjoy quicker downloads!</p>
                            <small class="text-muted">Posted: September 28, 2023</small>
                        </div>
                    </div>
                    <div class="card update-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Added HD Quality Option</h5>
                            <p class="card-text">Now you can download videos in high definition (HD) quality. Available for YouTube and Instagram videos.</p>
                            <small class="text-muted">Posted: August 12, 2023</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Frequently Asked Questions</h2>
                <p class="text-muted">Answers to common questions about our service</p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="faq-item mb-3">
                        <div class="faq-question">
                            <span>Is Finvare free to use?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, Finvare is completely free to use. There are no hidden fees or subscriptions required. You can download unlimited videos at no cost.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-3">
                        <div class="faq-question">
                            <span>Which video formats are supported?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>We support MP4, AVI, MOV, and FLV formats depending on the source platform. Most videos are available in MP4 format which works on all devices.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-3">
                        <div class="faq-question">
                            <span>Is it legal to download videos using Finvare?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>You may download videos for personal use only. Downloading copyrighted material without permission may violate copyright laws. Please respect the rights of content creators.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-3">
                        <div class="faq-question">
                            <span>Do I need to install any software?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>No, Finvare is a web-based application. You don't need to install any software. Just visit our website, paste the video URL, and download.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Finvare</h5>
                    <p class="text-muted">Your trusted video downloader for social media platforms. Fast, secure, and free.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Connect With Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-4"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                <p>&copy; 2023 Finvare. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // FAQ Toggle Functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const isOpen = answer.classList.contains('open');
                
                // Close all answers
                document.querySelectorAll('.faq-answer').forEach(ans => {
                    ans.classList.remove('open');
                });
                
                // Open clicked answer if it wasn't open
                if (!isOpen) {
                    answer.classList.add('open');
                }
            });
        });

        // Form Validation
        document.getElementById('downloadForm').addEventListener('submit', function(e) {
            const urlInput = document.getElementById('videoUrl');
            const url = urlInput.value.trim();
            
            if (!url) {
                e.preventDefault();
                alert('Please enter a valid video URL');
                return;
            }
            
            // Show loading state
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            submitButton.disabled = true;
            
            // Simulate processing delay
            setTimeout(() => {
                // In real implementation, you'd send the URL to your backend
                console.log('Processing download for:', url);
                
                // Reset button
                submitButton.innerHTML = '<i class="fas fa-download mr-2"></i>Start Downloading';
                submitButton.disabled = false;
                
                // Show success message
                alert('Download initiated! Please wait while we process your request.');
            }, 1500);
        });
    </script>
</body>
</html>
