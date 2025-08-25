<div class="footer-container">
    <!-- Column 1: Brand -->
    <div class="footer-box brand">
        <h2 style="font-size: 40px; font-family: 'Montserrat', sans-serif;">Smart Docs</h2>
        <p>Organize, share & grow knowledge effortlessly <br>with your team.</p>
    </div>
  
    <!-- Column 2: Links -->
    <div class="footer-box links">
      <h3>Explore</h3>
      <ul>
        <li>Home</li>
        <li>Documentation</li>
        <li>Categories</li>
        <li>About</li>
        <li>Contact</li>
      </ul>
    </div>
  
    <!-- Column 3: Newsletter + Social -->
    <div class="footer-box newsletter">
        <h3 class="text-lg font-semibold">
            Stay in the Loop <i class="fas fa-rocket text-white ml-1"></i>
          </h3>
        <p>Get monthly tips, feature updates, and productivity hacks.</p>
      <form>
        <input type="email" placeholder="Enter your email" />
        <button>Subscribe</button>
      </form>
  
      <!-- Social icons BELOW the form -->
      <div class="social-icons">
        <h4>Follow Us</h4>
        <div class="icons">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-linkedin"></i>
          <i class="fab fa-github"></i>
        </div>
      </div>
    </div>
  </div>

  <script>
    const counters = document.querySelectorAll('.counter');
  
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / 150; // speed control
  
        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 15);
        } else {
          counter.innerText = target.toLocaleString();
        }
      };
  
      updateCount();
    });

    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const testimonialDots = document.querySelector('.testimonial-dots');
  
    testimonialCards.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.classList.add('dot');
      if (i === 0) dot.classList.add('active');
      dot.addEventListener('click', () => showSlide(i));
      testimonialDots.appendChild(dot);
    });
  
    let current = 0;
  
    function showSlide(index) {
      testimonialCards.forEach(c => c.classList.remove('active'));
      document.querySelectorAll('.dot').forEach(d => d.classList.remove('active'));
      testimonialCards[index].classList.add('active');
      testimonialDots.children[index].classList.add('active');
      current = index;
    }
  
    // Auto-slide
    setInterval(() => {
      current = (current + 1) % testimonialCards.length;
      showSlide(current);
    }, 6000);
  </script>
</body>
</html>