/**
 * Add location hash in attribute action of login form
 * Used when an user is disconnect
 */
var form = document.getElementsByClassName('form-login');
if (form.length === 1) {
    form = form[0];
    form.setAttribute('action', form.getAttribute('action') + window.location.hash);
}
