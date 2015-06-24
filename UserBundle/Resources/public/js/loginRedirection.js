var form, forms;
forms = document.getElementsByClassName('redirectable-form');
for (var i= 0; i < forms.length; i++)
{
    form = forms[i];
    form.setAttribute('action', form.getAttribute('action') + window.location.hash);
}
