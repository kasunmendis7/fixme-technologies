document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.getElementById('menu-toggle');
  const navbarMenu = document.getElementById('navbar-menu');
  
  menuToggle.addEventListener('click', function() {
    navbarMenu.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });
  
  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    if (!menuToggle.contains(event.target) && !navbarMenu.contains(event.target)) {
      navbarMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    }
  });
  
  // Add animation to hamburger menu
  menuToggle.addEventListener('click', function() {
    const bars = this.querySelectorAll('.bar');
    if (this.classList.contains('active')) {
      bars[0].style.transform = 'rotate(-45deg) translate(-5px, 6px)';
      bars[1].style.opacity = '0';
      bars[2].style.transform = 'rotate(45deg) translate(-5px, -6px)';
    } else {
      bars[0].style.transform = 'none';
      bars[1].style.opacity = '1';
      bars[2].style.transform = 'none';
    }
  });
});
