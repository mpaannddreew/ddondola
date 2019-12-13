
window._ = require('lodash');
window.Popper = require('popper.js').default;
window.Moment = require('moment');
window.Collect = require('collect.js');
window.Bloodhound = require('bloodhound-js');
window.Swal = require('sweetalert2');
window.Uuid = require('uuid/v4');
window.FilePond = require('filepond');
window.VueFilePond = require('vue-filepond').default;
window.FilePondPluginImagePreview = require('filepond-plugin-image-preview');
window.FilePondPluginFileValidateType  = require('filepond-plugin-file-validate-type');
window.FilePondPluginImageCrop  = require('filepond-plugin-image-crop');
window.FilePondPluginImageTransform  = require('filepond-plugin-image-transform');
window.FilePondPluginImageEdit  = require('filepond-plugin-image-edit');
window.FilePondPluginFileRename  = require('filepond-plugin-file-rename');

window.DToast = function(type, title) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    Toast.fire({
        type: type,
        title: title
    });
};

let auth = document.head.querySelector('meta[name="auth-state"]');
window.Auth = parseInt(auth.content) === 1;

let seller = document.head.querySelector('meta[name="seller-state"]');
window.Seller = parseInt(seller.content) === 1;

window.Code = document.head.querySelector('meta[name="auth-code"]').content;

/**
 * We'll loading the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');
window.Token = token;
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


window.SearchHeaders = {
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": token.content,
    "Accept": "application/json"
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
});

window.RavePublicKey = process.env.MIX_RAVE_PUBLIC_KEY;
