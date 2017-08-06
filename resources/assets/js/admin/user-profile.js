$(document).ready(function() {

  'use strict';

  assignHandlers();

  var currentImg;

  var imgSrc = $('.profile-user-img').attr('src');

  var imgName = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);

  var $croppie = $('.croppie-test').croppie({
    url: 'http://drvodelec/storage/avatars/' + imgName,
    viewport: {
      width: 300,
      height: 300,
      type: 'circle',
    },
    boundary: { 
      width: 500, 
      height: 500 
    },
  });
  // set to the image currently used by croppie
  currentImg = $croppie.find('img').attr('src');
  
  // crop and upload the cropped image          
  function cropImage() {            
    
    $croppie.croppie('result', 'base64').then(function(base64){               
      
      var data = new FormData();

      data.append("image", base64);

      data.append("name", $croppie.find('img').attr('src'));

      $.ajax({
        url: '/admin/api/cropped-img',
        type: 'POST',               
        data: data,
        cache: false,
        processData: false, 
        contentType: false,
      })
      .done(function(response) {

        currentImg = 'http://drvodelec/storage/avatars/' + response;
        
        $('.profile-user-img').attr('src', 'http://drvodelec/storage/avatars/cropped/' + response + '?' + Math.random());


      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      

    });
  };

  // upload selected image as temp
  function uploadImage(image) {

    $('#myModal .modal-content .modal-body i').removeClass('fa-camera').addClass('fa-spin fa-refresh');

    $('#myModal .modal-content .modal-body input[name=image]').attr('type', 'disabled');
    
    var data = new FormData();

    data.append("image", image);
    
    $.ajax({
      url: '/admin/users/avatars',
      type: 'POST',           
      data: data,
      cache: false,
      processData: false, 
      contentType: false,
    })
    .done(function(response) {
      
      $croppie.croppie('bind', {

        url: '/storage/avatars/temp/' + response,
        
      });
      
      $('#cropButton').removeClass('hidden').addClass('visible');

      $('#myModal .modal-content .modal-body i').removeClass('fa-spin fa-refresh').addClass('fa-camera');

      $('#myModal .modal-content .modal-body input[name=image]').attr('type', 'file');

      
      
    })
    .fail(function(response) {
      console.log(response);
    })
    .always(function() {
      console.log("complete");
    });
    
  }

  function assignHandlers() {

    // upload temp avatar image
    $('#myModal input[name=image]').change(function(e) {

      uploadImage(e.target.files[0]);
    });

    // crop image
    $('#cropButton').click(cropImage);

    // on closed modal reset the current croppie image and delete the temp avatar image
    $('#myModal').on('hidden.bs.modal', function (e) {
      
      var avatar = $('#myModal img').attr('src');

      var avatarName = avatar.substring(avatar.lastIndexOf('/') + 1);

      $croppie.croppie('bind', {

        url: currentImg,
        
      });

      // delete temp avatar image
      $.ajax({
        url: '/admin/users/avatars?avatar=' + avatarName,
        type: 'DELETE',                               
        cache: false,
        processData: false, 
        contentType: false,
      })
      .done(function(response) {
        console.log(response);                
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      $('#myModal #cropButton').removeClass('visible').addClass('hidden');

    });
    
    $('#myModal').on('shown.bs.modal', function (e) {

      $croppie.croppie('bind');
      
    });
  }

});