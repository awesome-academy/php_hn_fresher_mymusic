require('./bootstrap');

import { song } from './admin/song';
import user from './admin/user';
song()

$('#authors-select').select2({
    tags: true,
});

$('.admin-user-table .user-manage').click(async function (e) {
    if (e.target.checked) {
        await user.unblockUser(e);
    } else {
        await user.blockUser(e);
    }
});
