// Get the current page from the URL parameter
const urlParams = new URLSearchParams(window.location.search);
let currentPage = parseInt(urlParams.get('page')) || 0;

// Event listener for the "Next" button
$('#prev_button').click(function() {
    // Decrement the current page
    currentPage--;

    // Redirect to index.php with the updated page parameter
    window.location.href = `index.php?page=${currentPage}`;
});

$('#next_button').click(function() {
    // Increment the current page
    currentPage++;

    // Redirect to index.php with the updated page parameter
    window.location.href = `index.php?page=${currentPage}`;
});


