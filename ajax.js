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
    error: function(data) { 
      // Some error in ajax call 
      console.log("some Error"); 
    } 
  });
}

$('#register_button').click(function(e) {
  e.preventDefault();
  let form = $('#registerUser');
  let url = form.attr('action');
  let data = form.serialize();
  let redirectUrl = 'index.php';
  submitFormRedirect(data, url, redirectUrl);
});
