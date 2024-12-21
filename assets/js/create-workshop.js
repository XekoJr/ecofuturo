function validateForm() {
    const title = document.getElementById('workshop-title').value.trim();
    const date = document.getElementById('workshop-date').value.trim();
    const smallDescription = document.getElementById('workshop-small-description').value.trim();
    const description = document.getElementById('workshop-description').value.trim();

    // Check if all fields are filled
    if (!title || !date || !smallDescription || !description) {
        alert('Todos os campos são obrigatórios.');
        return false;
    }

    // Validate date format (yyyy-mm-dd)
    const datePattern = /^\d{4}-\d{2}-\d{2}$/;
    if (!datePattern.test(date)) {
        alert('A data deve estar no formato aaaa-mm-dd.');
        return false;
    }

    // Validate small description length
    if (smallDescription.length < 150 || smallDescription.length > 200) {
        alert('A descrição pequena deve ter entre 150 e 200 caracteres.');
        return false;
    }

    // Validate description length
    if (description.length < 200) {
        alert('A descrição completa deve ter no mínimo 200 caracteres.');
        return false;
    }

    return true;
}