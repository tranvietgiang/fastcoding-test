<?php
require_once __DIR__ . '/../models/categaryCa.php';
require_once __DIR__ . '/../models/product.php';
require_once __DIR__ . '/../models/blog.php';
require_once __DIR__ . '/../models/whyChoose.php';
require_once __DIR__ . '/../models/todaySell.php';
require_once __DIR__ . '/../models/featuredProperty.php';

$categary = new categary;
$product = new product;
$blog = new blog;
$whyChooseModel = new whyChoose;
$todaySellModel = new todaySell;
$featuredPropertyModel = new featuredProperty;

$services = $categary->all();
$properties = $product->all();
$blogs = $blog->all();
$whyChoose = $whyChooseModel->first();
$todaySell = $todaySellModel->first();
$featuredProperty = $featuredPropertyModel->first();

function e($value): string
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<main id="home">
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-copy">
        <h1>Find The Best Real Estate For Your Country.</h1>
        <p style="opacity: 0.5;" class="lead">With over 1 million homes for sale available on the website, Renting can match you with a house.</p>
        <a class="primary-button" href="#properties">Start membership <i style="margin-left: 10px;" class="fa-solid fa-chevron-right"></i></a>
        <img style="position: absolute; top: 300px; left: 590px; z-index: 999" src="public/images/Vector.png" alt="" class="hero-decor">
      </div>
      <div class="hero-media">
        <div class="image-placeholder large"></div>
        <div class="floating-card">
          <strong><img src="public/images/increase 1.png" alt=""></strong>
          <span class="floating-value">$7454.21</span>
          <span>Revenue</span>
        </div>
        <div class="hero-badge">How it works <i class="fa-solid fa-circle-play"></i></div>
      </div>
    </div>
  </section>

  <section id="about" class="section centered">
    <div class="container narrow">
      <h2>Commercial real estate and office</h2>
      <p style="opacity: 0.5;">Work with Renting brokers who help you to get started with smart tools to.</p>
    </div>
    <div class="container guide-grid">
      <article class="guide-card">
        <div class="">
          <img src="public/images/icon.png" alt="">
        </div>
        <h3>Buyer Guides</h3>
        <p>Nurture valuable leads into customers, and turn one time.</p>
      </article>
      <article class="guide-card active">
        <div class="guide-icon">
          <img src="public/images/noun_seller_3414715.png" alt="" srcset="">
        </div>
        <h3>Renter Guides</h3>
        <p>Build brand awareness on the top social media networks.</p>
      </article>
      <article class="guide-card">
        <div class="guide-icon">
          <img src="public/images/21.png" alt="" srcset="">
        </div>
        <h3>Seller Guides</h3>
        <p>Get professionally-written content that attracts qualified.</p>
      </article>
    </div>
  </section>



  <section class="section split-section living-section">
    <div class="container split-grid living-grid">
      <div class="collage">
        <div class="image-placeholder block-one"></div>
        <div class="image-placeholder block-two"></div>
        <div class="rating-tile">
          <span class="rating-star">&#9733;</span>
          <span><?= e($whyChoose['rating'] ?? '') ?></span>
        </div>
      </div>
      <div class="section-copy">
        <h2><?= e($whyChoose['title'] ?? '') ?></h2>
        <p class="split-lead"><?= e($whyChoose['description'] ?? '') ?></p>
        <div class="feature-list">
          <?php foreach (($whyChoose['features'] ?? []) as $feature): ?>
            <article class="feature-item">
              <span class="feature-icon">
                <i class="<?= e($feature['icon'] ?? '') ?>"></i>
              </span>
              <div>
                <h3><?= e($feature['title'] ?? '') ?></h3>
                <p><?= e($feature['description'] ?? '') ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section today-sell-section">
    <div class="container today-sell-grid">
      <div class="today-sell-copy">
        <p class="today-eyebrow"><i class="fa-regular fa-circle-dot"></i><?= e($todaySell['eyebrow'] ?? '') ?></p>
        <h2><?= e($todaySell['title'] ?? '') ?></h2>
        <p class="today-lead"><?= e($todaySell['description'] ?? '') ?></p>
        <ul class="today-list">
          <?php foreach (($todaySell['items'] ?? []) as $item): ?>
            <li><?= e($item['label'] ?? '') ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="house-tabs">
          <?php foreach (($todaySell['tabs'] ?? []) as $index => $tab): ?>
            <span class="house-tab house-tab-<?= $index + 1 ?>"><?= e($tab['label'] ?? '') ?></span>
          <?php endforeach; ?>
        </div>
        <div class="today-pagination">
          <span class="active"></span>
          <strong>1</strong>
          <span>2</span>
          <span>3</span>
        </div>
      </div>
      <div class="today-gallery">
        <div class="image-placeholder today-main-image"></div>
        <div class="image-placeholder today-side-image top"></div>
        <div class="image-placeholder today-side-image bottom"></div>
      </div>
    </div>
  </section>

  <section id="services" class="section services-section">
    <div class="container narrow centered services-heading">
      <h2>Services provide for you</h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
    </div>
    <div class="container service-grid">
      <?php foreach ($services as $index => $service): ?>
        <article class="service-card">
          <div class="service-icon">
            <i class="<?= e($service['icon'] ?? '') ?>"></i>
          </div>
          <h3><?= e($service['title'] ?? '') ?></h3>
          <p><?= e($service['description'] ?? '') ?></p>
          <a href="#contact">Learn more <span>&rarr;</span></a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="properties" class="section featured-property-section">
    <div class="container">
      <div class="featured-property-top">
        <div>
          <h2><?= e($featuredProperty['title'] ?? '') ?></h2>
          <p><?= e($featuredProperty['description'] ?? '') ?></p>
        </div>
        <nav class="featured-tabs" aria-label="Featured property categories">
          <?php foreach (($featuredProperty['tabs'] ?? []) as $tab): ?>
            <a class="<?= !empty($tab['is_active']) ? 'active' : '' ?>" href="#properties"><?= e($tab['label'] ?? '') ?></a>
          <?php endforeach; ?>
        </nav>
      </div>
      <div class="featured-property-grid">
        <?php foreach (($featuredProperty['items'] ?? []) as $item): ?>
          <article class="featured-property-card <?= !empty($item['is_active']) ? 'active' : '' ?>">
            <div class="image-placeholder featured-property-image"></div>
            <div class="featured-property-info">
              <h3><?= e($item['title'] ?? '') ?></h3>
              <p><i class="fa-solid fa-location-dot"></i> <?= e($item['location'] ?? '') ?></p>
              <div class="featured-property-bottom">
                <strong><?= e($item['price'] ?? '') ?></strong>
                <a href="#contact" aria-label="View property"><i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <a class="featured-property-button" href="#properties"><?= e($featuredProperty['button_text'] ?? '') ?></a>
    </div>
  </section>


  <section class="unit-preview-section">
    <div class="unit-preview-card">
      <div class="unit-thumb">
        <img src="public/images/Rectangle 4311.png" alt="Property preview">
      </div>
      <div class="unit-preview-info">
        <strong>$4,000</strong>
        <span>242 Metric way</span>
        <div class="unit-stats">
          <span><i class="fa-solid fa-bed"></i>2</span>
          <span><i class="fa-solid fa-bath"></i>2</span>
          <span><i class="fa-solid fa-ruler-combined"></i>500sqf</span>
        </div>
      </div>
    </div>
    <div class="unit-badge">
      <span>UNIT NO.</span>
      <strong>9A</strong>
    </div>
  </section>

  <section class="section testimonial-section">
    <div class="container testimonial-heading">
      <h2>What our customers are saying</h2>
      <p>We make sure you have a fine distance with the sickness. We make you never lose hope.</p>
    </div>
    <div class="container testimonial-grid">
      <button class="testimonial-nav prev" type="button" aria-label="Previous testimonial">
        <i class="fa-solid fa-arrow-left"></i>
      </button>
      <div class="testimonial-photo-wrap">
        <div class="image-placeholder testimonial-photo"></div>
      </div>
      <article class="testimonial-copy">
        <div class="quote-mark">“</div>
        <p>We make sure you have a fine distance with the sickness. We make you never lose hope.</p>
        <p>We make sure you have with the sickness.</p>
        <div class="testimonial-stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <h3>Yunus Seyhan</h3>
        <span>Postgraduate Student</span>
      </article>
      <button class="testimonial-nav next" type="button" aria-label="Next testimonial">
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>
  </section>

  <section class="section projects-section">
    <div class="container projects-heading">
      <h2>We build more projects successful</h2>
    </div>
    <div class="container project-city-grid">
      <article class="project-city-card">
        <h3>San Francisco, California</h3>
        <a href="#properties">See more <i class="fa-solid fa-chevron-right"></i></a>
      </article>
      <article class="project-city-card">
        <h3>Washington DC</h3>
        <a href="#properties">See more <i class="fa-solid fa-chevron-right"></i></a>
      </article>
      <article class="project-city-card">
        <h3>Chicago</h3>
        <a href="#properties">See more <i class="fa-solid fa-chevron-right"></i></a>
      </article>
    </div>
    <form class="project-subscribe">
      <i class="fa-solid fa-envelope"></i>
      <input type="email" placeholder="Enter your email here" aria-label="Email address">
      <button type="submit">Subscribe</button>
    </form>
  </section>

  <section class="section blog-section">
    <div class="container blog-heading">
      <h2>From our blog</h2>
      <p>Find your suitable house here and stay safe and relaxe with pleasure</p>
    </div>
    <div class="container blog-grid">
      <?php foreach ($blogs as $blog): ?>
        <article class="blog-card">
          <div class="image-placeholder blog-image"></div>
          <div class="blog-body">
            <h3><?= e($blog['title'] ?? '') ?></h3>
            <a class="blog-category" href="#home"><i class="fa-regular fa-bookmark"></i><?= e($blog['category'] ?? '') ?></a>
            <p><?= e($blog['description'] ?? '') ?></p>
            <div class="blog-meta">
              <span><i class="fa-regular fa-calendar"></i><?= e($blog['date'] ?? '') ?></span>
              <span><i class="fa-regular fa-user"></i> By <a href="#home"><?= e($blog['author'] ?? '') ?></a></span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <a class="blog-read-all" href="#home">Read All</a>
  </section>

  <section id="contact" class="section contact-section">
    <div class="container contact-grid">
      <div>
        <p class="kicker">Contact us</p>
        <h2>Looking For To Take A Property?</h2>
        <p>Send your information and our advisor will contact you with matching property options.</p>
        <div class="contact-art">
          <div class="image-placeholder contact-one"></div>
          <div class="image-placeholder contact-two"></div>
        </div>
      </div>
      <form class="contact-form">
        <label>
          Name
          <input type="text" name="name" placeholder="Your name">
        </label>
        <label>
          Email
          <input type="email" name="email" placeholder="Your email">
        </label>
        <label>
          Message
          <textarea name="message" rows="4" placeholder="Tell us what you need"></textarea>
        </label>
        <button class="primary-button" type="submit">Send Message</button>
      </form>
    </div>
  </section>
</main>
