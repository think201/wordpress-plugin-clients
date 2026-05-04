/******* Jquery No Conflict Function *******/
window.$ = jQuery.noConflict();

var CTForm = {

  settings:
  {
    formObj  : null,
  },

  post: function(FormId, isUpdate)
  {    
    CTForm.settings.formObj = $(FormId);

    if(Validator.check(CTForm.settings.formObj) == false)
    {
        return false;
    }

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: CTForm.settings.formObj.serialize(),
      success: function(data, status) 
      {
        if (data.status == true) 
        {
          $('.ct_success_msg p').html(data.msg);
          $('.ct_success_msg').fadeIn(1000).siblings('.ct-msg').hide();
          
          if(!isUpdate)
          {
            $(FormId)[0].reset();  
          }
          
        } 
        else 
        {
          $('.ct_error_msg p').html(data.msg);
          $('.ct_error_msg').fadeIn(1000).siblings('.ct-msg').hide();
        }
      },
      error: function() 
      {
        $('.ct_error_msg p').html(data.msg);
        $('.ct_error_msg').fadeIn(1000).siblings('.ct-msg').hide();
      }                        
    }); 
  }
};

var Upload = {
 
    init: function(ButtonId, InputId) {
    var custom_uploader;
 
 
    $('#upload_logo').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: "Choose Client's Logo",
            button: {
                text: 'Choose Logo'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#logo').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
    }
};
 
var Validator = {

    init: function()
    {

    },

    check: function(FormObj)
    {
        return FormObj.validator('checkform', FormObj);
    },

    set: function(FormId)
    {
        $(FormId+' input').validator({events   : 'blur change'});
    },

};

var CTCreateShortCode = {
  settings:
  {
      shortcodeHolder : $('#shortcode-holder'),
      formObj : null
  },

  post: function(FormId)
  {    
    CTCreateShortCode.settings.formObj = $(FormId);

    if(Validator.check(CTCreateShortCode.settings.formObj) == false)
    {
        return false;
    }

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: CTCreateShortCode.settings.formObj.serialize(),
      success: function(data, status) 
      {
        if (data.status == true) 
        {
          $('.ct_success_msg p').html(data.msg);
          $('.ct_success_msg').fadeIn(1000).siblings('.ct-msg').hide();
          CTCreateShortCode.settings.shortcodeHolder.html(data.shortcode)
        } 
        else 
        {
          $('.ct_error_msg p').html(data.msg);
          $('.ct_error_msg').fadeIn(1000).siblings('.ct-msg').hide();
        }
      },
      error: function() 
      {
        $('.ct_error_msg p').html(data.msg);
        $('.ct_error_msg').fadeIn(1000).siblings('.ct-msg').hide();
      }                        
    }); 
  }
};
 
$(function() {
    Upload.init();

    Validator.set('#ct_add_form');

});
