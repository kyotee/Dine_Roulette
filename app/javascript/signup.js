function validate(form)
{
    fail = validateUsername(form.username.value)
    fail += validateFirstname(form.firstname.value)
    fail += validateLastname(form.lastname.value)
    fail += validateEmail(form.email.value)
    fail += validatePassword(form.password.value)

    if (fail == "") return true
    else { $('#signup').html(fail); return false }
}

function validateUsername(field)
{
    if (field == "") return "No username was entered.<br>"
    else if (field.length < 5)
        return "Usernames must be at least 5 characters.<br>"
    else if (/[^a-zA-Z0-9_-]/.test(field))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.<br>"
    return ""
}

function validateFirstname(field)
{
    return (field == "") ? "No first name was entered.<br>" : ""
}

function validateLastname(field)
{
    return (field == "") ? "No last name was entered.<br>" : ""
}

function validateEmail(field)
{
    if (field == "") return "No e-mail was entered.<br>"
    else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
        return "The e-mail address is invalid.<br>"
    return ""
}

function validatePassword(field)
{
    if (field == "") return "No password was entered.<br>"
    else if (field.length < 6)
        return "Passwords must be at least 6 characters.<br>"
    else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) || !/[0-9]/.test(field))
        return "Passwords require one each of a-z, A-Z and 0-9.<br>"
    return ""
}