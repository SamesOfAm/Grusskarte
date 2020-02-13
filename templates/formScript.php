<script>
    let images = document.getElementById('images').children[0].children;
    function selectImage(element) {
        let e = element || event;
        let number = 0;
        if(isNaN(parseInt(e.attributes[2].value))){
            number = e.attributes[1].value;
        } else {
            number = parseInt(e.attributes[2].value);
        }
        document.body.style.background = "url('files/" + customer + "/" + number + ".jpg') no-repeat top left/cover fixed";
        let buttons = document.getElementsByClassName('button');
        for(let i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove('selected');
            buttons[number-1].classList.add('selected');
        }
        let selectOptions = document.querySelector('.imageSelect').querySelector('.imageSelect').children;
        for (let i = 0; i < selectOptions.length; i++) {
            selectOptions[i].setAttribute('selected', 'false');
        }
        selectOptions[number - 1].setAttribute('selected', 'true');
    }

    let backgroundOptions = document.getElementById('select-image').children[0];
    for(let i = 2; i < images.length+1; i++) {
        backgroundOptions.innerHTML += '<li data-option="" data-value="' + i + '" onclick="selectImage(this)" class="button"><span>' + i + '</span></li>';
        let selectOption = document.createElement('option');
        selectOption.value = "img" + i;
        selectOption.text = i.toString();
        selectOption.selected = false;
        document.querySelector('.imageSelect').querySelector('.imageSelect').appendChild(selectOption);
    }

    function showCustomMessage(textarea, option) {
        document.getElementById(textarea).style.display = option.checked === true ? 'block' : 'none';
    }

    function validateEmails(email) {
        let re = /^(([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)(\s*(,)\s*|\s*$))*$/;
        return re.test(String(email).toLowerCase());
    }

    function validateForm() {
        if(document.forms[0].emailRecipient.value === '' || !validateEmails(document.forms[0].emailRecipient.value)) {
            document.forms[0].emailRecipient.style.border = "1px solid red";
        } else {
            return true;
        }
        return false;
    }

    let addCustomMessage = document.querySelector('.addCustomMessage');
    document.querySelector('.formbody').removeChild(addCustomMessage);
    document.querySelector('.generic-text').appendChild(addCustomMessage);

    let companyMessageInput = document.querySelector('.company-message-form').children[0];
    companyMessageInput.style.display = 'none';
    if(document.querySelector('.mod_article').querySelector('.company-message') !== null) {
        companyMessageInput.value = document.querySelector('.company-message').children[0].innerHTML;
    }

    let urlParamInput = document.querySelectorAll('.url-param')[1];
    let emailSenderIfOptIn = document.querySelectorAll('.email-sender')[1];
    let emailRecipientFill = document.querySelectorAll('.email-recipient-fill')[1];
    let emailRecipientFillBcc = document.querySelectorAll('.email-recipient-fill-bcc')[1];
    urlParamInput.style.display = 'none';
    emailSenderIfOptIn.style.display = 'none';
    emailRecipientFill.style.display = 'none';
    emailRecipientFillBcc.style.display = 'none';

    let submitButton = document.querySelector('.widget-submit');
    submitButton.addEventListener('click', function(){
        let image = (Array.prototype.indexOf.call(document.getElementById('select-image').children[0].children, document.getElementById('select-image').children[0].querySelector('.selected')) + 1);
        let customMessage = document.querySelector('.customMessage').querySelector('.customMessage').value;
        let encodedMessage = btoa(customMessage.replace(/\n/g, '\r\n'));
        let emailSender = document.querySelector('.address-sender').querySelector('.address-sender').value;
        let recipientField = document.querySelectorAll('.email-recipient')[1];
        let multipleRecipients = recipientField.value.indexOf(',') !== -1;
        urlParamInput.value = 'img=' + image + '&msg=' + encodedMessage;
        if(document.querySelector('.copyOptIn').querySelector('span').querySelector('input').checked) {
            emailSenderIfOptIn.value = emailSender;
        }
        if(multipleRecipients) {
            emailRecipientFill.value = "weihnachten@grusskarte.online";
            emailRecipientFillBcc.value = recipientField.value;
        } else {
            emailRecipientFill.value = recipientField.value;
        }
    });
    if(document.querySelector('.mod_article').querySelector('.company-message') !== null) {
        let child = document.querySelector('.mod_article').querySelector('.company-message');
        document.querySelector('.mod_article').removeChild(child);
        document.querySelector('.generic-text').insertBefore(child, document.querySelector('.addCustomMessage'));
    } else {
        console.log('No Company Message');
    }

</script>