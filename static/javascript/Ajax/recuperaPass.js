const input_pass = document.getElementById('email')


document.getElementById('forget-pass').addEventListener('click', () => {
    $.ajax({
        url:"Controller/funcs_ajax/recuperar_pass.php?email=" + input_pass.target.value,
        type:"GET",
        success: response => {
            console.log(response)
        }
    })
});
