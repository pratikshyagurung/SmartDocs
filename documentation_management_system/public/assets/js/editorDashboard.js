// Theme toggle functionality
const themeToggle = document.getElementById('theme-toggle');
const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

// Check for saved theme preference or use the system preference
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
    document.body.classList.add('dark');
    themeToggle.checked = true;
}

// Listen for toggle changes
themeToggle.addEventListener('change', function() {
    if (this.checked) {
        document.body.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
});

// Number counting animation for cards
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.number');
    const speed = 200;

    counters.forEach(counter => {
        const target = +counter.innerText;
        counter.innerText = '0'; // Reset to 0 before starting animation

        const updateCount = () => {
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = `${Math.ceil(count + increment)}`;
                setTimeout(updateCount, 10); // Adjust timing for smoother animation
            } else {
                counter.innerText = `${target}`;
            }
        };

        updateCount();
    });
});
