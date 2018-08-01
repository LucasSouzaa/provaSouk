function validForm(){
    var cpf = validateCPF($('input[name=cpf]').val())
    if(!cpf) {
        $('#groupCpf').addClass('has-error')
        return false;
    }else{
        $('#groupCpf').removeClass('has-error')
    }

    var password = validatePassword()

    alert(password);
    if(!password){
        $('#groupPassword').addClass('has-error')
        $('#groupReTypePassword').addClass('has-error')
        return false;
    }else{
        $('#groupPassword').removeClass('has-error')
        $('#groupReTypePassword').removeClass('has-error')
    }

    return true;
}

function validatePassword(){
    return $('#password').val() === $('#retypePassword').val();
}

function validateCPF(strCPF) {
    return true
    strCPF = strCPF.replace(/[\.-]/g, "")
    var sum = 0;
    var remainder;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) sum = sum + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    remainder = (sum * 10) % 11;

    if ((remainder == 10) || (remainder == 11))  remainder = 0;
    if (remainder != parseInt(strCPF.substring(9, 10)) ) return false;

    sum = 0;
    for (i = 1; i <= 10; i++) sum = sum + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    remainder = (sum * 10) % 11;

    if ((remainder == 10) || (remainder == 11))  remainder = 0;
    if (remainder != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}