<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            color: #333;
            padding: 20px;
        }
        .cadastro-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin-top: 20px;
        }
        .cadastro-container h1 {
            margin-bottom: 25px;
            font-size: 1.8rem;
            color: #007BFF;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: #555;
            display: inline-block;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            border-color: #e91e63;
            outline: none;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .form-group button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-group button:active {
            transform: translateY(0);
        }
        .button.cancel button {
            width: 100%;
            padding: 12px;
            background-color: #e91e63;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button.cancel button:hover {
            background-color: #c2185b;
            transform: translateY(-2px);
        }
        .button.cancel button:active {
            transform: translateY(0);
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            body {
                height: auto;
                padding: 10px;
            }
            .cadastro-container {
                padding: 20px 15px;
            }
            .cadastro-container h1 {
                font-size: 1.5rem;
            }
            .form-group input {
                padding: 10px;
            }
            .form-group button {
                padding: 10px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .cadastro-container {
                width: 100%;
                max-width: 100%;
                padding: 15px 10px;
            }
            .cadastro-container h1 {
                font-size: 1.4rem;
            }
            .form-group input {
                padding: 8px;
            }
            .form-group button {
                padding: 8px;
                font-size : 0.85rem;
            }
        }

        /* Mensagem de confirmação */
        .confirmacao {
            display: none;
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h1>Cadastro de Usuário</h1>
        <form id="formCadastro" action="../Controller/rota.php?acao=cadastrarUsuario" method="POST">
            <div class="form-group">
                <label for="nome_usuario">Nome:</label>
                <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite o nome completo" required>
            </div>
            <div class="form-group">
                <label for="email_usuario">Email:</label>
                <input type="email" name="email_usuario" id="email_usuario" placeholder="Digite o e-mail" required>
            </div>
            <div class="form-group">
                <label for="cpf_usuario">CPF:</label>
                <input type="text" name="cpf_usuario" id="cpf_usuario" maxlength="14" placeholder="000.000.000-00" required>
            </div>
            <div class="form-group">
                <label for="contato_usuario">Contato:</label>
                <input type="text" name="contato_usuario" id="contato_usuario" placeholder="(00) 0 0000-0000" required>
            </div>
            <div class="form-group">
                <label for="senha_usuario">Senha:</label>
                <input type="password" name="senha_usuario" id="senha_usuario" placeholder="Digite a senha" required>
            </div>
            <div class="form-group">
                <label for="data_nasc_usuario">Data de Nascimento:</label>
                <input type="date" name="data_nasc_usuario" id="data_nasc_usuario" required>
            </div>
            <div class="form-group">
                <label for="setor_usuario">Setor:</label>
                <input type="text" name="setor_usuario" id="setor_usuario" placeholder="Setor de atuação" required>
            </div>
            <div class="form-group">
                <label for="cargo_usuario">Cargo:</label>
                <input type="text" name="cargo_usuario" id="cargo_usuario" placeholder="Cargo do usuário" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
            <div class="button cancel">
                <button id="voltarButton" onclick="history.back()">Voltar</button>
</form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formCadastro');
            const nomeInput = document.getElementById('nome_usuario');
            const cpfInput = document.getElementById('cpf_usuario');
            const telefoneInput = document.getElementById('contato_usuario');
            const dataNascimentoInput = document.getElementById('data_nasc_usuario');

            // Validação do campo "Nome" (sem números)
            nomeInput.addEventListener('input', function() {
                nomeInput.value = nomeInput.value.replace(/[0-9]/g, '');
            });

            // Validação e formatação do CPF
            cpfInput.addEventListener('input', function() {
                let value = cpfInput.value.replace(/\D/g, '');
                value = value.replace(/(\d{3})(\d)/, '$1.$2')
                             .replace(/(\d{3})(\d)/, '$1.$2')
                             .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                cpfInput.value = value;
            });

            // Validação do campo "Contato" (apenas números no formato (00) 0 0000-0000)
            telefoneInput.addEventListener('input', function() {
                let value = telefoneInput.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                if (value.length > 2) value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                if (value.length > 7) value = value.replace(/^(\(\d{2}\) \d)(\d{4})(\d{4})$/, '$1 $2-$3');
                telefoneInput.value = value;
            });

            // Validação da data de nascimento (18 anos e não futuro)
            dataNascimentoInput.addEventListener('input', function() {
                const today = new Date();
                const birthDate = new Date(dataNascimentoInput.value);
                let age = today.getFullYear() - birthDate.getFullYear();
                const month = today.getMonth() - birthDate.getMonth();

                if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                if (age < 18 || birthDate > today) {
                    alert('Data de nascimento inválida. O usuário deve ter pelo menos 18 anos e a data não pode estar no futuro.');
                    dataNascimentoInput.value = '';
                }
            });

            // Exibir mensagem de confirmação ao enviar o formulário
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Impede o envio para exibir a mensagem primeiro
                alert('Usuário cadastrado com sucesso!');
                form.submit(); // Envia o formulário após a confirmação
            });
        });
    </script>
</body>
</html>

