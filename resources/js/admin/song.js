$(document).ready(function () {
  $('.song-authors-select2').select2({
    closeOnSelect: false,
  });

  $('.song-album-select2').select2();

  $('.song-thumbnail-preview').css('display', 'none');

  $('#thumbnail').change(function (e) {
    $('.open-thumbnail-input').css('box-shadow', 'none');
    const [file] = this.files;
    if (file) {
      $('.song-thumbnail-preview>img').attr('src', URL.createObjectURL(file));
      $('.song-thumbnail-preview').css('display', 'block');
    } else {
      $('.song-thum-bnail-preview').css('display', 'none');
    }
  });

  $('#thumbnail').on('dragover', function () {
    $('.open-thumbnail-input').css('box-shadow', '0px 0px 8px 0px #1ed760');
  });

  $('#thumbnail').on('dragleave', function () {
    $('.open-thumbnail-input').css('box-shadow', 'none');
  });

  $('#song-path').change(function (e) {
    const [file] = this.files;
    if (file) {
      $('.pre-listening').attr('src', URL.createObjectURL(file));
    } else {
      $('.pre-listening').attr('src', '');
    }
  });
});
