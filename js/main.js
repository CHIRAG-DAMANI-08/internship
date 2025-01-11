document.addEventListener('DOMContentLoaded', function() {
    // Filter buttons functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            // Fetch filtered content via AJAX
            fetchFilteredContent(this.textContent.toLowerCase());
        });
    });
    
    // Search functionality
    const searchIcon = document.querySelector('.search-icon');
    let searchOpen = false;
    
    searchIcon.addEventListener('click', function() {
        if (!searchOpen) {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'search-input';
            searchInput.placeholder = 'Search...';
            
            this.prepend(searchInput);
            searchInput.focus();
            searchOpen = true;
        }
    });
    
    // Infinite scroll implementation
    let loading = false;
    
    window.addEventListener('scroll', () => {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1000) {
            if (!loading) {
                loading = true;
                loadMoreContent();
            }
        }
    });
});

function fetchFilteredContent(filter) {
    fetch(`includes/fetch_articles.php?filter=${filter}`)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content-grid').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}

function loadMoreContent() {
    // Implementation for infinite scroll
    fetch('includes/fetch_articles.php?page=' + currentPage)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.content-grid').insertAdjacentHTML('beforeend', html);
            loading = false;
        })
        .catch(error => {
            console.error('Error:', error);
            loading = false;
        });
} 