

// 
// // Check to see if e-mail isn't blank and is well formed
// Read more at http://www.marketingtechblog.com/javascript-regex-emailaddress/#ixzz1p1ZDMNZe
var filter;
filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})$/;
//filter = /^([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})$/i;


// Validate the login form
function FormLoginValidator(theForm) {
    // Check to see if name isn't blank
    if (theForm.name.value === "") {
        alert("You must enter a VALID name.");
        theForm.name.focus();
        return false;
    }

    if (theForm.password.value === "") {
        alert('Please provide a VALID password');
        theForm.password.focus();
        return false;
    }
    return true;
}

function FormRegistrationValidator(theForm, regexUsername, regexPassword, regexEmail) {
    if (!regexUsername.test(theForm.username.value)) {
        alert("You must enter a VALID usename.\n\
            - Username must contain 5 letters or numbers: \n");

        theForm.username.focus();
        return false;
    }
    var passwordVal = regexPassword.test(theForm.password.value);
    if (!passwordVal) {
        alert("You must enter a VALID password.\n\
           Password must contain the following: \n\
                - A lowercase letter\n\
                - A capital (uppercase) letter\n\
                - A number\n\
                - Minimum 8 characters");
        theForm.password.focus();
        return false;
    }
    if (theForm.avatar.value === "") {
        alert("You must select an avatar.");
        theForm.avatar.focus();
        return false;
    }

    if (!regexEmail.test(theForm.email.value))
    {
        alert("You have entered an invalid email address!");
        theForm.email.focus();
        return false;
    } else {
        return true;
    }
}

var xmlHttp;
function GetXmlHttpObject() {
    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    } // Internet Explorer
    try {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
    } // Internet Explorer
    try {
        return new XMLHttpRequest();
    } catch (e) {
    } // Firefox, Opera 8.0+, Safari
    alert("XMLHttpRequest not supported");
    return null;
}

