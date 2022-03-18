require('./bootstrap');

import { song } from './admin/song';
song()

$('#authors-select').select2({
    tags: true,
});
