var form;
form = document.getElementsByClassName('redirectable-form')[0];
form.setAttribute('action', form.getAttribute('action') + window.location.hash);
