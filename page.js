// Get the current page from the URL parameter
const urlParams = new URLSearchParams(window.location.search);
let currentPage = parseInt(urlParams.get('page')) || 0;

// Event listener for the "Next" button
document.getElementById('prev_button').addEventListener('click', function() {
    // Decrement the current page
    currentPage--;

    // Redirect to index.php with the updated page parameter
    window.location.href = `index.php?page=${currentPage}`;
});

document.getElementById('next_button').addEventListener('click', function() {
    // Increment the current page
    currentPage++;

    // Redirect to index.php with the updated page parameter
    window.location.href = `index.php?page=${currentPage}`;
});