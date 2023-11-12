function submitFormRedirect(data, url, redirectUrl) {
  $.ajax({
    url: url,
    type: "POST",
    data: data,
    success: function(data) { 
      // Ajax call completed successfully 
      console.log("Form Submited Successfully");
      window.location.href = redirectUrl;
    }, 
    error: function(response) { 
      let errors = response.responseJSON;
      $('#createRecipe ul li.error').remove();
      $.each(errors, function(index, error) {
        let li = $('<li>').text(error).addClass('error');
        $('#createRecipe ul').append(li);
      });
    } 
  });
} 
  
$('#create_button').click(function(e) {
  e.preventDefault();
  let form = $('#createRecipe');
  let url = form.attr('action');
  let data = form.serialize();
  let redirectUrl = 'index.php';
  submitFormRedirect(data, url, redirectUrl);
});
