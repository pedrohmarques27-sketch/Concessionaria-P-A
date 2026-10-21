// Máscaras: CPF e telefone se formatam enquanto a pessoa digita
        const mascara = (id, formatar) => {
            const campo = document.getElementById(id);
            campo.addEventListener('input', () => {
                campo.value = formatar(campo.value.replace(/\D/g, ''));
            });
        };

        mascara('cpf', v => v.slice(0, 11)
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2'));

        mascara('telefone', v => v.slice(0, 11)
            .replace(/^(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{5})(\d{1,4})$/, '$1-$2'));