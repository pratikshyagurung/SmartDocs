<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Smart Docs | Documentation Center</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      color: #111;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    
.profile-icon {
    display: flex;
    align-items: center;
}

.profile-icon img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: 1.5px solid #fff;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
    margin-left: 978px;
    margin-top: 18px;
}

.profile-icon img:hover {
    transform: scale(1.05);
}

    .hero-content {
      position: relative;
      z-index: 3;
      height: calc(100% - 80px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 0 24px;
    }

    .hero-content h1 {
      color: #fff;
      font-size: 36px;
      font-weight: 700;
      line-height: 1.3;
    }

    .hero-content p {
      margin-top: 16px;
      color: #dddddd96;
      max-width: 928px;
    }   

    .hero-content a {
      margin-top: 24px;
      background: #fff;
      color: #000;
      padding: 12px 14px;
      border-radius: 12px;
      font-weight: 550;
      transition: background 0.3s;
    }

    .hero-content a:hover {
      background: #f0f0f0;
    }

    .streamlineSection {
      max-width: 1200px;
      margin: 30px auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }

    .streamlineSection .text h2 {
      font-size: 37px;
      font-weight: 550;
      margin-bottom: 16px;
    }

    .streamlineSection .text p {
      font-size: 14px;
      color: #666;
      margin-bottom: 28px;
      line-height: 1.4;
    }

    .streamlineSection .text a {
      background: #000;
      color: #ffffffe3;
      padding: 12px 24px;
      border-radius: 9999px;
      font-weight: 550;
      transition: background 0.3s;
    }
    .text{
        margin-left: 50px;
    }

    .streamlineSection .text a:hover {
      background: #222;
    }

    .cards {
      display: flex;
      gap: 16px;
      width: 650px;

    }

    .card {
      position: relative;
      height: 260px;
      background-size: cover;
      background-position: center;
      border-radius: 30px;
      overflow: hidden;
      flex-grow: 1;
    }

    .card.small {
      flex-grow: 0.6;
      color: #000;
    }

    .card span.label {
      position: absolute;
      top: 14px;
      right: 16px;
      background: #000;
      color: #f3f3f3;
      padding: 8px 16px;
      font-size: 12px;
      border-radius: 9999px;
    }

    .card span.title {
      position: absolute;
      bottom: 16px;
      left: 16px;
      color: #fff;
      font-size: 14px;
      font-weight: 500;
    }

    .card .icon {
    position: absolute;
    top: 14px;
    right: 16px;
    background: #000;
    color: #fff;
    padding: 8px;
    border-radius: 200px;
    transition: all 0.3s;
    }

    .card .icon:hover {
      background: #fff;
      color: #000;
    }
    .card img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 30px;
    z-index: 1;
    }

    .card span.label,
    .card span.title,
    .card .icon {
    z-index: 2;
    }


.stats-section {
    max-width: 1000px;
    margin: 80px auto;
    display: flex;
    justify-content: space-around;
    text-align: center;
    color: #373737;
    border-radius: 24px;
    gap: 100px
  }
  
  .stat h3 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 12px;
  }
  
  .stat p {
    font-size: 14px;
    color: #00000063;
    line-height: 1.6;
  }

  .insight-section {
        text-align: center;
        width: 1200px;
        margin: 0 auto;
        color: #ccc;
      }
      
      .insight-section h2 {
        font-size: 36px;
        font-weight: 600;
        line-height: 1.4;
        color: #000000;
      }

      .insight-section p {
        margin-top: 16px;
        font-size: 15px;
        color: #aaa;
        line-height: 1.6;
      }
    
      .insight-gif {
  margin-top: 32px;
  display: flex;
}

.insight-gif img {
    width: 200%;
      height: auto;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.most-viewed-section {
  max-width: 1200px;
  margin: 60px auto 80px;
  padding: 0 24px;
  display: flex;
  flex-direction: column;
  gap: 50px;
}
.most-viewed-article {
    display: flex;
    gap: 340px}

.left-article-label p {
  font-size: 14px;
  font-weight: 700;
  text-transform: uppercase;
  color: #666;
  margin: 0;
  min-width: 80px;
}



.right-article-content h2 {
  font-size: 36px;
  font-weight: 700;
  margin: 0 0 12px 0;
  color: #111;
  display: inline-block;
}

.learn-more {
  display: inline-flex;
  align-items: center;
  font-weight: 600;
  font-size: 16px;
  color: #000;
  gap: 6px;
  text-decoration: none;
  transition: color 0.3s;
  position: relative;
  right: 0; /* aligns with the start of h2 text */
}

.learn-more:hover {
  color: #555;
}

.learn-more i {
  font-size: 16px;
}


/* Article Info & Image Section */
.article-info-image {

    display: flex;
    align-items: flex-end;
    gap: 40px;
}

.left-typing-text p {
  font-family: 'Courier New', Courier, monospace;
  font-size: 18px;
  color: #444;
  margin-top: 40px; /* To push text down */
  line-height: 1.5;
  max-width: 400px;
}

.right-article-image img {
  width: 718px;
  border-radius: 24px;
  display: block;
  height: 450px;

}

.divider-line {
    border: none;
    border-top: 1px solid #ccc;
    width: 100%;
}

.why-choose-section {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 24px;
  }
  
  .why-choose-content {
    display: flex;
    gap: 60px;
    flex-wrap: wrap;
  }
  
  .why-left {
    flex: 1;
    min-width: 300px;
  }
  
  .why-left p:first-child {
    font-size: 14px;
    font-weight: 700;
    color: #666;
    text-transform: uppercase;
    margin-bottom: 8px;
  }
  
  .why-left h2 {
    font-size: 38px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
    line-height: 1.3;
  }
  
  .why-left .description {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 24px;
    max-width: 600px;
  }
  
  .discover-more {
    display: inline-flex;
    align-items: center;
    font-weight: 600;
    font-size: 16px;
    color: #000;
    gap: 8px;
    padding: 12px 20px;
    border: 2px solid #000;
    border-radius: 9999px;
    transition: 0.3s ease;
  }
  
  .discover-more:hover {
    background: #000;
    color: #fff;
  }
  
  .why-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 24px;
    min-width: 300px;
  }
  
  .feature {
    display: flex;
    gap: 18px;
    align-items: flex-start;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    transition: transform 0.3s;
  }
  
  .feature:hover {
    transform: translateY(-4px);
  }
  
  .feature i {
    font-size: 28px;
    color: #000;
    margin-top: 4px;
  }
  
  .feature h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #111;
  }
  
  .feature p {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
  }
  .scroll-banner {
      width: calc(82% - 120px);
      margin: 60px auto;
      overflow: hidden;
      white-space: nowrap;
      background: #111;
      color: #fff;
      padding: 12px 0;
      position: relative;
      border-radius: 16px;
    }
    
    .scroll-text {
      display: inline-block;
      padding-left: 100%;
      animation: scroll-left 18s linear infinite;
      font-size: 16px;
      font-weight: 500;
      white-space: nowrap;
    }
    
    .scroll-banner:hover .scroll-text {
      animation-play-state: paused;
    }
    
    @keyframes scroll-left {
      from {
        transform: translateX(0%);
      }
      to {
        transform: translateX(-100%);
      }
    }
    
    /* Fading cloudy/fog edges */
    .scroll-fade-left,
    .scroll-fade-right {
      position: absolute;
      top: 0;
      width: 80px;
      height: 100%;
      z-index: 2;
      pointer-events: none;
    }
    
    .scroll-fade-left {
      left: 0;
      background: linear-gradient(to right, #111 0%, transparent 100%);
    }
    
    .scroll-fade-right {
      right: 0;
      background: linear-gradient(to left, #111 0%, transparent 100%);
    }
    
    .pricing-plans {
    max-width: 1200px;
    margin: 80px auto;
    padding: 40px 24px;
    text-align: center;
    background: #dbdbdb80;
    border-radius: 20px;
}

.pricing-plans h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 12px;
}

.pricing-plans p {
  font-size: 14px;
  color: #666;
  margin-bottom: 48px;
}

.plans {
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
}

.plan {
    background: #fafafa;
    border-radius: 16px;
    padding: 32px 24px;
    width: 340px;
    height: 500px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.3s ease;
}

.plan:hover {
  transform: translateY(-8px);
}

.plan.popular {
  background: #000;
  color: #fff;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

.plan.popular .btn {
  background: #fff;
  color: #000;
}

.plan h3 {
  font-size: 22px;
  margin-bottom: 8px;
}

.price {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 20px;
}

.price span {
  font-size: 16px;
  font-weight: 400;
  color: #666;
}

.plan ul {
  list-style: none;
  margin-bottom: 28px;
  width: 100%;
  padding: 0;
  text-align: left;
}

.plan ul li {
  margin-bottom: 12px;
  font-size: 14px;
  color: inherit;
}

.btn {
  background: #000;
  color: #fff;
  padding: 12px 32px;
  border-radius: 9999px;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.3s;
}

.btn:hover {
  background: #333;
}

.testimonial-glass {
  background: linear-gradient(145deg, #f0f4f8, #ffffff);
  padding: 100px 0;
}

.testimonial-inner {
  max-width: 1200px;
  margin: auto;
  display: flex;
  gap: 60px;
  align-items: center;
  flex-wrap: wrap;
  padding: 0 24px;
}

.testimonial-left {
  flex: 1;
  min-width: 300px;
}

.testimonial-left h2 {
  font-size: 36px;
  font-weight: 700;
  color: #111;
  margin-bottom: 16px;
}

.testimonial-left p {
  font-size: 16px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 32px;
}

.testimonial-dots {
  display: flex;
  gap: 10px;
}

.testimonial-dots .dot {
  width: 12px;
  height: 12px;
  background: #ccc;
  border-radius: 50%;
  cursor: pointer;
  transition: background 0.3s;
}

.testimonial-dots .dot.active {
  background: #000;
}

.testimonial-right {
  flex: 1;
  min-width: 300px;
  position: relative;
}

.testimonial-carousel {
  position: relative;
  height: 300px;
}

.testimonial-card {
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(14px);
  padding: 32px;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  position: absolute;
  opacity: 0;
  transition: opacity 0.6s ease-in-out;
  width: 100%;
}

.testimonial-card.active {
  opacity: 1;
  position: relative;
}

.testimonial-card p {
  font-size: 16px;
  font-style: italic;
  color: #333;
  margin-bottom: 24px;
}

.user {
  display: flex;
  align-items: center;
  gap: 16px;
}

.user img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #000;
}

.user h4 {
  font-size: 16px;
  margin: 0;
  color: #000;
}

.user span {
  font-size: 13px;
  color: #666;
}

.fancy-footer {
  background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
  color: #fff;
  padding: 60px 20px 30px;
  font-family: 'Segoe UI', sans-serif;
}

.footer-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
  padding: 40px 275px;
  background-color: #0f2a35;
  color: white;
}


.footer-box h2,
.footer-box h3,
.footer-box h4 {
  margin-bottom: 10px;
}

.footer-box p,
.footer-box li {
  color: #ccc;
  font-size: 14px;
  line-height: 1.4;
}

.footer-box ul {
  list-style: none;
  padding: 0;
}

.footer-box ul li {
  margin-bottom: 8px;
}

.footer-box ul li a {
  text-decoration: none;
  color: #ccc;
  transition: color 0.3s ease;
}

.footer-box ul li a:hover {
  color: #fff;
}

.footer-box form {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.footer-box input {
  padding: 10px;
  border-radius: 8px;
  border: none;
  flex: 1;
}

.footer-box button {
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  background: white;
  color: black;
  font-weight: bold;
  cursor: pointer;
}

.social-icons {
  margin-top: 20px;
}

.social-icons .icons i {
  margin-right: 15px;
  font-size: 20px;
  cursor: pointer;
}
/* Footer bottom */
.footer-bottom {
  margin-top: 40px;
  text-align: center;
  font-size: 13px;
  color: #aaa;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding-top: 20px;
}

.logout-btn {
      border: 1px solid #fff;
      background: transparent;
      color: #fff;
      padding: 8px 16px;
      border-radius: 9999px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .logout-btn:hover {
      background: #fff;
      color: #000;
    }

  </style>
</head>
<body>