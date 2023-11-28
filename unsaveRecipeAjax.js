function submitOnClick(data, url, successCallback) {
    $.ajax({
        url: url,
        type: "GET",
        data: data,
        success: function(data) {
            // Ajax call completed successfully
            console.log("Button Submitted Successfully");
            successCallback();
        },
        error: function(response) {
            $('#recipes li.error').remove();
            let li = $('<li>').text("Failed to unsave recipe").addClass('error');
            $('#recipes').append(li);
        }
    });
}

$(document).on('click', '#remove_button', function (e) {
    let id = $(this).data('recipe-id');
    let url = 'remove_saved.php'

    submitOnClick({ id: id }, url, function () {
        // Delete associated container
        $('#' + id).remove();

        // Display success message and fade out
        let successMessage = $('<li>').text('Successfully removed').addClass('success');
        $('#recipes').append(successMessage);
        successMessage.fadeOut(3000, function () {
            $(this).remove();
        });
    });
});
