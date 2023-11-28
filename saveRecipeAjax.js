function getParameter(p)
{
    var url = window.location.search.substring(1);
    var varUrl = url.split('&');
    for (var i = 0; i < varUrl.length; i++)
    {
        var parameter = varUrl[i].split('=');
        if (parameter[0] == p)
        {
            return parameter[1];
        }
    }
}

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
            $('#recipe_info li.error').remove();
            let li = $('<li>').text("Failed to perform action").addClass('error');
            $('#recipe_info').append(li);
        }
    });
}

$(document).on('click', '#save_button', function (e) {
    let id = getParameter('id');
    let url = 'save_recipe.php'
    submitOnClick({ id: id }, url, function () {
        // Update button text and handle success
        $('#save_button').text('Unsave').attr('id', 'remove_button');

        // Display success message and fade out
        let successMessage = $('<li>').text('Successfully saved').addClass('success');
        $('#recipe_info').append(successMessage);
        successMessage.fadeOut(3000, function () {
            $(this).remove();
        });
    });
});

$(document).on('click', '#remove_button', function (e) {
    let id = getParameter('id');
    let url = 'remove_saved.php'

    submitOnClick({ id: id }, url, function () {
        // Update button text and handle success
        $('#remove_button').text('Save').attr('id', 'save_button');

        // Display success message and fade out
        let successMessage = $('<li>').text('Successfully removed').addClass('success');
        $('#recipe_info').append(successMessage);
        successMessage.fadeOut(3000, function () {
            $(this).remove();
        });
    });
});
