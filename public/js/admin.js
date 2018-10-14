$(document).ready(function() {
  $('#submitEditFormBtn').click(function(){ 
      $('#editBookBtn').trigger('click'); 
  });



});

$(document).ready(function() {
  $('.addcategoryform').select2();

  
});

function selectSubCat(selectObject){
    console.log('ccc', selectObject.value);
    var options = '<option value="">Select SubCategory</option>';
    $('select.book-sub-category')
                .find('option')
                .remove()
                .append(options)
                .attr('required', false);
    if(selectObject.value){
      $.ajax({
        url: "/category/getsubcategory/"+selectObject.value,
        cache: false,
        success: function(response){
          console.log('cat data', response);
          if(response.data && response.data.length > 0){
            
            $.each(response.data, function (key, val) {
               options += '<option value="'+val.id+'">'+val.name+'</option>';
            });
            
            $('select.book-sub-category')
                .find('option')
                .remove()
                .end()
                .append(options)
                .attr('required', true);
          }
        }
      });
    }
  }