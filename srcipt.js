// Function to check if an element is in the viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Function to add animation class to elements in viewport
function animateOnScroll() {
    const sections = document.querySelectorAll('.animated-section');
    sections.forEach(section => {
        const bounding = section.getBoundingClientRect();
        if (
            bounding.top <= (window.innerHeight || document.documentElement.clientHeight) - 100 // Adjust the threshold as needed (100 is just an example)
        ) {
            section.classList.add('animated');
        }
    });
}

// Initial triggering of the animation on page load
animateOnScroll();

// Event listener for scroll
document.addEventListener('scroll', animateOnScroll);