document.addEventListener("DOMContentLoaded", function() {
    const observerOptions = {
        threshold: 0.2 // Trigger when 20% of the item is visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add a slight delay for each item to get the "one by one" effect
                setTimeout(() => {
                    entry.target.classList.add('active');
                }, index * 150); // 150ms delay between each item

                observer.unobserve(entry.target); // Stop watching once it has appeared
            }
        });
    }, observerOptions);

    // Grab all your items and tell the observer to watch them
    document.querySelectorAll('.products').forEach((item) => {
        observer.observe(item);
    });
    document.querySelectorAll('.upgrade').forEach((item) => {
        observer.observe(item);
    });
    document.querySelectorAll('.footer').forEach((item) => {
        observer.observe(item);
    });
    document.querySelectorAll('.about').forEach((item) => {
        observer.observe(item);
    });

});

