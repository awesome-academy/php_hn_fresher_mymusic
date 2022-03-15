require('./bootstrap');
require('./admin/song')

$('#authors-select').select2({
    tags: true,
});
require('./music-player');
