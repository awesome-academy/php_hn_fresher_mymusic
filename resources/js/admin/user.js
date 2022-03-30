import trans from '../trans';
import axios from './axios';

async function blockUser(e) {
    let el = e.target;
    e.preventDefault();
    if (confirm(trans.__('Block user confirmation'))) {
        let id = el.getAttribute('data-user-id');
        let res = await axios.put(`/admin/users/${id}/block`);
        if (res && res.status === 200) {
            el.checked = false;
        } else if (res && res.response && res.response.data) {
            toastr.error(res.response.data.error);
        } else {
            toastr.error(trans.__('have_error'))
        }
    }
}

async function unblockUser(e) {
    let el = e.target;
    e.preventDefault();
    if (confirm(trans.__('Unblock user confirmation'))) {
        let id = el.getAttribute('data-user-id');
        let res = await axios.put(`/admin/users/${id}/unblock`);
        if (res && res.status === 200) {
            el.checked = true;
        } else if (res && res.response && res.response.data) {
            toastr.error(res.response.data.error);
        } else {
            toastr.error(trans.__('have_error'))
        }
    }
}

export default { blockUser, unblockUser }
