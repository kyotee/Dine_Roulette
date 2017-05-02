function validate1(form)
{
    fail = validateUsername1(form.username.value)
    fail += validatePassword1(form.password.value)

    if (fail == "") return true
    else { $('#login').html(fail); return false }
}

function validateUsername1(field)
{
    if (field == "") return "No username was entered.<br>"
    return ""
}

function validatePassword1(field)
{
    if (field == "") return "No password was entered.<br>"
    return ""
}