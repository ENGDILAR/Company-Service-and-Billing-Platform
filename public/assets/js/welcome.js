// Toggle menu
const menuToggle = document.getElementById('menu-toggle');
const navList = document.getElementById('nav-list');
menuToggle.addEventListener('change', () => {
    navList.classList.toggle('active');
});

// Smooth scroll
document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e){
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({behavior:'smooth'});
        if(menuToggle.checked){ menuToggle.checked = false; navList.classList.remove('active'); }
    });
});

// Sticky header
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if(window.scrollY>50) header.classList.add('scrolled');
    else header.classList.remove('scrolled');
});
