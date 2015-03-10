var form;
forms = document.getElementsByClassName('redirectable-form');
if (forms.length) {
    form = forms[0];
    form.setAttribute('action', form.getAttribute('action') + window.location.hash);
}
