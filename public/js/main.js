// Función para confirmar eliminación
function confirmarEliminacion(event) {
    if (!confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
        event.preventDefault();
    }
}


document.addEventListener('DOMContentLoaded', function() {
    // Agregar confirmación a todos los botones de eliminación
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', confirmarEliminacion);
    });
    
    
    const togglePwdLogin = document.getElementById('togglePasswordLogin');
    if (togglePwdLogin) {
        togglePwdLogin.addEventListener('click', function() {
            const input = document.getElementById('passwordLogin');
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = '🙈';
                } else {
                    input.type = 'password';
                    this.textContent = '👁️';
                }
            }
        });
    }

    
    const togglePwdReg = document.getElementById('togglePasswordRegister');
    if (togglePwdReg) {
        togglePwdReg.addEventListener('click', function() {
            const input = document.getElementById('passwordRegister');
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = '🙈';
                } else {
                    input.type = 'password';
                    this.textContent = '👁️';
                }
            }
        });
    }
});