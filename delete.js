document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('registration_form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        //initalize errors array
        const validationErrors = [];

        // Get form values
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm').value;
        const username = document.getElementById('username').value;
        const address = document.getElementById('address').value;
        const province = document.getElementById('province').value;
        const phone = document.getElementById('phone').value;
        const postal = document.getElementById('postalCode').value;
        const desc = document.getElementById('desc').value;
        const url = document.getElementById('url').value;

        //phone regex
        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        const phoneIsValid = phonePattern.test(phone)
        //postal regex
        const postalPattern = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
        const postalIsValid = postalPattern.test(postal)
        // email regex
        const emailPattern = /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const emailIsValid = emailPattern.test(email)

            //Validation checks
            if (password.length > 250 || confirm.length > 250 || password !== confirm) {
                validationErrors.push('Please make sure both passwords are the same and less than 250 characters\n');
            }
            if (firstname.length > 50 || firstname === "") {
                validationErrors.push('Please enter a first name less than 50 characters in length\n');
            }
            if (lastname.length > 50 || lastname === "") {
                validationErrors.push('Please enter a last name less than 50 characters in length\n');
            }
            if (!emailIsValid || email.length > 100 || email === "") {
                validationErrors.push('Please enter a proper email less than 100 characters in length\n');
            }
            if (address.length > 200 || address === "") {
                validationErrors.push('Please enter an address less than 200 characters in length\n');
            }
            if (province.length > 50 || province === "") {
                validationErrors.push('Please enter a province less than 50 characters in length\n');
            }
            if (username.length > 50 || username === "") {
                validationErrors.push('Please enter a username less than 50 characters in length\n');
            }
            if (desc.length > 50 || desc === "") {
                validationErrors.push('Please enter a description less than 50 characters in length\n');
            }
            if (!phoneIsValid || phone === "") {
                validationErrors.push('Please enter a phone number using format ###-###-####\n');
            }
            if (!postalIsValid || postal === "") {
                validationErrors.push('Please enter a postal code using formats h2t-1b8, h2z 1b8, H2Z1B8\n');
            }

        // Display errors or submit form
        if (validationErrors.length > 0) {
            alert(validationErrors.join(''));
        } else {
            form.submit();
        }
    });
});


