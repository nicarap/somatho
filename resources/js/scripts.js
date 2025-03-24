import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

"use strict";

window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll);

function handleScroll() {
    const navbar = document.querySelector(".navbar-fixed");
    if (navbar.getBoundingClientRect().top > 60) {
        navbar.setAttribute("data-fixed", "false");
    } else {
        navbar.setAttribute("data-fixed", "true");
    }
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (event) {
        event.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Close menu on click in small viewport
document.querySelectorAll('[data-toggle="offcanvas"]').forEach(button => {
    button.addEventListener('click', function () {
        document.querySelector('.offcanvas-collapse')?.classList.toggle('open');
    });
});

const amountScrolled = 700;
window.addEventListener("scroll", function () {
    const backToTop = document.querySelector('.back-to-top');

    if (!backToTop) return;
    if (window.scrollY > amountScrolled) {
        backToTop.style.display = 'block';
    } else {
        backToTop.style.display = 'none';
    }
});

/* Removes Long Focus On Buttons */
document.querySelectorAll(".button, a, button").forEach(element => {
    element.addEventListener('mouseup', function () {
        this.blur();
    });
});

/* Function to get the navigation links for smooth page scroll */
function getMenuItems() {
    const menuItems = [];
    document.querySelectorAll('.nav-link').forEach(link => {
        const hash = link.getAttribute('href').substring(1);
        if (hash !== "") menuItems.push(hash);
    });
    return menuItems;
}

/* Prevents adding of # at the end of URL on click of non-pagescroll links */
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        const hash = this.getAttribute('href').substring(1);
        if (hash === "") e.preventDefault();
    });
});

/* Checks page scroll offset and changes active link on page load */
changeActive();

/* Change active link on scroll */
document.addEventListener("scroll", function () {
    changeActive();
});

/* Function to change the active link */
function changeActive() {
    const menuItems = getMenuItems();
    document.querySelector('.offcanvas-collapse')?.classList.remove('open');

    menuItems.forEach(value => {
        const offsetSection = document.getElementById(value).offsetTop;
        const docScroll = document.documentElement.scrollTop;
        const docScroll1 = docScroll + 1;

        if (docScroll1 >= offsetSection) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList?.remove('bg-light-gold', 'text-white');
            });
            const activeLink = document.querySelector('.nav-link[href$="#' + value + '"]');
            if (activeLink) {
                activeLink.classList?.add('bg-light-gold', 'text-white');
            }
        }
    });
}

function animateFrom(elem, direction) {
    direction = direction || 1;
    let x = 0, y = direction * 100;
    if (elem?.classList?.contains("gs_reveal_fromLeft")) {
        x = -100;
        y = 0;
    } else if (elem?.classList?.contains("gs_reveal_fromRight")) {
        x = 100;
        y = 0;
    }

    if (!elem) return;

    elem.style.transform = "translate(" + x + "px, " + y + "px)";
    elem.style.opacity = "0";
    gsap.fromTo(elem, { x: x, y: y, autoAlpha: 0 }, {
        duration: 1.25,
        x: 0,
        y: 0,
        autoAlpha: 1,
        ease: "expo",
        overwrite: "auto"
    });
}

function hide(elem) {
    gsap.set(elem, { autoAlpha: 0 });
}

document.getElementById("openNavbar")?.addEventListener("click", function () {
    const collapseNavbar = document.getElementById("collapse-navbar");
    collapseNavbar?.setAttribute("data-expanded", "true");
    this.setAttribute("aria-expanded", "true");
    this.classList?.add("hidden");
    
    const closeNavbar = document.getElementById("closeNavbar");
    closeNavbar?.classList?.remove("hidden");
    closeNavbar?.setAttribute("aria-expanded", "true");
});

document.getElementById("closeNavbar")?.addEventListener("click", function () {
    const collapseNavbar = document.getElementById("collapse-navbar");
    collapseNavbar?.setAttribute("data-expanded", "false");
    this.setAttribute("aria-expanded", "false");
    this.classList?.add("hidden");
    
    const openNavbar = document.getElementById("openNavbar");
    openNavbar?.classList?.remove("hidden");
    openNavbar?.setAttribute("aria-expanded", "false");
});

// document.addEventListener("DOMContentLoaded", function () {
//     gsap.registerPlugin(ScrollTrigger);

//     ScrollTrigger.config({ limitCallbacks: true });

//     gsap.utils.toArray(".gs_reveal").forEach(function (elem) {
//         if (elem.getBoundingClientRect()?.top > 0) {
//             hide(elem); // assure that the element is hidden when scrolled into view

//             ScrollTrigger.create({
//                 trigger: elem,
//                 once: true,
//                 start: "top 80%",
//                 onEnter: function () { animateFrom(elem) },
//             });
//         }
//     });

// });

