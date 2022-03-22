import trans from '../trans';
import axios from './axios';

export function song() {
  $(document).ready(function () {
    $('.song-authors-select2').select2({
      closeOnSelect: false,
      tags: true
    });

    $('.song-authors-select2').change(async function (e) {
      let authorIds = $(this).val() ? JSON.stringify($(this).val()) : null;
      let albumDom = `<option value=""> ${trans.__('choose_author')} </option>`;
      if (authorIds) {
        albumDom = `<option value=""> ${trans.__('Choose')} </option>`;
        let res = await axios.get('/api/get-albums-of-authors', {
          'author_id': authorIds
        });
        if (res && res.status === 200) {
          $.each(res.data.albums, function (index, album) {
            albumDom += `<option value='${album.id}'>${album.title}</option>`;
          });
        }
      }

      $('.song-album-select2').html(albumDom);
    })

    $('.song-album-select2').select2({
      tags: true,
      width: '100%',
    });

    $('.song-thumbnail-preview').css('display', 'none');

    $('#thumbnail').change(function (e) {
      $('.open-thumbnail-input').css('box-shadow', 'none');
      const [file] = this.files;
      if (file) {
        $('.song-thumbnail-preview>img').attr('src', URL.createObjectURL(file));
        $('.song-thumbnail-preview').css('display', 'block');
      } else {
        $('.song-thumbnail-preview').css('display', 'none');
        $('.song-thumbnail-preview>img').attr('src', '');
      }
    });

    $('#thumbnail').on('dragover', function () {
      $('.open-thumbnail-input').css('box-shadow', '0px 0px 8px 0px #1ed760');
    });

    $('#thumbnail').on('dragleave', function () {
      $('.open-thumbnail-input').css('box-shadow', 'none');
    });

    $('#song-path').change(async function (e) {
      const [file] = this.files;
      if (file) {
        $('#pre-listening').attr('src', URL.createObjectURL(file));
      } else {
        $('#pre-listening').attr('src', '');
      }
    });

    $('#pre-listening').on('loadedmetadata', function () {
      $('#durations').val(Math.ceil(this.duration));
    });

    $('#thumbnail').change(function (e) {
      $('.open-thumbnail-input').css('box-shadow', 'none');
      const [file] = this.files;
      if (file) {
        $('.edit-song-thumbnail-preview>img').attr('src', URL.createObjectURL(file));
        $('.edit-song-thumbnail-preview').css('display', 'block');
      } else {
        $('.edit-song-thumbnail-preview').css('display', 'none');
        $('.edit-song-thumbnail-preview>img').attr('src', '');
      }
    });
  });
}
